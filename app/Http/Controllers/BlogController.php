<?php

namespace App\Http\Controllers;


use DomDocument;
use App\Models\Tag;
use App\Models\Blog;
use App\Models\User;
use Mockery\Exception;
use App\Models\Comment;
use App\Models\Profile;
use App\Models\Category;
use App\Models\BlogPhoto;
use App\Models\SiteSetting;
use Illuminate\Support\Str;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Services\ProfanityService;
use Mews\Purifier\Facades\Purifier;
use App\Services\WordCounterService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Intervention\Image\Facades\Image;
use function Symfony\Component\String\b;
use Illuminate\Support\Facades\Validator;




class BlogController extends Controller
{

    protected $profanityService;
    protected $total_word_count;
    // Controller yapıcısında ProfanityService'i enjekte etme
    public function __construct(ProfanityService $profanityService,WordCounterService $wordcounter)
    {
        $this->profanityService = $profanityService;
        $this->total_word_count = $wordcounter;
    }


    public function create()
    {
        $data['categories'] = Category::where('is_delete', 0)->where('status', 1)->get();
        $user_id = Auth::user()->id;
        // Önce profili bul ama user üzerinde bulmada id kullanarak bul
        //for içinde ilişkili olduğu categorileri dön ve işlemlerini yap
        $user = User::with('categories')->find($user_id);
        $user_categories = $user->categories;
        foreach ($user_categories as $category) {
            $category->blogs_count = Blog::where('category_id', $category->id)
                ->where('status', 1) // Sadece aktif olanlar
                ->where('is_confirmed',1)
                ->count();
        }
        $data['user_categories'] = $user_categories;

        $data['notifications'] = $user->notifications()->where('status',true)->orderBy('created_at','desc')->take(10)->get();
        $data['notifications_count'] = Auth::user()->notifications()->whereNull('read_at')->count();
        $tags = Tag::all();
        $tag_names = [];
        foreach ($tags as $tag) {
            $tag_names[] = $tag->name;
        }
        $data['tags'] = $tag_names;
        $data['site_setting'] = SiteSetting::first();


        return view('Authenticated_pages.createBlog', $data);
    }




    public function store(Request $request)
    {

        $validatedData = Validator::make($request->all(), [
            'summery' => 'required|max:255 ',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'title' => 'required | max:80',
            'category_id' => 'required',
            'description' => 'required',
        ]);


        if ($validatedData->fails()) {
            // Hata mesajlarını alın
            $errors = $validatedData->errors()->all(); // istersek laravelin kendi hatam mesajını da gönderebiliriz
            // E-posta veya şifrenin hatalı olduğunu belirten özel bir hata mesajı oluşturun
            $errorMessage = 'Girilen email veya şifre formatı hatalı!';
            // Hata mesajlarını kullanıcıya gösterin
            return redirect()->back()->with('error', $errors);
        }


        if($request->tags){
            // Parse Tags
            $jsonData = $request->input('tags');
            // JSON verisini diziye çeviriyoruz
            $parsedData = json_decode($jsonData, true);
            $values = array_map(function ($item) {
                return $item['value'];
            }, $parsedData);

            // Şimdi $values dizisinde ["css", "html", "javascript", "ABSYS", "A# .NET", "ACC"] değerleri bulunur

            $saved_tags_id = [];
            foreach($values as $tag_name){
                $tag = Tag::where('name', $tag_name)->firstOrNew();
                $tag->name = $tag_name;
                $tag->save();
                $saved_tags_id[] = $tag->id;
            }
        }

        // MİN_TO_READ CALCULATOR
        $word_counter = new WordCounterService;
        $total_word_count = $word_counter->countWordsInParagraphs($request->description);
        $wordsPerMinute = 250; // Ortalama okuma hızı
        $minToRead = ($total_word_count != 0) ? ($total_word_count/$wordsPerMinute) : 0 ;
        $minToRead = ($minToRead<1) ? 0 : $minToRead; //eğer mintoread 0 dan az ise 0, büyükse kendi değeri



        $blog = new Blog();
        $blog->status = 1;
        $blog->title = request('title');
        $blog->summery = request('summery');
        $blog->category_id = request('category_id');
        $blog->user_id = Auth::user()->id;
        $blog->like_count = 0;
        $blog->save_count = 0;
        $blog->comment_count = 0;
        $blog->min_to_read = $minToRead;




        $description = $request->input('description');
        $dom = new DOMDocument();
        $dom->loadHTML('<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">' . $description, 9);

        $body = $dom->getElementsByTagName('body')->item(0);
        $description_text = $body ? $body->textContent : '';

        $images = $dom->getElementsByTagName('img');
        $file_path = "/blog_images/description_photos/";
        $image_names = [];
        $max_image_size_in_mb = 4; // Maksimum resim boyutu (MB cinsinden)
        $max_image_size_in_bytes = $max_image_size_in_mb * 1024 * 1024; // Byte cinsinden

        foreach ($images as $key => $img) {

            $base64_str = explode(',', explode(';', $img->getAttribute('src'))[1])[1];

            // Base64 string'in boyutunu hesapla
            $image_size_in_bytes = (strlen($base64_str) * 3 / 4) - substr_count($base64_str, '=');

            // Eğer resim boyutu limitten büyükse hata döndür
            if ($image_size_in_bytes > $max_image_size_in_bytes) {
                return back()->with('error','Resim boyutu çok büyük. Maksimum ' . $max_image_size_in_mb . ' MB olabilir.');
            }

            $data = base64_decode($base64_str);
            $image_name = time() . '_' . uniqid() . '.png';

            // Dosyayı Kaydetme
            $directory = public_path($file_path);
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true); // Eksik klasörleri oluşturur.
            }
            $image_names[] = $image_name;
            file_put_contents(public_path($file_path) . $image_name, $data);

