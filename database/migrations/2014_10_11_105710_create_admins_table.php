<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('superadmin_id')->unsigned()->nullable();
            $table->foreign('superadmin_id')->references('id')->on('superadmins')->onDelete('cascade');   
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->unique();
             $table->string('password');
             $table->string('username')->unique();
            $table->string('profession','60')->nullable();
            $table->string('aboutyou',500)->nullable();
            $table->string('coverphoto')->nullable();
            $table->string('gender');
            $table->tinyInteger('actype')->default(2);
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
        
        Schema::dropIfExists('admins');
    }
}
