<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    // primaryKeyを定義
    protected $primaryKey = 'district_code';

    // timestampsはない
    public $timestamps = false;

    //hasMany設定
    public function prefectures()
    {
        return $this->hasMany('App\Models\Prefecture', 'district_code', 'district_code');
    }
}
