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
        Schema::create('day_of_weeks', function (Blueprint $table) {
            $table->id();
            $table->string("name", 20);
            $table->timestamps();
        });

        DB::table('day_of_weeks')->insert([
            ['name' => 'Понеділок'],
            ['name' => 'Вівторок'],
            ['name' => 'Середа'],
            ['name' => 'Четвер'],
            ['name' => 'П\'ятниця'],
            ['name' => 'Субота '],
            ['name' => 'Неділя'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('day_of_weeks');
    }
};
