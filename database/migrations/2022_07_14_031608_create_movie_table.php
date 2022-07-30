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
        Schema::create('movie', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->text('description');
            $table->string('duration');
            $table->string('age_classification');
            $table->char('year_entry', 4);
            $table->unsignedBigInteger('genre_id');
            $table->unsignedBigInteger('type_entertainment_id');
            $table->unsignedBigInteger('created_user_id');
            $table->char('situation', 1);
            $table->timestamps();

            $table->foreign('genre_id')->references('id')->on('genre');
            $table->foreign('type_entertainment_id')->references('id')->on('type_entertainment');
            $table->foreign('created_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movie');
    }
};
