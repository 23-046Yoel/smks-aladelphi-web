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
        Schema::create('spp_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->integer('month'); // 1 = January, 12 = December
            $table->year('year');
            $table->integer('amount');
            $table->date('payment_date');
            $table->enum('status', ['paid', 'unpaid', 'partial'])->default('paid');
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete(); // Cashier
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spp_payments');
    }
};
