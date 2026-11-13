<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'area_id',
    'name',
    'address_line',
    'city',
    'state_or_province',
    'postal_code',
    'country_code',
    'coordinates',
])]
class Location extends Model
{
    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    public function jobPostings(): HasMany
    {
        return $this->hasMany(JobPosting::class);
    }
}
