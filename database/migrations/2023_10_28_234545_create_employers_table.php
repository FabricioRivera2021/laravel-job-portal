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
        Schema::create('employers', function (Blueprint $table) {
            $table->id();

            $table->string('company_name');
            $table->foreignIdFor(\App\Models\User::class)
                  ->nullable()
                  ->constrained();

            $table->timestamps();
        });

        //esta tabla se esta modificando para añadir una clave foranea del employer que es el que genera el JOB OFFER
        Schema::table('jobs', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Employer::class)->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //para borrar al empleador primero hay que borrar la referencia desde la tabla de jobs al empleador
        Schema::table('jobs', function(Blueprint $table)
        {
            $table->dropForeignIdFor(\App\Models\Employer::class);
        });

        Schema::dropIfExists('employers');
    }
};
