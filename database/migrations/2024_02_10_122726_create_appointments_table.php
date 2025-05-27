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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('reason', 300)->default(' ');
            $table->smallInteger('cabinet')->unsigned();
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');

            $table->foreignId('dentist_id')->constrained()
                ->onUpdate('restrict')
                ->onDelete('restrict');
            $table->foreignId('patient_id')->constrained()
                ->onUpdate('restrict')
                ->onDelete('restrict');
            $table->foreignId('appointment_status_id')->default(1)->constrained()
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
        Schema::dropIfExists('appointments');
    }
};
