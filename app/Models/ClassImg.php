<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassImg extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function CalligraphyClassList()
    {
        return $this->belongsTo('App\Models\CalligraphyClassList', 'class_id');
    }
}
