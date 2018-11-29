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
        Schema::create('wechat_users', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
	        $table->string('open_id', 32);
	        $table->string('union_id', 32)->nullable();
	        $table->string('session_key');
	        $table->string('phone', 20)->nullable();
	        $table->string('password')->nullable();
            $table->string('nick_name', 50)->nullabe();
	        $table->enum('gender', ['0', '1', '2'])->default(0)->comment('性别 0：未知、1：男、2：女');
            $table->char('language', 10)->nullabe();
            $table->string('city', 20)->nullabe();
            $table->string('province', 20)->nullabe();
            $table->string('country', 20)->nullabe();
            $table->string('avatar_url', 500)->nullabe();
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
        Schema::dropIfExists('wechat_users');
    }
}
