@csrf
<div class="footer-background col-md-12">
    <a href="/" style="text-decoration: none;">
        <div class="top-footer">
            <img src="{{asset('storage/materials/mainLogo.png')}}" width="200" height="100" class="d-inline-block align-top" alt="" style="margin-top: 1rem">
        </div>
    </a>
    <div class="footer-link-titles">
        <a href="/#newPost">
            <div class="link-title"><i class="far fa-file"></i> 新着の投稿</div>
        </a>
        <a href="{{ route('postPopular', ['nextPage' => 1]) }}">
            <div class="link-title"><i class="fas fa-fire-alt"></i> 人気の投稿</div>
        </a>
        <a href="{{ route('selectArea', ['district_code' => 2]) }}">
            <div class="link-title"><i class="fas fa-user-friends"></i> 教室を探す</div>
        </a>
        @auth
            <a href="{{ route('profile.show', auth()->user()->id) }}">
                <div class="link-title"><i class="fas fa-house-user"></i> プロフィール</div>
            </a>
        @endauth
        @guest
            <a href="{{ route('login') }}">
                <div class="link-title"><i class="fas fa-house-user"></i> プロフィール</div>
            </a>
        @endguest
        <a href="#word">
            <div class="link-title"><i class="fas fa-search"></i> 検索</div>
        </a>
    </div>

    <div class="right-side">© 2021 手書き部</div>
    <div class="right-side">
        <small>ALL RIGHTS RESERVED.</small>
    </div>
</div>

<style>
    .footer-background {
        border-top: solid 1px rgba(0,0,0,0.2);
        height: 100px;
        width: 100vw;
        margin: 0px;
    }
    .top-footer {
        text-align: center;
        font-size: 30px;
        font-family: Sawarabi Gothic;
    }
    .top-footer:hover {
        color: #3B2B31;overflow-x;
    }
    .footer-link-titles {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
    }
    .right-side {
        text-align: right;
        padding-right: 1%;
    }
    .link-title {
        margin: 1rem;
    }
</style>