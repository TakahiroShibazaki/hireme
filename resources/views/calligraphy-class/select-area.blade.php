@extends('post.layout')

@section('content')
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <h2>エリア選択</h2>
        <table class="district-table">
            <tbody>
                <tr>
                    <td id="dist_1"><a href="{{ route('selectArea', ['district_code' => 1]) }}">北海道・東北</a></td>
                    <td id="dist_2"><a href="{{ route('selectArea', ['district_code' => 2]) }}">関東</a></td>
                    <td id="dist_3"><a href="{{ route('selectArea', ['district_code' => 3]) }}">甲信越・北陸</a></td>
                    <td id="dist_4"><a href="{{ route('selectArea', ['district_code' => 4]) }}">東海</a></td>
                    <td id="dist_5"><a href="{{ route('selectArea', ['district_code' => 5]) }}">近畿</a></td>
                    <td id="dist_6"><a href="{{ route('selectArea', ['district_code' => 6]) }}">中国</a></td>
                    <td id="dist_7"><a href="{{ route('selectArea', ['district_code' => 7]) }}">四国</a></td>
                    <td id="dist_8"><a href="{{ route('selectArea', ['district_code' => 8]) }}">九州・沖縄</a></td>
                </tr>
            </tbody>
        </table>
        <ul class="menu">
            @foreach ($classAreas as $classArea)
                <li class="prefecture-list">
                    <a class="prefecture-link js-prefecture-link" href=""><h2>{{ $classArea['prefecture_name'] }}</h2></a>
                    <ul class="area-list">
                        @for ($i = 0; $i < 3; $i++)
                            @if (isset($classArea[$i][0]['id']))
                                <li class="area-list-item municipality-type">
                                    <h3>{{ $classArea['prefecture_name'] }}の{{ $classArea[$i][0]['municipality_type'] }}</h3>
                                </li>
                                @foreach ($classArea[$i] as $area)
                                    <li class="area-list-item">
                                        <a href="{{ route('showClassList', ['district_code' => $classArea['district_code'], 'prefecture_code' => $area['prefecture_code'], 'area_code' => $area['id'] ]) }}">
                                            <i class="fas fa-chevron-right" style="color: #dbdad0"></i> {{ $area['area_name'] }}
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        @endfor
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="col-md-1"></div>
</div>

<style>
    /* district選択タブ */
    .district-table{
        width: 100%;
        border: 0;
        border-collapse: separate;
        border-top-left-radius: 6px;
        border-top-right-radius: 6px;
        border-bottom: 3px solid #C2D655;
    }
    .district-table td{
        text-align: center;
        background-color: #f3f2ec;
        font-weight: bold;
        color: rgb(88, 76, 32);
        padding-top: 10px;
        padding-bottom: 10px;
        width: 12.5%;
        border-right: 3px solid #fff;
    }
    .district-table td.active{
        color: #fff;
        background-color: #C2D655;
    }
    /* prefecture選択アコーディオン */
    .menu{
        width: 100%;
        padding-left: 0;
        padding-top: 0.4rem;
        margin: 0;
    }
    .prefecture-list {
        width: 100%;
        background: #f3f2ec;
        color: #5E504A;
        font: bold;
        cursor: pointer;
        display: block;
        margin-bottom: 1px;
        position: relative;
        border-radius: 10px;
        border: thin solid rgba(94, 80, 74, 0.3);
    }
    .prefecture-link {
        display: block;
        padding: 1rem;
    }
    .municipality-type{
        background-color: #f3f2ec;
        color: rgb(94, 85, 53);
        display: block;
        width: 100%;
        margin: 0;
        padding: 0;
        border-left: medium solid #C2D655;
    }
    .area-list {
        list-style: none;
        background: #fff;
        display: none;
        padding:1rem;
    }
    .area-list-item {
        font: bold;
        display: inline-block;
        color: #222;
        padding: 1rem;
    }

</style>

<script>
    // エリアの初期タブ選択
    $(function(){
        let url = location.href;
        let districtNum = 'dist_' + url.slice(-1);
        document.getElementById(districtNum).classList.add('active');
    })

    // 都道府県リストの開閉
    $(function() {
        $('.js-prefecture-link').each(function(){
            $(this).on('click',function(){
                $("+.area-list",this).slideToggle();
                return false;
            });
        });
    });
</script>

@endsection
