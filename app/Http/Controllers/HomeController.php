<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use App\Models\Profile;
use App\Models\Category;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isEmpty;

class HomeController extends Controller
{
    public function home()
    {

        // HER SEFERİNDE SAYFA YENİLENDİKTEN SONRA 10 SANİYE BOYUNCA VERİYİ CACHE'DE TUTUYOR
        // 10 SANİYE İÇİNDE BİR İSTEK ATILIRSA VE AYNI SORGU YAPILIRSA DB'YE GİTMEDEN CACHE'DEN VERİYİ ALIYOR
        // 10 SANİYEDEN SONRA BİR İSTEK GELİRSE TEKRAR DB DEN VERİYİ ÇEKİP CACHE KAYDEDİP 10 SANİYE BOYUNCA TUTUYOR
        // !!! BU 10 SANİYE İÇİNDE YAPILAN HER SORGU İÇİN CACHE VERİSİ KULLANILIR(ASIL VERİ DEĞİŞSE BİLE)



        $site_set = SiteSetting::first();
        $data['site_setting'] = $site_set;


        // VERİLERİ PAGİNATE İLE GÖSTERDİĞİMİZ İÇİN AYNI ŞEKİLDE CACHE'E DE HER SAYFA İÇİN AYRI OLARAK KAYDETMELİYİZ
        //VERİLER REMEMBER İLE VARSA CACHE'DEN GETİRİLİYOR YOKSA DB'DEN GELİR
        $page = request()->get('page', 1); // Varsayılan olarak 1. sayfa
        $data['blogs'] = Cache::remember("blogs_page_{$page}", now()->addSeconds(30), function () {
            return Blog::where('status', 1)
                ->where('is_confirmed', 1)
                ->orderBy('created_at', 'desc')
                ->with('tags')
                ->paginate(8);
        });




        $data['categories'] = Cache::remember('categories',now()->addSeconds(30), function() {
            return Category::where('is_delete',0)->where('status',1)->get();
        });


        if($site_set->editors_pick_blog_id){
            $data['editors_blog'] = Blog::where('status',1)
            ->where('is_confirmed',1)
            ->where('id',$site_set->editors_pick_blog_id)
            ->first();
        }else{
            $data['editors_blog'] = Blog::where('status',1)
        ->where('is_confirmed',1)
        ->inRandomOrder()
        ->first();
        }



        $data['trend_blogs'] = Cache::remember('trend_blogs',now()->addSeconds(30), function() {
            return Blog::where('status',1)
            ->where('is_confirmed',1)
            ->orderBy('like_count','desc')
            ->take(3)
            ->get();
        });


        $data['populer_post'] = Cache::remember('populer_post',now()->addSeconds(30), function() {
            return Blog::where('status',1)
            ->where('is_confirmed',1)
            ->orderBy('comment_count','desc')
            ->first();
        });


        $data['populer_users'] = Cache::remember('populer_users',now()->addSeconds(30), function() {
            return User::where('status',0)
            ->where('is_delete',0)
            ->inRandomOrder()
            ->take(3)
            ->get();  // status 0 aktif
        });

        $user_id = Auth::id();
        $user = User::with('categories')->find($user_id);
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
        $data['notifications_count'] = $user->notifications->where('status',1)->whereNull('read_at')->count();


        $data['user_categories'] = $user_categories;


        return view('Authenticated_pages.home',$data);
    }

    public function show_blogs($id)
    {
        $data['site_setting'] = SiteSetting::first();

        $data['blogs'] = Blog::where('category_id',$id)
        ->where('is_confirmed',1)
        ->where('status',1)
        ->orderby('created_at','desc')
        ->paginate(6);

        $data['categories'] = Category::where('is_delete',0)->where('status',1)->get();
        $selected = Category::find($id);



        $data['populer_users'] = User::where('status',0)
        ->inRandomOrder()
        ->take(3)
        ->get();  // status 0 aktif


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
        $data['selectedCategory'] = $selected;
        $user_categories_ids[] = $user->categories->pluck('id')->toArray();
        $buttonText = "";
        if (in_array($selected->id,$user_categories_ids[0])){
            $buttonText = '✓';
        }else{
            $buttonText  = 'ADD';
        }
        $data['buttonText'] = $buttonText;
        $data['notifications'] = $user->notifications()->where('status',true)->orderBy('created_at','desc')->take(10)->get();
        $data['notifications_count'] = $user->notifications->where('status',1)->whereNull('read_at')->count();


        return view('Authenticated_pages.blogs_of_category',$data);
    }

    public function create_profile()
    {
        $data['site_setting'] = SiteSetting::first();

        return view('Authenticated_pages.createProfile',$data);
    }

