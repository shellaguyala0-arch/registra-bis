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

            // Business that made the payment
            $table->foreignId('business_id')
                ->constrained('businesses')
                ->cascadeOnDelete();

            // Fee assessment associated with this payment
            $table->foreignId('assessment_id')
                ->constrained('fee_assessments')
                ->cascadeOnDelete();

            // Official Receipt number
            $table->string('reference_no')->unique();

            // Amount actually paid
            $table->decimal('amount', 12, 2);

            // Date payment was made
            $table->date('payment_date');

            // Optional remarks
            $table->text('remarks')->nullable();

            // User/treasurer who received the payment
            $table->foreignId('received_by')
                ->constrained('users')
                ->restrictOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};