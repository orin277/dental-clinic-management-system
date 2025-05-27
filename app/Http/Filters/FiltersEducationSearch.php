<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class FiltersEducationSearch implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where('user_dentists.name', 'LIKE', "%{$value}%")
            ->orWhere('user_dentists.surname', 'LIKE', "%{$value}%")
            ->orWhere('user_dentists.patronymic', 'LIKE', "%{$value}%");
    }
}
