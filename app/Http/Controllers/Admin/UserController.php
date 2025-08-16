<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Error;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\error;

class UserController extends Controller
{



    public function add_user()
    {
        $data['page'] = 'users';
        $data['user'] = Auth::user();
        $data['pending_blogs_count'] = Blog::where('status', 1)
            ->where('is_confirmed', 0)->count();

        return view('Management_pages.user.add', $data);
    }

    public function insert_user(Request $request)
    {

        $validatedData = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
        ]);
        if ($validatedData->fails()) {
            // Hata mesajlarını alın
            $errors = $validatedData->errors()->all(); // istersek laravelin kendi hatam mesajını da gönderebiliriz
            // E-posta veya şifrenin hatalı olduğunu belirten özel bir hata mesajı oluşturun
            $errorMessage = 'Girilen email veya şifre formatı hatalı!';
            // Hata mesajlarını kullanıcıya gösterin
            return redirect()->back()->with('error', $errors);
        }

        $save = new User;
        $save->name = trim($request->name);
        $save->email = trim($request->email);
        $save->password = Hash::make($request->password);
        $save->status = trim($request->status);
        $save->gender = 1;
        $is_saved = $save->save();

        if ($is_saved) {
            return redirect()->route('users')->with('success', 'User created successfully!');
        } else {
            return redirect()->back()->with('error', 'User could not created!');
        }
    }

    public function edit_user($id)
    {

        $data['page'] = 'users';
        $data['user'] = Auth::user();
        $data['pending_blogs_count'] = Blog::where('status', 1)
            ->where('is_confirmed', 0)->count();

        $data['getRecord'] = User::getSingle($id);
        return view('Management_pages.user.edit', $data);
    }

    public function update_user(Request $request, $id)
    {
        try {
            $validatedData = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|max:255|unique:users,email,' . $id,
            ]);
            if ($validatedData->fails()) {
                // Hata mesajlarını alın
                $errors = $validatedData->errors()->all(); // istersek laravelin kendi hatam mesajını da gönderebiliriz
                // E-posta veya şifrenin hatalı olduğunu belirten özel bir hata mesajı oluşturun
                $errorMessage = 'Girilen email veya şifre formatı hatalı!';
                // Hata mesajlarını kullanıcıya gösterin
                return redirect()->back()->with('error', $errors);
            }
            $user_name = $request->name;
            $user_email = $request->email;
            $user_is_active = (int)$request->status;
            $user_id = (int)$id;

            // eğer şifre verisi gelirse değiştir gelmezse aynı kalsın
            $user = User::getSingle($user_id);
            $user->name = trim($user_name);
            $user->email = trim($user_email);
            if (!empty($request->password)) {
                $user->password = Hash::make($request->password);
            }

            $user->status = $user_is_active;
            $user->save();

            return redirect()->route('users')->with('success', 'User updates successfully!');
        } catch (\Throwable $err) {
            return redirect()->back()->with("error", "Kullanıcı güncellemesi sırasında hata oluştu: " . $err);
        }
    }

    public function delete_user(Request $request)
    {
        request()->validate([
            "user_id" =>  "required"
        ]);

        try {
            $user = User::find($request->user_id);

            if (!$user) {
                return response()->json(['success' => false, 'message' => 'Kullanıcı Bulunamadı! Lütfen sayfayı yenileyin veya verileri kontrol ediniz.'], 500);
            }

            $blogs = $user->blogs;
            $comments = $user->comments;
            $notifications = $user->notifications;
            $categories = $user->categories;
            $profile = $user->profile;
            $liked_blogs = $user->liked_blogs;
            $saved_blogs = $user->saved_blogs;

            $oldUserPicture = $user->photo;
            if ($user->photo && file_exists(public_path('uploads/') . $user->photo)) {
                if ($oldUserPicture != 'Default_pfp_women.png' && $oldUserPicture != 'Default_pfp.jpg') { // default resim kontrolü değilse sil

                    $directory = public_path('uploads/') . $oldUserPicture;
                    if (file_exists($directory)) {
                        unlink(public_path('uploads/') . $oldUserPicture);  // unlink ile fotoğraf silinir
                    }
                }
            }


            if (isset($notifications)) {
                foreach ($notifications as $notification) {
                    $notification->delete();
                }
            }

            foreach ($blogs as $blog) {

                if (isset($blog->tags)) {
                    $blog->tags()->detach();
                }

                // blog resimleri varsa sil
                if (!empty($blog->images)) {
                    foreach ($blog->images as $image) {

                        $directory = public_path('blog_images/description_photos/') . $image->image_name;
                        if (file_exists($directory)) {
                            unlink(public_path('blog_images/description_photos/') . $image->image_name);
                        }
                        $image->delete();
                    }
                }

                // cover photo varsa sil
                if (!empty($blog->cover_photo)) {
                    $directory = public_path('blog_images/cover_photos/') . $blog->cover_photo;
                    if (file_exists($directory)) {
                        unlink(public_path('blog_images/cover_photos/') . $blog->cover_photo);
                    }
                }

                // blog u sil
                $blog->delete();
            }

            if (isset($comments)) {
                foreach ($comments as $comment) {
                    $comment->delete();
                }
            }

            if (isset($categories)) {
                $user->categories()->detach();
            }

            if ($profile) {
                $profile->delete();
            }


            if (isset($liked_blogs)) {
                $user->liked_blogs()->detach();
            }

            if (isset($saved_blogs)) {
                $user->saved_blogs()->detach();
            }

            $username = $user->name;
            $user->delete();

            return response()->json(['success' => true, 'message' => $username], 200);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => $exception->getMessage()], 500);
        }
    }


    public function AccountSetting()
    {

        $data['page'] = 'users';
        $data['user'] = Auth::user();
        $data['pending_blogs_count'] = Blog::where('status', 1)
            ->where('is_confirmed', 0)->count();

        $data['getUser'] = User::getSingle(Auth::user()->id);
        return view('Management_pages.profile.account_settings', $data);
    }

    public function UpdateAccountSetting(Request $request)
    {

        $getUser = User::getSingle(Auth::user()->id);
        $getUser->name = $request->name;

        if (!empty($request->file('profile_pic'))) {    // Eğer fotoğraf gelirse güncelleme yap

            if (!empty($getUser->photo) && file_exists('uploads/' . $getUser->photo)) {
                unlink('uploads/' . $getUser->photo);
            }

            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $filename = Str::random(20) . '.' . $ext;
            $file->move('uploads/', $filename);
            $getUser->photo = $filename;
        }

        $getUser->save();

        return redirect()->back()->with('success', 'Account settings updated successfully');
    }
}
