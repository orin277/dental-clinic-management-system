<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class FiltersUserSearch implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where('users.name', 'LIKE', "%{$value}%")
            ->orWhere('users.surname', 'LIKE', "%{$value}%")
            ->orWhere('users.patronymic', 'LIKE', "%{$value}%")
            ->orWhere('users.email', 'LIKE', "%{$value}%")
            ->orWhere('users.phone', 'LIKE', "%{$value}%");
    }
}
