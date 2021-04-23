<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $data = $request;

        $comment= new Comment;
        $comment->post_id = $data['postId'];
        $comment->user_id = $data['userId'];
        $comment->content = $data['comment'];
        $comment->save();
        
        $last_insert_id = $comment->id;
        
        $comment = Comment::where('id', $last_insert_id)->first();
        $user_id = $comment['user_id'];
        $user_info = User::where('id', $user_id)->first();
        $comment['user_name'] = $user_info['name'];
        $comment['profile_photo_path'] = $user_info['profile_photo_path'];
        $comment['time'] = substr($comment['updated_at'], 0, -3);
        return $comment;
    }

    public function destroy(Request $request)
    {
        $data = $request;

        $comment = Comment::where('post_id', $data['postId'])
                    ->where('user_id', $data['userId'])
                    ->where('content', $data['content'])
                    ->first();
        $comment->delete();
        return '削除成功';
    }
}
