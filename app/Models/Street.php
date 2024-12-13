<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\{Region, City};

class Street extends Model
{
    use HasFactory;

    protected $tableName = 'streets';

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_name', 'name');
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'region_name', 'name');
    }

    protected static function getFtsText(string $text): ?string
    {
        if (!preg_match_all('{[0-9а-яА-ЯёЁa-z]+}uis', $text, $matches)) {
            return null;
        }

        return implode(' ', array_map(function(string $value): string {
                return "+{$value}*";
            }, array_unique(array_map(function (array $match): string {
                return $match[0];
            }, $matches)))
        );
    }

    public static function searchByText(string $text)
    {
        $searchText = static::getFtsText($text);

        if (is_null($searchText)) {
            return [];
        }

        return static::select(['region_name', 'city_name', 'name AS street_name',])
            ->whereRaw('MATCH(region_name, city_name, name) AGAINST(? IN BOOLEAN MODE)', $searchText)->get();
    }
}