<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Books extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('authors');
            $table->string('isbn');
            $table->integer('number_of_pages')->unsigned();
            $table->string('publisher');
            $table->string('country');
            $table->string('release_date');
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
        Schema::drop('books');
    }
}
