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
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            // Store the applicant's full name
            $table->string('name');
            // Store the applicant's email address
            $table->string('email')->unique();
            // Store the applicant's phone number
            $table->string('phone');
            // Store the position the applicant is applying for
            $table->string('position');
            // Store the applicant's experience in years
            $table->integer('experience');
            // Store the applicant's cover letter or description
            $table->text('description')->nullable();
            // Store the current status of the application (new, under review, accepted, rejected)
            $table->string('status')->default('new');
            // Store created and updated timestamps automatically
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};
