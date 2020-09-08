<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCostModule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cost_category', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned()->nullable();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('cost', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cost_category_id')->unsigned()->nullable();
            $table->string('name');
            $table->text('description');
            $table->text('nominal');
            $table->text('date');
            $table->timestamps();

            // foreign key on cost_category
            $table->foreign     ( 'cost_category_id' )
                  ->references  ( 'id' )
                  ->on          ( 'cost_category' )
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
        Schema::drop('cost_category');
        Schema::drop('cost');
    }
}
