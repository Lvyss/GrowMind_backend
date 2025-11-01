<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;


class Lesson extends Model
{
use HasFactory;


protected $fillable = ['module_id','title','content','video_url','order'];


public function module()
{
return $this->belongsTo(Module::class);
}
}