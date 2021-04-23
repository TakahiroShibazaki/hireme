<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('プロフィールを編集') }}
    </x-slot>

    <x-slot name="description">
        {{ __('') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            wire:model="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " onChange="changeProfilePhoto()" id="changeicon" />

                <x-jet-label for="photo" value="{{ __('アイコン') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover" id="currentPhoto">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview">
                    <span class="block rounded-full w-20 h-20"
                          x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'" id="previewPhoto" >
                    </span>
                </div>

                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('アイコン写真を選ぶ') }}
                </x-jet-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto" id="deleteProfilePhoto">
                        {{ __('アイコンを削除する') }}
                    </x-jet-secondary-button>
                @endif

                <x-jet-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- ヘッダー画像 -->
        <div class="col-span-6 sm:col-span-4">
            <form enctype="multipart/form-data" id="userHeaderImgForm" method="post">
                <label for="userHeaderImg">
                    <span id="file_img_0" class="file_img">
                        @if ($state['user_header_img'] === null)
                            <div id="up-button" style="opacity: 0.7;">
                                <img class="img-fluid" style="width:100%" src="{{asset('storage/materials/stationery.jpeg')}}">
                            </div>
                        @else
                            <img src="{{asset('storage/user_header_img/'.$state['user_header_img'])}}" alt="" style="width:100%" id="header">
                        @endif
                    </span>
                    
                    <img id="preview_0" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" style="max-width: 100%">
                    <input type="file" class="file_btn d-transparent" id="userHeaderImg" value="" accept="image/*" onchange="previewImage(this, 0);">
                    <div class="inline-flex items-center bg-white border border-gray-300 px-4 py-2 rounded-md font-semibold text-xs text-gray-700 shadow-sm uppercase tracking-widest hover:text-gray-500">ヘッダー写真を選ぶ</div>
                </label>
            </form>
        </div>
        

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('名前') }}" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" autocomplete="name" />
            <x-jet-input-error for="name" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="email" value="{{ __('メールアドレス') }}" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" />
            <x-jet-input-error for="email" class="mt-2" />
        </div>

        <!-- introduction -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="introduction" value="{{ __('自己紹介') }}" class=""/>
            <div class="form-input">
                <textarea name="" id="introduction" cols="28" rows="8" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" wire:model.defer="state.introduction"></textarea>
            </div>
            <x-jet-input-error for="introduction" class="mt-2" />
        </div>

        <!-- prefecture -->
        <div class="col-span-6 sm:col-span-4">
            <div class="profile-information">
                <div>
                    <x-jet-label for="prefecture" value="{{ __('都道府県') }}" />
                </div>
                <div class="custom-control custom-switch">
                    @if($state['prefectureFlag'] == 1)
                        <input type="checkbox" class="custom-control-input" id="customSwitch1" wire:model="state.prefectureFlag" autocomplete="prefectureFlag" checked>                    
                        <label class="custom-control-label" for="customSwitch1">表示</label>
                    @elseif ($state['prefectureFlag'] == 0)
                        <input type="checkbox" class="custom-control-input" id="customSwitch1" wire:model="state.prefectureFlag" autocomplete="prefectureFlag">
                        <label class="custom-control-label" for="customSwitch1">非表示</label>
                    @endif
                </div>
            </div>
            <x-jet-input id="prefecture" type="text" class="mt-1 block w-full" wire:model.defer="state.prefecture" autocomplete="prefecture" />
            <x-jet-input-error for="prefecture" class="mt-2" />
        </div>
        
        
        <!-- birth year -->
        <div class="col-span-6 sm:col-span-4">
            <div class="profile-information">
                <div>
                    <x-jet-label for="bd_year" value="{{ __('誕生年') }}" />
                </div>
                <div class="custom-control custom-switch">
                    @if($state['birthyearFlag'] == 1)
                        <input type="checkbox" class="custom-control-input" id="customSwitch2" wire:model="state.birthyearFlag" autocomplete="birthyearFlag" checked>                    
                        <label class="custom-control-label" for="customSwitch2">表示</label>
                    @elseif ($state['birthyearFlag'] == 0)
                        <input type="checkbox" class="custom-control-input" id="customSwitch2" wire:model="state.birthyearFlag" autocomplete="birthyearFlag">
                        <label class="custom-control-label" for="customSwitch2">非表示</label>
                    @endif
                </div>
            </div>
                <div class="form-input">
                    <select id="bd_year" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" wire:model.defer="state.bd_year">
                        <option value="0" selected>年</option>
                        @for ($i = 2021; $i >= 1905; $i--)
                            <option value="{{$i}}">{{$i}}年</option>
                        @endfor
                    </select>
                </div>
            <x-jet-input-error for="bd_year" class="mt-2" />
        </div>

        <!-- birth day -->
        <div class="col-span-6 sm:col-span-4">
            <div class="profile-information">
                <div>
                    <x-jet-label for="bd_month" value="{{ __('誕生日') }}"/>
                </div>
                <div class="custom-control custom-switch">
                    @if($state['birthdayFlag'] == 1)
                        <input type="checkbox" class="custom-control-input" id="customSwitch3" wire:model="state.birthdayFlag" autocomplete="birthdayFlag" checked>                    
                        <label class="custom-control-label" for="customSwitch3">表示</label>
                    @elseif ($state['birthdayFlag'] == 0)
                        <input type="checkbox" class="custom-control-input" id="customSwitch3" wire:model="state.birthdayFlag" autocomplete="birthdayFlag">
                        <label class="custom-control-label" for="customSwitch3">非表示</label>
                    @endif
                </div>
            </div>
                <div class="form-input">
                    <select id="bd_month" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" wire:model="state.bd_month">
                        <option value="0" selected>月</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{$i}}">{{$i}}月</option>
                        @endfor
                    </select>
                </div>
            <x-jet-input-error for="bd_month" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="bd_day" value=""/>
                <div class="form-input">
                    <select id="bd_day" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" wire:model.defer="state.bd_day">
                        <option value="0" selected>日</option>
                        {{$state['bd_month']}}
                        @for ($i = 1; $i <= 31; $i++)
                            <option value="{{$i}}">{{$i}}日</option>
                        @endfor
                    </select>
                </div>
            <x-jet-input-error for="bd_month" class="mt-2" />
        </div>

        <!-- webサイトurl -->
        <div class="col-span-6 sm:col-span-4">
            <div class="profile-information">
                <div>
                    <x-jet-label for="user_website_url" value="{{ __('サイトURL') }}" />
                </div>
                <div class="custom-control custom-switch">
                    @if($state['websiteFlag'] == 1)
                        <input type="checkbox" class="custom-control-input" id="customSwitch4" wire:model="state.websiteFlag" autocomplete="websiteFlag" checked>                    
                        <label class="custom-control-label" for="customSwitch4">表示</label>
                    @elseif ($state['websiteFlag'] == 0)
                        <input type="checkbox" class="custom-control-input" id="customSwitch4" wire:model="state.websiteFlag" autocomplete="websiteFlag">
                        <label class="custom-control-label" for="customSwitch4">非表示</label>
                    @endif
                </div>
            </div>
            <x-jet-input id="user_website_url" type="text" class="mt-1 block w-full" wire:model.defer="state.user_website_url" autocomplete="user_website_url" />
            <x-jet-input-error for="user_website_url" class="mt-2" />
        </div>
        

        <!-- 所属団体 -->
        <div class="col-span-6 sm:col-span-4">
            <div class="profile-information">
                <div>
                    <x-jet-label for="belonging_group" value="{{ __('所属クラブ/教室') }}" />
                </div>
                <div class="custom-control custom-switch">
                    @if($state['belonging_groupFlag'] == 1)
                        <input type="checkbox" class="custom-control-input" id="customSwitch5" wire:model="state.belonging_groupFlag" autocomplete="belonging_groupFlag" checked>                    
                        <label class="custom-control-label" for="customSwitch5">表示</label>
                    @elseif ($state['belonging_groupFlag'] == 0)
                        <input type="checkbox" class="custom-control-input" id="customSwitch5" wire:model="state.belonging_groupFlag" autocomplete="belonging_groupFlag">
                        <label class="custom-control-label" for="customSwitch5">非表示</label>
                    @endif
                </div>
            </div>
            <x-jet-input id="belonging_group" type="text" class="mt-1 block w-full" wire:model.defer="state.belonging_group" autocomplete="belonging_group" />
            <x-jet-input-error for="belonging_group" class="mt-2" />
        </div>
        
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('保存しました！') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo" id="save">
            {{ __('保存') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>

<style>
*,
*::before,
*::after {
  box-sizing: border-box;
}


h1 {
  color: #fff;
}
group + group {
  margin-top: 20px;
}
.inline-radio {
  display: flex;
  border-radius: 3px;
  overflow: hidden;
  border: 1px solid #b6b6b6;
}
.inline-radio div {
  position: relative;
  flex: 1;
}
.inline-radio input {
  width: 100%;
  height: 60px;
  opacity: 0;
}
.inline-radio label {
  position: absolute;
  top: 0;
  left: 0;
  color: #b6b6b6;
  width: 100%;
  height: 100%;
  background: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  pointer-events: none;
  border-right: 1px solid #b6b6b6;
}
.inline-radio div:last-child label {
  border-right: 0;
}
.inline-radio input:checked + label {
  background: #d81b60;
  font-weight: 500;
  color: #fff;
}
.d-transparent {
    width: 1px;
    height: 1px;
    opacity: 0;
}
.profile-information {
    display: flex;
    justify-content: space-between;
}
.show-btn {
    margin-left: 1rem;
    margin-top: -0.2rem;
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

        // ヘッダー画像登録処理
        $(function(){
            $('#save').on('click', function(){

                // hostのid
                var userId = `{{ Auth::id() }}`;
                
                //アップロードファイルの入力値を取得する。
                var fileData = document.getElementById("userHeaderImg").files[0];

                //フォームデータを作成する。(送信するデータ)
                var submitUserHeaderImgForm = new FormData();

                // 作成したフォームデータに画像ファイル、hostのidを追加する
                submitUserHeaderImgForm.append("file", fileData);
                submitUserHeaderImgForm.append("userId", userId);

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/user/newHeaderImg',
                    type: 'POST',
                    data: submitUserHeaderImgForm,
                    processData : false,
                    contentType : false
                })

                .done((data) => {
                    var currentHeaderUrl = document.getElementById('header').src;
                    var urlWithoutFileName = currentHeaderUrl.substr(0, 43);
                    var newHeaderUrl = urlWithoutFileName + data;
                    document.getElementById('header').src = newHeaderUrl;
                })
                .fail((data) => {
                    //失敗した場合の処理
                    console.log('fail');  //レスポンス文字列を表示
                })            
            })
        })
    }

    

    // ナブバーのアイコン変更(画像あり)
    function changeProfilePhoto() {
        $(function(){
            $('#save').on('click', function(){
                var newProfilePhotoUrl = document.getElementById('previewPhoto').style.backgroundImage;
                var deleteFrontFiveLetters = newProfilePhotoUrl.slice(5);
                var deleteBackThreeLetters = deleteFrontFiveLetters.slice(0, -3);
                document.getElementById('navigationUserIcon').src = deleteBackThreeLetters;
            })
        })
    }

    // ナブバーのアイコン変更(画像なし)
    $('#deleteProfilePhoto').on('click', function(){
        var test = `
        <div style="background-color: #EBF4FF; color: #7F9CF5; width: 2.5rem; height: 2.5rem; border-radius: 50%; margin-left: -1rem;">
            <div style="font-weight: lighter; font-size: 18px; text-align: center; line-height: 2.5rem;">上塚</div>
        </div>
        `;
        document.getElementById('navigationUserIcon').insertAdjacentHTML('beforebegin',test);
        document.getElementById('navigationUserIcon').remove();
    }) 
</script>

    

    
