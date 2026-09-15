<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('fee_assessments', function (Blueprint $table) {
            $table->dropForeign(['fee_type_id']);
            $table->dropColumn('fee_type_id');
        });
    }

    public function down(): void
    {
        Schema::table('fee_assessments', function (Blueprint $table) {
            $table->foreignId('fee_type_id')
                ->nullable()
                ->constrained('fee_types')
                ->nullOnDelete();
        });
    }
};