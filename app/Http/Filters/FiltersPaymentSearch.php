<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class FiltersPaymentSearch implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where('user_patients.name', 'LIKE', "%{$value}%")
            ->orWhere('user_patients.surname', 'LIKE', "%{$value}%")
            ->orWhere('user_patients.patronymic', 'LIKE', "%{$value}%");
    }
}
