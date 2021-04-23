<?php 

/**
 * 開発用の共通関数
 */

// 引数を出力後、処理継続
function d($data){
    echo('<pre style="
                        padding-top: 100px;
                        border: 1px;
                    ">');
    var_dump($data);
    echo('</pre>');
}

// 引数を出力後、処理を中断
function dx($data){
    echo('<pre style="
                        padding-top: 100px;
                        border: 1px;
                    ">');
    var_dump($data);
    echo('<pre>');
    die();
}