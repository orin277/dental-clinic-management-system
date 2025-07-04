<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function dentist()
    {
        return $this->belongsTo(Dentist::class);
    }
}
