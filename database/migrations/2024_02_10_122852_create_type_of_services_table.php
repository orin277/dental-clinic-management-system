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
        Schema::create('type_of_services', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30);
            $table->timestamps();
        });

        DB::table('type_of_services')->insert([
            ['name' => 'Діагностика'],
            ['name' => 'Терапія'],
            ['name' => 'Дитяча стоматологія'],
            ['name' => 'Пародонтологія'],
            ['name' => 'Хірургія'],
            ['name' => 'Ортопедія '],
            ['name' => 'Ортодонтія'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_of_services');
    }
};
