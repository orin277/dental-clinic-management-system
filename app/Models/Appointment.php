<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Appointment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function dentist()
    {
        return $this->belongsTo(Dentist::class);
    }

    public function scopeById($query, $dentistId)
    {
        return $query->where('appointments.id', $dentistId);
    }

    public function scopeByDentistId($query, $dentistId)
    {
        return $query->where('dentist_id', $dentistId);
    }

    public function scopeByPatientId($query, $patientId)
    {
        return $query->where('patient_id', $patientId);
    }

    public function scopeByDate($query, $date)
    {
        return $query->where('date', $date);
    }

    public function scopeDateBetween($query, $startDate, $endDate)
    {
        return $query->whereBetween('date', [$startDate, $endDate]);
    }

    public function scopeFrom(Builder $query, $date): Builder
    {
        return $query->where('date', '>=', Carbon::parse($date));
    }

    public function scopeTo(Builder $query, $date): Builder
    {
        return $query->where('date', '<=', Carbon::parse($date));
    }
}
