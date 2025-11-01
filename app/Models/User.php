<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;


/* ==========================
| User Model
========================== */
class User extends Authenticatable
{
use HasApiTokens, HasFactory;


protected $fillable = ['name','email','password','avatar','google_id'];


public function profile()
{
return $this->hasOne(Profile::class);
}


public function progress()
{
return $this->hasMany(UserProgress::class);
}


public function achievements()
{
return $this->belongsToMany(Achievement::class, 'user_achievements')
->withTimestamps();
}
}