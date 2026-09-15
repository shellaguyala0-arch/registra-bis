<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | Allow payments without a business
            |--------------------------------------------------------------------------
            |
            | Filing Complaint is not connected to a registered business.
            |
            */
            $table->unsignedBigInteger('business_id')
                ->nullable()
                ->change();

            /*
            |--------------------------------------------------------------------------
            | Complaint Information
            |--------------------------------------------------------------------------
            */

            $table->string('complainant_name')
                ->nullable()
                ->after('remarks');

            $table->string('complainant_contact')
                ->nullable()
                ->after('complainant_name');

            $table->string('respondent_name')
                ->nullable()
                ->after('complainant_contact');

            $table->string('respondent_contact')
                ->nullable()
                ->after('respondent_name');

            $table->string('complaint_type')
                ->nullable()
                ->after('respondent_contact');

            $table->date('incident_date')
                ->nullable()
                ->after('complaint_type');

            $table->string('incident_place')
                ->nullable()
                ->after('incident_date');

            $table->text('complaint_description')
                ->nullable()
                ->after('incident_place');
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {

            $table->dropColumn([
                'complainant_name',
                'complainant_contact',
                'respondent_name',
                'respondent_contact',
                'complaint_type',
                'incident_date',
                'incident_place',
                'complaint_description',
            ]);
        });
    }
};