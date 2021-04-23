
 <div class="row">
    <div class="col-md-12">
        <div style="text-align: center; background-color: rgba(199, 189, 165, 1); padding: 0.7rem; border-radius: 10px 10px 0px 0px ;">
            <p style="line-height: 0.7rem; color: white; font-size: 1.6rem;">Search</p>
        </div>
        <div style="background-color: rgba(199, 189, 165, 0.7); padding:0.7rem; border-radius: 0px 0px 10px 10px;">
            <form id="form" action={{ route('postSearch') }} method="get" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="word">フリーワード検索</label>
                    <input type="text" class='form-control' id="word" name="word">
                </div>
                <div class="row">
                    <div class="col-md-12" style="">
                        <button class="btn" style="background-color: #c691a5; color: white; width: 100%" type="submit">検索</button>
                    </div>
                </div>
            </form>
            <form id="form" action={{ route('userSearch') }} method="get" enctype="multipart/form-data">
                @csrf
                <div class="form-group" style="padding-top: 1rem;">
                    <label for="userStr">ユーザー検索</label>
                    <input type="text" class='form-control' id="userStr" name="userStr">
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn" style="background-color: #c691a5; color: white; width: 100%" type="submit">検索</button>
                    </div>
                </div>
            </form>
            <p style="padding-top: 1.5rem">人気のタグから検索</p>
            <div style="background-color: white; border-radius: 10px 10px 10px 10px;">
                <span style="width: 90%;">
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
                    <div style="padding: 0.7rem; text-align: center">
                        @foreach ($tags as $tag)
                            <a href="{{ route('searchComment', ['searchWords' => $tag, 'nextPage' => 0]) }}">
                                <span class="original-tag-item" style="display: inline-block;">
                                    #{{ $tag }} <i class="fa fa-chevron-right"></i>
                                </span>
                            </a>
                        @endforeach
                    </div>
                </span>
            </div>
        </div>
    </div>
 </div>

 <style>
     .original-tag-item{
        color: #242424;
        background-color: #f7f5ee;
        border: 1px solid #dacfaf;
        border-radius: 30px!important;
        margin: 0 3px 5px 0;
        font-size: 0.8rem;
        padding: 3px 5px 3px 7px;
     }
 </style>
 
 
