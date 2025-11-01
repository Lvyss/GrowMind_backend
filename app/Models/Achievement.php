<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;


class Achievement extends Model
{
use HasFactory;


protected $fillable = ['title','description','exp_reward','icon'];


public function users()
{
return $this->belongsToMany(User::class,'user_achievements')->withTimestamps();
}
}