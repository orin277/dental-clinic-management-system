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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->decimal('price', 8, 2);

            $table->foreignId('type_of_service_id')->constrained()
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->timestamps();
        });

        DB::table('services')->insert([
            ['name' => 'Консультація', 'price' => 300, 'type_of_service_id' => 1],
            ['name' => 'Прицільний знімок', 'price' => 100, 'type_of_service_id' => 1],
            ['name' => 'Панорамний знімок', 'price' => 300, 'type_of_service_id' => 1],
            ['name' => 'Комп’ютерна томографія', 'price' => 600, 'type_of_service_id' => 1],
            ['name' => 'Лікування карієсу', 'price' => 1200, 'type_of_service_id' => 2],
            ['name' => 'Лікування кореневих каналів', 'price' => 4000, 'type_of_service_id' => 2],
            ['name' => 'Реставрація зуба', 'price' => 2000, 'type_of_service_id' => 2],
            ['name' => 'Професійна гігієна порожнини рота', 'price' => 1000, 'type_of_service_id' => 3],
            ['name' => 'Лікування карієсу молочного зуба', 'price' => 800, 'type_of_service_id' => 3],
            ['name' => 'Видалення молочного зуба', 'price' => 800, 'type_of_service_id' => 3],
            ['name' => 'Професійна гігієна порожнини рота', 'price' => 2000, 'type_of_service_id' => 4],
            ['name' => 'Відбілювання зубів', 'price' => 4000, 'type_of_service_id' => 4],
            ['name' => 'Плазмоліфтинг тканин пародонту', 'price' => 1500, 'type_of_service_id' => 4],
            ['name' => 'Клінічне подовження коронки зуба лазером', 'price' => 1400, 'type_of_service_id' => 4],
            ['name' => 'Видалення зуба', 'price' => 1400, 'type_of_service_id' => 5],
            ['name' => 'Видалення зуба мудрості', 'price' => 2000, 'type_of_service_id' => 5],
            ['name' => 'Резекція верхівки кореня зуба', 'price' => 2400, 'type_of_service_id' => 5],
            ['name' => 'Пластика вуздечки язика (губи)', 'price' => 2000, 'type_of_service_id' => 5],
            ['name' => 'Гінгівектомія', 'price' => 800, 'type_of_service_id' => 5],
            ['name' => 'Синус ліфтинг', 'price' => 8000, 'type_of_service_id' => 5],
            ['name' => 'Кісткова пластика', 'price' => 8000, 'type_of_service_id' => 5],
            ['name' => 'Імплантація зубів', 'price' => 12000, 'type_of_service_id' => 5],
            ['name' => 'Металокерамічні коронки ', 'price' => 4000, 'type_of_service_id' => 6],
            ['name' => 'Керамічні коронки', 'price' => 8000, 'type_of_service_id' => 6],
            ['name' => 'Вінір e-max', 'price' => 10000, 'type_of_service_id' => 6],
            ['name' => 'Протезування на імплантах', 'price' => 12000, 'type_of_service_id' => 6],
            ['name' => 'Установка металевої брекет-системи', 'price' => 14000, 'type_of_service_id' => 7],
            ['name' => 'Установка керамічної брекет-системи ', 'price' => 18000, 'type_of_service_id' => 7],
            ['name' => 'Розширювальний апарат', 'price' => 4000, 'type_of_service_id' => 7],
            ['name' => 'Ортодонтичне лікування елайнерами', 'price' => 60000, 'type_of_service_id' => 7],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
