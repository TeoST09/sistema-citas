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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users');

            $table->foreignId('mascota_id')
                ->constrained('mascotas');

            $table->foreignId('veterinario_id')
                ->constrained('users');

            $table->foreignId('servicio_id')
                ->constrained('servicios');

            $table->date('fecha');
            $table->time('hora_inicio');
            $table->time('hora_fin');

            $table->decimal('precio', 10, 2);

            $table->string('estado', 30)->default('pendiente');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
