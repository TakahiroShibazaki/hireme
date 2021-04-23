@extends('post.layout')

@section('content')
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
    <div class="margin-1">検索結果 : {{count($calligraphyClasses)}}件</div>

        @foreach ($calligraphyClasses as $calligraphyClass)
            <div class="show-class">
                <h4 class="mt-0 class-name">{{ $calligraphyClass->class_name }}</h4>
                <div class="media main-border">
                    {{-- classImgがあるかつimg_type_idが1のファイルネーム(メイン画像)を取得してくる --}}
                    @if (isset($calligraphyClass->classImgs[0]) && $calligraphyClass->classImgs[0]->img_type_id === 1)
                        <img src="{{ asset('storage/classImages/'.$calligraphyClass->classImgs[0]->file_name) }}" alt="{{$calligraphyClass->classImgs[0]->file_name}}" style="width: 25%; height: auto;" class="main-border margin-1">
                    @else
                        <img src="{{ asset('storage/materials/mainLogo.png') }}" alt="" style="width: 25%; height: auto" class="main-border margin-1">
                    @endif

                    <div class="media-body table-body">
                        <table class="table table-bordered">
                            <tbody>
                            {{-- 現状住所では、初期値 - の場合はエリア名まで表示(住所見つからなかったものに - を登録した)
                                    アクセスや問い合わせなどは値がなければ - を表示している 最終的な処遇は検討中 --}}
                                <tr>
                                    <th class="table-title-color th-width">住所</th>
                                    @if ($calligraphyClass->address === "-")
                                        <th>{{$calligraphyClass->area->prefectures->prefecture_name . $calligraphyClass->area->area_name}}</th>
                                    @else
                                        <th>{{ $calligraphyClass->area->prefectures->prefecture_name . $calligraphyClass->area->area_name . $calligraphyClass->address }}</th>
                                    @endif
                                </tr>
                                <tr>
                                    <th class="table-title-color">アクセス</th>
                                    <th>{{$calligraphyClass->access}}</th>
                                </tr>
                                <tr>
                                    <th class="table-title-color">お問い合わせ</th>
                                    @if (!isset($calligraphyClass->contacts[0]))
                                        <th>-</th>
                                    @else
                                        <th>
                                            @foreach ($calligraphyClass->contacts as $contact)
                                                {{$contact->contactTypes[0]->platform}} : <a href="">{{$contact->registration_id}}</a>
                                                <br>
                                            @endforeach
                                        </th>
                                    @endif
                                </tr>
                                <tr>
                                    <th class="table-title-color">リンク</th>
                                    @if (!isset($calligraphyClass->classSiteUrls[0]))
                                        <th>-</th>
                                    @else
                                        <th>
                                            @foreach ($calligraphyClass->classSiteUrls as $classSiteUrl)
                                                <a href="{{$classSiteUrl->url}}">{{$classSiteUrl->url}}</a>
                                                <br>
                                            @endforeach
                                        </th>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="col-md-2"></div>
</div>
@endsection

<style>
.table-layout {
    table-layout:fixed;
}
.show-class {
    background-color: #F3F2EC;
    padding: 1rem;
    margin-bottom: 2rem;
}
.table-body {
    padding: 1rem 1rem 0 0;
}
.th-width {
    width: 8rem;
}
.main-border {
    border: double 3px #ccc;
    margin-bottom: 2rem;
    background-color: #fff;
}
.table-title-color {
    background-color: #F3F2EC;
}
.table-title-color {
    height: 3rem;
    vertical-align: middle !important;
}
.margin-1 {
    margin:1rem;
}
/* スマホ用 */
@media (max-width: 599px) {
    th {
        font-size: 0.5rem;
    }
    tr {
        width: 100%;
    }
    .th-width {
        width: 3rem;
    }
    .class-name {

    }
}
</style>