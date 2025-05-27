<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->time('start_time');
            $table->time('end_time');

            $table->foreignId('dentist_id')->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('day_of_week_id')->constrained()
                ->onUpdate('restrict')
                ->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
