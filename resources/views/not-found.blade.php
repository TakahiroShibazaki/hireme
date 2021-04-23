@extends('post.layout')

@section('content')
    <div class="jumbotron">
        <h1 class="display-4">お探しのページは、以下のいずれかの理由により、見つかりませんでした。</h1>
        <p class="lead">・URLが間違っている</p>
        <p class="lead">・ページのURLが変更されている</p>
        <p class="lead">・削除されたか、または利用できない可能性があります。</p>
        <hr class="my-4">
        <p>お手数ですが、トップページ、またはサイト内検索からお求めのページをお探しください。</p>
        <a class="btn btn-primary btn-lg" href="/" role="button">TOPへ戻る</a>
    </div>
@endsection