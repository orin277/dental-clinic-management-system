<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dentist_specializations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30);
            $table->timestamps();
        });

        DB::table('dentist_specializations')->insert([
            ['name' => 'Стоматолог-терапевт'],
            ['name' => 'Стоматолог-ортопед'],
            ['name' => 'Стоматолог-ортодонт'],
            ['name' => 'Стоматолог-хірург'],
            ['name' => 'Стоматолог-пародонтолог'],
            ['name' => 'Дитячий стоматолог '],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dentist_specializations');
    }
};
