<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>手書き部 | 手書き文字投稿サイト</title>
        <meta name="keywords" content="手書き部,手書き,書道,カリグラフィー,習い事,教室,投稿,SNS">
        <meta name="description" content="手書き部は、言葉を大切にする「手書き文字」の投稿サイトです。">

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <title>タビリパ</title>

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-80M67ZRFTY"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-80M67ZRFTY');
        </script>

        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        {{-- jQuery --}}
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>


        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        {{-- <link href="https://fonts.googleapis.com/css?family=Sawarabi+Gothic" rel="stylesheet"> --}}

        {{-- lightbox(showの写真一覧機能) --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js" type="text/javascript"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.css" rel="stylesheet">

        {{-- fontawesome --}}
        <script src="https://kit.fontawesome.com/382d09cdb7.js" crossorigin="anonymous"></script>


        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */
            html{line-height:1.15;-webkit-text-size-adjust:100%}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}

            body {
                font-family: 'Nunito';
                color: rgba(0,0,0,0.7);
                height:100%;
            }
            h2{
                font-size: 1.3rem;
                font-weight: bold;
                color: rgb(88, 76, 32);
                margin: 0;
                padding: 0;
            }
            .h2mini{
                font-size: 1rem;
                font-weight: bold;
                color: rgb(88, 76, 32);
            }
            h3{
                font-size: 1rem;
                font-weight: bold;
                color: rgb(88, 76, 32);
                margin: 0;
                padding: 0;
            }
            a{
                text-decoration: none;
            }
            .reset-button{
                background-color: transparent;
                border: none;
                cursor: pointer;
                outline: none;
                padding: 0;
                appearance: none;
            }
            .nav-icon{
                    /* padding-top: 1rem; */
                    color: rgba(0,0,0,0.6);
                    line-height: 4rem;
                    font-size: 0.9rem;
                }
            .nav-icon:hover {
                opacity: 0.7;
                color: rgba(0,0,0,0.2);
            }
            #nav{
                /* position: fixed; */
                width: 100%;
            }
            .navbar-bg {
                background-color: ;
                width:100%;
                height:2.6rem;
            }
            .navbar-bottom {
                border-bottom: solid 1px rgba(0,0,0,0.2);
                /* height: 4rem; */
                width: 100%;
            }
            .navbar-flex {
                display: flex;
                justify-content: space-evenly;
            }
            .title-font {
                color: #F2B950; /*rgba(0,0,0,0.5);*/
                /* line-height: 4rem; */
                font-size: 1.5rem;
                font-family: Sawarabi Gothic;
            }
            .reset-button{
                background: none;
                border: none;
                outline: none;
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
            }
            .search_form {
                /* position:relative;
                width: 100%; */
            }
            .search_form_input {
                /* vertical-align: middle;
                display: inline-block; */
                height:50px;
                width: 55%;
                padding:0 10px;
                position:absolute;
                left:0;
                top:0.5rem;
                border-radius:2px;
                outline:0;
                background:#eee;
            }
            .search_form_input::placeholder{ /* Others */
                font-size: 1.2vw;
            }
            .search_form_button {
                /* vertical-align: middle;
                display: inline-block; */
                height:50px;
                position:absolute;
                left:47%;
                top:0.5rem;
                background:none;
                color:#666;
                border:none;
                font-size: 1.2vw;
                /* font-size:20px; */
            }
            .search_form_button:hover{
                /* color:#7fbfff; */
            }
            /* .nav-icon {
                width: 30%;
                max-height: 4rem;
                object-fit: cover;
            } */
            .bottom-nav {
                display: none;
            }

            /* PC用 */
            @media(min-width: 600px){
                #between_layout_contant{
                    padding-top: 3rem;
                    width: 100%;
                }

            }
            /* スマホ用 */
            @media (max-width: 599px) {
                /* #nav-button{
                    display: none;
                } */
                #between_layout_contant{
                    padding-top: 5rem;
                }
                .nav-icon {
                    width: 40%;
                }
                .search {
                    display: none;
                }
                #nav-logo {
                    display: none;
                }
                .bottom-nav {
                    display: block;
                    position: fixed;
                    width: 100%;
                    bottom: 0;
                    left: 0;
                    right: 0;
                    z-index: 99;
                    background: #fff;
                    text-align: center;
                }
                .bottom-nav-flex {
                    display: flex;
                    justify-content: space-evenly;
                }
                .bottom-nav-icon {
                    font-size: 2.2rem;
                }
                .bottom-nav-home-icon {
                    padding-top: 0.3rem;
                    padding-bottom: 0.2rem;
                }
                .user-profile-btn {
                    padding: 0;
                }
                .user-profile-text {
                    display: block;
                    padding-top: 1rem;
                    margin-top: -0.9rem;
                    font-size: 0.7rem;
                    font-family: 'Nunito';
                    color: rgba(0,0,0,0.7);
                }
                .bottom-nav-text {
                    display: block;
                    font-size: 0.7rem;
                    margin-top: -0.6rem;
                }
                footer {
                    margin-bottom: 16rem;
                }
                .search_icon {
                    display: inline-block;
                    font-family: FontAwesome;
                    font-style: normal;
                    font-weight: normal;
                    line-height: 1;
                    -webkit-font-smoothing: antialiased;
                    -moz-osx-font-smoothing: grayscale;
                }

            }
        </style>
    </head>
    <body class="antialiased">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 px-0">
                    <div class="row no-gutters navbar-bottom">
                        <div class="col-md-3 px-0">
                            <div style="text-align: left;">
                                <a href="/" style="text-decoration: none;">
                                    <span class="nav-icon">
                                        <img src="{{asset('storage/materials/mainLogo.png')}}" width="200" height="100" class="d-inline-block align-top" alt="">
                                        <!-- <span class="title-font">ふでぺん</span> -->
                                    </span>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-5 px-0 search">
                            <form id="form" class="search_form" action={{ route('postSearch') }} method="get" enctype="multipart/form-data">
                                @csrf
                                {{-- <div style="height: 4rem; line-height: 4rem"> --}}
                                    <input type="text" class="search_form_input" id="word" name="word" placeholder="好きな言葉、#ハッシュタグで検索">
                                    <button class="search_form_button" type="submit"><i class="fas fa-search"></i></button>
                                {{-- </div> --}}
                            </form>
                        </div>
                        <div class="col-md-4 px-0" id="nav-logo">
                            <div class="navbar-flex">
                                @if (Route::has('login'))
                                    <a href="{{ route('postCreate') }}" class="nav-icon" id="create">
                                        <i class="fas fa-pen-fancy"></i><span> 投稿</span>
                                    </a>
                                    {{-- <a href="{{ route('postSearch') }}" class="nav-icon" id="find">
                                        <i class="fas fa-search"></i><span> 検索</span>
                                    </a> --}}
                                    @auth
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="{{Auth::user()->profile_photo_url}}" alt="" style="width: 2.5rem; height: 2.5rem; border-radius: 50%;" id="navigationUserIcon">
                                        </button>

                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                            <small class="dropdown-item-text text-xs text-gray-400">アカウント管理</small>
                                                <a class="dropdown-item" href="{{ route('profile.show', auth()->user()->id) }}">プロフィール</a>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                                    ログアウト
                                                </a>
                                            </form>
                                        </div>
                                    </div>
                                    @else
                                        <a href="{{ route('login') }}" class="nav-icon" id="login">
                                            <i class="fas fa-unlock-alt"></i><span> ログイン</span>
                                        </a>
                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="nav-icon" id="register">
                                                <i class="fas fa-user-plus"></i><span> アカウント作成</span>
                                            </a>
                                        @endif
                                    @endauth
                                @endif
                            </div>

                        </div>

                        {{-- <div class="col-md-1 px-0"></div> --}}
                    </div>
                </div>

                <div class="bottom-nav" id="bottomNav">
                    <div class="bottom-nav-flex">
                        <div>
                            <a href="/">
                                <div class="bottom-nav-icon"><i class="fas fa-home"></i></div>
                                <span class="bottom-nav-text">HOME</span>
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('postCreate') }}">
                                <div class="bottom-nav-icon"><i class="fas fa-pen-fancy"></i></div>
                                <span class="bottom-nav-text">投稿</span>
                            </a>
                        </div>
                        <div>
                            <!-- Modalのボタン -->
                            <button type="button" class="btn" data-toggle="modal" data-target="#exampleModalCenter" style="padding: 0;" data-backdrop="false">
                                <div style="color: rgba(0,0,0,0.7);" class="bottom-nav-icon"><i class="fas fa-search"></i></div>
                                <span class="bottom-nav-text">検索</span>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenterTitle">好きな言葉、#ハッシュタグで検索</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" style="padding: 0;">
                                            <form id="form" class="" action={{ route('postSearch') }} method="get" enctype="multipart/form-data">
                                                @csrf
                                                <input type="text" class="search_icon" id="word" name="word" placeholder="　&#xf002; 検索する" style="width: 100%; height: 4rem;">
                                                {{--<button class="search_form_button" type="submit"><i class="fas fa-search"></i></button>--}}
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                                                    <button type="submit" class="btn btn-outline-primary">検索</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @auth
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn user-profile-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="{{ Auth::user()->profile_photo_url }}" alt="" style="width: 2.5rem; height: 2.5rem; border-radius: 50%;" id="navigationUserIcon">
                                    <span class="user-profile-text">アカウント</span>
                                </button>

                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <small class="dropdown-item-text text-xs text-gray-400">アカウント管理</small>
                                    <a class="dropdown-item" href="{{ route('profile.show', auth()->user()->id) }}">プロフィール</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                            ログアウト
                                        </a>
                                    </form>
                                </div>
                            </div>
                        @else
                            <div>
                                <a href="{{ route('login') }}">
                                    <div class="bottom-nav-icon"><i class="fas fa-unlock-alt"></i></div>
                                    <span class="bottom-nav-text">ログイン</span>
                                </a>
                            </div>

                            <div>
                                <a href="{{ route('register') }}">
                                <div class="bottom-nav-icon"><i class="fas fa-user-plus"></i></div>
                                    <span class="bottom-nav-text">登録</span>
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        <div id="between_layout_contant">
            @yield('content')
        </div>
        <footer>
            @include('post.footer')
        </footer>
    </body>
</html>

<script>

</script>