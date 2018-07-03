<?php

use Illuminate\Support\Facades\Schema;
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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
	        $table->string('open_id');
	        $table->string('union_id')->nullable();
	        $table->string('session_key');
	        $table->string('phone', 20)->nullable();
	        $table->string('password')->nullable();
            $table->string('nick_name', 50)->nullabe();
	        $table->string('gender', 50)->nullabe();
            $table->string('language', 50)->nullabe();
            $table->string('city', 50)->nullabe();
            $table->string('province', 50)->nullabe();
            $table->string('country', 50)->nullabe();
            $table->string('avatar_url', 50)->nullabe();
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
        Schema::dropIfExists('user');
    }
}
