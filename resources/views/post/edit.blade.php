@extends('post.layout')

@section('content')
<div class="container-flued">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h1>edit</h1>
            <form action={{ route('postUpdate', $post->post_main_id) }} method="post" enctype="multipart/form-data">
            @method('PUT') 
            @csrf
                @php
                    $preMainId = $post->post_main_id;
                @endphp
                <div>
                    <input type="hidden" id ="preMainId" name="preMainId" value ="{{$preMainId}}">
                </div>
                <div class="form-group">
                    <label for="title">タイトル</label>
                    <input type="text" id="title" class='form-control' name="title" value="{{$post->title}}" required>
                </div>
                <div class="row">
                    <div class="col-md-12" style="text-align: center">
                        <label for="main_photo">
                            <span id="file_img_0" class="file_img">
                                <div id="up-button" style="opacity: 0.7;">
                                    <img class="img-fluid" style="width:100%" src="">
                                </div>
                            </span>
                            <img id="preview_0" src="{{asset('storage/postedImages/'.$post->photo)}}" style="max-width: 100%">
                            <input type="file" class="file_btn" style="display: none" id="main_photo" name="main_photo" value=""  accept="image/*" onchange="previewImage(this, 0);">
                        </label>
                    </div> 
                </div>
                <div class="row  no-gutters table-row">
                    <div class="col-md-3 table-category-name">
                        <p>タグ</p>
                    </div>
                    <div class="col-md-9 table-content">
                        <select id="tag" class="table-text-input" name="tag" value="{{$mainTagMap->tag_id}}">
                            <option value="" disabled>選択してください</option>
                            <?php
                                $tagCount = 0;
                                foreach ($tags as $tag) { 
                                    $tagCount ++;
                            ?>
                            <option id="tag_main_<?=$tagCount?>" value="{{$tag->tag_id}}">{{$tag->tag_name}}</option>
                        <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row no-gutters table-row">
                            <div class="col-md-3 table-category-name">
                                <p>エリア</p>
                            </div>
                            <div class="col-md-9 table-content">
                                <input type="text" class="table-text-input" id="area" name="area" value="{{$post->area}}" autocomplete="on" list="areas" placeholder="エリアを入力してね" required>
                                <datalist id="areas">
                                    @foreach ($areas as $area)
                                            <option value="{{$area->area_name}}">
                                    @endforeach
                                </datalist>
                            </div>
                        </div>
                        <div class="row  no-gutters table-row">
                            <div class="col-md-3 table-category-name">
                                <p>年</p>
                            </div>
                            <div class="col-md-9 table-content">
                                <select id="year" class="table-text-input" name="year" value="{{$post->year}}" required>
                                    <option id="2021" value="2021">2021年</option>
                                    <option id="2020" value="2020">2020年</option>
                                    <option id="2019" value="2019">2019年</option>
                                    <option id="2018" value="2018">2018年</option>
                                    <option id="2017" value="2017">2017年</option>
                                    <option id="2016" value="2016">2016年</option>
                                    <option id="2015" value="2015">2015年</option>
                                    <option id="2014" value="2014">2014年</option>
                                    <option id="2013" value="2013">2013年</option>
                                    <option id="2012" value="2012">2012年</option>
                                    <option id="2011" value="2011">2011年</option>
                                    <option id="2010" value="2010">2010年</option>
                                </select>
                            </div>
                        </div>
                        <div class="row  no-gutters table-row">
                            <div class="col-md-3 table-category-name">
                                <p>月</p>
                            </div>
                            <div class="col-md-9 table-content">
                                <select id="month" class="table-text-input" name="month" value="{{$post->month}}" required>
                                    <option id="month_1" value="1">1月</option>
                                    <option id="month_2" value="2">2月</option>
                                    <option id="month_3" value="3">3月</option>
                                    <option id="month_4" value="4">4月</option>
                                    <option id="month_5" value="5">5月</option>
                                    <option id="month_6" value="6">6月</option>
                                    <option id="month_7" value="7">7月</option>
                                    <option id="month_8" value="8">8月</option>
                                    <option id="month_9" value="9">9月</option>
                                    <option id="month_10" value="10">10月</option>
                                    <option id="month_11" value="11">11月</option>
                                    <option id="month_12" value="12">12月</option>
                                </select>
                            </div>
                        </div>
                        <div class="row  no-gutters table-row">
                            <div class="col-md-3 table-category-name">
                                <p>期間</p>
                            </div>
                            <div class="col-md-9 table-content">
                                <select id="term" class="table-text-input" name="term" value="{{$post->term->id}}" required>
                                    <option id="term_1" value="1">日帰り</option>
                                    <option id="term_2" value="2">1泊2日</option>
                                    <option id="term_3" value="3">2泊3日</option>
                                    <option id="term_4" value="4">3泊4日</option>
                                    <option id="term_5" value="5">5日間</option>
                                    <option id="term_6" value="6">6日間</option>
                                    <option id="term_7" value="7">7日間</option>
                                    <option id="term_8" value="8">8日間</option>
                                    <option id="term_9" value="9">9日間</option>
                                    <option id="term_10" value="10">10日間〜</option>
                                </select>
                            </div>
                        </div>
                        <div class="row  no-gutters table-row">
                            <div class="col-md-3 table-category-name">
                                <p>予算</p>
                            </div>
                            <div class="col-md-9 table-content">
                                <select id="budget" class="table-text-input" name="budget" value="{{$post->budget_id}}" required>
                                    <option value="" disabled>選択してください</option>
                                    <option id="budget_1"value="1">~1万円</option>
                                    <option id="budget_2"value="2">1万円~3万円</option>
                                    <option id="budget_3"value="3">3万円~5万円</option>
                                    <option id="budget_4"value="4">5万円~10万円</option>
                                    <option id="budget_5"value="5">10万円~20万円</option>
                                    <option id="budget_6"value="6">20万円~</option>
                                </select>
                            </div>
                        </div>
                        <div class="row  no-gutters table-row">
                            <div class="col-md-3 table-textarea-category-name">
                                <p>思い出</p>
                            </div>
                            <div class="col-md-9 table-content">
                                <textarea class="table-textarea-input" name="impression" rows="6" placeholder="" value="" required>{{$post->impression}}</textarea>
                            </div>
                        </div>

                {{-- sub_post --}}
                <div>
                    <div>
                        <input id="totalCount" type="hidden" name="totalCount" value ="<?=count($sub_posts);?>">
                    </div>
                    <?php
                        $count = 0;
                    ?>
                    @foreach ($sub_posts as $key => $value)
                        <?php $count++ ?>
                        <div id="form_<?=$count?>">
                            <div class="row">
                                <div id="subPostDiv_<?=$count?>" class="col-md-10">
                                    <div>
                                        <label id="subPostLabel_<?=$count?>">No.<?=$count?></label>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6" style="text-align: center">
                                            <label id="sub_photo_<?=$count?>_label" for="sub_photo_<?=$count?>" style="width:100%">
                                                @if (!empty($value->photo))
                                                    <input type="file" class="file_btn" id="sub_photo_<?=$count?>" name="sub_photo_<?=$count?>" value="" accept="image/*" onchange="previewImage(this, <?=$count?>);">
                                                    <span id="file_img_<?=$count?>" class="file_img">
                                                        <div id="up-button" style="opacity: 0.7;">
                                                            <img class="img-fluid " src="">
                                                        </div>
                                                    </span>
                                                    <img class="img-fluid" id="preview_<?=$count?>" src="{{asset('storage/postedImages/'.$value->photo)}}">
                                                @else
                                                    <input type="file" class="file_btn" id="sub_photo_<?=$count?>" name="sub_photo_<?=$count?>" value="" accept="image/*" onchange="previewImage(this, <?=$count?>);">
                                                    <span id="file_img_<?=$count?>" class="file_img">
                                                        <div id="up-button" style="opacity: 0.7;">
                                                            <img class="img-fluid" src="{{asset('storage/materials/up_img_icon.png')}}">
                                                        </div>
                                                    </span>
                                                    <img class="img-fluid" id="preview_<?=$count?>" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==">
                                                @endif
                                            </label>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label id="tag_<?=$count?>_label" for="tag_<?=$count?>">写真にタグをつけましょう！</label>
                                                <select id="tag_<?=$count?>" class="form-control" name="tag_<?=$count?>" value="{{$subTagMaps[$count-1]->tag_id}}">
                                                    <option value="" disabled>選択してください</option>
                                                    @foreach ($tags as $tag)
                                                        <option id ="tag_sub<?=$count?>_{{$tag->tag_id}}" value="{{$tag->tag_id}}">{{$tag->tag_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label  id="comment_<?=$count?>_label" name="comment_<?=$count?>">コメント:</label>
                                                <input id="comment_<?=$count?>" class="form-control" type="text" name="comment_<?=$count?>" value="{{$value->comment}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div>
                                        <div>
                                            <button id="upFormbtn_<?=$count?>" type="button" class="btn btn-primary" onclick="upForm(<?=$count?>)">↑</button>
                                        </div>
                                        <div>
                                            <button id="downFormbtn_<?=$count?>" type="button" class="btn btn-primary" onclick="downForm(<?=$count?>)">↓</button>
                                        </div>
                                        <div>
                                            <input type="hidden" id="delFlag_<?=$count?>" name="delFlag_<?=$count?>" value="0">
                                        </div>
                                        <div>
                                            <button id="delFlagBtn_<?=$count?>" type="button" class="btn btn-danger" onclick="delFlagBtn(<?=$count?>)">削除</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- ここに追加分subPostが入る --}}
                    <div>
                        <button type="button" id="addFormbtn" onclick="addForm()">旅先を追加</button>
                    </div>
                    <div>
                        <button type="button" id="delFormbtn" onclick="delForm()">旅先を削除</button>
                    </div>
                    <div class="button">
                        <button type="submit">更新する</button>
                    </div>
                </div>
            </form>
            <div class="form-inline float-right">
                <a href={{ route('postIndex') }} class='btn btn-outline-primary'>戻る</a>
            </div>
        </div>
        <div class="col-md-3 "></div>
    </div>
</div>

<style>
    .blur{
        -ms-filter: blur(6px);
        filter: blur(6px);
    }
    .file_btn{
        display: none;
    }

    .table-row{
        width: 100%;
        /* margin-left: 0px; */
        border-bottom: solid 2px white;
        text-align: center;
    }
    .table-category-name{
        background-color: #c691a5;
        text-align: center;
        color: white;
        font-weight: bold;
        display: table;
        position: relative;
        min-height: 3rem;
    }
    .table-category-name > p{
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        margin: auto;
        width: 90%;
        height: 80%;
    }
    .table-content{
        background-color: rgba(0,0,0,0.1);
        position: relative;
        min-height: 3rem;
    }
    .table-text-input {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        margin: auto;
        width: 90%;
        height: 80%;
        border-radius: 5px;
    }
    .table-textarea-input{
        width: 90%;
    }
    /* PC用 */
    @media(min-width: 600px){
        .table-textarea-category-name{
            background-color: #c691a5;
            text-align: center;
            color: white;
            font-weight: bold;
            display: table;
            position: relative;
            height: 10rem;
        }

    }
    /* スマホ用 */
    @media (max-width: 599px) {
        .table-textarea-category-name{
            background-color: #c691a5;
            text-align: center;
            color: white;
            font-weight: bold;
            display: table;
            position: relative;
            min-height: 3rem;
        }
    }
</style>


<script>
    //sub_post数をカウント
    let count = document.getElementById('totalCount').value;
    count = parseInt(count);

    /**
    * sub_post用の入力フォームを追加
    */
    function addForm()
    {
    
    if (count <= 30){
        count += 1;
        const form = document.createElement("div");
        form.id = `form_${count}`;

        let content =`
            <div class="row">
                <div id="subPostDiv_${count}" class="col-md-10">
                    <div>
                        <label id="subPostLabel_${count}">No.${count}</label>
                    </div>
                    <div>
                        <label id="sub_photo_${count}_label" for="sub_photo_${count}">写真を追加</label>
                        <input type="file" id="sub_photo_${count}" name="sub_photo_${count}" value=""  accept="image/*">
                    </div>
                    <div class="form-group">
                        <label id="tag_${count}_label" for="tag_${count}">写真にタグをつけましょう！</label>
                        <select id="tag_${count}" class="form-control" name="tag_${count}" value="">
                            <option value="" disabled selected>選択してください</option>
                            <?php foreach ($tags as $tag) { ?>
                                <option value="{{$tag->tag_id}}">{{$tag->tag_name}}</option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label id="comment_${count}_label" for="comment_${count}">コメント:</label>
                        <input id ="comment_${count}" class="form-control" type="text" name="comment_${count}" value="">
                    </div>
                </div>
                <div class="col-md-2">
                    <div>
                        <div>
                            <button id="upFormbtn_${count}" type="button" class="btn btn-primary" onclick="upForm(${count})">↑</button>
                        </div>
                        <div>
                            <button id="downFormbtn_${count}" type="button" class="btn btn-primary" onclick="downForm(${count})">↓</button>
                        </div>
                        <div>
                            <input type="hidden" id="delFlag_${count}" name="delFlag_${count}" value="0">
                        </div>
                        <div>
                            <button id="delFlagBtn_${count}" type="button" class="btn btn-danger" onclick="delFlagBtn(${count})">削除</button>
                        </div>
                    </div>
                </div>
            <div>
            
        `;
        form.innerHTML = content;

        let parentDiv = document.getElementById("addFormbtn").parentNode;
        let addbtn = document.getElementById("addFormbtn");
        parentDiv.insertBefore(form, addbtn);

        let totalCount = document.getElementById('totalCount');
        totalCount.value = parseInt(totalCount.value) + 1;

        } else if (count == 31) {
        const form = document.createElement("div");
        let content ="<p>投稿数の上限を超えています</p>"
        form.innerHTML = content;

        let parentDiv = document.getElementById("addFormbtn").parentNode;
        let addbtn = document.getElementById("addFormbtn");
        parentDiv.insertBefore(form, addbtn);
        }
    }

    /**
     * sub_post削除
     */
    function delForm(){
        if(document.getElementById(`form_${count}`)){
            const form = document.getElementById(`form_${count}`);
            form.remove();
            count -= 1;

            let totalCount = document.getElementById('totalCount');
            totalCount.value = parseInt(totalCount.value) - 1;
        }
    }

    /**
     * subPostの上下入れ替え機能 
     */
    function upForm(formNum){
        if (formNum > 1) {
            // １つ上のsubPostNum
            let refNum = formNum - 1;
            // 上に挿入される要素の親要素
            let  parent = document.getElementById('form_' + refNum).parentNode;
            // 挿入する要素
            let targetEle = document.getElementById('form_' + formNum);
            // 上に挿入される要素
            let referenceEle = document.getElementById('form_' + refNum);
            // 挿入
            parent.insertBefore(targetEle, referenceEle);

            // referenceEle書き換え
            // 全体div
            let referenceWholeDiv = document.getElementById('form_' + refNum);
            referenceWholeDiv.id = 'form_' + formNum;
            
            // contantDiv
            let referenceSubPostDiv = document.getElementById('subPostDiv_' + refNum);
            referenceSubPostDiv.id = 'subPostDiv_' + formNum;

            // delFlag
            let referenceDelFlag = document.getElementById('delFlag_' + refNum);
            referenceDelFlag.id = 'delFlag_' + formNum;
            referenceDelFlag.name = 'delFlag_' + formNum;

            // delFlagBtn
            let referenceDelFlagBtn = document.getElementById('delFlagBtn_' + refNum);
            referenceDelFlagBtn.id = 'delFlagBtn_' + formNum;
            referenceDelFlagBtn.setAttribute("onclick", 'delFlagBtn('+ formNum + ')');

            // No
            let referenceLabel = document.getElementById('subPostLabel_' + refNum);
            referenceLabel.id = 'subPostLabel_' + formNum;
            referenceLabel.innerHTML = 'No.' + formNum;

            // photo
            let referencePhotoLabel = document.getElementById('sub_photo_' + refNum + '_label');
            referencePhotoLabel.id = 'sub_photo_' + formNum + '_label';
            referencePhotoLabel.setAttribute("for", 'sub_photo_' + formNum + '_label');

            let referencePhoto = document.getElementById('sub_photo_' + refNum);
            referencePhoto.id = 'sub_photo_' + formNum;
            referencePhoto.name = 'sub_photo_' + formNum;

            // tag
            let referenceTagLabel = document.getElementById('tag_' + refNum + '_label'); 
            referenceTagLabel.id = 'tag_' + formNum + '_label'
            referenceTagLabel.setAttribute("for", 'tag_' + formNum + '_label');

            let referenceTag = document.getElementById('tag_' + refNum);
            referenceTag.id = 'tag_' + formNum;
            referenceTag.name = 'tag_' + formNum;

            // commnet
            let referenceCommentLabel = document.getElementById('comment_' + refNum + '_label');
            referenceCommentLabel.id =  'comment_' + formNum + '_label';
            referenceCommentLabel.setAttribute("for", 'comment_' + formNum + '_label');

            let referenceComment = document.getElementById('comment_' + refNum);
            referenceComment.id = 'comment_' + formNum;
            referenceComment.name = 'comment_' + formNum;

            //upbutton
            let referenceUpbtn = document.getElementById('upFormbtn_' + refNum);
            referenceUpbtn.id = 'upFormbtn_' + formNum;
            referenceUpbtn.setAttribute("onclick", 'upForm('+ formNum + ')');

            //downbutton
            let referenceDownbtn = document.getElementById('downFormbtn_' + refNum);
            referenceDownbtn.id = 'downFormbtn_' + formNum;
            referenceDownbtn.setAttribute("onclick", 'downForm('+ formNum + ')');
            
            // targetEle書き換え
            // 全体div
            let targetWholeDiv = document.getElementById('form_' + formNum);
            targetWholeDiv.id = 'form_' + refNum;

            //contentDiv
            let targetSubPostDiv = document.getElementById('subPostDiv_' + formNum);
            targetSubPostDiv.id = 'subPostDiv_' + refNum;

            // delFlag
            let targetDelFlag = document.getElementById('delFlag_' + formNum);
            targetDelFlag.id = 'delFlag_' + refNum;
            targetDelFlag.name = 'delFlag_' + refNum;

            // delFlagBtn
            let targetDelFlagBtn = document.getElementById('delFlagBtn_' + formNum);
            targetDelFlagBtn.id = 'delFlagBtn_' + refNum;
            targetDelFlagBtn.setAttribute("onclick", 'delFlagBtn('+ refNum + ')');

            // No
            let targetLabel = document.getElementById('subPostLabel_' + formNum);
            targetLabel.id = 'subPostLabel_' + refNum;
            targetLabel.innerHTML = 'No.' + refNum;

            // photo
            let targetPhotoLabel = document.getElementById('sub_photo_' + formNum + '_label');
            targetPhotoLabel.id = 'sub_photo_' + refNum + '_label';
            targetPhotoLabel.setAttribute("for", 'sub_photo_' + refNum + '_label');

            let targetPhoto = document.getElementById('sub_photo_' + formNum);
            targetPhoto.id = 'sub_photo_' + refNum;
            targetPhoto.name = 'sub_photo_' + refNum;

            // tag
            let targetTagLabel = document.getElementById('tag_' + formNum + '_label'); 
            targetTagLabel.id = 'tag_' + refNum + '_label'
            targetTagLabel.setAttribute("for", 'tag_' + refNum + '_label');

            let targetTag = document.getElementById('tag_' + formNum);
            targetTag.id = 'tag_' + refNum;
            targetTag.name = 'tag_' + refNum;

            // commnet
            let targetCommentLabel = document.getElementById('comment_' + formNum + '_label');
            targetCommentLabel.id =  'comment_' + refNum + '_label';
            targetCommentLabel.setAttribute("for", 'comment_' + refNum + '_label');

            let targetComment = document.getElementById('comment_' + formNum);
            targetComment.id = 'comment_' + refNum;
            targetComment.name = 'comment_' + refNum;

            //upbutton
            let targetUpbtn = document.getElementById('upFormbtn_' + formNum);
            targetUpbtn.id = 'upFormbtn_' + refNum;
            targetUpbtn.setAttribute("onclick", 'upForm('+ refNum + ')');

            //downbutton
            let targetDownbtn = document.getElementById('downFormbtn_' + formNum);
            targetDownbtn.id = 'downFormbtn_' + refNum;
            targetDownbtn.setAttribute("onclick", 'downForm('+ refNum + ')');
        }
    }

    function downForm(formNum) {
        let totalCount = document.getElementById('totalCount').value;

        if (formNum < totalCount ) {
            // １つ下のsubPostNum
            let refNum = formNum + 1;
            // 上に挿入される要素の親要素
            let  parent = document.getElementById('form_' + refNum).parentNode;
            // 挿入する要素
            let targetEle = document.getElementById('form_' + formNum);
            // 上に挿入される要素
            let referenceEle = document.getElementById('form_' + refNum);
            // 挿入
            parent.insertBefore(targetEle, referenceEle.nextSibling);

            // targetEle書き換え
            // 全体div
            let targetWholeDiv = document.getElementById('form_' + formNum);
            targetWholeDiv.id = 'form_' + refNum;

            //contentDiv
            let targetSubPostDiv = document.getElementById('subPostDiv_' + formNum);
            targetSubPostDiv.id = 'subPostDiv_' + refNum;

            // delFlag
            let targetDelFlag = document.getElementById('delFlag_' + formNum);
            targetDelFlag.id = 'delFlag_' + refNum;
            targetDelFlag.name = 'delFlag_' + refNum;

            // delFlagBtn
            let targetDelFlagBtn = document.getElementById('delFlagBtn_' + formNum);
            targetDelFlagBtn.id = 'delFlagBtn_' + refNum;
            targetDelFlagBtn.setAttribute("onclick", 'delFlagBtn('+ refNum + ')');

            // No
            let targetLabel = document.getElementById('subPostLabel_' + formNum);
            targetLabel.id = 'subPostLabel_' + refNum;
            targetLabel.innerHTML = 'No.' + refNum;

            // photo
            let targetPhotoLabel = document.getElementById('sub_photo_' + formNum + '_label');
            targetPhotoLabel.id = 'sub_photo_' + refNum + '_label';
            targetPhotoLabel.setAttribute("for", 'sub_photo_' + refNum + '_label');

            let targetPhoto = document.getElementById('sub_photo_' + formNum);
            targetPhoto.id = 'sub_photo_' + refNum;
            targetPhoto.name = 'sub_photo_' + refNum;

            // tag
            let targetTagLabel = document.getElementById('tag_' + formNum + '_label'); 
            targetTagLabel.id = 'tag_' + refNum + '_label'
            targetTagLabel.setAttribute("for", 'tag_' + refNum + '_label');

            let targetTag = document.getElementById('tag_' + formNum);
            targetTag.id = 'tag_' + refNum;
            targetTag.name = 'tag_' + refNum;

            // commnet
            let targetCommentLabel = document.getElementById('comment_' + formNum + '_label');
            targetCommentLabel.id =  'comment_' + refNum + '_label';
            targetCommentLabel.setAttribute("for", 'comment_' + refNum + '_label');

            let targetComment = document.getElementById('comment_' + formNum);
            targetComment.id = 'comment_' + refNum;
            targetComment.name = 'comment_' + refNum;

            //upbutton
            let targetUpbtn = document.getElementById('upFormbtn_' + formNum);
            targetUpbtn.id = 'upFormbtn_' + refNum;
            targetUpbtn.setAttribute("onclick", 'upForm('+ refNum + ')');

            //downbutton
            let targetDownbtn = document.getElementById('downFormbtn_' + formNum);
            targetDownbtn.id = 'downFormbtn_' + refNum;
            targetDownbtn.setAttribute("onclick", 'downForm('+ refNum + ')');

            // referenceEle書き換え
            // 全体div
            let referenceWholeDiv = document.getElementById('form_' + refNum);
            referenceWholeDiv.id = 'form_' + formNum;

            // contantDiv
            let referenceSubPostDiv = document.getElementById('subPostDiv_' + refNum);
            referenceSubPostDiv.id = 'subPostDiv_' + formNum;

            // delFlag
            let referenceDelFlag = document.getElementById('delFlag_' + refNum);
            referenceDelFlag.id = 'delFlag_' + formNum;
            referenceDelFlag.name = 'delFlag_' + formNum;

            // delFlagBtn
            let referenceFlagBtn = document.getElementById('delFlagBtn_' + refNum);
            referenceFlagBtn.id = 'delFlagBtn_' + formNum;
            referenceFlagBtn.setAttribute("onclick", 'delFlagBtn('+ formNum + ')');

            // No
            let referenceLabel = document.getElementById('subPostLabel_' + refNum);
            referenceLabel.id = 'subPostLabel_' + formNum;
            referenceLabel.innerHTML = 'No.' + formNum;

            // photo
            let referencePhotoLabel = document.getElementById('sub_photo_' + refNum + '_label');
            referencePhotoLabel.id = 'sub_photo_' + formNum + '_label';
            referencePhotoLabel.setAttribute("for", 'sub_photo_' + formNum + '_label');

            let referencePhoto = document.getElementById('sub_photo_' + refNum);
            referencePhoto.id = 'sub_photo_' + formNum;
            referencePhoto.name = 'sub_photo_' + formNum;

            // tag
            let referenceTagLabel = document.getElementById('tag_' + refNum + '_label'); 
            referenceTagLabel.id = 'tag_' + formNum + '_label'
            referenceTagLabel.setAttribute("for", 'tag_' + formNum + '_label');

            let referenceTag = document.getElementById('tag_' + refNum);
            referenceTag.id = 'tag_' + formNum;
            referenceTag.name = 'tag_' + formNum;

            // commnet
            let referenceCommentLabel = document.getElementById('comment_' + refNum + '_label');
            referenceCommentLabel.id =  'comment_' + formNum + '_label';
            referenceCommentLabel.setAttribute("for", 'comment_' + formNum + '_label');

            let referenceComment = document.getElementById('comment_' + refNum);
            referenceComment.id = 'comment_' + formNum;
            referenceComment.name = 'comment_' + formNum;

            //upbutton
            let referenceUpbtn = document.getElementById('upFormbtn_' + refNum);
            referenceUpbtn.id = 'upFormbtn_' + formNum;
            referenceUpbtn.setAttribute("onclick", 'upForm('+ formNum + ')');

            //downbutton
            let referenceDownbtn = document.getElementById('downFormbtn_' + refNum);
            referenceDownbtn.id = 'downFormbtn_' + formNum;
            referenceDownbtn.setAttribute("onclick", 'downForm('+ formNum + ')');
        }
    }

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

    /**
     * mainPost初期値設定
     */
        // year
        let year = document.getElementById('year');
        let yearVal = year.getAttribute('value');
        console.log(yearVal);
        let selectedYear = document.getElementById(yearVal);
        selectedYear.selected = true;
        //month
        let month = document.getElementById('month');
        let monthVal = month.getAttribute('value');
        let selectedMonth = document.getElementById('month_' + monthVal);
        selectedMonth.selected = true;
        //term
        let term = document.getElementById('term');
        let termVal = term.getAttribute('value');
        let selectedTerm = document.getElementById('term_' + termVal);
        selectedTerm.selected = true;
        //budgets
        let budget = document.getElementById('budget');
        let budgetVal = budget.getAttribute('value');
        let selectedBudget = document.getElementById('budget_' + budgetVal);
        selectedBudget.selected = true;
        //tag
        let tag = document.getElementById('tag');
        let tagVal = tag.getAttribute('value');
        let selectedTag = document.getElementById('tag_main_' + tagVal);
        selectedTag.selected = true;

    /**
     * subPostの初期値設定
     */
    
    for (let index = 0; index < {{$subPostCount}}; index++) {
        //tag
        var tagSub = document.getElementById('tag_' + String(index+1));
        var tagSubVal = tagSub.getAttribute('value');
        var selectedSubTag = document.getElementById('tag_sub' + String(index+1) + '_' + tagSubVal);
        selectedSubTag.selected = true;
    }

    /**
     * subPost削除機能
     */
     function delFlagBtn(formNum){
        let delFlag = document.getElementById('delFlag_' + formNum);
        let targetPost = document.getElementById('subPostDiv_' + formNum);
        console.log(delFlag);
        if (delFlag.value === "0") {
            delFlag.value = "1"; 
            targetPost.classList.add('blur');
        } else {
            delFlag.value = "0";
            targetPost.classList.remove('blur');
        }
    }
    
    
    
</script>



@endsection
