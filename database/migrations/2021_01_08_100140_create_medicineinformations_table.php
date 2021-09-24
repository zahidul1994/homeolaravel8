<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicineinformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicineinformations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('superadmin_id')->unsigned()->nullable();
            $table->foreign('superadmin_id')->references('id')->on('superadmins')->onDelete('cascade');   
            $table->bigInteger('admin_id')->unsigned()->nullable();
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');   
            $table->bigInteger('disease_id')->unsigned()->nullable();
            $table->foreign('disease_id')->references('id')->on('diseases')->onDelete('cascade');   
            $table->string('title')->nullable();
            $table->string('slug')->unique();
            $table->string('keyword')->nullable();
            $table->string('photo')->nullable();
            $table->string('metadescription',160)->nullable();
            // $table->json('medicineinfo')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('medicineinformations');
    }
}
