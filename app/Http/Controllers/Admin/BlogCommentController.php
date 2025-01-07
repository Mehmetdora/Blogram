<?php

namespace App\Http\Controllers\Admin;

use DOMDocument;
use App\Models\Blog;
use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use App\Models\BlogPhoto;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BlogCommentController extends Controller
{
    //
    public function add_blog(){
        $data['categories'] = Category::where('is_delete', 0)->where('status', 1)->get();

        $data['page'] = 'blogs_comments';
        $data['user'] = Auth::user();
        $data['pending_blogs_count'] = Blog::where('status',1)
        ->where('is_confirmed',0)->count();

        return view("Management_pages.blog.add",$data);
    }
    public function added_blog(Request $request){

        $validatedData = Validator::make($request->all(), [
            'summery' => 'required|max:300 ',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
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

        $blog = new Blog();
        $blog->status = 1;
        $blog->title = request('title');
        $blog->summery = request('summery');
        $blog->category_id = request('category_id');
        $blog->user_id = Auth::user()->id;
        $blog->like_count = 0;
        $blog->comment_count = 0;

        $description = $request->description;
        $dom = new DOMDocument();
        $dom->loadHTML($description, 9);

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

            // Yüklenen resimlerin isimlerini bir array a kaydet
            $image_names[] = $image_name;
            // Dosyayı Kaydetme
            $directory = public_path($file_path);
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true); // Eksik klasörleri oluşturur.
            }
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
        return redirect()->route('blogs_comments');

    }



    public function edit_blog($id){
        $blog = Blog::find($id);

        $data['blog'] = $blog;
        $data['categories'] = Category::where('is_delete', 0)->where('status', 1)->get();

        $data['page'] = 'blogs_comments';
        $data['user'] = Auth::user();
        $data['pending_blogs_count'] = Blog::where('status',1)
        ->where('is_confirmed',0)->count();

        return view('Management_pages.blog.edit', $data);
    }
    public function edited_blog(Request $request){
        $validatedData = Validator::make($request->all(), [
            'title' => 'required | max:80',
            'summery' => 'required|max:300 ',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000|nullable',
            'blog_id' => 'required',
            'category_id' => 'required',
            'description' => 'required',
        ]);
        if ($validatedData->fails()) {
            $errors = $validatedData->errors()->all();
            return redirect()->back()->with('error', $errors);
        }

        $blog = Blog::find($request->blog_id);
        $blog->status = 1;
        $blog->title = request('title');
        $blog->summery = request('summery');
        $blog->category_id = request('category_id');


        $description = $request->description;
        $dom = new DOMDocument();
        $dom->loadHTML($description, 9);
        $images = $dom->getElementsByTagName('img');
        $file_path = "/blog_images/description_photos/";
        $image_names = [];
        $max_image_size_in_mb = 4; // Maksimum resim boyutu (MB cinsinden)
        $max_image_size_in_bytes = $max_image_size_in_mb * 1024 * 1024; // Byte cinsinden


        foreach ($images as $key => $img) {
            $src = $img->getAttribute('src');

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

                    file_put_contents(public_path('blog_images/description_photos/' . $image_name), $data);

                    $img->removeAttribute('src');
                    $img->setAttribute('src', $file_path . $image_name);
                } else {
                    return redirect()->back()->with('error', 'Error while updating the blog!');
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
                    return redirect()->back()->with('error', 'Error while updating the blog!');
                }
                continue;
            }
            // Eğer src bir yerel dosya yoluysa kontrol et
            elseif (file_exists(public_path($src))) {
                // Dosya varsa, işleme gerek yok, olduğu gibi bırak

                $image_names[] = basename($src);
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

        if ($isSaved) {

            // NEW NOTIFICATION
            $notification = new Notification();
            $notification->receiver_id = $blog->user->id;
            $notification->sender_id = $admin->id;
            $notification->type = 'edited';
            $notification->title = 'YOUR BLOG IS EDITED';
            $notification->mentioned_id = $blog->id;
            $notification->content = ' is edited your blog: '.$blog->title;
            $notification->url = route('blogs.show', $blog->id);
            $blog->user->notifications()->save($notification);

            return redirect()->route('detail-blog',$blog->id)->with('success', 'Blog updated successfully');
        } else {
            return redirect()->back()->with('error', 'Error while updating the blog!');
        }
    }

    public function delete_blog(Request $request){
        try {
            $blog = Blog::find($request->blog_id);
            if ($blog) {
                $blog->status = 0;
                if(isset($blog->comments)){
                    foreach ($blog->comments as $comment) {
                        $comment->status = 0;

                        // NEW NOTIFICATION
                        $notification = new Notification();
                        $notification->receiver_id = $blog->user->id;
                        $notification->sender_id = $admin->id;
                        $notification->type = 'deleted';
                        $notification->title = 'YOUR BLOG IS DELETED';
                        $notification->mentioned_id = $blog->id;
                        $notification->content = ' deleted your blog: '.$blog->title;
                        $notification->url = route('blogs.show', $blog->id);
                        $blog->user->notifications()->save($notification);

                        $comment->save();
                    }
                }
            }
            $isSaved = $blog->save();
            if ($isSaved) {
                return response()->json(['success' => true]);
            }
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => $exception->getMessage()], 500);
        }
    }



    public function detail_blog($id){

        $data['page'] = 'blogs_comments';
        $data['user'] = Auth::user();
        $data['pending_blogs_count'] = Blog::where('status',1)
        ->where('is_confirmed',0)->count();

        $data['blog'] = Blog::where('id', $id)
        ->where('status', 1)
        ->first();
        $data['comments'] = Comment::where('blog_id', $id)
            ->where('status', 1)
            ->orderBy('created_at', 'desc')->get();

        return view('Management_pages.blog.detail_blog', $data);
    }

    public function delete_comment(Request $request){
        try {
            $comment_id = $request->comment_id;
            $comment = Comment::find($comment_id);
            $comment->status = 0;
            $isSaved = $comment->save();
                if ($isSaved) {
                    return response()->json(['success' => true]);
                }
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => $exception->getMessage()], 500);
        }
    }


    public function list_user_blog($id){
        $data['blogs_owner'] = User::where('id', $id)->first();
        $data['page'] = 'blogs_comments';
        $data['user'] = Auth::user();
        $data['pending_blogs_count'] = Blog::where('status',1)
        ->where('is_confirmed',0)->count();

        $data['blogs'] = Blog::where('user_id', $id)
        ->where('status', 1)
        ->where('is_confirmed',1)
        ->orderBy('created_at','desc')->paginate(12);

        return view('Management_pages.blog.list_user_blog', $data);
    }




    public function search_blog(Request $request)
{
    if($request->ajax()) {

        if(isset($request->user_id )) {     // belli bir user_id için arama user üzerine tıklandığında
            $data = Blog::where('status', 1)
                    ->where('is_confirmed',1)
                    ->where('user_id', $request->user_id)
                    ->where(function ($query) use ($request) {
                        $query->Where('title', 'like', '%' . $request->search . '%')
                            ->orWhere('summery', 'like', '%' . $request->search . '%');
                    })->get();
        }else{
            $data = Blog::where('status', 1)    // bütün bloglar arasından arama
                        ->where('is_confirmed',1)
                        ->where(function ($query) use ($request) {
                        $query->where('id', 'like', '%' . $request->search . '%')
                            ->orWhere('title', 'like', '%' . $request->search . '%')
                            ->orWhere('summery', 'like', '%' . $request->search . '%')
                            ->orWhere('description', 'like', '%' . $request->search . '%');
                    })->get();

        }


        $output = '';

        if(count($data) > 0) {
            foreach($data as $blog) {


                $output .= '
                    <div class="col-lg-3 mb-3" style="background-color:whitesmoke; margin:5px; border-radius:7px;">
                        <div class="post-entry-alt">
                            <a href="' . route('detail-blog', $blog->id) . '" class="img-link">
                                <img style="height: 200px; margin-top:10px;" src="' . asset('blog_images/cover_photos/' . $blog->cover_photo) . '" alt="Image" class="img-fluid">
                            </a>
                            <div class="excerpt">
                                <h2><a href="' . route('detail-blog', $blog->id) . '">' . $blog->title . '</a></h2>
                                <div class="post-meta align-items-center text-left clearfix">
                                    <figure class="author-figure mb-0 me-3 float-start">';

                if ($blog->user->photo) {
                    $output .= '<img src="' . asset('uploads/' . $blog->user->photo) . '" class="img-fluid" alt="Author Image">';
                } else {
                    $output .= '<img src="/img/Default_pfp.jpg" class="img-fluid" alt="Author Image">';
                }

                $output .= '</figure>
                                    <span class="d-inline-block mt-1">By <a href="' . route('list-user-blog', $blog->user->id) . '">' . $blog->get_blog_user($blog)->name . '</a></span>
                                    <span>&nbsp;-&nbsp;' . $blog->created_at->diffForHumans() . '</span>
                                </div>
                                <p>' . $blog->summery . '</p>
                                <p><a href="' . route('detail-blog', $blog->id) . '" class="read-more">More Info</a></p>
                            </div>
                        </div>
                    </div>';
            }
        } else {
            $output .= 'No results';
        }

        return $output;
    }
}

}
