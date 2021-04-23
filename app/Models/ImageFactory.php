<?php

namespace App\Models;

class ImageFactory
{
    //$imgNameToStore = 画像用class::リネームfunction($img);

    /**
     * 受け取った画像ファイルをリネーム、リサイズ後storage/app/public/postedImageへ保存
     * 保存先へのパス/ファイル名を返す
     * $imgFile：保存したい画像ファイル
     */
    public function storeImage($imgFile){

        /*
        * 画像ファイル名が一意になるように変更し保存
        */

        //エクステンションを含めたファイル名を取得
        $fileNameWithExt = $imgFile->GetClientOriginalName();

        //エクステンションを除いたファイル名を取得
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

        //ファイルのエクステンションを取得
        $extension = pathinfo($fileNameWithExt, PATHINFO_EXTENSION); // type1
        //$extension = $imgFile->GetClientOriginalExtension(); // type2

        //ファイル名が一意になるように変更
        $imageNameToStore = $fileName."_".time().".".$extension;

        //リネームした画像ファイルを一時保存
        $path = $imgFile->move(storage_path('app/public/postedImages'), $imageNameToStore);

        /**
         * 保存した画像ファイルをリサイズし保存
         * 旧データを削除
         */

        //ファイルリサイズ用に現在のサイズを取得
        list($width, $hight) = getimagesize(storage_path('app/public/postedImages/').$imageNameToStore);

        // サイズを指定して新しい画像のキャンバスを作成
        $image = imagecreatetruecolor($width, $hight);

        // 元の画像から新しい画像作成
        $baseImage = imagecreatefromjpeg(storage_path('app/public/postedImages/').$imageNameToStore);

        //サンプリング処理
        imagecopyresampled($image, $baseImage, 0, 0, 0, 0, $width, $hight, $width, $hight);

        //リサイズ後のファイル名を作成
        $resizedImageNameToStore = "resized".$imageNameToStore;

        //画像をリサイズして、保存
        imagejpeg($image,storage_path('app/public/postedImages/').$resizedImageNameToStore,50);

        // メモリを開放
        imagedestroy($image);

        //旧ファイル削除
        $pathdel = storage_path('app/public/postedImages/').$imageNameToStore;
        \File::delete($pathdel);

        return $resizedImageNameToStore;

    }

    /**
     * 受け取った画像ファイルをリネーム、リサイズ後storage/app/public/(指定されたフォルダ)へ保存
     * 保存先へのファイル名を返す
     * $imgFile：保存したい画像ファイル
     * $dirName：保存したいフォルダネーム
     */
    public function store_img($imgFile, $dirName){

        if (empty($imgFile) || empty($dirName)) {
            return false;
        }

        /*
        * 画像ファイル名が一意になるように変更し保存
        */

        //エクステンションを含めたファイル名を取得
        $fileNameWithExt = $imgFile->GetClientOriginalName();

        //エクステンションを除いたファイル名を取得
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

        //ファイルのエクステンションを取得
        $extension = pathinfo($fileNameWithExt, PATHINFO_EXTENSION); // type1
        //$extension = $imgFile->GetClientOriginalExtension(); // type2

        //ファイル名が一意になるように変更
        $imageNameToStore = $fileName."_".time().".".$extension;

        //リネームした画像ファイルを一時保存
        $path = $imgFile->move(storage_path('app/public/' . $dirName), $imageNameToStore);

        /**
         * 保存した画像ファイルをリサイズし保存
         * 旧データを削除
         */

        //ファイルリサイズ用に現在のサイズを取得
        list($width, $hight) = getimagesize(storage_path('app/public/' . $dirName) . '/' . $imageNameToStore);

        // サイズを指定して新しい画像のキャンバスを作成
        $image = imagecreatetruecolor($width, $hight);

        // 元の画像から新しい画像作成
        $baseImage = imagecreatefromjpeg(storage_path('app/public/' . $dirName) . '/' . $imageNameToStore);

        //サンプリング処理
        imagecopyresampled($image, $baseImage, 0, 0, 0, 0, $width, $hight, $width, $hight);

        //リサイズ後のファイル名を作成
        $resizedImageNameToStore = "resized".$imageNameToStore;

        //画像をリサイズして、保存
        imagejpeg($image,storage_path('app/public/' . $dirName) . '/' . $resizedImageNameToStore,50);

        // メモリを開放
        imagedestroy($image);

        //旧ファイル削除
        $pathdel = storage_path('app/public/' . $dirName) . '/' . $imageNameToStore;
        \File::delete($pathdel);

        return $resizedImageNameToStore;
    }
}
