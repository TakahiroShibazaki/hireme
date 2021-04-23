@extends('post.layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="col-12">
                    <p>{{ $searchResultUser[0]['searchUser'] }}の検索結果</p>
                </div>
                @if (!isset($searchResultUser[1]['0']['id']))
                    <div class="col-12">
                        検索結果が0件です
                    </div>
                    @php
                        $tags = [
                            '習字',
                            '書道',
                            '筆',
                            '書初め',
                            'カリグラフィー',
                            '万年筆',
                            '羽ペン',
                            'モダンカリグラフィー',
                            '手書き',
                            '西洋書法',
                            'handlettering',
                            'lettering',
                            '筆ペン',
                            'レタリング',
                            'ハンドレタリング',
                            '書法',
                            '書道アート',
                            '筆文字',
                            '書',
                            '毛筆',
                            'ペン',
                            'ガラスペン'
                        ];
                    @endphp
                    <div class="col-12">
                        <div style="padding: 0.7rem; text-align: center">
                            <h2>人気のタグから探す!</h2>
                            @foreach ($tags as $tag)
                                <a href="{{ route('searchComment', ['searchWords' => $tag, 'nextPage' => 0]) }}">
                                    <span class="original-tag-item" style="display: inline-block;">
                                        #{{ $tag }} <i class="fa fa-chevron-right"></i>
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
                @if (isset($searchResultUser[1]['0']['id']))
                    @foreach ($searchResultUser[1] as $user)
                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="card">                        
                                <div class="card-content">
                                    <a href="{{ route('profile.show', $user['id']) }}">
                                        <img class="profile_photo" src="{{ asset('storage/'.$user['profile_photo_path']) }}">
                                        <span class="user-name">{{ $user['name'] }}</span>
                                    </a>
                                    <button id="follow_{{ $user['id'] }}" class="follow  btn btn-sm btn-outline-success" style="float:right" value="{{ $user['followFlag'] }}">
                                        <span>
                                            +フォロー
                                        </span>
                                    </button>
                                </div>
                                <div class="card-read-more">
                                    <div class="row">
                                        @for ($i = 0; $i < count($user['posts']); $i++)
                                                @if ($i % 2 === 0)
                                                    <div class="col-6" style="padding-right: 0">
                                                        <a href="{{ route('postShow', [ 'id' =>  $user['posts'][$i]['id'] ]) }}">
                                                            <div class="image-square">
                                                                <img class="img-fluid original-img-square" style="padding:0.2rem" src="{{ asset('storage/postedImages/'.$user['posts'][$i]['photo']) }}">
                                                            </div>
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="col-6" style="padding-left: 0"> 
                                                        <a href="{{ route('postShow', [ 'id' =>  $user['posts'][$i]['id'] ]) }}">
                                                            <div class="image-square">
                                                                <img class="img-fluid original-img-square" style="padding:0.2rem" src="{{ asset('storage/postedImages/'.$user['posts'][$i]['photo']) }}">
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
                @endif
            </div>
        </div>
        <div class="col-md-3">
            @include('post.search')
        </div>
    </div>
</div>

<style>
    .more{
            text-align: center
    }
    .more a{
        display:block;
        width: 100%;
        padding-top: 6px;
        padding-bottom: 6px;
        background-color: #f7f5ee;
        border: 1px solid #9d8849;
        border-radius: 4px;
        color: #9d8849;
    }
        .original-img-square{
            width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 6px;
        }
        

        .wrapper {
            display: table;
            /* height: 100%; */
            width: 100%;
        }

        .container-fostrap {
        display: table-cell;
        padding: 1em;
        text-align: center;
        vertical-align: middle;
        }
        .fostrap-logo {
        width: 100px;
        margin-bottom:15px
        }
        h1.heading {
        color: #fff;
        font-size: 1.15em;
        font-weight: 900;
        margin: 0 0 0.5em;
        color: #505050;
        }
        @media (min-width: 450px) {
        h1.heading {
            font-size: 3.55em;
        }
        }
        @media (min-width: 760px) {
        h1.heading {
            font-size: 3.05em;
        }
        }
        @media (min-width: 900px) {
        h1.heading {
            font-size: 3.25em;
            margin: 0 0 0.3em;
        }
        } 
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
        .img-card {
            width: 100%;
            height:200px;
            border-top-left-radius:2px;
            border-top-right-radius:2px;
            display:block;
            overflow: hidden;
        }
        .img-card img{
            width: 100%;
            height: 200px;
            object-fit:cover; 
            transition: all .25s ease;
        } 
        .card-content {
            padding:15px;
            text-align:left;
        }
        .card-title {
            margin-top:0px;
            font-weight: 500;
            font-size: 1em;
        }
        .card-title a {
            color: #000;
            text-decoration: none !important;
        }
        .card-read-more {
            border-top: 1px solid #D4D4D4;
        }
        /* .card-read-more a {
            text-decoration: none !important;
            padding:10px;
            font-weight:600;
            text-transform: uppercase
        } */
        .profile_photo{
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
        }
        .user-name{
            font-size: 0.5rem;
        }
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
</style>

<script>
    // followの初期値
    $(function(){
        let follows = document.getElementsByClassName('follow');
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
        $('.follow').on('click', function(){
            @auth
                let id = $(this).attr('id').replace('follow_', '');
                let followFlag = $(this).attr('value');
                let data = {userId: `{{ Auth::id() }}`, followUserId: id};
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
                    target = document.getElementById('follow_' + id);
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
 