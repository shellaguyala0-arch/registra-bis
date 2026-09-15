<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('businesses', function (Blueprint $table) {
            $table->string('owner_photo')->nullable();
            $table->string('valid_id_file')->nullable();
            $table->string('business_exterior')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('businesses', function (Blueprint $table) {
            $table->dropColumn([
                'owner_photo',
                'valid_id_file',
                'business_exterior',
            ]);
        });
    }
};