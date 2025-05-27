<?php

namespace App\Services;

use App\Models\Tooth;

class ToothService
{
    public function findAll()
    {
        $teeth = Tooth::get();

        return $teeth;
    }

    public function findById($id)
    {
        $tooth = Tooth::where('teeth.id', '=', $id)->firstOrFail();

        return $tooth;
    }
}
