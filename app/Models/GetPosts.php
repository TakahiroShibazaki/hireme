<?php

namespace App\Models;
use App\Models\Post;
use App\Models\Like;

class GetPosts{
    
    /**
     * Post人気順取得
     * 
     * @param string $from 取得期間の始まり
     * @param string $to 取得期間の終わり
     * @param int $after 何個目から取得するか
     * @param int $amount 取得post数
     * @return array
     */
    function getPostsOrderByPopularity($from,$to,$after,$amount) 
    {
        $postsOrderByPopularity = [];
        $likes =  Like::where('created_at', '>=', $from)
                        ->where('created_at', '<=', $to)
                        ->get();
        // $likesが空だったらreturn
        if (empty($likes)) {
            return $postsOrderByPopularity;
        }

        if (!empty($likes[0])) {
            // 配列にpost_idを格納
            for ($i=0; $i < count($likes); $i++) {
                $postsIdArr[] = $likes[$i]['post_id'];
            }
            // それぞれの個数チェック
            // Keyがid
            $likeNumArrVluIsNum = array_count_values($postsIdArr);
            // いいねの数が多い順にpostIdを配列に追加
            $postIdsOrderByLikeNum = [];
            $i = 0;
            foreach ($likeNumArrVluIsNum as $id => $num) {
                // １回目だけ普通に追加
                if ($i === 0) {
                    $postIdsOrderByLikeNum[] = $id;
                } else {
                    // ２回目以降は、配列のそれぞれのnumを大きさを比較しながら、idを挿入
                    $k = 0;
                    $insertSuccessFlag = false;
                    foreach ($postIdsOrderByLikeNum as $postIdOrderByLikeNum) {
                        if ($num >= $likeNumArrVluIsNum[$postIdOrderByLikeNum]) {
                            array_splice($postIdsOrderByLikeNum, $k, 0, $id);
                            $insertSuccessFlag = true;
                            continue 2;
                        }
                        $k++;
                    }
                    // $postIdsOrderByLikeNum配列ないで、最小の場合は、上の条件に一致しないので、最後に追加する。
                    if ( $insertSuccessFlag === false) {
                        array_push($postIdsOrderByLikeNum, $id);
                    }
                }
                $i++;
            }

            // 0~$after分は格納しない
            for ($i=0; $i < $after; $i++) { 
                array_shift($postIdsOrderByLikeNum);
            }
            // $amount以下を削除
            $lastPage = 1;
            while (count($postIdsOrderByLikeNum) > $amount) {
                array_pop($postIdsOrderByLikeNum);
                $lastPage = 0;
            }
            $postsOrderByPopularity = [];
            for ($i=0; $i < count($postIdsOrderByLikeNum) ; $i++) { 
                $postsOrderByPopularity[] = Post::where('id', $postIdsOrderByLikeNum[$i])->get();
            }
            $postsOrderByPopularity[0]['lastPage'] = $lastPage;
         }
        return $postsOrderByPopularity;
    }
}
