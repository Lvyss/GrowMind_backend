<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSectionProgress extends Model
{
    protected $fillable = [
        'user_id', 'section_id', 'completed', 'completed_at'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function section() {
        return $this->belongsTo(ModuleSection::class, 'section_id');
    }
}
