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
        Schema::create('mascotas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->date('fecha_nacimiento')->nullable();
            $table->string('sexo', 20)->nullable();
            $table->decimal('peso', 5, 2)->nullable();
            $table->string('foto')->nullable();

            $table->foreignId('user_id')
                ->constrained('users');

            $table->foreignId('especie_id')
                ->constrained('especies');

            $table->foreignId('raza_id')
                ->nullable()
                ->constrained('razas');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mascotas');
    }
};
