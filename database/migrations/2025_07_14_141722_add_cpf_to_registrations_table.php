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
        Schema::table('registrations', function (Blueprint $table) {
            // adiciona o CPF (11 dígitos), campo único, após a coluna telefone
            $table->string('cpf', 11)
                  ->after('telefone')
                  ->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            // primeiro remove o índice único e depois a coluna
            $table->dropUnique(['cpf']);
            $table->dropColumn('cpf');
        });
    }
};