            $img->removeAttribute('src');
            $img->setAttribute('src', $file_path . $image_name);
        }
        $description = $dom->saveHTML();
        $blog->description = $description;


        // cover photo kaydetme
        $file_path = public_path('/blog_images/cover_photos/');
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '.png';
            $file->move($file_path, $filename);
            $blog->cover_photo = $filename;
        } else {
            return redirect()->back()->with('error', 'Cover photo must be upload!');
        }

        $blog->save();

        // Blog ile bağlantılı bir modelde resimlerin isimlerini tut ve gerektiğinde bu model üzerinden işlemler yap
        foreach ($image_names as $image_name) {
            $new_image = new BlogPhoto();
            $new_image->blog_id = $blog->id;
            $new_image->image_name = $image_name;
            $new_image->save();
        }

        $user = Auth::user();
        $user->blogs()->save($blog);
        $request->tags && $blog->tags()->syncWithoutDetaching($saved_tags_id);// verilen array içindeki id'ler ile eğer ye




        // gizli zararlı yazılımları bulma
        $domm = new DOMDocument();
        $sonuc = false;
        @$domm->loadHTML($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $forbiddenTags = ['script'];
        foreach ($forbiddenTags as $tag) {
            $elements = $domm->getElementsByTagName($tag);
            if ($elements->length > 0) {
                $sonuc = true; // İstenmeyen etiket bulunursa true döner
            }
        }
        if ($sonuc) {
            $blog->is_confirmed = false;
            $blog->save();
            return redirect()->back()->with('error','İçerikte bazı istenmeyen kullanımlar tespit edildi.Admin tarafından incelenmek içn beklemeye alındı!');
        }


        if ($this->profanityService->containsProfanity($description_text)) {
            $blog->is_confirmed = false;
            $blog->save();
            return redirect()->route('home')->with('error' , 'Uygunsuz kelimeler tespit edildi! Admin tarafından onaylanması için beklemeye alınmıştır. Onaylandıktan sonra paylaşıma alınacaktı.');
        }
        if ($this->profanityService->containsProfanity($blog->summery)) {
            $blog->is_confirmed = false;
            $blog->save();
            return redirect()->route('home')->with('error' , 'Uygunsuz kelimeler tespit edildi! Admin tarafından onaylanması için beklemeye alınmıştır. Onaylandıktan sonra paylaşıma alınacaktı.');
        }
        if ($this->profanityService->containsProfanity($blog->title)) {
            $blog->is_confirmed = false;
            $blog->save();
            return redirect()->route('home')->with('error' , 'Uygunsuz kelimeler tespit edildi! Admin tarafından onaylanması için beklemeye alınmıştır. Onaylandıktan sonra paylaşıma alınacaktı.');
        }

        // Eğer her şey doğru olursa cache blog verilerini sil

        $total_blog_count = Blog::where('status',1)
        ->where('is_confirmed',1)
        ->count();
        $page_count = ceil($total_blog_count/8); // Her sayfa 8 blog içerdiği için

        for ($i=1; $i<=$page_count ; $i++) {
            Cache::forget("blogs_page_{$i}");
        }

        return redirect()->route('home');
    }




    public function show_blogs($blog_id)
    {

        $blog = Blog::where('id', $blog_id)
        ->where('status', 1)
        ->where('is_confirmed',1)
        ->first();

        //dd($blog->description);

        if (!$blog) {
            return redirect()->back()->with('error', 'Blog Bulunamadı!');
        }
        $data['blog'] = $blog;

        $user_id = Auth::user()->id;
        // Önce profili bul ama user üzerinde bulmada id kullanarak bul
        //for içinde ilişkili olduğu categorileri dön ve işlemlerini yap
        $user = User::with('categories')->find($user_id);
        $user_categories = $user->categories;
        foreach ($user_categories as $category) {
            $category->blogs_count = Blog::where('category_id', $category->id)
                ->where('status', 1) // Sadece aktif olanlar
                ->where('is_confirmed',1)
                ->count();
        }
        $data['user_categories'] = $user_categories;

        if ($user->liked_blogs->where('id', $blog_id)->first() == null) { // Eğer kullanıcını beğendiği bloğlar arasında bu id li bloğ yok ise
            $data['is_liked'] = 0;  // bunu kullanarak like butonunu değiştir
        } else {
            $data['is_liked'] = 1;
        }

        if ($user->saved_blogs()->where('blog_id', $blog->id)->first() == null) { // Eğer kullanıcını beğendiği bloğlar arasında bu id li bloğ yok ise
            $data['is_saved'] = 0;  // bunu kullanarak save butonunu değiştir
        } else {
            $data['is_saved'] = 1;
        }



        $data['categories'] = Category::where('is_delete', 0)->where('status', 1)->get();
        $data['comments'] = Comment::with('user')->where('blog_id', $blog_id)
            ->where('status', 1)
            ->orderBy('created_at', 'desc')->get();

        $data['notifications'] = $user->notifications()->where('status',true)->orderBy('created_at','desc')->take(10)->get();
        $data['notifications_count'] = $user->notifications->whereNull('read_at')->count();
        $data['site_setting'] = SiteSetting::first();



        return view('Authenticated_pages.blogs.show', $data);
    }





    public function edit($blog_id)
    {   $blog = Blog::find($blog_id);
        $data['blog'] = $blog;
        $data['selected_category'] = Category::find($data['blog']->category_id);

        $user_id = Auth::user()->id;
        // Önce profili bul ama user üzerinde bulmada id kullanarak bul
        //for içinde ilişkili olduğu categorileri dön ve işlemlerini yap
        $user = User::with('categories')->find($user_id);
        $user_categories = $user->categories;
        foreach ($user_categories as $category) {
            $category->blogs_count = Blog::where('category_id', $category->id)
                ->where('status', 1) // Sadece aktif olanlar
                ->where('is_confirmed',1)
                ->count();
        }
        $data['user_categories'] = $user_categories;

        $data['categories'] = Category::where('is_delete', 0)->where('status', 1)->get();
        $data['notifications'] = $user->notifications()->where('status',true)->orderBy('created_at','desc')->take(10)->get();
        $data['notifications_count'] = Auth::user()->notifications()->whereNull('read_at')->count();

        $selected_tags = [];    // Seçilmiş tagler
        foreach($blog->tags as $tag){
            $selected_tags[] = $tag->name;
        }

        $tags = Tag::all();
        $tag_names = [];
        foreach ($tags as $tag) {
            $tag_names[] = $tag->name;
        }

        $data['selected_tags'] = $selected_tags;
        $data['tags'] = $tag_names;
        $data['site_setting'] = SiteSetting::first();

        return view('Authenticated_pages.myBlogs.edit', $data);
    }

    public function edited(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'title' => 'required | max:80',
            'summery' => 'required|max:255 ',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000|nullable',
            'blog_id' => 'required',
            'category_id' => 'required',
            'description' => 'required',
        ]);
        if ($validatedData->fails()) {
            $errors = $validatedData->errors()->all();
            return redirect()->back()->with('error', $errors);
        }




        // Parse Tags
        $jsonData = $request->input('tags');
        $saved_tags_id = [];
        $blog = Blog::find($request->blog_id);
        if(isset($jsonData)){// eğer tag eklenmişse kaydetme
            // JSON verisini diziye çeviriyoruz
            $parsedData = json_decode($jsonData, true);
            $values = array_map(function ($item) {
                return $item['value'];
            }, $parsedData);

            // Şimdi $values dizisinde ["css", "html", "javascript", "ABSYS", "A# .NET", "ACC"] değerleri bulunur

            $saved_tags = $blog->tags->pluck('name')->toArray();

            if ($values === $saved_tags) {

            }else{
                $blog->tags()->detach();

                foreach($values as $tag_name){
                    if ($this->profanityService->containsProfanity($tag_name)) {
                        return redirect()->back()->with('error' , 'Eklediğiniz tag ismi uygunsuz! Lütfen uygun bir tag ismi kullanınız.');
                    }

                    $tag = Tag::where('name', $tag_name)->firstOrNew();
                    $tag->name = $tag_name;
                    $tag->save();
                    $saved_tags_id[] = $tag->id;
                }
            }
        }
        $word_counter = new WordCounterService;
        $total_word_count = $word_counter->countWordsInParagraphs($request->description);
        $wordsPerMinute = 250; // Ortalama okuma hızı
        $minToRead = ($total_word_count != 0) ? ($total_word_count/$wordsPerMinute) : 0 ;
        $minToRead = ($minToRead<1) ? 0 : (int)$minToRead; //eğer mintoread 0 dan az ise 0, büyükse kendi değeri


        $blog->min_to_read = $minToRead;
        $blog->status = 1;
        $blog->title = request('title');
        $blog->summery = request('summery');
        $blog->category_id = request('category_id');
        $blog->user_id = Auth::user()->id;

        $description = $request->input('description');

        $dom = new DOMDocument();
        $dom->loadHTML( $description, 9);

        $body = $dom->getElementsByTagName('body')->item(0);
        $description_text = $body ? $body->textContent : '';

        $images = $dom->getElementsByTagName('img');
        $file_path = "/blog_images/description_photos/";
        $image_names = [];
        $max_image_size_in_mb = 4; // Maksimum resim boyutu (MB cinsinden)
        $max_image_size_in_bytes = $max_image_size_in_mb * 1024 * 1024; // Byte cinsinden


        foreach ($images as $key => $img) {
            $src = $img->getAttribute('src');
            echo $src;

            if (strpos($src, 'base64') !== false) {
                // base64 formatında olup olmadığını kontrol et
                $src_parts = explode(',', $src);

                if (isset($src_parts[1])) {

                    // Base64 string'in boyutunu hesapla
                    $image_size_in_bytes = (strlen($src_parts[1]) * 3 / 4) - substr_count($src_parts[1], '=');

                    // Eğer resim boyutu limitten büyükse hata döndür
                    if ($image_size_in_bytes > $max_image_size_in_bytes) {
                        return back()->with('error','Yeni yüklenen resim boyutu çok büyük. Maksimum ' . $max_image_size_in_mb . ' MB olabilir.');
                    }

                    $data = base64_decode($src_parts[1]);
                    $image_name = time() . '_' . uniqid() . '.png';

                    // Yüklenen resimlerin isimlerini bir array a kaydet
                    $image_names[] = $image_name;

                    // Dosyayı Kaydetme
                    $directory = public_path($file_path);
                    if (!file_exists($directory)) {
                        mkdir($directory, 0755, true); // Eksik klasörleri oluşturur.
                    }
                    file_put_contents(public_path('blog_images/description_photos/' . $image_name), $data);

                    $img->removeAttribute('src');
                    $img->setAttribute('src', $file_path . $image_name);
                } else {
                    dd(' base64 işlemleri sırasında hatalı');
                }
            } // URL olup olmadığını kontrol et
            elseif (dirname($src) == '/blog_images/description_photos') {
                $image_name = basename($src);
                $image_data = file_get_contents(public_path($src));

                if ($image_data) {
                    // Yüklenen resimlerin isimlerini bir array'e kaydet
                    $image_names[] = $image_name;

                    $img->removeAttribute('src');
                    $img->setAttribute('src', $file_path . $image_name);
                } else {
                    dd('Resim URL\'si geçersiz veya indirilemedi.');
                }
                continue;
            }
            // Eğer src bir yerel dosya yoluysa kontrol et
            elseif (file_exists(public_path($src))) {
                // Dosya varsa, işleme gerek yok, olduğu gibi bırak

                $image_names[] = basename($src);
                dd(basename($src));
                continue;
            } else {
                return redirect()->back()->with('error','This images are not suitable! Please try with another photos :)');
            }
        }


        $zaten_kayıtlı_images = [];
        foreach ($blog->images as $image) {   // veritabanında kayıtlı resim gelen resimler arasındaysa geç, arasında değilse sil
            if (in_array($image->image_name, $image_names)) {
                $zaten_kayıtlı_images[] = $image->image_name;
                continue;
            } else {
                if (file_exists(public_path('blog_images/description_photos/') . $image->image_name)) {
                    unlink(public_path('blog_images/description_photos/') . $image->image_name);
                } else {
                    dd("yolu --" . public_path('blog_images/description_photos/' . $image->image_name) . "-- olan dosya veritabanında yokkk");
                }
                $image->delete();
            }
        }

        $description = $dom->saveHTML();
        $blog->description = $description;

                    if (count($image_names) == 0) {   // hiç foto yüklenmemişse
            if (isset($blog->images)) {
                foreach ($blog->images as $kayıtlı_image) {
                    $kayıtlı_image->delete();
                }
            }
        } else {
            foreach ($image_names as $new_image) {
                if (!(in_array($new_image, $zaten_kayıtlı_images))) {
                    $new_image_blog = new BlogPhoto();
                    $new_image_blog->image_name = $new_image;
                    $new_image_blog->blog_id = $blog->id;
                    $new_image_blog->save();
                }
            }
        }

        // EĞER YENİ COVER PHOTO GELİRSE KAYDET YOKSA GEÇ
        $file_path = public_path('/blog_images/cover_photos/');
        $old_cover_photo = $blog->cover_photo;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '.png';
            $file->move($file_path, $filename);

            if ($old_cover_photo && file_exists(public_path('blog_images/cover_photos/' . $old_cover_photo))) {        // FOTOĞRAF DEĞİŞİNCE ESKİ FOTOĞRAFI SİLİYORUZ
                unlink(public_path('blog_images/cover_photos/' . $old_cover_photo));  // unlink ile fotoğraf silinir
            }
            $blog->cover_photo = $filename;
        }

        $user = Auth::user();
        $isSaved = $user->blogs()->save($blog);
        $blog->tags()->syncWithoutDetaching($saved_tags_id);



        $domm = new DOMDocument();
        $sonuc = false;
        @$domm->loadHTML($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $forbiddenTags = ['script', 'iframe'];
        foreach ($forbiddenTags as $tag) {
            $elements = $domm->getElementsByTagName($tag);
            if ($elements->length > 0) {
                $sonuc = true; // İstenmeyen etiket bulunursa true döner
            }
        }
        if ($sonuc) {
            $blog->is_confirmed = false;
            $blog->save();
            return redirect()->back()->with('error','İçerikte bazı istenmeyen kullanımlar tespit edildi.Admin tarafından incelenmek içn beklemeye alındı!');
        }

        // Blogların içeriğini kontrol etme
        if ($this->profanityService->containsProfanity($description_text)) {
            $blog->is_confirmed = false;
            $blog->save();
            return redirect()->route('profile.show')->with('error' , ' description Uygunsuz kelimeler tespit edildi! Admin tarafından onaylanması için beklemeye alınmıştır. Onaylandıktan sonra paylaşıma alınacaktı.');
        }
        if ($this->profanityService->containsProfanity($blog->summery)) {
            $blog->is_confirmed = false;
            $blog->save();
            return redirect()->route('profile.show')->with('error' , 'summery Uygunsuz kelimeler tespit edildi! Admin tarafından onaylanması için beklemeye alınmıştır. Onaylandıktan sonra paylaşıma alınacaktı.');
        }
        if ($this->profanityService->containsProfanity($blog->title)) {
            $blog->is_confirmed = false;
            $blog->save();
            return redirect()->route('profile.show')->with('error' , 'title Uygunsuz kelimeler tespit edildi! Admin tarafından onaylanması için beklemeye alınmıştır. Onaylandıktan sonra paylaşıma alınacaktı.');
        }

        $total_blog_count = Blog::where('status',1)
        ->where('is_confirmed',1)
        ->count();
        $page_count = ceil($total_blog_count/8); // Her sayfa 8 blog içerdiği için

        for ($i=1; $i<=$page_count ; $i++) {
            Cache::forget("blogs_page_{$i}");
        }

        if ($isSaved) {
            return redirect()->route('profile.show')->with('success', 'Blog updated successfully');
        } else {
            return redirect()->back()->with('error', 'Error while updating the blog!');
        }
    }



    public function delete(Request $request)
    {
        try {
            $blog = Blog::find($request->blog_id);
            $blog->status = 0;
            unlink(public_path('blog_images/cover_photos/').$blog->cover_photo);
            if (isset($blog->images)) {
                foreach ($blog->images as $image) {
                    unlink(public_path('blog_images/description_photos/') . $image->image_name);
                    $image->delete();
                }
            }
            foreach($blog->comments as $comment) {
                $comment->delete();
            }
            $isSaved = $blog->save();
            $notifications = Notification::where('mentioned_id', $blog->id)
            ->where('type','like')
            ->get();
            foreach ($notifications as $notification) {
                $notification->status = false;
                $notification->save();
            }

            if ($isSaved) {
                return response()->json(['success' => true]);
            }
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => $exception->getMessage()], 500);
        }
    }



    public function liked(Request $request)
    {
        try{
            $blogId = $request->input('blog_id');
            $isLike = $request->input('is_like');

            $begenilmisMi = 0;


            $blog = Blog::with('user')->where('id', $blogId)->where('status', 1)->first();
            if (!$blog) {
                return response()->json(['success' => false, 'message' => 'Blog not found']);
            }
            $user = User::find(Auth::user()->id);

            if ($isLike) {
                $begenilmisMi = $blog->liked_users->where('user_id', $user->id)->first();
                if ($begenilmisMi == null) {
                    if ($blog->user_id == $user->id) { // kendi bloğu ise beğenemez
                        return response()->json(['success' => false, 'message' => 'You cannot like own blogs']);
                    } else {
                        $blog->liked_users()->syncWithoutDetaching($user);
                        $blog->like_count += 1;
                        $begenilmisMi = 1;

                        // NEW NOTIFICATION
                        $notification = new Notification();
                        $notification->receiver_id = $blog->user->id;
                        $notification->sender_id = $user->id;
                        $notification->type = 'like';
                        $notification->title = 'LIKED';
                        $notification->mentioned_id = $blog->id;
                        $notification->content = ' liked your blog';
                        $notification->url = route('blogs.show', $blog->id);
                        $blog->user->notifications()->save($notification);
                    }
                }
            } else {
                $blog->like_count -= 1;
                $blog->liked_users()->detach($user);
                $begenilmisMi = 0;
            }

            $blog->save();

            return response()->json(['success' => true]);
        }catch(Exception $e){
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }

    }


    public function saved(Request $request)
    {
        try{

            $blogId = $request->input('blog_id');
            $isSaved = $request->input('is_saved');

            $kayıtlıMı = 0;


            $blog = Blog::with('user')
            ->where('id', $blogId)
            ->where('status', 1)
            ->first();

            if (!$blog) {
                return response()->json(['success' => false, 'message' => 'Blog not found']);
            }
            $user = Auth::user();

            if ($isSaved) {
                $kayıtlıMı = $blog->savedBy_users->where('user_id', $user->id)->first();
                if ($kayıtlıMı == null) {
                    if ($blog->user_id == $user->id) { // kendi bloğu ise kaydedemez
                        return response()->json(['success' => false, 'message' => 'You cannot save own blogs']);
                    } else {
                        $blog->savedBy_users()->syncWithoutDetaching($user);
                        $blog->save_count += 1;
                        $kayıtlıMı = 1;

                        // NEW NOTIFICATION
                        $notification = new Notification();
                        $notification->receiver_id = $blog->user->id;
                        $notification->sender_id = $user->id;
                        $notification->type = 'save';
                        $notification->title = 'SAVED';
                        $notification->mentioned_id = $blog->id;
                        $notification->content = ' saved your blog';
                        $notification->url = route('blogs.show', $blog->id);
                        $blog->user->notifications()->save($notification);
                    }
                }
            } else {
                $blog->save_count -= 1;
                $blog->savedBy_users()->detach($user);
                $kayıtlıMı = 0;
            }

            $blog->save();

            return response()->json(['success' => true]);
        }catch(Exception $e){
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }

    }


}
