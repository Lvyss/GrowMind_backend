<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;


class QuizQuestion extends Model
{
use HasFactory;


protected $fillable = ['quiz_id','question','type','correct_answer'];


public function options()
{
return $this->hasMany(QuizOption::class, 'question_id');
}
}