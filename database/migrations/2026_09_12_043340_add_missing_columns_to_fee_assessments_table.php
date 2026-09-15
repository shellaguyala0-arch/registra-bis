<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('fee_assessments', function (Blueprint $table) {
            $table->date('assessment_date')->nullable();
            $table->unsignedBigInteger('assessed_by')->nullable();
            $table->text('remarks')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('fee_assessments', function (Blueprint $table) {
            $table->dropColumn([
                'assessment_date',
                'assessed_by',
                'remarks',
            ]);
        });
    }
};