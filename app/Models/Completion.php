<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Completion extends Model {
    protected $fillable = ['user_id', 'lesson_id', 'xp', 'completed_at'];
}

