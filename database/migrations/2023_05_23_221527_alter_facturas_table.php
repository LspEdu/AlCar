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
        Schema::table('facturas', function (Blueprint $table) {
            $table->enum('metodoPago', ['tarjeta', 'efectivo','bizum','transferencia'])->default('efectivo');
            $table->string('codigo')->unique();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->integer('dias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('facturas', function (Blueprint $table) {
            $table->dropColumn('metodoPago');
            $table->dropColumn('codigo');
            $table->dropColumn('lat');
            $table->dropColumn('lng');
            $table->dropColumn('dias');
        });
    }
};
