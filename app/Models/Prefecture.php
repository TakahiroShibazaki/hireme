<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prefecture extends Model
{
    use HasFactory;

    // primaryKeyを定義
    protected $primaryKey = 'prefecture_code';

    // timestampsはない
    public $timestamps = false;

    //hasMany設定
    public function areas()
    {
        return $this->hasMany('App\Models\Area', 'prefecture_code', 'prefecture_code');
    }

    //belongsTo設定
    public function districts()
    {   
        return $this->belongsTo('App\Models\District', 'district_code', 'district_code');
    }
}
