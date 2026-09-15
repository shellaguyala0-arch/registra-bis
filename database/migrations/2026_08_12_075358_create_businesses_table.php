<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();

            $table->string('business_name');
            $table->string('owner_name');
            $table->text('address');

            $table->string('contact_number', 30)->nullable();
            $table->string('email')->nullable();

            $table->string('category');
            $table->string('landmark')->nullable();
            $table->text('location_description')->nullable();

            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            $table->string('permit_number')->unique();

            $table->string('registration_status')->default('Pending');
            $table->string('payment_status')->default('Unpaid');
            $table->string('closure_status')->default('Active');

            $table->timestamps();
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};
