<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('anime')->create('animes', function (Blueprint $table) {
            $table->id();
            $table->string('unqID')->unique();
            $table->string('name')->nullable();
            $table->string('japanese_name')->nullable();
            $table->string('trailer')->nullable();
            $table->string('type')->nullable();
            $table->string('source')->nullable();
            $table->string('season')->nullable();
            $table->string('duration')->nullable();
            $table->string('rating')->nullable();
            $table->float('score')->nullable();
            $table->integer('scored_by')->nullable();
            $table->integer('rank')->nullable();
            $table->integer('popularity')->nullable();
            $table->integer('members')->nullable();
            $table->integer('favorites')->nullable();
            $table->text('synopsis')->nullable();
            $table->text('background')->nullable();
            $table->string('string_date')->nullable();
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
        Schema::dropIfExists('animes');
    }
};
