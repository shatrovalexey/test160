<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};
use App\Models\{Region, Street};

class City extends Model
{
    use HasFactory;

    protected $tableName = 'cities';

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'region_name', 'name');
    }

    public function street(): HasMany
    {
        return $this->hasMany(Street::class, 'name', 'city_name');
    }
}