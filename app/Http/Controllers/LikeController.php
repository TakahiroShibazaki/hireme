<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\User;

class LikeController extends Controller
{
    public function store(Request $request)
    {
        $data = $request;

        $like = new Like;
        $like->post_id = $data['postId'];
        $like->user_id = $data['userId'];
        $like->save();

        // $user_info = User::where('id', $data['userId'])->first();
        // $like['user_name'] = $user_info->name;
        // $like['user_photo'] = $user_info->profile_photo_path;
        // $like['user_id'] = $data['userId'];
        // if (empty($like['user_photo'])) {
        //     $like['user_icon'] = substr($like['user_name'], 0, 2);
        //     $like['user_icon'] = strtoupper($like['user_icon']);
        // }
        $like['count'] = Like::where('post_id', $data['postId'])->count();
        return $like;
    }

    public function destroy(Request $request)
    {
        $data = $request;

        $like = Like::where('post_id', $data['postId'])
                    ->where('user_id', $data['userId'])
                    ->first();
        $like->delete();
        
        // $user_info = User::where('id', $data['userId'])->first();
        // $like->user_name = $user_info->name;
        $like['count'] = Like::where('post_id', $data['postId'])->count();
        return $like;
    }
}
