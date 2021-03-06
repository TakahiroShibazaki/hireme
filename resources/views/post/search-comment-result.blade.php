@extends('post.layout')

@section('content')
{{-- {{ Breadcrumbs::render('searchComment', $searchWords, $searchedCommentResult[0]['nextPage']) }} --}}
<div class="container-fluid">
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="col-12">
                    <p>{{ $searchWords }}の検索結果</p>
                </div>
                <section class="wrapper">
                    <div class="container-fostrap">
                        <div class="content">
                            <div class="container">
                                <div class="row">
                                    @for ($i = 0; $i < count($searchedCommentResult[1]); $i++)
                                        <div class="col-sm-12 col-md-6 col-lg-4">
                                            <div class="card">
                                                <a href="{{ route('postShow', [ 'id' =>  $searchedCommentResult[1][$i]['id'] ]) }}">
                                                    <img class="img-fluid" src="{{ asset('storage/postedImages/'.$searchedCommentResult[1][$i]['photo']) }}">
                                                    <div class="card-content">
                                                        <a href="{{ route('profile.show', ['id' => $searchedCommentResult[1][$i]->user->id]) }}">
                                                            <img class="profile_photo" src="{{ $searchedCommentResult[1][$i]->user->profile_photo_url }}">
                                                            <span class="user-name">{{ $searchedCommentResult[1][$i]->user->name }}</span>
                                                        </a>
                                                        <span id="totalLikeNum_{{ $searchedCommentResult[1][$i]['id'] }}" class="totalLikeNum totalLikeNum_{{ $searchedCommentResult[1][$i]['id'] }}">
                                                            <i class="fas fa-heart fa-sm"></i> <span>{{ $searchedCommentResult[1][$i]['totalLikeNum'] }}</span>
                                                        </span>
                                                        <div style="padding: 1rem 0 1rem 0;">
                                                            <div style="display:inline-flex">
                                                                @foreach ($searchedCommentResult[1][$i]['tags'] as $tag)
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
                                                            <button id="commentPost_{{ $searchedCommentResult[1][$i]['id'] }}" class="like likeFlag_{{ $searchedCommentResult[1][$i]['id'] }} reset-button" value="{{ $searchedCommentResult[1][$i]['likeFlag'] }}">
                                                                <span style="color: #F97855;"><i class="far fa-heart"></i>いいね!</span>
                                                            </button>
                                                        </div>
                                                        <div class="col-6">
                                                            <a href="{{ route('postShow', ['id' => $searchedCommentResult[1][$i]['id']]) }}"><i class="far fa-comment"></i>コメント</a>
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
                @if ($searchedCommentResult[0]['lastPage'] !== 1)
                    <div class="col-12">
                        <div class="more" style="padding-top:2rem">
                            <a href="{{ route('searchComment', ['searchWords' => $searchWords, 'nextPage' => $searchedCommentResult[0]['nextPage']]) }}">もっと見る</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-md-3">
            @include('post.search')
        </div>
    </div>
</div>

<style>
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
</style>

@include('components.likeAjax')

@endsection
 