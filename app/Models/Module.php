<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = ['slug', 'title', 'description', 'published'];

    public function sections()
    {
        return $this->hasMany(ModuleSection::class)->orderBy('order');
    }
}
