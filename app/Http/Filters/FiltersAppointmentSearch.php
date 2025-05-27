<?php

namespace App\Http\Filters;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FiltersAppointmentSearch implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where('user_patients.name', 'LIKE', "%{$value}%")
            ->orWhere('user_patients.surname', 'LIKE', "%{$value}%")
            ->orWhere('user_patients.patronymic', 'LIKE', "%{$value}%")
            ->orWhere('user_dentists.name', 'LIKE', "%{$value}%")
            ->orWhere('user_dentists.surname', 'LIKE', "%{$value}%")
            ->orWhere('user_dentists.patronymic', 'LIKE', "%{$value}%");
    }
}
