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
        Schema::create("formulario3", function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sesion_usuario')->unsigned();
            $table->foreign('sesion_usuario')->references('id')->on('login_usuarios');
            $table->string('name');
            $table->string('especialidad');
            $table->string('telefono');
            $table->string('direccion');
            $table->string('ciudad');
            $table->string('secretaria');
            $table->string('tel_ayuda');
            $table->string('ips_consulta');
            $table->string('ips_cirugia');
            $table->string('preg_indag1');
            $table->string('preg_indag2');
            $table->string('preg_indag3');
            $table->string('preg_indag4');
            $table->string('preg_indag5');
            $table->string('preg_indag6');
            $table->string('preg_indag7');
            $table->string('preg_indag8');
            $table->string('preg_indag9');
            $table->string('preg_indag10');
            $table->string('preg_indag11');
            $table->string('preg_indag12');
            $table->string('categoria');
            $table->string('observaciones');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
