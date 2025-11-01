<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class QuizOption extends Model
{
use HasFactory;


protected $fillable = ['question_id','option_text'];


public function question()
{
return $this->belongsTo(QuizQuestion::class);
}
}