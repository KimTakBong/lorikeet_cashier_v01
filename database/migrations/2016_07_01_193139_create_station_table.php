<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('station_domicile', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('station', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('user_id'); //(JSON)
            $table->integer('domicile_id')->unsigned();
            $table->text('address');
            $table->text('map'); //(JSON)
            $table->text('description');
            $table->text('images'); //(JSON)
            $table->text('status'); //(premium, regular, banned)
            $table->timestamps();

            // foreign key on domicile
            $table->foreign     ( 'domicile_id' )
                  ->references  ( 'id' )
                  ->on          ( 'station_domicile' )
                  ->onDelete    ( 'cascade' );
        });

        Schema::create('field_category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('field', function (Blueprint $table) {
            $table->increments('id');;
            $table->integer('category_id')->unsigned();
            $table->integer('station_id')->unsigned();
            $table->string('name');
            $table->text('description');
            $table->text('images'); //(JSON)
            $table->text('schedule'); //(JSON)
            $table->integer('price_cash');
            $table->integer('price_coin');
            $table->timestamps();

            // foreign key on station
            $table->foreign     ( 'station_id' )
                  ->references  ( 'id' )
                  ->on          ( 'station' )
                  ->onDelete    ( 'cascade' );

            // foreign key on field_category
            $table->foreign     ( 'category_id' )
                  ->references  ( 'id' )
                  ->on          ( 'field_category' )
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
        Schema::drop('station_domicile');
        Schema::drop('station');
        Schema::drop('field_category');
        Schema::drop('field');
    }
}
