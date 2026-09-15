<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();

            // Business that requested/received the document
            $table->foreignId('business_id')
                  ->constrained('businesses')
                  ->cascadeOnDelete();

            // Document identification
            $table->string('document_no')->unique();
            $table->string('document_type');

            // Document details
            $table->text('purpose')->nullable();
            $table->date('issued_date');

            // Secretary/User who issued the document
            $table->foreignId('issued_by')
                  ->constrained('users')
                  ->restrictOnDelete();

            // Document status
            $table->string('status')->default('Issued');

            // Additional notes
            $table->text('remarks')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
