<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeFrom(Builder $query, $date): Builder
    {
        return $query->where('payments.date', '>=', Carbon::parse($date));
    }

    public function scopeTo(Builder $query, $date): Builder
    {
        return $query->where('payments.date', '<=', Carbon::parse($date));
    }

    public function scopeByDentistId($query, $dentistId)
    {
        return $query->where('dentist_id', $dentistId);
    }

    public function scopeByPatientId($query, $dentistId)
    {
        return $query->where('patient_id', $dentistId);
    }
}
