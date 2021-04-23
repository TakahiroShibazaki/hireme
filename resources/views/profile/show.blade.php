@extends('post.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-10">
            @if ($user->user_header_img)
                <img src="{{asset('storage/user_header_img/'.$user->user_header_img)}}" class="img-fluid" alt="Responsive image" style="width: 100%; max-height: 250px; object-fit: cover;">
            @else
                <img src="{{asset('storage/materials/img03.webp')}}" alt="" style="width: 100%; max-height: 250px; object-fit: cover;">
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="user-profile y-1">
                        <img src="{{ $user->profile_photo_url }}" alt="" style="width: 5rem; height: 5rem; border-radius: 50%;">
                        <div class="user-name">{{ $user->name }}</div>
                    </div>
                    @if ($user->id !== Auth::id())
                        <button id="follow_{{ $user['id'] }}" class="follow btn btn-outline-success" value="{{ $followFlag }}">
                            <span>
                                +フォロー
                            </span>
                        </button>
                    @endif

                    <div class="user-info y-1">
                        @if ($user->belonging_group && $user->belonging_groupFlag === 1)
                            <div>所属するクラブや団体：{{$user->belonging_group}}</div>
                        @endif
                        @if ($user->prefecture && $user->prefectureFlag === 1)
                            <div>都道府県：{{$user->prefecture}}</div>
                        @endif
                        {{$user->birthyear}}
                        @if ($user->bd_year && $user->birthyearFlag === 1)
                            <div>誕生年：{{$user->bd_year}}年</div>
                        @endif

                        @if ($user->bd_day && $user->birthdayFlag === 1)
                            <div>{{$user->bd_month}}月{{$user->bd_day}}日</div>
                        @endif
                        @if ($user->website && $user->websiteFlag)
                            <a href="{{$user->user_website_url}}">
                                <div>{{$user->user_website_url}}</div>
                            </a>
                        @endif
                    </div>

                    @if ($user->introduction)
                        <div class="user-introduction y-1">{{$user->introduction}}</div>
                    @else
                        <p>自己紹介文はまだありません。</p>
                    @endif

                    @if ($user->id === Auth::id())
                        <a href="{{ route('profile.edit', auth()->user()->id) }}" style="display: block; margin-bottom: 1rem;">
                            <button class="btn btn-outline-info">プロフィールを編集する</button>
                        </a>
                    @endif
                </div>
                
                <div class="col-md-12">
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn user-status active radio_label"">
                            <input type="radio" name="options" class="selected" id="pastPosts" autocomplete="off" checked autofocus>過去の投稿
                            <div class="user-status-num">
                                @if ($posts)
                                    {{count($posts)}}
                                @else
                                    0
                                @endif
                            </div>
                        </label>
                        <label class="btn user-status radio_label">
                            <input type="radio" name="options" id="favoritePosts" autocomplete="off">お気に入り
                            <div class="user-status-num">
                                @if ($favorites)
                                    {{count($favorites)}}
                                @else
                                    0
                                @endif
                            </div>
                        </label>
                        <label class="btn user-status radio_label">
                            <input type="radio" name="options" id="followFriends" autocomplete="off">フォロー
                            <div class="user-status-num">
                                @if ($followUsers)
                                    {{count($followUsers)}}
                                @else
                                    0
                                @endif
                            </div>
                        </label>
                        <label class="btn user-status radio_label">
                            <input type="radio" name="options" id="followerFriends" autocomplete="off">フォロワー
                            <div class="user-status-num">
                                @if ($followerUsers)
                                    {{count($followerUsers)}}
                                @else
                                    0
                                @endif
                            </div>
                        </label>
                    </div>
                    <div class="tab past" id="past">
                        <h2>{{ $user->name }}さん<span class="h2mini">の投稿</span></h2>
                        @if ($posts)
                            <div class="row">
                                @foreach ($posts as $post)
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="card">
                                            <a href="{{ route('postShow', ['id' => $post->id]) }}">
                                                <div class="image-square">
                                                    <img src="{{ asset('storage/postedImages/'.$post->photo) }}" class="img-fluid">
                                                </div>
                                            </a>
                                            <div class="card-read-more">
                                                <div class="row" style="padding: 0.5rem 0 0.5rem 0">
                                                    <div class="col-6" style="text-align: center">
                                                        <button id="likePast_{{ $post['id'] }}" class="like reset-button likeFlag_{{ $post['id'] }}" value="{{ $post['likeFlag'] }}">
                                                            <span style="color: #F97855;"> <i class="far fa-heart"></i>いいね!</span>
                                                        </button>
                                                    </div>
                                                    <div class="col-6" style="text-align: center; border-left: 1px solid #D4D4D4;">
                                                        <a href="{{ route('postShow', ['id' => $post->id]) }}"><i class="far fa-comment"></i>コメント</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p>投稿はまだありません。</p>
                        @endif
                    </div>

                    <div class="tab favo non-display" id="favo">
                        <h2>お気に入り</h2>
                        @if ($favorites)
                        <div class="row">
                            @foreach($favorites as $favorite)
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="card">
                                        <a href="{{ route('postShow', ['id' => $favorite->id]) }}">
                                            <div class="image-square">
                                                <img src="{{ asset('storage/postedImages/'.$favorite->photo) }}" class="img-fluid">
                                            </div>
                                        </a>
                                        <div class="card-content">
                                            <a href="{{ route('profile.show', $favorite->user->id) }}">
                                                <img class="profile_photo" src="{{ $favorite->user->profile_photo_url }}">
                                                <span class="card-user-name">{{ $favorite->user->name }}</span>
                                            </a>
                                            {{-- @if ($favorite['totalLikeNum'] !== 0)
                                                <span class="totalLikeNum">
                                                    <i class="fas fa-heart fa-sm"></i> {{ $favorite['totalLikeNum'] }}
                                                </span>
                                            @endif --}}
                                            {{-- <div style="padding: 1rem 0 1rem 0;">
                                                <div style="display:inline-flex">
                                                    @foreach ($favorite['tags'] as $tag)
                                                        <a href="{{ route('searchComment', ['searchWords' => $tag->tag, 'nextPage' => 0]) }}">
                                                            <span class="original-tag-item">
                                                                #{{ $tag->tag }} <i class="fa fa-chevron-right"></i>
                                                            </span>
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div> --}}
                                        </div>
                                        <div class="card-read-more">
                                            <div class="row" style="padding: 0.5rem 0 0.5rem 0">
                                                <div class="col-6" style="text-align: center">
                                                    <button id="likeFavorite_{{ $favorite['id'] }}" class="like reset-button likeFlag_{{ $favorite['id'] }}" value="{{ $favorite['likeFlag'] }}">
                                                        <span style="color: #F97855;"><i class="far fa-heart"></i>いいね!</span>
                                                    </button>
                                                </div>
                                                <div class="col-6" style="text-align: center">
                                                    <a href="{{ route('postShow', ['id' => $favorite->id]) }}"><i class="far fa-comment"></i>コメント</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                            
                        @else
                            <p>お気に入りした投稿はまだありません。</p>
                        @endif
                    </div>
                    <div class="tab follow non-display" id="follow">
                        <h2>フォロー</h2>
                        @if ($followUsers)
                            @foreach ($followUsers as $followUser)
                                <div class="col-md-6 col-lg-4 col-xl-4">
                                    <div class="card">                    
                                        <div class="card-content">
                                            <a href="{{ route('profile.show', $followUser->id) }}">
                                                <img class="profile_photo" src="{{ $followUser->profile_photo_url }}">
                                                <span class="user-name">{{ $followUser->name }}</span>
                                            </a>
                                            <button id="follow_{{ $followUser['id'] }}" class="followButton followFlag_{{ $followUser['id'] }} btn btn-sm btn-outline-success" style="float:right;" value="{{ $followUser['followFlag'] }}">
                                                <span>
                                                    +フォロー
                                                </span>
                                            </button>
                                        </div>
                                        <div class="card-read-more">
                                            <div class="row">
                                                @if (isset($followUser['posts']))
                                                    @for ($i = 0; $i < count($followUser['posts']); $i++)
                                                        @if ($i % 2 === 0)
                                                            <div class="col-6" style="padding-right: 0">
                                                                <a href="{{ route('postShow', [ 'id' =>  $followUser['posts'][$i]['id'] ]) }}">
                                                                    <div class="image-square">
                                                                        <img class="img-fluid original-img-square" style="padding:0.2rem" src="{{ asset('storage/postedImages/'.$followUser['posts'][$i]['photo']) }}">
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        @else
                                                            <div class="col-6" style="padding-left: 0"> 
                                                                <a href="{{ route('postShow', [ 'id' =>  $followUser['posts'][$i]['id'] ]) }}">
                                                                    <div class="image-square">
                                                                        <img class="img-fluid original-img-square" style="padding:0.2rem" src="{{ asset('storage/postedImages/'.$followUser['posts'][$i]['photo']) }}">
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        @endif
                                                    @endfor
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div>フォローしているユーザーはまだいません</div>
                        @endif
                    </div>
                    <div class="tab follower non-display" id="follower">
                        <h2>フォロワー</h2>
                        @if ($followerUsers)
                            @foreach ($followerUsers as $followerUser)
                                <div class="col-md-6 col-lg-4 col-xl-4">
                                    <div class="card">                        
                                        <div class="card-content">
                                            <a href="{{ route('profile.show', $followerUser['id']) }}">
                                                <img class="profile_photo" src="{{ $followerUser->profile_photo_url }}">
                                                <span class="user-name">{{ $followerUser->name }}</span>
                                            </a>
                                            <button id="follower_{{ $followerUser['id'] }}" class="followButton followFlag_{{ $followerUser['id'] }} btn btn-sm btn-outline-success" style="float:right" value="{{ $followerUser['followFlag'] }}">
                                                <span>
                                                    +フォロー
                                                </span>
                                            </button>
                                        </div>
                                        <div class="card-read-more">
                                            <div class="row">
                                                @for ($i = 0; $i < count($followerUser['posts']); $i++)
                                                        @if ($i % 2 === 0)
                                                            <div class="col-6" style="padding-right: 0">
                                                                <a href="{{ route('postShow', [ 'id' =>  $followerUser['posts'][$i]['id'] ]) }}">
                                                                    <div class="image-square">
                                                                        <img class="img-fluid original-img-square" style="padding:0.2rem" src="{{ asset('storage/postedImages/'.$followerUser['posts'][$i]['photo']) }}">
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        @else
                                                            <div class="col-6" style="padding-left: 0"> 
                                                                <a href="{{ route('postShow', [ 'id' =>  $followerUser['posts'][$i]['id'] ]) }}">
                                                                    <div class="image-square">
                                                                        <img class="img-fluid original-img-square" style="padding:0.2rem" src="{{ asset('storage/postedImages/'.$followerUser['posts'][$i]['photo']) }}">
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        @endif
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div>フォローされているユーザーはまだいません</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-1">
        </div>
    </div>
</div>

<style>
.image-square{
    position:relative;
    overflow:hidden;
    padding-bottom:100%;
}
.image-square img{
    position:absolute;
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.user-profile {
    display: flex;
}
.profile_photo{
    width: 2rem;
    height: 2rem;
    border-radius: 50%;
}
.card-user-name{
    font-size: 0.5rem;
}
.user-name {
    line-height: 500%;
    padding-left: 1rem;
    font-weight: bold;
}
.user-status {
    padding: 1rem;
}
.user-status:focus {
    outline:0;
}
.user-status:hover {
    background-color: #FCF1DE;
    border-bottom: solid 3px #F5CD84;
}
.btn:focus {
	outline:0;
}
.focus {
    background-color: #FCF1DE;
    border-bottom: solid 3px #F5CD84;
}
.selected {
    background-color: #FCF1DE;
    border-bottom: solid 3px #F5CD84;
}
.user-status-num {
    text-align: center;
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
.y-1 {
    margin: 1rem 0;
}
.non-display {
    display: none;
}
.follow-border {
    border-bottom:1px solid #CCCCCC;
    margin: 1rem 0 0 0;
}

    /*ポスト用カードcss*/
    .card {
        display: block; 
        margin-bottom: 20px;
        line-height: 1.42857143;
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12);
        transition: box-shadow .25s;
    }
    .card:hover {
        box-shadow: 0 8px 17px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    }
    .card-content {
        padding:15px;
        text-align:left;
    }
    .card-read-more {
        border-top: 1px solid #D4D4D4;
    }
    .card-read-more a {
        text-decoration: none !important;
        text-transform: uppercase
    }

    /* スマホ用 */
    @media (max-width: 599px) {
        .tab {
            margin-top: 2rem;
        }
        .user-status {
            font-size: 0.8rem;
        }
    }
</style>

<script>
document.getElementById("pastPosts").onclick = function() {
    $('.tab').addClass('non-display');
    $('#past').removeClass('non-display');
    $('.radio_label').removeClass('selected');
    $('#pastPosts').parent().addClass('selected');
};
document.getElementById("favoritePosts").onclick = function() {
    $('.tab').addClass('non-display');
    $('#favo').removeClass('non-display');
    $('.radio_label').removeClass('selected');
    $('#favoritePosts').parent().addClass('selected');
};
document.getElementById("followFriends").onclick = function() {
    $('.tab').addClass('non-display');
    $('#follow').removeClass('non-display');
    $('.radio_label').removeClass('selected');
    $('#followFriends').parent().addClass('selected');
};
document.getElementById("followerFriends").onclick = function() {
    $('.tab').addClass('non-display');
    $('#follower').removeClass('non-display');
    $('.radio_label').removeClass('selected');
    $('#followerFriends').parent().addClass('selected');
};
// いいねの初期値
$(function(){
    let likes = document.getElementsByClassName('like');
    likes = Array.from(likes) ;
    likes.forEach(like => {
        if (like.value === '1') {
            target = document.getElementById(like.id).firstElementChild.firstElementChild;
            target.classList.remove('far');
            target.classList.add('fas');
        }
    });
});
// いいねクリック
$(function(){
    $('.like').on('click', function(){
        @auth
            <?php if (Auth::user()->email_verified_at) { ?>
                let htmlId = $(this).attr('id')
                let postId = htmlId.split('_');
                postId = postId[1];
                let likeFlag = $(this).attr('value');
                let data = {postId: postId, userId: `{{ Auth::id() }}`};
                let url = '/deletelike';
                if (likeFlag === '0') {
                    url = '/like';
                }
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: 'POST',
                    data: data
                })
                .done((data) => {
                    let targets = document.getElementsByClassName(`likeFlag_${postId}`);
                    targets = Array.from(targets);
                    targets.forEach(target => {
                        let targetId = document.getElementById(target.id);
                        targetId.firstElementChild.firstElementChild.classList.toggle('far');
                        targetId.firstElementChild.firstElementChild.classList.toggle('fas');
                        if (likeFlag === '0') {
                            targetId.value = '1';
                        } else {
                            targetId.value = '0';
                        }
                    });
                })
                .fail((data) => {
                    console.log('fail');
                })
            <?php } else { ?>
                location.href = "{{ route('verification.notice') }}";
            <?php } ?>
        @endauth
        @guest
            location.href = "{{ route('login') }}";
        @endguest
    });
});

