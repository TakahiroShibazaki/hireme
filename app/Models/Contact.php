<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    public $timestamps = false;

    // 連絡先のプラットフォーム取得用
    public function contactTypes()
    {
        return $this->hasMany('App\Models\ContactType', 'id', 'contact_type_id');
    }
}
