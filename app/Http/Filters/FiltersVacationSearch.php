<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class FiltersVacationSearch implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where('users.name', 'LIKE', "%{$value}%")
            ->orWhere('users.surname', 'LIKE', "%{$value}%")
            ->orWhere('users.patronymic', 'LIKE', "%{$value}%");
    }
}
