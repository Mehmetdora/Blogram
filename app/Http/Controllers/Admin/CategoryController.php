<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    public function add_category()
    {

        $data['page'] = 'categories';
        $data['user'] = Auth::user();
        $data['pending_blogs_count'] = Blog::where('status',1)
        ->where('is_confirmed',0)->count();

        return view('Management_pages.category.add', $data);
    }

    public function insert_category(Request $request)
    {

        $save = new Category();
        $save->name =              trim($request->name);
        //$save->slug =              trim(Str::slug($request->name));
        //$save->title =             trim($request->title);
        //$save->meta_title =        trim ($request->meta_title);
        //$save->meta_description =  trim ($request->meta_description);
        //$save->meta_keywords =     trim ($request->meta_keywords);
        $save->status =            trim($request->status);
        //$save->is_menu =           trim($request->is_menu);
        $save->save();

        return redirect()->route('categories')->with('success', 'Category created successfully');
    }

    public function edit_category($id)
    {
        $data['page'] = 'categories';
        $data['user'] = Auth::user();
        $data['pending_blogs_count'] = Blog::where('status',1)
        ->where('is_confirmed',0)->count();

        $data['getRecord'] = Category::find($id);
        return view('Management_pages.category.edit', $data);
    }

    public function update_category(Request $request, $id)
    {
        $save = Category::find($id);
        $save->name =             trim($request->name);
        //$save->slug =             trim(Str::slug($request->name));
        //$save->title =            trim($request->title);
        //$save->meta_title =       trim ($request->meta_title);
        //$save->meta_description = trim ($request->meta_description);
        //$save->meta_keywords =    trim ($request->meta_keywords);
        $save->status =           trim($request->status);
        //$save->is_menu =          trim($request->is_menu);
        $save->save();

        return redirect()->route('categories')->with('success', 'Category updated successfully');
    }

    public function delete_category(Request $request)
    {
        try {
            $save = Category::find($request->category_id);
            $save->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => $exception->getMessage()], 500);
        }

    }
}
