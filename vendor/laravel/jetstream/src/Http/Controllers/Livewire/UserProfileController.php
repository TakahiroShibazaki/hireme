<?php

namespace Laravel\Jetstream\Http\Controllers\Livewire;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Post;
use App\Models\Favorite;
use App\Models\User;
use App\Models\Follow;
use App\Models\Like;


class UserProfileController extends Controller
{
    /**
     * Show the user profile screen.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function edit(Request $request, int $id)
    {
        // ログイン中のidと一致していればedit表示し、一致してなければnot foundページへ
        if (\Auth::id() !== $id) {
            return view('not-found');
        }

        return view('profile.edit', [
            'request' => $request,
            'user' => $request->user(),
            'id' => $id,
        ]);
    }

    public function show($host)
    {
        $user = User::where('id', $host)->first();
        // userが見つからなかたらnotFound
        if (is_null($user)) {
            return view('not-found');
        }

        /**
         * $hostの投稿を取得
         */
        $posts = Post::where('user_id', $host)->get();

        /**
         * $hostの投稿いいね判定用フラグを付与
         */
        $visitor = \Auth::id();
        foreach ($posts as $post) {
            $post['likeFlag'] = '0';
            if (isset($visitor)) {
                $likeFlag = Like::where('post_id', $post['id'])
                                ->where('user_id', $visitor)
                                ->exists();
                if ($likeFlag === true) {
                    $post['likeFlag'] = '1';
                }
            }
        }

        /**
         * $hostがお気に入りした投稿を取得
         */
        $favoriteMaps = Favorite::where('user_id', $host)->get();
        // dx($favoriteMaps);
        $favorites = [];
        foreach ($favoriteMaps as $val) {
            $favorites[] = Post::where('id', $val['post_id'])->first();
        }

        /**
         * $hostの投稿いいね判定用フラグを付与
         */
        // for ($i=0; $i < count($favorites); $i++) { 
        //     $favorites[$i]['likeFlag'] = '0';
        //     if (isset($visitor)) {
        //         $likeFlag = Like::where('post_id', $favorites[$i]['id'])
        //                         ->where('user_id', $visitor)
        //                         ->exists();
        //         if ($likeFlag === true) {
        //             $favorites[$i]['likeFlag'] = '1';
        //         }
        //     }
        // }
        
        foreach ($favorites as $favorite) {
            $favorite['likeFlag'] = '0';
            if (isset($visitor)) {
                $likeFlag = Like::where('post_id', $favorite['id'])
                                ->where('user_id', $visitor)
                                ->exists();
                if ($likeFlag === true) {
                    $favorite['likeFlag'] = '1';
                }
            }
        }

        /**
         * ログインしていた場合、$hostが$visitorをフォローのしているか
         */
        $visitor = \Auth::id();
        $followFlag = '0';
        if (isset($visitor)) {
            $followExists = Follow::where('followed_user', $host)->where('following_user', $visitor)->exists();
            if ($followExists === true) {
                $followFlag = '1';
            }
        }

        /**
         * $hostがフォローしているユーザー一覧&情報を取得
         */
        $followInfos = Follow::where('following_user', $host)->get();
        $followUsers = [];
        foreach ($followInfos as $followInfo) {
            $followUsers[] = User::where('id', $followInfo['followed_user'])->first();
        }
        // 投稿を取得
        foreach ($followUsers as $followerUser) {
            $followerUser['posts'] = Post::where('user_id', $followerUser['id'])->take(4)->get();
        }

        //　フォローフラグを立てる
        $visitor = \Auth::id();
        if (isset($visitor)) {
            foreach ($followUsers as $followUser) {
                $followUser['followFlag'] = 0;
                $followFlag = Follow::where('following_user', $visitor)
                                    ->where('followed_user', $followUser['id'])
                                    ->exists();
                if ($followFlag) {
                    $followUser['followFlag'] = 1;
                }
            }
        }

        /**
         * $hostをフォローしているユーザー一覧&情報を取得
         */
        $followerInfos = Follow::where('followed_user', $host)->get();
        $followerUsers = [];
        foreach ($followerInfos as $followerInfo) {
            $followerUsers[] = User::where('id', $followerInfo['following_user'])->first();
        }
        // 投稿を取得
        foreach ($followerUsers as $followerUser) {
            $followerUser['posts'] = Post::where('user_id', $followerUser['id'])->take(4)->get();
        }
        //　フォローフラグを立てる
        $visitor = \Auth::id();
        if (isset($visitor)) {
            foreach ($followerUsers as $followerUser) {
                $followerUser['followFlag'] = 0;
                $followFlag = Follow::where('following_user', $visitor)
                                    ->where('followed_user', $followerUser['id'])
                                    ->exists();
                if ($followFlag) {
                    $followerUser['followFlag'] = 1;
                }
            }
        }
        // dx($followerUsers[0]['id']);
        return view('profile.show', [
            // 'request' => $request,
            'user' => $user,
            'posts' => $posts,
            'favorites' => $favorites,
            'followFlag' => $followFlag,
            'followUsers' => $followUsers,
            'followerUsers' => $followerUsers,
            'id' => $host,
        ]);
    }
}
