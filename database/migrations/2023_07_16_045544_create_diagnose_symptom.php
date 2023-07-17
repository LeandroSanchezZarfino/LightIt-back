<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagnoseSymptom extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnose_symptom', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('diagnose_id');
            $table->unsignedBigInteger('symptom_id');
            $table->timestamps();

            $table->foreign('diagnose_id')->references('id')->on('diagnoses')->onDelete('cascade');
            $table->foreign('symptom_id')->references('id')->on('symptoms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diagnose_symptom');
    }
}
