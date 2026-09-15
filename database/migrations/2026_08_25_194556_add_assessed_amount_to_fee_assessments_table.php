<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('fee_assessments', function (Blueprint $table) {
            $table->decimal('assessed_amount', 12, 2)
                ->default(0)
                ->after('transaction_type');
        });
    }

    public function down(): void
    {
        Schema::table('fee_assessments', function (Blueprint $table) {
            $table->dropColumn('assessed_amount');
        });
    }
};