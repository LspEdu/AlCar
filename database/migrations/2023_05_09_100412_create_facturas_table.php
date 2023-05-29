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
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('FechaInicio');
            $table->date('FechaFin');
            $table->float('importe', 10, 2);

            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained('users')
                  ->onUpdate('cascade')
                  ->nullOnDelete();

            $table->foreignId('coche_id')
                  ->constrained('coches')
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
        Schema::dropIfExists('facturas');
    }
};
