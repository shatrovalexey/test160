<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\{City, Street};

class Region extends Model
{
    use HasFactory;

    protected $tableName = 'regions';

    public function street(): HasMany
    {
        return $this->hasMany(Street::class, 'region_name', 'name');
    }

    public function city(): HasMany
    {
        return $this->hasMany(City::class, 'region_name', 'name');
    }
}