    public function store_profile(Request $request)
    {

        $validatedData = Validator::make($request->all(), [
            'profile_name'=>'required | max:20',
            'skills' => 'nullable | max:100',
            'photo' => 'image|mimes:jpeg,png,JPEG,JPG,jpg,gif,svg|max:10000|nullable',
            'gender'=>'required',
        ]);


        if ($validatedData->fails()) {
            // Hata mesajlarını alın
            $errors = $validatedData->errors()->all(); // istersek laravelin kendi hatam mesajını da gönderebiliriz

            // E-posta veya şifrenin hatalı olduğunu belirten özel bir hata mesajı oluşturun
            $errorMessage = 'Girilen email veya şifre formatı hatalı!';

            // Hata mesajlarını kullanıcıya gösterin
            return redirect()->back()->with('error',$errors);
        }


        $user = Auth::user();
        $profile = New Profile;
        $profile->profile_name = $request->profile_name;
        $user->gender = $request->gender;
        $profile->status = true;
        $profile->user_id = $user->id;

        $user = Auth::user();
        $user->bio = $request->bio;
        $user->skill = $request->skills;

        $file_path = public_path('uploads');
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalName();
            $file->move($file_path, $filename);
            $user->photo = $filename;
        }else{// gender 1 : kadın, 0:erkek
            $user->photo = $request->gender ? 'Default_pfp_women.png':'Default_pfp.jpg';
        }
        $user->save();
        $profile->save();

        Auth::user()->profile()->save($profile);

        return  redirect()->route('category.select');
    }



    public function select_category(){
        $data['site_setting'] = SiteSetting::first();
        $data['categories'] = Category::where('is_delete',0)->where('status',1)->get();
        return view('Authenticated_pages.selectCategory',$data);
    }
    public function selected_category(Request $request)
    {
        $categories = $request->selectedCategories;
        $categories = array_map('intval', explode(',', $categories)); // string parçalama

        if (count($categories) < 3){
            return redirect()->back()->with('error','En az 3 kategori seçmeniz gerekli');
        }
        $user = Auth::user();
        $user->categories()->syncWithoutDetaching($categories);
        return  redirect()->route('home');
    }

    public function myCategory_deleted(Request $request)
    {
        try {
            $category = Category::find($request->category_id);
            $user = Auth::user();
            $user->categories()->detach($category->id);
            return response()->json(['success' => true]);
        }catch (\Exception $exception){
            return response()->json(['success' => false, 'message' => $exception->getMessage()], 500);
        }
    }
    public function myCategory_added(Request $request)
    {
        try {
            $category = Category::find($request->category_id);
            $user = Auth::user();
            $user->categories()->syncWithoutDetaching($category);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function add_more_categories(){
        $user = Auth::user();
        $user = User::with('categories')->find($user->id);
        $user_categories = $user->categories;
        foreach ($user_categories as $category) {
            $category->blogs_count = Blog::where('category_id', $category->id)
                ->where('status', 1) // Sadece aktif olanlar
                ->where('is_confirmed',1)
                ->count();
        }
        $data['user_categories'] = $user_categories;
        $data['site_setting'] = SiteSetting::first();

        $data['notifications'] = $user->notifications()->where('status',true)->orderBy('created_at','desc')->take(10)->get();
        $data['notifications_count'] = $user->notifications->where('status',1)->whereNull('read_at')->count();
        $data['categories'] = Category::where('is_delete',0)->where('status',1)->get();
        return view('Authenticated_pages.Add_category',$data);
    }

    public function added_more_categories(Request $request){

        $categories = array_map('intval', explode(',', $request->selectedCategories)); // string parçalama
        $user = Auth::user();

        foreach ($user->categories as $category){
            if(!in_array($category->id, $categories)){
                $user->categories()->detach($category->id);
            }
        }

        if(!is_null($request->selectedCategories)){
            $user->categories()->syncWithoutDetaching($categories);
        }

        return redirect()->route('home');
    }

    public function show_notifications(){

        $user_id = Auth::user()->id;
        $user = User::with('categories')->find($user_id);
        $user_categories = $user->categories;
        foreach ($user_categories as $category) {
            $category->blogs_count = Blog::where('category_id', $category->id)
                ->where('status', 1) // Sadece aktif olanlar
                ->where('is_confirmed',1)
                ->count();
        }
        $data['user_categories'] = $user_categories;
        $data['site_setting'] = SiteSetting::first();

        $data['categories'] = Category::where('is_delete',0)->where('status',1)->get();
        $data['notifications'] = $user->notifications()->where('status',true)->orderBy('created_at','desc')->take(10)->get();
        $data['notifications_count'] = $user->notifications->where('status',1)->whereNull('read_at')->count();
        $all_notifications = $user->notifications()->where('status',true)->orderBy('created_at','desc')->paginate(15);

        $data['all_notifications'] = $all_notifications;

        return view('Authenticated_pages.notifications',$data);
    }

    public function users_all(){
        $user_id = Auth::user()->id;
        $user = User::with('categories')->find($user_id);
        $user_categories = $user->categories;
        foreach ($user_categories as $category) {
            $category->blogs_count = Blog::where('category_id', $category->id)
                ->where('status', 1) // Sadece aktif olanlar
                ->where('is_confirmed',1)
                ->count();
        }
        $data['user_categories'] = $user_categories;
        $data['site_setting'] = SiteSetting::first();

        $data['notifications'] = $user->notifications()->where('status',true)->orderBy('created_at','desc')->take(10)->get();
        $data['notifications_count'] = $user->notifications->where('status',1)->whereNull('read_at')->count();
        $data['users_all'] = User::where('is_admin',false)
        ->where('status',false)
        ->where('is_delete',false)
        ->whereHas('profile')   // profil oluşturmuş kullanıcıları listele
        ->orderBy('created_at','desc')
        ->take(12)
        ->get();


        return view('Authenticated_pages.users_all',$data);


    }


}
