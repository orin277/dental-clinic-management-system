<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Weekend extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeDay(Builder $query, $date): Builder
    {
        return $query->where('day', '=', Carbon::parse($date));
    }
}
