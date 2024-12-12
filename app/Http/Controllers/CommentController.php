<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Mockery\Exception;
use App\Models\Comment;
use App\Models\Profile;
use App\Models\Category;
use App\Models\Notification;
use Illuminate\Http\Request;
use function Laravel\Prompts\alert;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Type\Integer;

class CommentController extends Controller
{

    public function created(Request $request)
    {

        $validatedData = Validator::make($request->all(), [
            'comment' => 'required',
            'blog_id' => 'required',
        ]);
        if ($validatedData->fails()) {
            $errors = $validatedData->errors()->all(); // istersek laravelin kendi hatam mesajını da gönderebiliriz
            // E-posta veya şifrenin hatalı olduğunu belirten özel bir hata mesajı oluşturun
            $errorMessage = 'Girilen email veya şifre formatı hatalı!';
            return redirect()->back()->with('error', $errors);
        }
        $blog = Blog::find($request->blog_id);
        $user = Auth::user();
        $comment = new Comment();
        $comment->blog_id = $request->blog_id;
        $comment->user_id = $user->id;
        $comment->content = $request->comment;
        $comment->status = true;
        $comment->save();
        $blog->comments()->save($comment);
        $user->comments()->save($comment);
        $blog->comment_count += 1;
        $blog->save();

        if($blog->user->id != $user->id) {
            // NEW NOTIFICATION
            $notification = new Notification();
            $notification->receiver_id = $blog->user->id;
            $notification->sender_id = $user->id;
            $notification->type = 'commented';
            $notification->title = 'NEW COMMENT';
            $notification->mentioned_id = $comment->id;
            $notification->content = ' commented your blog: '.$comment->content;
            $notification->url = route('blogs.show', $blog->id);
            $blog->user->notifications()->save($notification);
        }


        $data['comments'] = Comment::where('blog_id', $request->blog_id)->where('status', 1)->orderBy('created_at', 'desc')->get();
        return redirect()->back()->with($data);


    }

    public function reply(Request $request)
    { // request ile reply ve blog id comment id geliyor
        $user = Auth::user();
        $blog = Blog::find($request->blog_id);
        $main_comment = Comment::find($request->comment_id);
        $reply = new Comment();
        $reply->parent_id = $request->comment_id;
        $reply->content = $request->reply;
        $reply->blog_id = $request->blog_id;
        $reply->user_id = $user->id;
        $reply->status = true;
        $reply->save();
        $main_comment->replies()->save($reply);
        $blog->comments()->save($reply);
        $user->comments()->save($reply);
        $blog->comment_count += 1;
        $blog->save();
        $data['comments'] = Comment::with('replies')
            ->where('blog_id', $request->blog_id) // nulla bak
            ->where('status', 1)
            ->orderBy('created_at', 'desc')->get();
        $data['blog'] = Blog::where('id', $request->blog_id)->where('status', 1)->first();
        $user = User::with('categories')->find($user->id);
        if ($user->liked_blogs->where('id', $request->blog_id)->first() == null) { // Eğer kullanıcını beğendiği bloğlar arasında bu id li bloğ yok ise
            $data['is_liked'] = 0;  // bunu kullanarak like butonunu değiştir
        } else {
            $data['is_liked'] = 1;
        }
        $data['user_categories'] = $user->categories;
        $data['categories'] = Category::all()->where('status', 1);

        if($main_comment->user->id != $user->id) {
            // NEW NOTIFICATION
            $notification = new Notification();
            $notification->receiver_id = $main_comment->user->id;
            $notification->sender_id = $user->id;
            $notification->type = 'replied';
            $notification->title = 'NEW REPLY';
            $notification->mentioned_id = $reply->id;
            $notification->content = ' replied your comment: '.$reply->content;
            $notification->url = route('blogs.show', $blog->id);
            $main_comment->user->notifications()->save($notification);
        }


        if($request->ajax()){
            try{
                return response()->json(['success' => true]);
            }catch(Exception $e){
                return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
            }
        }
        return redirect()->back()->with($data);
    }

    public function edited(Request $request)
    {

        $validatedData = Validator::make($request->all(), [
            'comment' => 'required',
        ]);
        if ($validatedData->fails()) {
            $error = $validatedData->errors()->all();
            return redirect()->back()->with('error', $error);
        }
        $comment = Comment::find($request->comment_id);
        $comment->content = $request->comment;
        $comment->save();

        if($request->ajax()){
            try{
                return response()->json(['success' => true]);
            }catch(Exception $e){
                return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
            }
        }

        return redirect()->back()->with('success', 'Your comment successfully edited!');


    }

    public function deletedComment(Request $request)
    {


        $comment_id = $request->input('comment_id');
        $blog_id = $request->input('blog_id');

        // Veriyi işleme veya silme işlemi yapılabilir
        // Örnek olarak, veritabanından bir kayıt silme:
        // Comment::where('id', $comment_id)->delete();

        $commentCount = 1; //yorumla beraber silindiği için yorum kesin silindiği için 1 ile başlıyor , yanıt varsa ekleme olur

        $comment = Comment::find($comment_id);
        $blog = Blog::find($blog_id);


        $comment->status = 0;
        if($comment->replies){// RECURSİVE BİR ŞEKİLDE TÜM REPLY LARA ERİŞME
            $commentCount = $this->delete_replies($comment,$commentCount);
        }
        $blog->comment_count -= $commentCount;

        $blog->save();
        $comment->save();

        $notifications = Notification::where('mentioned_id', $comment->id)
            ->whereIn('type', ['commented','replied'])
            ->get();
            foreach ($notifications as $notification) {
                $notification->status = false;
                $notification->save();
            }

        if($request->ajax()){
            try{
                return response()->json(['success' => true]);
            }catch(Exception $e){
                return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
            }
        }

        return response()->json(['success' => true, 'message' => 'Comment and replies deleted successfully', 'comment_id' => $comment_id]);
    }

    public function delete_replies(Comment $comment , int $comment_count){
        foreach($comment->replies as $reply){
            $comment_count += 1;
            $reply->status= 0;
            $reply->save();
            if($reply->replies){
                $comment_count = $this->delete_replies($reply,$comment_count);
            }
        }
        return $comment_count;
    }
}
