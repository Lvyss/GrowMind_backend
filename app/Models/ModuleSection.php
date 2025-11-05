<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModuleSection extends Model
{
    protected $fillable = ['module_id', 'title', 'order', 'content', 'xp_reward'];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

public function questions()
{
    return $this->hasMany(ModuleSectionQuestion::class, 'section_id')->orderBy('order');
}


public function progress()
{
    return $this->hasMany(UserSectionProgress::class, 'section_id');
}

}
