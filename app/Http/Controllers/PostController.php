<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostStoreRequest;
use App\Models\ImageFactory;
use App\Models\Post;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Favorite;
use App\Models\GetPosts;
use App\Models\Tag;
use App\Models\User;
use App\Models\Follow;

use Illuminate\Support\Facades\Mail;


class PostController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth')->except(['index', 'show', 'search', 'popular', 'searchWord', 'searchComment', 'userSearch']);

        // $this->middleware('auth')->except(['index', 'show',]);
        $this->middleware('verified')->except(['index', 'show', 'search', 'popular', 'searchWord', 'searchComment', 'userSearch']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();

        /**
         * 新着順
         */
        $postsOrderByLatest = Post::latest()->paginate(24);

        /**
         * タグ取得
         */
        foreach ($postsOrderByLatest as $postOrderByLatest) {
            $postOrderByLatest['tags'] = Tag::where('post_id', $postOrderByLatest['id'])->get();
        }
        /**
         * 総いいね数をカウント
         */
        foreach ($postsOrderByLatest as $postOrderByLatest) {
            $postOrderByLatest['totalLikeNum'] = Like::where('post_id', $postOrderByLatest['id'])->count();
        }

        /**
         * いいね判定用フラグ
         */
        if (!empty($user)) {
            $login_user_id = $user->id;
            foreach ($postsOrderByLatest as $postOrderByLatest) {
                $postOrderByLatest['likeFlag'] = '0';
                 $likeFlag = Like::where('post_id', $postOrderByLatest['id'])
                                                ->where('user_id', $login_user_id)
                                                ->exists();
                if ($likeFlag === true) {
                    $postOrderByLatest['likeFlag'] = '1';
                }
            }
        }

        /**
         * 人気順(1ヶ月以内)
         */
        $getPosts = new GetPosts;
        //取得期間
        $from = date("Y-m-d H:i:s",strtotime("-1 month"));
        $to = date("Y-m-d H:i:s");
        // X個目以降を取得
        $after = 0;
        // X個取得
        $amount = 24;
        $postsOrderByPopularity = $getPosts->getPostsOrderByPopularity($from, $to, $after, $amount);

        return view('post.index', [
            'postsOrderByLatest' => $postsOrderByLatest,
            'postsOrderByPopularity' => $postsOrderByPopularity,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {
        /**
         * DBへ格納
         */
        $ImageFactory = new ImageFactory;
        //画像を保存し、ファイル名を返す
        $imagePath = $ImageFactory->storeImage($request->file('photo'));

        $post = new Post();
        $user = \Auth::user();

        $id = $user->id.time();
        $post->id = $id;
        $post->user_id = $user->id;
        $post->photo = $imagePath;

        if (isNotNullOrBlank($request->comment)) {
            /**
             * タグ機能
             */
            $arrExplodeBySpace = [];
            // 半角スペース, 全角スペース区切りで配列へ格納
            $arrExplodeByHarf = explode(' ', $request->comment);
            foreach ($arrExplodeByHarf as $explodeByHarf) {
                $arrExplodeBySpace = explode('　', $explodeByHarf);
                // 1文字目が'#','＃'
                foreach ($arrExplodeBySpace as $explodeBySpace) {
                    if (strpos($explodeBySpace, '#') === 0 || strpos($explodeBySpace, '＃') === 0) {
                        $explodeBySpace = mb_substr($explodeBySpace, 1);
                        //d($explodeBySpace);
                        $tag = new Tag();
                        $tag->post_id = $id;
                        $tag->tag = $explodeBySpace;
                        $tag->save();
                    }
                }
            }
            $post->comment = $request->comment;
        }

        if (isNotNullOrBlank($request->word)) {
            $post->word = $request->word;
        }
        $post->save();

        return redirect()->route('postShow', ['id' => $id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $post_id = $post->id;
        $user = \Auth::user();

        /**
         * いいね取得
         */
        // ログイン中のユーザーがいいねしているかチェック
        $likeFlag = "0";
        if (!empty($user)) {
            $login_user_id = $user->id;
            $likeExists = Like::where('post_id', $post_id)
                    ->where('user_id', $login_user_id)
                    ->exists();
            if ($likeExists) {
                $likeFlag = "1";
            }
        } else {
            $login_user_id = "";
        }
        // いいね数をカウント
        $like_count = Like::where('post_id', $post_id)->count();

        //　いいねした人のを最大10人分取得
        $likeUsers = Like::where('post_id', $post_id)->take(10)->get();

         /**
         * コメント取得
         */
        $comments = Comment::where('post_id', $post_id)->get();


        /**
         * お気に入り機能
         */
        $favoriteFlag = "0";
        if (isNotNullOrBlank($user)) {
            $login_user_id = $user->id;
            $favoriteExists = Favorite::where('post_id', $post_id)
                    ->where('user_id', $login_user_id)
                    ->exists();
            if (isNotNullOrBlank($favoriteExists)) {
                $favoriteFlag = "1";
            }
        } else {
            $login_user_id = "";
        }

        /**
         * 同一ワードを含む投稿を取得
         */
        $sameWordPosts = [];
        if (isNotNullOrBlank($post->word)) {
            $sameWordPosts = Post::where('word', 'like', "%$post->word%")
                                ->where('id', '!=', $post->id)
                                ->get();
        }
        /**
         * 人気順(1ヶ月以内)
         */
        $getPosts = new GetPosts;
        //取得期間
        $from = date("Y-m-d H:i:s",strtotime("-1 month"));
        $to = date("Y-m-d H:i:s");
        // X個目以降を取得
        $after = 0;
        // X個取得
        $amount = 20;
        $postsOrderByPopularity = $getPosts->getPostsOrderByPopularity($from, $to, $after, $amount);

        /**
         * 新着順
         */
        $postsOrderByLatest = Post::latest()->take(15)->get();

        /**
         * 同一ユーザーの投稿
         */
        $postUserId = $post->user_id;
        $sameUserPosts = Post::where('user_id', $postUserId)->take(10)->get();

        /**
         * タグ取得
         */
        // $tags = [];
        $tags = Tag::where('post_id', $post_id)->get();

        return view('post.show', [
            'post' => $post,
            'likeFlag' => $likeFlag,
            'like_count' => $like_count,
            'likeUsers' => $likeUsers,
            'comments' => $comments,
            'favoriteFlag' => $favoriteFlag,
            'tags' => $tags,
            'sameUserPosts' => $sameUserPosts,
            'sameWordPosts' => $sameWordPosts,
            'postsOrderByPopularity' => $postsOrderByPopularity,
            'postsOrderByLatest' => $postsOrderByLatest,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 使わない
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //使わない
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * 人気順一覧
     */
    public function popular(Request $request, $nextPage) {

        /**
         * 人気順(1ヶ月以内)
         */
        $getPosts = new GetPosts;
        //取得期間
        $from = date("Y-m-d H:i:s",strtotime("-1 month"));
        $to = date("Y-m-d H:i:s");
        // X個取得
        $amount = 6;
        // X個目以降を取得
        $after = $amount * $nextPage - $amount;

        $postsOrderByPopularity = $getPosts->getPostsOrderByPopularity($from, $to, $after, $amount);

        /**
         * タグ取得
         */
        foreach ($postsOrderByPopularity as $postOrderByPopularity) {
            if (isset($postOrderByPopularity[0]['id'])) {
                $postOrderByPopularity['tags'] = Tag::where('post_id', $postOrderByPopularity[0]['id'])->get();
                //d($postOrderByPopularity['tags']);
            }
        }
        /**
         * 総いいね数をカウント
         */
        foreach ($postsOrderByPopularity as $postOrderByPopularity) {
            $postOrderByPopularity[0]['totalLikeNum'] = Like::where('post_id', $postOrderByPopularity[0]['id'])->count();
        }

        /**
         * いいね判定用フラグ
         */
        $user = \Auth::user();
        if (!empty($user)) {
            $login_user_id = $user->id;
            foreach ($postsOrderByPopularity as $postOrderByPopularity) {
                $postOrderByPopularity[0]['likeFlag'] = '0';
                 $likeFlag = Like::where('post_id', $postOrderByPopularity[0]['id'])
                                                ->where('user_id', $login_user_id)
                                                ->exists();
                if ($likeFlag === true) {
                    $postOrderByPopularity[0]['likeFlag'] = '1';
                }
            }
        }

        $nextPage++;
        return view('post.popular', [
            'postsOrderByPopularity' => $postsOrderByPopularity,
            'nextPage' => $nextPage,
        ]);
    }

    /**
     * ワード＆コメント検索機能
     */
    public function search(Request $request)
    {
        // 未入力だったらreturn
        if (!isNotNullOrBlank($request->word)) {
            return back();
        }
        $searchWords = str_replace('　', ' ', $request->word);
        $words = explode(' ', $searchWords);

        /**
         * 書かれた言葉から検索
         */

        // １ページ当たりの取得件数
        $perPage = 2;
        // 現在のページ(遷移後ページ視点)
        $currentPage = 0;

        $query = Post::query();
        foreach ($words as $word) {
            $query->orwhere('word', 'LIKE', '%'.$word.'%');
        }
        $searchedWordResult[0]['total'] = $query->count();
        $searchedWordResult[0]['perPage'] = $perPage;
        $searchedWordResult[0]['currentPage'] = $currentPage;
        $nextPage = $currentPage + 1;
        $searchedWordResult[0]['lastPage'] = 0;
        if ($searchedWordResult[0]['total'] <= $searchedWordResult[0]['perPage'] * $nextPage) {
            $searchedWordResult[0]['lastPage'] = 1;
        }
        $searchedWordResult[] = $query->offset($searchedWordResult[0]['perPage'] * $searchedWordResult[0]['currentPage'])->limit($perPage)->get();

        /**
         * タグ取得
         */
        for ($i=0; $i < count($searchedWordResult[1]); $i++) {
            $searchedWordResult[1][$i]['tags'] = Tag::where('post_id', $searchedWordResult[1][$i]['id'])->get();
        }
        /**
         * 総いいね数をカウント
         */
        for ($i=0; $i < count($searchedWordResult[1]); $i++) {
            $searchedWordResult[1][$i]['totalLikeNum'] = Like::where('post_id', $searchedWordResult[1][$i]['id'])->count();
        }

        /**
         * いいね判定用フラグ
         */
        $user = \Auth::user();

        if (!empty($user)) {
            $login_user_id = $user->id;
            for ($i=0; $i < count($searchedWordResult[1]); $i++) {
                $searchedWordResult[1][$i]['likeFlag'] = '0';
                $likeFlag = Like::where('post_id', $searchedWordResult[1][$i]['id'])
                                                    ->where('user_id', $login_user_id)
                                                    ->exists();
                if ($likeFlag === true) {
                    $searchedWordResult[1][$i]['likeFlag'] = '1';
                }
            }
        }

        /**
         * コメントから検索
         */
        if (isNotNullOrBlank($request->perPage)) {
            $perPage = $request->perPage;
        } else {
            // １ページ当たりの取得件数
            $perPage = 1;
        }
        if (isNotNullOrBlank($request->currentPage)) {
            $currentPage = $request->currentPage;
        } else {
            $currentPage = 0;
        }

        $query = Post::query();
        foreach ($words as $word) {
            $query->orwhere('comment', 'LIKE', '%'.$word.'%');
        }
        $searchedCommentResult[0]['total'] = $query->count();
        $searchedCommentResult[0]['perPage'] = $perPage;
        $searchedCommentResult[0]['currentPage'] = $currentPage;
        $nextPage = $currentPage + 1;
        $searchedCommentResult[0]['lastPage'] = 0;
        if ($searchedCommentResult[0]['total'] <= $searchedCommentResult[0]['perPage'] * $nextPage) {
            $searchedCommentResult[0]['lastPage'] = 1;
        }
        $searchedCommentResult[] = $query->offset($searchedCommentResult[0]['perPage'] * $searchedCommentResult[0]['currentPage'])->limit($perPage)->get();
        /**
         * タグ取得
         */
        for ($i=0; $i < count($searchedCommentResult[1]); $i++) {
            $searchedCommentResult[1][$i]['tags'] = Tag::where('post_id', $searchedCommentResult[1][$i]['id'])->get();
        }
        /**
         * 総いいね数をカウント
         */
        for ($i=0; $i < count($searchedCommentResult[1]); $i++) {
            $searchedCommentResult[1][$i]['totalLikeNum'] = Like::where('post_id', $searchedCommentResult[1][$i]['id'])->count();
        }

        /**
         * いいね判定用フラグ
         */
        $user = \Auth::user();

        if (!empty($user)) {
            $login_user_id = $user->id;
            for ($i=0; $i < count($searchedCommentResult[1]); $i++) {
                $searchedCommentResult[1][$i]['likeFlag'] = '0';
                $likeFlag = Like::where('post_id', $searchedCommentResult[1][$i]['id'])
                                                    ->where('user_id', $login_user_id)
                                                    ->exists();
                if ($likeFlag === true) {
                    $searchedCommentResult[1][$i]['likeFlag'] = '1';
                }
            }
        }

        return  view('post.search-result', [
            'searchWords' => $searchWords,
            'searchedWordResult' => $searchedWordResult,
            'searchedCommentResult' => $searchedCommentResult,
        ]);
    }

    /**
     * 書かれた言葉から検索結果
     */
    public function searchWord(Request $request, $searchWords, $nextPage) {

        // 未入力だったらreturn
        if (!isNotNullOrBlank($searchWords)) {
            return back();
        }
        $searchWords = str_replace('　', ' ', $searchWords);
        $words = explode(' ', $searchWords);

        // 1ページ当たりの取得件数
        $perPage = 2;

        if (isNotNullOrBlank($nextPage)) {
            $currentPage = (int)$nextPage;
        } else {
            $currentPage = 0;
        }

        $query = Post::query();
        foreach ($words as $word) {
            if (isNotNullOrBlank($word)) {
                $query->orWhere('word', 'LIKE', '%'.$word.'%');
            }
        }


        $searchedWordResult[0]['searchWords'] = $searchWords;
        $searchedWordResult[0]['total'] = $query->count();
        $searchedWordResult[0]['perPage'] = $perPage;
        $searchedWordResult[0]['currentPage'] = $currentPage;
        $searchedWordResult[0]['nextPage'] = $currentPage + 1;
        $searchedWordResult[0]['lastPage'] = 0;
        if ($searchedWordResult[0]['total'] <= $searchedWordResult[0]['perPage'] * $searchedWordResult[0]['nextPage']) {
            $searchedWordResult[0]['lastPage'] = 1;
        }
        $searchedWordResult[] = $query->offset($searchedWordResult[0]['perPage'] * $searchedWordResult[0]['currentPage'])->limit($perPage)->get();

        /**
         * タグ取得
         */
        for ($i=0; $i < count($searchedWordResult[1]); $i++) {
            $searchedWordResult[1][$i]['tags'] = Tag::where('post_id', $searchedWordResult[1][$i]['id'])->get();
        }

        /**
         * 総いいね数をカウント
         */
        for ($i=0; $i < count($searchedWordResult[1]); $i++) {
            $searchedWordResult[1][$i]['totalLikeNum'] = Like::where('post_id', $searchedWordResult[1][$i]['id'])->count();
        }

        /**
         * いいね判定用フラグ
         */
        $user = \Auth::user();

        if (!empty($user)) {
            $login_user_id = $user->id;
            for ($i=0; $i < count($searchedWordResult[1]); $i++) {
                $searchedWordResult[1][$i]['likeFlag'] = '0';
                $likeFlag = Like::where('post_id', $searchedWordResult[1][$i]['id'])
                                                    ->where('user_id', $login_user_id)
                                                    ->exists();
                if ($likeFlag === true) {
                    $searchedWordResult[1][$i]['likeFlag'] = '1';
                }
            }
        }

        return view('post.search-word-result', [
            'searchWords' => $searchWords,
            'searchedWordResult' => $searchedWordResult,
        ]);
    }

    /**
     * コメントから検索結果
     */
    public function searchComment(Request $request, $searchWords, $nextPage) {

        // 未入力だったらreturn
        if (!isNotNullOrBlank($searchWords)) {
            return back();
        }
        $searchWords = str_replace('　', ' ', $searchWords);
        $words = explode(' ', $searchWords);

        // 1ページ当たりの取得件数
        $perPage = 2;

        if (isNotNullOrBlank($nextPage)) {
            $currentPage = (int)$nextPage;
        } else {
            $currentPage = 0;
        }

        $query = Post::query();
        foreach ($words as $word) {
            if (isNotNullOrBlank($word)) {
                $query->orWhere('comment', 'LIKE', '%'.$word.'%');
            }
        }

        $searchedCommentResult[0]['searchWords'] = $searchWords;
        $searchedCommentResult[0]['total'] = $query->count();
        $searchedCommentResult[0]['perPage'] = $perPage;
        $searchedCommentResult[0]['currentPage'] = $currentPage;
        $searchedCommentResult[0]['nextPage'] = $currentPage + 1;
        $searchedCommentResult[0]['lastPage'] = 0;
        if ($searchedCommentResult[0]['total'] <= $searchedCommentResult[0]['perPage'] * $searchedCommentResult[0]['nextPage']) {
            $searchedCommentResult[0]['lastPage'] = 1;
        }
        $searchedCommentResult[] = $query->offset($searchedCommentResult[0]['perPage'] * $searchedCommentResult[0]['currentPage'])->limit($perPage)->get();

        /**
         * タグ取得
         */
        for ($i=0; $i < count($searchedCommentResult[1]); $i++) {
            $searchedCommentResult[1][$i]['tags'] = Tag::where('post_id', $searchedCommentResult[1][$i]['id'])->get();
        }

        /**
         * 総いいね数をカウント
         */
        for ($i=0; $i < count($searchedCommentResult[1]); $i++) {
            $searchedCommentResult[1][$i]['totalLikeNum'] = Like::where('post_id', $searchedCommentResult[1][$i]['id'])->count();
        }

        /**
         * いいね判定用フラグ
         */
        $user = \Auth::user();

        if (!empty($user)) {
            $login_user_id = $user->id;
            for ($i=0; $i < count($searchedCommentResult[1]); $i++) {
                $searchedCommentResult[1][$i]['likeFlag'] = '0';
                $likeFlag = Like::where('post_id', $searchedCommentResult[1][$i]['id'])
                                                    ->where('user_id', $login_user_id)
                                                    ->exists();
                if ($likeFlag === true) {
                    $searchedCommentResult[1][$i]['likeFlag'] = '1';
                }
            }
        }

        return view('post.search-comment-result', [
            'searchWords' => $searchWords,
            'searchedCommentResult' => $searchedCommentResult,
        ]);
    }

    /**
     * ユーザー検索
     */
    public function userSearch(Request $request) {
        // 空だったら戻る
        if (!isNotNullOrBlank($request->userStr)) {
            return back();
        }
        $searchUser = $request->userStr;

        /**
         * info
         */
        $users[0]['searchUser'] = $searchUser;

        /**
         * 検索ワードを含むユーザーを検索
         */
        $users[1] = User::where('name', 'LIKE', '%'.$searchUser.'%')
                    ->select('id', 'name', 'profile_photo_path')
                    ->get();
        // 取得できなかったらビューへ
        if (empty($users[1][0])) {
            return  view('post.search-user-result');
        }

        /**
         * ユーザーの投稿を取得
         */
        foreach ($users[1] as $user) {
            $user['posts'] = Post::where('user_id', $user['id'])->take(4)->get();
        }

        /**
         * フォローフラグを立てる
         */
        $loginUserId = \Auth::id();
        if (isset($loginUserId)) {
            foreach ($users[1] as $user) {
                $user['followFlag'] = 0;
                $followFlag = Follow::where('following_user', $loginUserId)
                                    ->where('followed_user', $user['id'])
                                    ->exists();
                if ($followFlag) {
                    $user['followFlag'] = 1;
                }
            }
        }

        return  view('post.search-user-result', [
            'searchResultUser' => $users,
        ]);
    }
}
