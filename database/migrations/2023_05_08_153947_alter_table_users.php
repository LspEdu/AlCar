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
        Schema::table('users', function (Blueprint $table) {
            $table->string('ape1')
                ->string('ape2')->nullable()
                ->text('direccion')->nullable()
                ->int('tlf');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //dropColumn
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('ape1')
                ->dropColumn('ape2')
                ->dropColumn('direccion')
                ->dropColumn('tlf');
        });
    }
};
