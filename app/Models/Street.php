<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\{Region, City};

/**
* Улица
*/
class Street extends Model
{
    use HasFactory;

    /**
    * @var string $tableName
    */
    protected $tableName = 'streets';

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_name', 'name');
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'region_name', 'name');
    }

    /**
    * Запрос FTS из строки
    *
    * @param ?string $text - входной текст
    *
    * @return ?string - запрос в формате FTS
    */
    protected static function getFtsText(?string $text = null): ?string
    {
        if (is_null($text)) {
            return null;
        }
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

    /**
    * Поиск FTS
    *
    * @param ?string $text - входной текст
    */
    public static function searchByText(?string $text = null)
    {
        $searchText = static::getFtsText($text);

        if (is_null($searchText)) {
            return [];
        }

        return static::select(['region_name', 'city_name', 'name AS street_name',])
            ->whereRaw('MATCH(region_name, city_name, name) AGAINST(? IN BOOLEAN MODE)', $searchText)->get();
    }
}