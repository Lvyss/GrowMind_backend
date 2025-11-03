<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleFillChallenge extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'info',
        'code',
        'blanks',
        'explanation',
        'order',
        'language',
        'exp'         // tambahkan exp
    ];

    // otomatis cast JSON ke array
    protected $casts = [
        'blanks' => 'array'
    ];

    // relasi ke module
    public function module()
    {
        return $this->belongsTo(Module::class);
    }

}
