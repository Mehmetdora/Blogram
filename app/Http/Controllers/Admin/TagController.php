<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function tag_deleted(Request $request){

        try {
            $save = Tag::find($request->tag_id);
            $save->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => $exception->getMessage()], 500);
        }

    }

    public function tag_added(Request $request){
        try {
            $tag = new Tag();
            $tag->name = $request->tag_name;
            $tag->save();

            return response()->json(['success' => true]);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => $exception->getMessage()], 500);
        }
    }
}
