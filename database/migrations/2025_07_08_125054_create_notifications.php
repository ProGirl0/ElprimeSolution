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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_cliente')->constrained('clientes');
            $table->foreignId('id_remitente')->constrained('users');
            $table->string('descricao'); 
            $table->string('observacao')->nullable(); 
            $table->enum('tipo', ['Validação de comprovativo', 'Invalidação de comprovativo', 'Outro']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
