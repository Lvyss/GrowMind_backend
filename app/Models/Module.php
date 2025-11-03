<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = [
        'title', 'slug', 'content', 'status'
    ];

    protected $casts = [
        'content' => 'array', // auto decode JSON
    ];

    public function challenges()
{
    return $this->hasMany(ModuleFillChallenge::class);
}

}

