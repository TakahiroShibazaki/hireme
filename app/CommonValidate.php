<?php

/**
 * 0,"0"は空じゃない!スペースのみは空!の空判定
 * 未定義の可能性のあるものは、事前にisset()判定を！
 */
if (!function_exists('isNotNullOrBlank')) {
    function isNotNullOrBlank($val){
        // " ", "　", "(tab)"を削除 
        $val = preg_replace('/\s| +|　+/', '', $val);
        // 0,"0"を含まないempty判定
        if (!empty($val) || $val === 0 || $val === "0") {
            return true;
        } else {
            return false;
        }
    }
}