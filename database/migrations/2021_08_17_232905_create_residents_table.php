<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->integer('book_id')->nullable();
            $table->string('title')->nullable();
            $table->string('superHost')->nullable();
            $table->string('residentType')->nullable();
            $table->string('location')->nullable();
            $table->string('samplePhotoUrl')->nullable();
            $table->string('rating')->nullable();
            $table->bigInteger('personReviewed')->change();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('residents');
    }
}
