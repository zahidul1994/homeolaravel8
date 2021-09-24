<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->bigInteger('admin_id')->unsigned()->nullable();
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');   
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('password');
            $table->integer('phone')->unique();
            $table->string('image')->nullable();
            $table->integer('refer')->unique();
            $table->integer('otp')->nullable();
			 $table->string('division')->nullable();
			 $table->string('district')->nullable();
			 $table->string('thana')->nullable();
			 $table->string('fulladdress')->nullable();
			 $table->string('drtype')->default('Homeopathy');
			 $table->string('drtitle')->nullable();
			 $table->string('drabout',1000)->nullable();
            $table->tinyInteger('status')->default(2);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
       $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
