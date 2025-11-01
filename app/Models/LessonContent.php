<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonContent extends Model {
    protected $fillable = ['lesson_id','type','content','order'];
}


