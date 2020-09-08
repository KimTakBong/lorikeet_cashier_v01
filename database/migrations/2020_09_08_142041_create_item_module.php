<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemModule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('price');
            $table->text('hpp');
            $table->text('stock');
            $table->enum('is_visible', ['yes', 'no']);
            $table->boolean('is_delete');
            $table->timestamps();
        });

        Schema::create('item_restock', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->text('quantity');
            $table->text('buying_price')->nullable();
            $table->text('buying_date');
            $table->boolean('is_delete');
            $table->timestamps();

            // foreign key on item
            $table->foreign     ( 'item_id' )
                  ->references  ( 'id' )
                  ->on          ( 'item' )
                  ->onDelete    ( 'cascade' );

            // foreign key on user
            $table->foreign     ( 'user_id' )
                  ->references  ( 'id' )
                  ->on          ( 'users' )
                  ->onDelete    ( 'cascade' );
        });

        Schema::create('item_transaction', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id')->unsigned()->nullable();
            $table->text('quantity');
            $table->text('total_price');
            $table->text('discount');
            $table->timestamps();

            // foreign key on item
            $table->foreign     ( 'item_id' )
                  ->references  ( 'id' )
                  ->on          ( 'item' )
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
        Schema::drop('item');
        Schema::drop('item_restock');
        Schema::drop('item_transaction');
    }
}
