<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{



    public function add_user()
    {
        $data['page'] = 'users';
        $data['user'] = Auth::user();
        $data['pending_blogs_count'] = Blog::where('status',1)
        ->where('is_confirmed',0)->count();

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
        $data['pending_blogs_count'] = Blog::where('status',1)
        ->where('is_confirmed',0)->count();

        $data['getRecord'] = User::getSingle($id);
        return view('Management_pages.user.edit', $data);
    }

    public function update_user(Request $request, $id)
    {
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

        // eğer şifre verisi gelirse değiştir gelmezse aynı kalsın
        $save = User::getSingle($id);
        $save->name = trim($request->name);
        $save->email = trim($request->email);
        if (!empty($request->password)) {
            $save->password = Hash::make($request->password);
        }
        $save->status = trim($request->status);
        $is_saved = $save->save();

        if ($is_saved) {
            return redirect()->route('users')->with('success', 'User updates successfully!');
        } else {
            return redirect()->back()->with('error', 'User could not updated!');
        }
    }

    public function delete_user(Request $request)
    {

        try {
            $save = User::find($request->user_id);
            $save->is_delete = 1;
            $save->save();
            return response()->json(['success' => true]);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => $exception->getMessage()], 500);
        }
    }


    public function AccountSetting()
    {

        $data['page'] = 'users';
        $data['user'] = Auth::user();
        $data['pending_blogs_count'] = Blog::where('status',1)
        ->where('is_confirmed',0)->count();

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
