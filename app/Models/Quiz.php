<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;


class Quiz extends Model
{
use HasFactory;


protected $fillable = ['module_id','title','description'];


public function questions()
{
return $this->hasMany(QuizQuestion::class);
}


public function module()
{
return $this->belongsTo(Module::class);
}
}