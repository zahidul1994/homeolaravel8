<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiseasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diseases', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('admin_id')->unsigned()->nullable();
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');   
            $table->string('diseasename');
            $table->string('slug')->unique();
            $table->string('menwomen');
            $table->string('diseaseimage')->nullable();
            $table->string('description',500)->nullable();
            $table->tinyInteger('use')->default(1);
            $table->tinyInteger('status')->default(2);
            $table->tinyInteger('dmuse')->default(0);
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
        Schema::dropIfExists('diseases');
    }
}
