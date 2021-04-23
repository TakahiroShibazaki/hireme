@extends('post.layout')

@section('content')
{{-- {{ Breadcrumbs::render('postCreate') }} --}}
<div class="container-fluid">
    <div class="row">
    <div class="col-md-2"></div>
        <div class="col-md-8">
            <h2 style="padding-bottom: 2rem;">教室を登録する</h2>
            <form id="form" action={{ route('classStore') }} method="post" enctype="multipart/form-data">
            @csrf
                <div class="container">
                    <div class="row original-border-around-with-padding">
                        <div class="col-md-6">
                            <!-- 写真投稿 -->
                            <div class="row">
                                <div class="col-md-12" style="text-align: center">
                                    <label for="photo">
                                        <span id="file_img_0" class="file_img">
                                            <div id="up-button" style="opacity: 0.7;">
                                                <img class="img-fluid" style="width:100%" src="{{asset('storage/materials/stationery.jpeg')}}">
                                            </div>
                                        </span>
                                        <img id="preview_0" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" style="max-width: 100%">
                                        <input type="file" class="file_btn d-transparent" id="photo" name="photo" value="" accept="image/*" onchange="previewImage(this, 0);" required>
                                        <div>ロゴをクリックして画像を選びましょう！</div>
                                    </label>
                                </div>
                            </div>
                            <label for="img_type" class="original-subbar">
                                <span><img src="{{asset('storage/materials/maru_fude_icon.png')}}" alt="" style="width: 1rem; height: 1rem;"></span>
                                    画像タイプ
                                </label>
                            <div class="form-group">
                                <select id="img_type" class="table-text-input" name="img_type" value="">
                                    <option value="" selected disabled>画像タイプを選択</option>
                                    @foreach ($imageTypes as $imageType)
                                        <option value="{{ $imageType->id }}">{{ $imageType->img_type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="class-name" class="original-subbar">
                                    <span><img src="{{asset('storage/materials/maru_fude_icon.png')}}" alt="" style="width: 1rem; height: 1rem;"></span>
                                    教室名
                                </label>
                                <input type="text" class='form-control' id="class_name" name="class_name" placeholder="教室名">
                            </div>
                            <label for="area" class="original-subbar">
                                <span><img src="{{asset('storage/materials/maru_fude_icon.png')}}" alt="" style="width: 1rem; height: 1rem;"></span>
                                    教室エリア
                                </label>
                            <div class="form-group">
                                <select id="area" class="table-text-input" name="area" value="">
                                    <option value="" selected disabled>教室のエリアを選択</option>
                                    @foreach ($areas as $area)
                                        <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="address" class="original-subbar">
                                    <span><img src="{{asset('storage/materials/maru_fude_icon.png')}}" alt="" style="width: 1rem; height: 1rem;"></span>
                                    教室エリア以下の住所
                                </label>
                                <input type="text" class='form-control' id="address" name="address" placeholder="教室エリア以下の住所">
                            </div>
                            <div class="form-group">
                                <label for="access" class="original-subbar">
                                    <span><img src="{{asset('storage/materials/maru_fude_icon.png')}}" alt="" style="width: 1rem; height: 1rem;"></span>
                                    アクセス
                                </label>
                                <input type="text" class='form-control' id="access" name="access" placeholder="アクセス">
                            </div>
                            <div class="form-group">
                                <label for="url" class="original-subbar">
                                    <span><img src="{{asset('storage/materials/maru_fude_icon.png')}}" alt="" style="width: 1rem; height: 1rem;"></span>
                                    教室url
                                </label>
                                <input type="text" class='form-control' id="url" name="url" placeholder="url">
                            </div>
                            @for ($i = 1; $i < 4; $i++)
                                <label for="contact_type_{{ $i }}" class="original-subbar">
                                    <span><img src="{{asset('storage/materials/maru_fude_icon.png')}}" alt="" style="width: 1rem; height: 1rem;"></span>
                                    連絡先種別{{ $i }}
                                </label>
                                <div class="form-group">
                                    <select id="contact_type_{{ $i }}" class="table-text-input" name="contact_type_{{ $i }}" value="">
                                        <option value="" selected disabled>連絡先種別</option>
                                        @foreach ($contactTypes as $contactType)
                                            <option value="{{ $contactType->id }}">{{ $contactType->platform }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="contact_info_{{ $i }}" class="original-subbar">
                                        <span><img src="{{asset('storage/materials/maru_fude_icon.png')}}" alt="" style="width: 1rem; height: 1rem;"></span>
                                        連絡先{{ $i }}
                                    </label>
                                    <input type="text" class='form-control' id="contact_info_{{ $i }}" name="contact_info_{{ $i }}">
                                </div>
                            @endfor
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
     * preview機能
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

</script>
@endsection
