<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;


class Module extends Model
{
use HasFactory;


protected $fillable = ['title','slug','description','thumbnail','difficulty','theme'];


public function lessons()
{
return $this->hasMany(Lesson::class);
}


public function quiz()
{
return $this->hasOne(Quiz::class);
}
}