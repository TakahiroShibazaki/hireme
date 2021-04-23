<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    // primaryKeyを定義
    // protected $primaryKey = ['area_name', 'prefecture_code'];
    
    // primaryKeyが数字ではない
    // public $incrementing = false;

    // primaryKeyをの型を定義
    // protected $keyType = 'string';

    // timestampsはない
    public $timestamps = false;

    //belongsTo設定
    public function prefectures()
    {
        return $this->belongsTo('App\Models\Prefecture', 'prefecture_code', 'prefecture_code');
    }
}
