<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalligraphyClassList extends Model
{
    use HasFactory;

    public $timestamps = false;

    // 教室の写真取得用
    public function classImgs()
    {
        return $this->hasMany('App\Models\ClassImg', 'class_id', 'id');
    }

    // エリア取得用
    public function area()
    {
        return $this->hasOne('App\Models\Area', 'id', 'area_code');
    }

    // 連絡先取得用
    public function contacts()
    {
        return $this->hasMany('App\Models\Contact', 'class_id', 'id');
    }

    // サイトURL取得用
    public function classSiteUrls()
    {
        return $this->hasMany('App\Models\ClassSiteUrl', 'class_id', 'id');
    }
}
