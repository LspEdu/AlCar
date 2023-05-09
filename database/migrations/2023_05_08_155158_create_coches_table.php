<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coches', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('marca');
            $table->string('modelo');
            $table->enum('tipo', ['utilitario', 'deportivo', 'superdeportivo', 'biplaza', 'offroad']);
            $table->float('precio', 8, 2);
            $table->string('matricula', 15);
            $table->enum('combustible', ['gasolina', 'diesel', 'electrico', 'hibrido'])->nullable();
            $table->enum('cambio', ['automatico', 'manual']);
            $table->year('ano')->nullable();
            $table->string('motor')->nullable();
            $table->string('clindrada')->nullable();
            $table->string('color')->nullable();
            $table->integer('km')->nullable();
            $table->integer('plazas')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->boolean('validado')->default(false);

            $table->foreignId('id_user')
                  ->constrained('users')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coches');
    }
};
