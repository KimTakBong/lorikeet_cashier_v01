<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('start');
            $table->string('end');
            $table->string('price');
        });

        Schema::create('book_schedule', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('field_id')->unsigned();
            $table->integer('book_id')->unsigned();
            $table->string('date');
            $table->string('duration');
            
            // foreign key on category
            $table->foreign     ( 'field_id' )
                  ->references  ( 'id' )
                  ->on          ( 'field' )
                  ->onDelete    ( 'cascade' );

            // foreign key on domicile
            $table->foreign     ( 'book_id' )
                  ->references  ( 'id' )
                  ->on          ( 'book' )
                  ->onDelete    ( 'cascade' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('book_schedule');
        Schema::drop('book');
    }
}