// followの初期値
$(function(){
    let follows = document.getElementsByClassName('followButton');
    follows = Array.from(follows);
    follows.forEach(follow => {
        if (follow.value === '1') {
            target = document.getElementById(follow.id);
            target.classList.remove('btn-outline-success');
            target.classList.add('btn-success');
            target.firstElementChild.textContent = 'フォロー中';
        }
    })
});

// follow
$(function(){
    $('.followButton').on('click', function(){
        @auth
            // '_'から後ろがuserid
            let id = $(this).attr('id');
            let userId = id.split('_');
            let followUserId = userId[1];
            console.log(followUserId);
            let followFlag = $(this).attr('value');
            let data = {userId: `{{ Auth::id() }}`, followUserId: followUserId};
            let url = '/user/unfollow';
            if (followFlag === '0') {
                url = '/user/follow';
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: 'POST',
                data: data
            })
            .done((data) => {
                targets = document.getElementsByClassName(`followFlag_${followUserId}`);
                targets = Array.from(targets);
                targets.forEach(target => {
                    // let targetId = document.getElementById(target.id);
                    target.classList.toggle('btn-outline-success');
                    target.classList.toggle('btn-success');
                    if (followFlag === '0') {
                        target.value = '1';
                        target.firstElementChild.textContent = 'フォロー中';
                    } else {
                        target.value = '0';
                        target.firstElementChild.textContent = '+フォロー';
                    }
                })
            })
            .fail((data) => {
            })
        @endauth
        @guest
            location.href = "{{ route('login') }}";
        @endguest
    })
});
</script>

@endsection