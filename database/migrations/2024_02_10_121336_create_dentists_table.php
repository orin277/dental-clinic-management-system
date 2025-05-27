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
        Schema::create('dentists', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('cabinet')->unsigned();
            $table->string('address', 100)->default('');
            $table->tinyInteger('sex')->unsigned();
            $table->tinyInteger('work_experience')->unsigned();

            $table->foreignId('user_id')->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('dentist_specialization_id')->constrained()
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dentists');
    }
};
