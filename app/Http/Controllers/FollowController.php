<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Follow;

class FollowController extends Controller
{
    public function store(Request $request)
    {
        $data = $request;
        $follow = new Follow;

        $follow->following_user = $data['userId'];
        $follow->followed_user = $data['followUserId'];
        $follow->save();
        return "保存成功";
    }

    public function destroy(Request $request)
    {
        $data = $request;
        
        $follow = Follow::where('following_user', $data['userId'])
                     ->where('followed_user', $data['followUserId'])
                     ->first();
        $follow->delete();
        return '削除成功';
    }
}
