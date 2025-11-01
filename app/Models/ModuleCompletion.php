<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModuleCompletion extends Model
{
    protected $fillable = ['user_id', 'module_id', 'xp_gained', 'completed_at'];

    protected $casts = [
        'completed_at' => 'datetime',
    ];

    public function user() {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function module() {
        return $this->belongsTo(\App\Models\Module::class);
    }
}
