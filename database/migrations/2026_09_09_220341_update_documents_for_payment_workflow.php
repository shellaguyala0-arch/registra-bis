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
        /*
        |--------------------------------------------------------------------------
        | IMPORTANT
        |--------------------------------------------------------------------------
        | payment_id already exists in the current SQLite database.
        | Therefore, DO NOT add payment_id again here.
        |
        | This migration only adds the requester fields that are still needed.
        |--------------------------------------------------------------------------
        */

        $existingColumns = Schema::getColumnListing('documents');

        Schema::table('documents', function (Blueprint $table) use ($existingColumns) {

            /*
             * Requester's Last Name
             */
            if (!in_array('requester_last_name', $existingColumns)) {
                $table->string('requester_last_name')->nullable();
            }

            /*
             * Requester's First Name
             */
            if (!in_array('requester_first_name', $existingColumns)) {
                $table->string('requester_first_name')->nullable();
            }

            /*
             * Requester's Middle Name
             */
            if (!in_array('requester_middle_name', $existingColumns)) {
                $table->string('requester_middle_name')->nullable();
            }

            /*
             * Requester's Birthdate
             */
            if (!in_array('requester_birthdate', $existingColumns)) {
                $table->date('requester_birthdate')->nullable();
            }

            /*
             * Requester's Age
             */
            if (!in_array('requester_age', $existingColumns)) {
                $table->unsignedInteger('requester_age')->nullable();
            }

            /*
             * Requester's Sex
             */
            if (!in_array('requester_sex', $existingColumns)) {
                $table->string('requester_sex')->nullable();
            }

            /*
             * Requester's Birthplace
             */
            if (!in_array('requester_birthplace', $existingColumns)) {
                $table->string('requester_birthplace')->nullable();
            }

            /*
             * Requester's Marital Status
             */
            if (!in_array('requester_marital_status', $existingColumns)) {
                $table->string('requester_marital_status')->nullable();
            }

            /*
             * Requester's Blood Type
             */
            if (!in_array('requester_blood_type', $existingColumns)) {
                $table->string('requester_blood_type')->nullable();
            }

            /*
             * Requester's Citizenship
             */
            if (!in_array('requester_citizenship', $existingColumns)) {
                $table->string('requester_citizenship')->nullable();
            }

            /*
             * Requester's Contact Number
             */
            if (!in_array('requester_contact', $existingColumns)) {
                $table->string('requester_contact')->nullable();
            }

            /*
             * Requester's Address
             */
            if (!in_array('requester_address', $existingColumns)) {
                $table->text('requester_address')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $existingColumns = Schema::getColumnListing('documents');

        $columnsToRemove = [
            'requester_last_name',
            'requester_first_name',
            'requester_middle_name',
            'requester_birthdate',
            'requester_age',
            'requester_sex',
            'requester_birthplace',
            'requester_marital_status',
            'requester_blood_type',
            'requester_citizenship',
            'requester_contact',
            'requester_address',
        ];

        $columnsToRemove = array_values(
            array_intersect($columnsToRemove, $existingColumns)
        );

        if (!empty($columnsToRemove)) {
            Schema::table('documents', function (Blueprint $table) use ($columnsToRemove) {
                $table->dropColumn($columnsToRemove);
            });
        }
    }
};
