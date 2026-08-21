<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            // ✅ Pas de constrained() : la table orders n'existe pas encore à ce stade
            $table->foreignId('order_id')->nullable()->index();
            $table->string('type')->default('e-money');
            $table->string('status')->default('pending');
            $table->string('fedapay_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');   // ✅ corrigé : 'payments' pas 'payment'
    }
};