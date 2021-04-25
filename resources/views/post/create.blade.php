@extends('post.layout')

@section('content')
{{-- {{ Breadcrumbs::render('postCreate') }} --}}
<div class="container-fluid">
    <div class="row">
    <div class="col-md-2"></div>
        <div class="col-md-8">
            <h2 style="padding-bottom: 2rem;">作品を投稿する</h2>
            <form id="form" action={{ route('postStore') }} method="post" enctype="multipart/form-data">
            @csrf
                <div class="container">
                    {{-- エラー文表示 --}}
                    <div class="row">
                        <div class="col-md-12 alert-danger" style="padding-bottom: 1rem">
                            @if (count($errors) > 0)
                                {{-- TODO:エラー時の画像の初期値を設定 --}}
                                <ul>
                                    <li>画像をもう一度画像を選択してください</li>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="row original-border-around-with-padding">
                        <div class="col-md-6">
                            {{-- 写真投稿 --}}
                            <div class="row">
                                <div class="col-md-12" style="text-align: center">
                                    <label for="photo">
                                        <span id="file_img_0" class="file_img">
                                            <div id="up-button" style="opacity: 0.7;">
                                                <img class="img-fluid" style="width:100%" src="{{ asset('storage/materials/stationery.jpeg') }}">
                                            </div>
                                        </span>
                                        <img id="preview_0" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" style="max-width: 100%">
                                        <input type="file" class="file_btn d-transparent" id="photo" name="photo" value="" accept="image/*" onchange="previewImage(this, 0);" required>
                                        <div>ロゴをクリックして画像を選びましょう！</div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            {{-- 書いた文字入力欄 --}}
                            <div class="form-group">
                                <label for="word" class="original-subbar">
                                <span><img src="{{asset('storage/materials/maru_fude_icon.png')}}" alt="" style="width: 1rem; height: 1rem;"></span>
                                    書いた文字
                                </label>
                                <input type="text" class='form-control' id="word" name="word" value="{{ old('word') }}" maxlength="255" placeholder="どんな文字を書きましたか?">
                            </div>
                            <br>
                            {{-- コメント入力欄 --}}
                            <div class="form-group">
                                <label for="comment" class="original-subbar">
                                    <i class="fas fa-comment-dots"></i>
                                    <span>コメント</span>
                                    <span style="float: right;">
                                        <button type="button" class="btn-color" data-toggle="tooltip" data-placement="right" title="「#」に続けて好きなキーワードを入力するとタグを付けられます。&#10;複数のタグを付けたい場合は間にスペースを入力して下さい。">
                                            <i class="far fa-question-circle"></i>
                                        </button>
                                    </span>
                                </label>
                                <textarea class="form-control" id="comment" name="comment" value="{{ old('comment') }}" placeholder="「#」に続けて好きなキーワードを入力するとタグを付けられます。&#10;複数のタグを付けたい場合は間にスペースを入力して下さい。" type="text" rows="6" maxlength="255">{{ old('comment') }}</textarea>
                                <div><span id="showTextLength">0</span>/255文字です。<span class ="text-length-alert">255文字以内で入力して下さい。</span></div>
                            </div>
                        </div>
                        {{-- よく使われるタグ表示 TODO:DBからよく使われるタグ順に取得し表示 --}}
                        <div class="col-md-12 often-tags">
                            <h2 style="margin-bottom: 1rem;">#よく使われるタグ</h2>
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
                            @foreach ($tags as $tag)
                                <span class="original-tag-item" style="display: inline-block;>
                                    <button class="tagBtn reset-button" type="button" id="{{ $tag }}" value="{{ $tag }}" onclick="tagBtnClk(this.id)">
                                        #{{ $tag }}<i class="fa fa-chevron-right"></i>
                                    </button>
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="button-flex">
                    <div class="button">
                        <div>
                            <button type="submit" class="btn btn-outline-info">メッセージを送信</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        {{-- @include('post.search') --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    #dialog-img{
        background-color: white;
        display:inline-block;
    }
    #dialog-img img{
        opacity: 0.5;
        display:block;
    }
    #dialog-img:after{
        content: "クリックしてトップ写真を選択してください";
        position: absolute;
        top: 100px;
        left: 90px;
        font-size: 20px;
        color:white;
    }
    ul{
        list-style: none;
    }
    .create-title {
        background-color: #ece6d5;
        margin-bottom: 3rem;
        font-weight: 900;
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
        width: 100%;
    }
    input {
        margin: 0;
    }
    .original-border-around-with-padding{
        border: 2px solid #f1ece0;
        border-radius: 4px;
        padding: 40px 20px 10px 20px;
    }
    .button-flex {
        margin: 1rem 0;
        text-align: right;
    }
    .btn-color {
        background-color: transparent;
    }
    .d-transparent {
        width: 1px;
        height: 1px;
        opacity: 0;
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
    .often-tags {
        text-align: center;
        margin-top: 1rem;
    }
    .text-length-alert {
        background-color: #D3D3D3;
        display: none;
    }
</style>

<script>

    /**
     * 画像preview機能
     */
    function previewImage(obj, formNum)
    {
        var fileReader = new FileReader();
        fileReader.onload = (function() {
            document.getElementById('preview_' + formNum).src = fileReader.result;
        });
        fileReader.readAsDataURL(obj.files[0]);
        document.getElementById('file_img_' + formNum).style.display = "none";
    }

    /**
     * タグクリックでタグ文字列追加
     */
    function tagBtnClk(tagName) {
        var tag = tagName;
        document.getElementById('comment').value += " " + "#" + tagName;
    }

    /**
     * commentの文字数カウント
     */
    var textLength = document.getElementById('comment');
    textLength.addEventListener("keyup", function() {
        document.getElementById('showTextLength').textContent = textLength.value.length;
        if (document.getElementById('showTextLength').textContent >= 255) {
            document.getElementById('showTextLength').style.color = "red";
        } else {
            document.getElementById('showTextLength').style.color = "#4C4C4C";
        }
    })

    /**
     * tooltipの初期化
     */
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

</script>
@endsection
