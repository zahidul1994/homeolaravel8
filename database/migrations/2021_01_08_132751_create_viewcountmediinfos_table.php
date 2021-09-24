<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewcountmediinfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('viewcountmediinfos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('medicineinformation_id')->unsigned()->nullable();
            $table->foreign('medicineinformation_id')->references('id')->on('medicineinformations')->onDelete('cascade');
             $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string("ip");
            $table->integer("click");
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
        Schema::dropIfExists('viewcountmediinfos');
    }
}
