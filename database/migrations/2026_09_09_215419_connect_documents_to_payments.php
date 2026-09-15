<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('documents', function (Blueprint $table) {

            // Payment that triggered the document request
            $table->foreignId('payment_id')
                ->nullable()
                ->unique()
                ->after('business_id')
                ->constrained('payments')
                ->nullOnDelete();

            // Secretary is assigned only when the document is issued
            $table->foreignId('issued_by')
                ->nullable()
                ->change();
        });
    }

    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {

            $table->dropForeign(['payment_id']);
            $table->dropUnique(['documents_payment_id_unique']);
            $table->dropColumn('payment_id');

            $table->foreignId('issued_by')
                ->nullable(false)
                ->change();
        });
    }
};