<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('superadmin_id')->unsigned()->nullable();
            $table->foreign('superadmin_id')->references('id')->on('superadmins')->onDelete('cascade');   
            $table->bigInteger('admin_id')->unsigned()->nullable();
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');   
            $table->string('name')->nullable();
            $table->string('subject')->nullable();
           $table->mediumText('message')->nullable();
           $table->string('reply',500)->nullable();
           $table->tinyInteger('status')->default(2);
           $table->softDeletes('deleted_at', 0);
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
        Schema::dropIfExists('contacts');
    }
}
