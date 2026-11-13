<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'role_id',
    'program_module_id',
    'program_module_name',
    'can_view',
    'can_create',
    'can_update',
    'can_delete',
])]
class UserRightModule extends Model
{
    protected function casts(): array
    {
        return [
            'can_view' => 'boolean',
            'can_create' => 'boolean',
            'can_update' => 'boolean',
            'can_delete' => 'boolean',
        ];
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function programModule(): BelongsTo
    {
        return $this->belongsTo(ProgramModule::class);
    }
}
