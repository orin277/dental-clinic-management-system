<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Bill extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeByAppointmentId($query, $appointmentId)
    {
        return $query->where('appointment_id', $appointmentId);
    }

    public function scopeFrom(Builder $query, $date): Builder
    {
        return $query->where('bills.date', '>=', Carbon::parse($date));
    }

    public function scopeTo(Builder $query, $date): Builder
    {
        return $query->where('bills.date', '<=', Carbon::parse($date));
    }
}
