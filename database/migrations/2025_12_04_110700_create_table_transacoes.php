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
        Schema::create('transacoes', function (Blueprint $table) {
            $table->id();
            $table->string('categoria')->nullable()->default('outros')->index();
            $table->text('descricao')->nullable();
            $table->date('data');
            $table->enum('tipo', ['receita', 'despesa'])->index();
            $table->decimal('valor', 15, 2)->default(0.00);
            $table->timestamps();

            $table->foreignId('usuario_id')->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_transacoes');
    }
};
