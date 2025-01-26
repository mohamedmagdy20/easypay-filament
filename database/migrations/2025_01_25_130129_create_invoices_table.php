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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->date('transaction_date')->nullable();
            $table->decimal('paid_amount')->nullable();
            $table->decimal('remaining_amount')->nullable();
            $table->decimal('total')->nullable();
            $table->decimal('installment_fees')->nullable();
            $table->decimal('installment_with_fees')->nullable();
            $table->integer('months_num')->nullable();
            $table->decimal('installment_value')->nullable();
            $table->date('completed_at')->nullable();
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
            $table->foreignId('investor_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
