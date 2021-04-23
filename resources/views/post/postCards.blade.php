@foreach ($postsOrderByLatest as $postOrderByLatest)
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="card">
            <a href="{{ route('postShow', ['id' => $postOrderByLatest->id]) }}">
                <img class="img-fluid" src="{{ asset('storage/postedImages/'.$postOrderByLatest->photo) }}">
                <div class="card-content">
                    <a href="{{ route('profile.show', $postOrderByLatest->user->id) }}">
                        <img class="profile_photo" src="{{ $postOrderByLatest->user->profile_photo_url }}">
                        <span class="user-name">{{ $postOrderByLatest->user->name }}</span>
                    </a>
                    {{-- @if ($postOrderByLatest['totalLikeNum'] !== 0) --}}
                        <span id="totalLikeNum_{{ $postOrderByLatest->id }}" class="totalLikeNum">
                            <i class="fas fa-heart fa-sm"></i> <span>{{ $postOrderByLatest['totalLikeNum'] }}</span>
                        </span>
                    {{-- @endif --}}
                    <div style="padding: 1rem 0 1rem 0;">
                        <div style="display:inline-flex">
                            @foreach ($postOrderByLatest['tags'] as $tag)
                                <a href="{{ route('searchComment', ['searchWords' => $tag->tag, 'nextPage' => 0]) }}">
                                    <span class="original-tag-item">
                                        #{{ $tag->tag }} <i class="fa fa-chevron-right"></i>
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </a>
            <div class="card-read-more">
                <div class="row" style="padding: 0.5rem 0 0.5rem 0">
                    <div class="col-6">
                        <button id="{{ $postOrderByLatest['id'] }}" class="like reset-button" value="{{ $postOrderByLatest['likeFlag'] }}">
                            <span style="color: #F97855;"><i class="far fa-heart"></i>いいね!</span>
                        </button>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('postShow', ['id' => $postOrderByLatest->id]) }}"><i class="far fa-comment"></i>コメント</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach