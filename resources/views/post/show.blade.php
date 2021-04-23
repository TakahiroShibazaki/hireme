@extends('post.layout')

@section('content')
{{-- {{ Breadcrumbs::render('postShow', $post) }} --}}
<div class="container-fluid">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-12 original-border-around-with-padding">
                    <div class="row">
                        <div class="col-md-6">
                            @if (!empty($post->photo))
                            <div style="text-align: center">
                                <img class="img-fluid" src="{{asset('storage/postedImages/'.$post->photo)}}" style="border-radius: 4px">
                            </div>
                            @endif
                            <div class="row">
                                <div class="col-md-3" style="text-align: center; padding:1rem;">
                                    <!-- いいね -->
                                    <div style="border: 1px solid #F97855; border-radius: 4px;">
                                        <button id="like" value={{ $likeFlag }} class="btn" style="outline: none">
                                            @if ($likeFlag == "0")
                                                <i class="far fa-heart" id="icon-color" style="color: #F97855;"></i>
                                            @else
                                                <i class="current-color fas fa-heart" id="icon-color" style="color: #F97855;"></i>
                                            @endif
                                            <span style="color: #F97855; font-size: 0.8rem">いいね!</span>
                                        </button>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div id="likeAreaJs" style="display: none;"></div>
                                    <div id="like-count" class="likeInfo">
                                        <span>
                                            @if ($like_count != "0")
                                                <i class="far fa-heart" style="color: #F97855;"></i>
                                                <span style="color: #c7b685;"><small>{{ $like_count }}回いいね!されてます</small></span>
                                            @endif
                                        </span>
                                    </div>
                                    <div id="profilePhoto">
                                        @foreach ($likeUsers as $likeUser)
                                            <a href="{{ route('profile.show', $likeUser->user->id) }}">
                                                <span id="addUserImg{{$likeUser->user->id}}">
                                                    <img src="{{ $likeUser->user->profile_photo_url }}" alt="" style="width: 2rem; height: 2rem; border-radius: 50%;">
                                                </span>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- お気に入り保存 -->
                                <div class="col-md-3" style="text-align: right; padding: 1rem;">
                                    <button class="btn" id="favorite" value={{$favoriteFlag}} style="border: 1px solid #F2B950;">
                                        @if ($favoriteFlag === "0")
                                            <i class="far fa-star star" id="favoriteBtn">お気に入り</i>
                                        @else
                                            <i class="fas fa-star star" id="favoriteBtnOn">お気に入り</i>
                                        @endif
                                    </button>
                                </div>
                            </div>

                            <!-- <div class="row">
                                <div class="12">
                                    @if (!empty($post->word))
                                        <p>{{ $post->word}}</p>
                                    @endif
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="col-md-2">
                                    <span>
                                        <a href="{{ route('profile.show', $post->user->id) }}">
                                            <img src="{{ $post->user->profile_photo_url }}" alt="" style="width: 3rem; height: 3rem; border-radius: 50%;">
                                        </a>
                                    </span>
                                </div>
                                <div class="col-md-10 original-border-around-with-padding">
                                    <div>
                                        {{ $post->user->name }}
                                    </div>
                                    <div>
                                        @if (!empty($post->comment))
                                        <p>{{ $post->comment }}</p>
                                        <p class="original-text-muted" style="float: right">{{ substr($post->updated_at, 0, -3)}}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @for ($i = 0; $i < count($comments); $i++)
                                <div class="row" style="padding-top: 2rem" id ="destroyComment{{$i}}">
                                    <div class="col-md-2">
                                        <a href="{{ route('profile.show', $comments[$i]->user->id) }}">
                                            <span class="comment-icon" id="comment-icon-{{ $i }}">
                                                <img src="{{ $comments[$i]->user->profile_photo_url }}">
                                            </span>
                                        </a>
                                    </div>
                                    <div class="col-md-10 original-border-around-with-padding">
                                        <div>
                                            {{ $comments[$i]->user->name }}
                                        </div>
                                        <div>
                                            <p>{{ $comments[$i]->content }}</p>
                                            <span class="original-text-muted" style="float: right">{{ substr($comments[$i]->updated_at, 0, -3) }}</span>
                                            @auth
                                                @if ( $comments[$i]->user->id === \Auth::user()->id)
                                                    <!-- Modalのボタン -->
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                                                        <span><i class="far fa-trash-alt"></i></span>
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">コメントを削除</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    本当に削除しますか？
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                                                                    <button data-dismiss="modal" type="button" class="btn btn-danger" id="{{ $i }}" onclick="clk(this.id, this.value)" value={{ $comments[$i]->content }}>削除する</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            @endfor
                            <input type="hidden" id=commentCnt value=<?=$i?>>

                            <!-- 新しいコメント -->
                            <div id ="commentAreaJS"></div>
                            <div class="row" style="padding-top: 2rem">
                                <div class="col-md-10">
                                    <div id="commentPlace">
                                        <textarea class="original-border-around-with-padding" style="width:100%;" id="exampleFormControlTextarea1" rows="3" maxlength="255" placeholder="感想をシェアしよう！"></textarea>
                                    </div>
                                    <div>
                                        <span style="float: right"><span id="showTextLength">0</span>/255文字</span>
                                    </div>
                                </div>
                                <div class="col-md-2 submit-btn">
                                    <button type="button" class="reset-button original-border-around" style="padding:0 0.6rem 0 0.6rem" id="submitComment">送信</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{ route('profile.show', $post->user->id) }}">
                                        <span>
                                            <img src="{{ $post->user->profile_photo_url }}" alt="" style="width: 3rem; height: 3rem; border-radius: 50%;">
                                            {{ $post->user->name }}
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="original-text-small">{{ $post->user->introduction }}</p>
                                </div>
                            </div>
                            @if (!empty($sameUserPosts[0]->id))
                                <div class="row">
                                    <div class="col-md-12">
                                        @for ($i = 0; $i < count($sameUserPosts); $i++)
                                            <a href="{{ route('postShow', ['id' => $sameUserPosts[$i]->id]) }}">
                                                <span class="original-img-square">
                                                    <img class="img-fluid original-img-square" src="{{asset('storage/postedImages/'.$sameUserPosts[$i]->photo)}}">
                                                </span>
                                            </a>
                                            @if ($i === 10)
                                                <a href="">
                                                    もっと見る
                                                </a>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                            @endif
                            @if (!empty($tags[0]->id))
                                <div class="row" style="padding-top: 2rem">
                                    <div class="col-md-12">
                                        <p class="original-subbar"><i class="fas fa-hashtag"></i> 関連タグ</p>
                                        <div style="display:inline-flex">
                                            @foreach ($tags as $tag)
                                                <a href="{{ route('searchComment', ['searchWords' => $tag->tag, 'nextPage' => 0]) }}">
                                                    <span class="original-tag-item">
                                                        #{{ $tag->tag }} <i class="fa fa-chevron-right"></i>
                                                    </span>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (!empty($sameWordPosts[0]->id))
                                <div class="row" style="padding-top: 2rem">
                                    <div class="col-md-12">
                                        <p class="original-subbar"><i class="fas fa-book-open"></i> 同じワードを含む投稿</p>
                                        @foreach ($sameWordPosts as $sameWordPost)
                                            <a href="{{ route('postShow', ['id' => $sameWordPost->id]) }}">
                                                <span class="original-img-square">
                                                    <img class="img-fluid original-img-square" src="{{asset('storage/postedImages/'.$sameWordPost->photo)}}">
                                                </span>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            @if (!empty($postsOrderByPopularity[0][0]->id))
                                <div class="row" style="padding-top: 2rem">
                                    <div class="col-md-12">
                                        <p class="original-subbar"><i class="fas fa-fire-alt"></i> 人気な投稿</p>
                                        @for ($i = 0; $i < count($postsOrderByPopularity) -1; $i++)
                                            <a href="{{ route('postShow', ['id' => $postsOrderByPopularity[$i][0]->id]) }}">
                                                <img class="img-fluid original-img-square" src="{{asset('storage/postedImages/'.$postsOrderByPopularity[$i][0]->photo)}}">
                                            </a>
                                        @endfor
                                    </div>
                                </div>
                            @endif
                            @if (!empty($postsOrderByLatest[0]->id))
                                <div class="row" style="padding-top: 2rem">
                                    <div class="col-md-12">
                                        <p class="original-subbar"><i class="far fa-file"></i> 新しい投稿</p>
                                        @for ($i = 0; $i < count($postsOrderByLatest); $i++)
                                            <a href="{{ route('postShow', ['id' => $postsOrderByLatest[$i]->id]) }}">
                                                <img class="img-fluid original-img-square" src="{{asset('storage/postedImages/'.$postsOrderByLatest[$i]->photo)}}">
                                            </a>
                                        @endfor
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>


                    <!-- コメントアイコン -->
                    <!-- <a href="#commentPlace">
                        <button type="button" id="commentButton" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">
                            <i class="far fa-comment"></i>
                        </button>
                    </a> -->

    <style>
        .reset-button{
            background-color: transparent;
            border: none;
            cursor: pointer;
            outline: none;
            padding: 0;
            appearance: none;
        }
        .original-text-muted{
            color: #c7b685;
            font-size: 0.8rem;
        }
        .original-text-small{
            font-size: 0.8rem;
            color: #9d8849;
            clear: both;
            margin-bottom: 5px;
            margin-top: 7px;
        }
        .original-border-around-with-padding{
            border: 2px solid #f1ece0;
            border-radius: 4px;
            padding: 20px 20px 10px 20px;
        }
        .original-border-around{
            border: 2px solid #f1ece0;
            border-radius: 4px;
        }
        .original-subbar{
            font-size: 0.8rem;
            font-weight: bold;
            background-color: #ece6d5;
            padding: 4px 3px 4px 8px;
            border-radius: 4px;
            margin-bottom: 10px;
            clear: both;
            margin-top: 0px;
        }
        .original-tag-item{
            color: #242424;
            background-color: #f7f5ee;
            /* border-color: #dacfaf; */
            border: 1px solid #dacfaf;
            border-radius: 30px!important;
            margin: 0 3px 5px 0;
            font-size: 0.8rem;
            padding: 3px 5px 3px 7px;
        }
        .original-img-square{
            width: 4rem;
            height: 4rem;
            object-fit: cover;
            border-radius: 6px;
        }
        .comment-icon{

        }
        .star {
            font-size: 0.8rem;
            color: #F2B950;
        }
        .comment-icon > img{
            width: 3rem;
            height: 3rem;
            border-radius: 50%;
        }
        /* スマホ用 */
        @media (max-width: 599px) {
            .submit-btn {
                margin-bottom: 2rem;
            }
        }
    </style>

    <script>
        // いいね
        $(function(){
            $('#like').on('click', function(){
                @auth
                    <?php if (Auth::user()->email_verified_at) { ?>
                        var likeFlag = document.getElementById("like").value;
                        var data = {postId: `{{$post->id}}`, userId: `{{ Auth::id() }}`};
                        if (likeFlag === "0") {
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url: '/like',
                                type: 'POST',
                                data: data
                            })
                            .done((data) => {
                                //成功した場合の処理
                                document.getElementById("like").value = "1";
                                var icon = document.getElementById("icon-color");
                                icon.classList.remove('far');
                                icon.classList.add('fas');
                                document.querySelector('#like').style.color = 'red'
                                var likeCount = data['count'];
                                document.getElementById('likeAreaJs').style.display = "";
                                if (likeCount > 0) {
                                    var likeInfo = document.getElementById('like-count');
                                    if (likeInfo) {
                                        likeInfo.remove();
                                    }
                                    let newLike = `
                                        <span id="like-count">
                                            <i class="far fa-heart" style="color: #F97855;"></i>
                                            <span style="color: #c7b685;"><small>${data['count']}回いいね!されてます</small></span>
                                        </span>
                                    `;
                                    // いいねしたユーザーのアイコンを表示
                                    let userIcon = document.getElementById('navigationUserIcon');
                                    let addUserId = "addUserImg" + data['user_id'];
                                    let addImg = `
                                        <span id="${addUserId}">
                                            <img src="${userIcon.getAttribute('src')}" alt="" style="width: 2rem; height: 2rem; border-radius: 50%;">
                                        </span>
                                    `;
                                    $(addImg).appendTo('#profilePhoto');
                                    $(newLike).appendTo('#likeAreaJs');
                                }
                                likeFlag = "1";
                            })
                            .fail((data) => {
                            })
                        } else if (likeFlag === "1") {
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url: '/deletelike',
                                type: 'POST',
                                data: data
                            })
                            .done((data) => {
                                //成功した場合の処理
                                document.getElementById("like").value = "0";
                                var icon = document.getElementById("icon-color");
                                icon.classList.remove('fas');
                                icon.classList.add('far');
                                document.querySelector('#like').style.color = 'icon-color'
                                var likeCount = data['count'];
                                document.getElementById('likeAreaJs').style.display = "";
                                var likeInfo = document.getElementById('like-count');
                                    likeInfo.remove();
                                    var deleteUserPhotoId = "addUserImg" + data['user_id'];
                                    var deleteUserPhoto = document.getElementById(deleteUserPhotoId);
                                    if (deleteUserPhoto) {
                                        deleteUserPhoto.remove();
                                    }
                                    var deleteNoUserPhotoId = "addNoUserId" + data['user_id'];
                                    var deleteNoUserPhoto = document.getElementById(deleteNoUserPhotoId);
                                    if (deleteNoUserPhoto) {
                                        deleteNoUserPhoto.remove();
                                    }
                                if (likeCount > 0) {
                                    let deleteLike = `
                                        <span id="like-count">
                                            <i class="far fa-heart" style="color: #F97855;"></i>
                                            <span style="color: #c7b685;"><small>${data['count']}回いいね!されてます</small></span>
                                        </span>
                                    `;
                                    $(deleteLike).appendTo('#likeAreaJs');
                                } else if (likeCount == "0") {
                                    // var likeInfo = document.getElementById('like-count');
                                    // likeInfo.remove();
                                }
                                likeFlag = "0";
                            })
                            .fail((data) => {
                            })
                        }
                    <?php } else { ?>
                        location.href = "{{ route('verification.notice') }}";
                    <?php } ?>


                @endauth

                @guest
                    location.href = "{{ route('login') }}";
                @endguest
            });
        });

        // コメント追加
        $(function(){
            $('#submitComment').on('click', function(){
                @auth
                var inputComment = document.getElementById('exampleFormControlTextarea1').value;
                var data = {postId: `{{$post->id}}`, userId: `{{ Auth::id() }}`, comment: inputComment};
                $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: '/comment',
                            type: 'POST',
                            data: data
                        })
                        .done((data) => {
                            // 削除用にid付与
                            commentCnt = document.getElementById('commentCnt').value;
                            // 取得したアイコンパスから、非同期で、画像を取得して、表示する
                            let newComment = `
                            <div class="row" style="padding-top: 2rem" id="destroyComment${commentCnt}">
                                    <div class="col-md-2">

                                        <span id="comment-icon-${commentCnt}">

                                        </span>

                                    </div>
                                    <div class="col-md-10 original-border-around-with-padding">
                                        <div>
                                            ${data['user_name']}
                                        </div>
                                        <div>
                                            <p>${data['content']}</p>
                                            <span class="original-text-muted" style="float: right">${data['time']}</span>

                                            <!-- Modalのボタン -->
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                                                <span><i class="far fa-trash-alt"></i></span>
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            本当に削除しますか？
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                                                            <button data-dismiss="modal" type="button" class="btn btn-danger" id="${commentCnt}" onclick="clk(this.id, this.value)" value=${data['content']}>削除する</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                            document.getElementById('commentAreaJS').insertAdjacentHTML('beforebegin',newComment);
                            // 画像を読み込み反映
                            if (data['profile_photo_path']) {
                                url = 'http://tsukushi.jp/storage/' + data['profile_photo_path'];
                                var img = new Image();
                                img.src = url;
                                $(img).bind("load", function() {
                                    //画像読み込み完了時の処理
                                    imgId = `span#comment-icon-${commentCnt}`;
                                    $(imgId).html($(img));
                                });
                                let addImg =  document.getElementById(`comment-icon-${commentCnt}`);
                                addImg.classList.add('comment-icon');
                            } else {
                                var noImgUserName = `{{ \Auth::user()->name }}`;
                                var userIcon = noImgUserName.substr(0, 2).toUpperCase();
                                let noImg = `
                                <div class="col-md-2">
                                    <div style="background-color: #EBF4FF; color: #7F9CF5; width: 3rem; height: 3rem; border-radius: 50%; margin-left: -1rem;">
                                        <div style="font-weight: bold; font-size: 20px; text-align: center; line-height: 3rem;">${userIcon}</div>
                                    </div>
                                </div>
                                `;
                                imgId = `span#comment-icon-${commentCnt}`;
                                $(noImg).appendTo(imgId);
                            }
                            //commentCntをカウントアップ
                            document.getElementById('commentCnt').value++;

                            // コメントフォームの中身を削除
                            var commentForm = document.getElementById("exampleFormControlTextarea1");
                            commentForm.value = "";
                        })
                        .fail((data) => {
                            //失敗した場合の処理
                        })
                @endauth
                @guest
                    location.href = "{{ route('login') }}";
                @endguest
            });
        });

        // コメント削除
        function clk(commentId, commentValue) {
            @auth
                var inputDestroyComment = 'commentArea' + commentId;
                var destroyComment = document.getElementById(inputDestroyComment);
                var data = {postId: `{{$post->id}}`, userId: `{{ Auth::id() }}`, content: commentValue};
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/deletecomment',
                    type: 'POST',
                    data: data
                })
                .done((data) => {
                    //commentCntをカウントダウン
                    document.getElementById('commentCnt').value--;
                    var destroyIdName = 'destroyComment' + commentId;
                    var destroyComment = document.getElementById(destroyIdName);
                    destroyComment.remove();
                });
            @endauth
            @guest
                location.href = "{{ route('login') }}";
            @endguest
        }

        // お気に入り保存
        $(function(){
            $('#favorite').on('click', function(){
                @auth
                    // var favoriteFlag = document.getElementById("favorite").value;
                    var data = {postId: `{{$post->id}}`, userId: `{{ Auth::id() }}`};
                    var currentFavoriteBtn = $('.star').attr('id');
                    if (currentFavoriteBtn == "favoriteBtn") {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: '/favorite',
                            type: 'POST',
                            data: data
                        })

                        .done((data) => {
                            //成功した場合の処理
                            $('#favoriteBtn').removeClass('far');
                            $('#favoriteBtn').addClass('fas');
                            $('#favoriteBtn').attr('id', 'favoriteBtnOn');
                        })
                        .fail((data) => {
                        })
                    } else {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: '/deletefavorite',
                            type: 'POST',
                            data: data
                        })
                        .done((data) => {
                            $('#favoriteBtnOn').removeClass('fas');
                            $('#favoriteBtnOn').addClass('far');
                            $('#favoriteBtnOn').attr('id', 'favoriteBtn');
                        })
                        .fail((data) => {
                        })
                    }
                @endauth

                @guest
                    location.href = "{{ route('login') }}";
                @endguest
            });
        });

        $(function(){
            var textLength = document.getElementById('exampleFormControlTextarea1');
            textLength.addEventListener("keyup", function() {
                document.getElementById('showTextLength').textContent = textLength.value.length;
                if (document.getElementById('showTextLength').textContent >= 255) {
                    document.getElementById('showTextLength').style.color = "red";
                } else {
                    document.getElementById('showTextLength').style.color = "#4C4C4C";
                }
            })
        })

    </script>
@endsection
