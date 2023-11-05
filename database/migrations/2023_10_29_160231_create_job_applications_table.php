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
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->constrained();
            
            $table->foreignIdFor(\App\Models\Job::class)->constrained(); 
            // ->onDelete('cascade'); 
                    //this is for that we delete a jobOffer that might have applications already sended,
                    // those will be deleted first, so that we dont have data floating in the air

            $table->unsignedInteger('expected_salary');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
