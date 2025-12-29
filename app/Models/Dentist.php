<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dentist extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function vacations()
    {
        return $this->hasMany(Vacation::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function educations()
    {
        return $this->hasMany(Education::class);
    }
}
