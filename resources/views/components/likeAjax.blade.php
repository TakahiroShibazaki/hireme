<script>
    // いいねの初期値
    $(function(){
        let likes = document.getElementsByClassName('like');
        likes = Array.from(likes) ;
        likes.forEach(like => {
            if (like.value === '1') {
                target = document.getElementById(like.id).firstElementChild.firstElementChild;
                target.classList.remove('far');
                target.classList.add('fas');
            }
        });
    });
    // いいねクリック
    $(function(){
        $('.like').on('click', function(){
            @auth
                <?php if (Auth::user()->email_verified_at) { ?>
                    let id = $(this).attr('id');
                    let postId = id.split('_');
                    postId = postId[1];
                    let likeFlag = $(this).attr('value');
                    let data = {postId: postId, userId: `{{ Auth::id() }}`};
                    let url = '/deletelike';
                    if (likeFlag === '0') {
                        url = '/like';
                    }
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: url,
                        type: 'POST',
                        data: data
                    })
                    .done((data) => {
                        let targets = document.getElementsByClassName(`likeFlag_${postId}`);
                        targets = Array.from(targets);
                        targets.forEach(target => {
                            let targetId = document.getElementById(target.id);
                            // ハートの色を切り替える
                            targetId.firstElementChild.firstElementChild.classList.toggle('far');
                            targetId.firstElementChild.firstElementChild.classList.toggle('fas');
                            // LikeFlagを切り替え
                            if (likeFlag === '0') {
                                targetId.value = '1';
                            } else {
                                targetId.value = '0';
                                // let totalLikeNums = document.getElementsByClassName(`totalLikeNum_${postId}`);
                                // totalLikeNums = Array.from(totalLikeNums) ;
                                // totalLikeNums.forEach(totalLikeNum => {
                                //     totalLikeNumInt = parseInt(totalLikeNum.querySelector('span').textContent) - 1;
                                //     totalLikeNum.querySelector('span').textContent = totalLikeNumInt;
                                // });
                            }
                        });
                        
                        let totalLikeNums = document.getElementsByClassName(`totalLikeNum_${postId}`);
                        totalLikeNums = Array.from(totalLikeNums) ;
                        totalLikeNums.forEach(totalLikeNum => {
                            // likeの総数を加減する
                            if (likeFlag === '0') {
                                totalLikeNumInt = parseInt(totalLikeNum.querySelector('span').textContent) + 1;
                            } else {
                                totalLikeNumInt = parseInt(totalLikeNum.querySelector('span').textContent) - 1;
                            }
                            totalLikeNum.querySelector('span').textContent = totalLikeNumInt;
                            // ハートを表示、非表示
                            if (totalLikeNumInt === 0) {
                                totalLikeNum.style.visibility = 'hidden';
                            } else {
                                totalLikeNum.style.visibility = 'visible';
                            }
                        });
                    })
                    .fail((data) => {
                    })
                <?php } else { ?>
                    location.href = "{{ route('verification.notice') }}";
                <?php } ?>
            @endauth
            @guest
                location.href = "{{ route('login') }}";
            @endguest
        });
    });

    // totalLikeNumの初期値
    $(function () {
        let totalLikeNums = document.getElementsByClassName('totalLikeNum');
        totalLikeNums = Array.from(totalLikeNums) ;
        totalLikeNums.forEach(totalLikeNum => {
            if (totalLikeNum.querySelector('span').textContent === '0') {
                totalLikeNum.style.visibility = 'hidden';
            }
        });
    });
</script>