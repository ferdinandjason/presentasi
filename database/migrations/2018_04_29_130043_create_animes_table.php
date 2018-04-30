<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->longText('synopsis');
            $table->string('picture');
            $table->string('english_title');
            $table->string('japanese_title');
            $table->string('trailer');
            $table->string('status');
            $table->string('aired');
            $table->integer('episodes');
            $table->string('type');
            $table->string('duration');
            $table->string('rating');
            $table->double('score');
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
}
