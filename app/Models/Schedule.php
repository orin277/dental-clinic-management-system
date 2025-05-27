<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function dentist()
    {
        return $this->belongsTo(Dentist::class);
    }

    public function scopeByDentistId($query, $dentistId)
    {
        return $query->where('dentist_id', $dentistId);
    }
}
