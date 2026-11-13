<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['parent_area_id', 'name', 'code', 'description', 'boundary'])]
class Area extends Model
{
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_area_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_area_id');
    }

    public function locations(): HasMany
    {
        return $this->hasMany(Location::class);
    }
}
