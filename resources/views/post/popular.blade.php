@extends('post.layout')

@section('content')
    <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-10">
            <div class="row">
                <div class="col-12">
                    <h2>人気の投稿</h2>
                </div>
            </div>
            <div class="row">
                <section class="wrapper">
                    <div class="container-fostrap">
                        <div class="content">
                            <div class="container">
                                <div class="row">
                                    @for ($i = 0; $i < count($postsOrderByPopularity) -1; $i++)
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="card">
                                                <a href="{{ route('postShow', ['id' => $postsOrderByPopularity[$i][0]->id]) }}">
                                                    <img class="img-fluid" src="{{asset('storage/postedImages/'.$postsOrderByPopularity[$i][0]->photo)}}">
                                                    <div class="card-content">
                                                        <a href="{{ route('profile.show', $postsOrderByPopularity[$i][0]->user->id) }}">
                                                            <img class="profile_photo" src="{{ $postsOrderByPopularity[$i][0]->user->profile_photo_url }}">
                                                            <span class="user-name">{{ $postsOrderByPopularity[$i][0]->user->name }}</span>
                                                        </a>
                                                        <span id="totalLikeNum_{{ $postsOrderByPopularity[$i][0]->id }}" class="totalLikeNum totalLikeNum_{{ $postsOrderByPopularity[$i][0]->id }}">
                                                            <i class="fas fa-heart fa-sm"></i> <span>{{ $postsOrderByPopularity[$i][0]['totalLikeNum'] }}</span>
                                                        </span>
                                                        <div style="padding: 1rem 0 1rem 0;">
                                                            <div style="display:inline-flex">
                                                                @foreach ($postsOrderByPopularity[$i]['tags'] as $tag)
                                                                    <a href="{{ route('searchComment', ['searchWords' => $tag->tag, 'nextPage' => 0]) }}">
                                                                        <span class="original-tag-item">
                                                                            #{{ $tag->tag }} <i class="fa fa-chevron-right"></i>
                                                                        </span>
                                                                    </a>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <div class="card-read-more">
                                                    <div class="row" style="padding: 0.5rem 0 0.5rem 0">
                                                        <div class="col-6">
                                                            <button id="popularPost_{{ $postsOrderByPopularity[$i][0]['id'] }}" class="like likeFlag_{{ $postsOrderByPopularity[$i][0]['id'] }} reset-button" value="{{ $postsOrderByPopularity[$i][0]['likeFlag'] }}">
                                                                <span style="color: #F97855;"><i class="far fa-heart"></i>いいね!</span>
                                                            </button>
                                                        </div>
                                                        <div class="col-6">
                                                            <a href="{{ route('postShow', ['id' => $postsOrderByPopularity[$i][0]->id]) }}"><i class="far fa-comment"></i>コメント</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-12">
                @if ($postsOrderByPopularity[0]['lastPage'] === 0)
                    <div class="more" style="padding-top:2rem">
                        <a href="{{ route('postPopular', ['nextPage' => $nextPage]) }}">もっと見る</a>
                    </div>
                @endif
            </div>
        <div class="col-md-1">
        </div>
    <style>
        h2{
            font-size: 1.4rem;
            font-weight: bold;
            color: rgb(88, 76, 32);
        }
        a:hover {
        text-decoration: none;
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
        .reset-button{
            background-color: transparent;
            border: none;
            cursor: pointer;
            outline: none;
            padding: 0;
            appearance: none;
        }
        .original-img-square{
            width: 8rem;
            height: 8rem;
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
        .card-read-more a {
            text-decoration: none !important;
            padding:10px;
            font-weight:600;
            text-transform: uppercase
        }
        .profile_photo{
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
        }
        .user-name{
            font-size: 0.5rem;
        }
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
        .totalLikeNum {
            color: #F97855;
            font-size: 0.7rem;
            float: right;
        }
    </style>

    @include('components.likeAjax')

@endsection
