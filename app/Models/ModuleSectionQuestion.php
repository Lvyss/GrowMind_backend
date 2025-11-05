<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModuleSectionQuestion extends Model
{
    protected $fillable = [
        'section_id',
        'type',
        'instruction',
        'template',
        'answers',
        'points',
        'order'
    ];

    protected $casts = [
        'answers' => 'array', // biar langsung auto array saat fetch
    ];

    public function section()
    {
        return $this->belongsTo(ModuleSection::class, 'section_id');
    }
}
