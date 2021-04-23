<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserHeaderImgController extends Controller
{
    public function store(Request $request)
    {
        //アップロードパスを指定する。(/storage/user_header_img)
        $upload_file_path = storage_path().'/user_header_img/';

        //アップロードファイルを受け取る。
        $result = $request->file('file')->isValid();

        /*
        * 画像ファイル名が一意になるように変更し保存
        */

        //エクステンションを含めたファイル名を取得
        $fileNameWithExt = $request->file('file')->GetClientOriginalName();

        //エクステンションを除いたファイル名を取得
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

        //ファイルのエクステンションを取得
        $extension = pathinfo($fileNameWithExt, PATHINFO_EXTENSION);

        //ファイル名が一意になるように変更
        $imageNameToStore = $fileName."_".time().".".$extension;

        //リネームした画像ファイルを一時保存
        $path = $request->file('file')->move(storage_path('app/public/user_header_img'), $imageNameToStore);
        
        /**
         * 保存した画像ファイルをリサイズし保存
         * 旧データを削除
         */

        //ファイルリサイズ用に現在のサイズを取得
        list($width, $hight) = getimagesize(storage_path('app/public/user_header_img/').$imageNameToStore);

        // サイズを指定して新しい画像のキャンバスを作成
        $image = imagecreatetruecolor($width, $hight);

        // 元の画像から新しい画像作成
        $baseImage = imagecreatefromjpeg(storage_path('app/public/user_header_img/').$imageNameToStore);

        //サンプリング処理
        imagecopyresampled($image, $baseImage, 0, 0, 0, 0, $width, $hight, $width, $hight);

        //リサイズ後のファイル名を作成
        $resizedImageNameToStore = "resized".$imageNameToStore;

        //画像をリサイズして、保存
        imagejpeg($image,storage_path('app/public/user_header_img/').$resizedImageNameToStore,50);

        // メモリを開放
        imagedestroy($image);

        //旧ファイル削除
        $pathdel = storage_path('app/public/user_header_img/').$imageNameToStore;
        \File::delete($pathdel);

        // DBのuser_header_imgに$resizedImageNameToStoreを保存
        $user = User::where('id', $request->userId)->first();
        $user->user_header_img = $resizedImageNameToStore;
        $user->save();

        // $returnData = "{{asset('storage/user_header_img/".$resizedImageNameToStore."')}}";
        return $resizedImageNameToStore;
    }
}
