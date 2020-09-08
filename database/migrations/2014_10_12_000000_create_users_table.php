<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usergroups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('access_right');
            $table->boolean('is_delete');
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id')->unsigned();
            $table->string('name');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('avatar')->nullable();
            $table->integer('coin');
            $table->enum('is_active', ['active', 'inactive']);
            $table->boolean('is_delete');
            $table->rememberToken();
            $table->timestamps();

            // foreign key on usergroups
            $table->foreign     ( 'group_id' )
                  ->references  ( 'id' )
                  ->on          ( 'usergroups' )
                  ->onDelete    ( 'cascade' );
        });

        Schema::create('user_coin_log', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('coin_old');
            $table->string('coin_new');
            $table->timestamps();
            
            // foreign key on users
            $table->foreign     ( 'user_id' )
                  ->references  ( 'id' )
                  ->on          ( 'users' )
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
        Schema::drop('usergroups');
        Schema::drop('users');
        Schema::drop('user_coin_log');
    }
}
