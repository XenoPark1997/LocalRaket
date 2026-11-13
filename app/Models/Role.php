<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'display_name', 'description'])]
class Role extends Model
{
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function userRightModules(): HasMany
    {
        return $this->hasMany(UserRightModule::class);
    }

    public function programModules(): BelongsToMany
    {
        return $this->belongsToMany(ProgramModule::class, 'user_right_modules')
            ->withPivot(['program_module_name', 'can_view', 'can_create', 'can_update', 'can_delete'])
            ->withTimestamps();
    }
}
