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
        Schema::create("login_usuarios", function (Blueprint $table) {
            $table->id();
            $table->string("nombreApellido", 100);
            $table->string("usuario", 100);
            $table->string("contrasena");
            $table->string("cedula", 30);
            $table->string("telefono", 30);
            $table->string("correo", 100);
            $table->integer("tipoUsuario");
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
