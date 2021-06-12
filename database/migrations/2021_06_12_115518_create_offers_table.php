<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('file');
            $table->timestamps();

            //Cột khóa ngoại 
            $table->integer('user_id')->unsigned();
            //Tạo liên kết khóa ngoại
            $table->foreign('user_id')->references('id')->on('users');

            //Cột khóa ngoại 
            $table->integer('organization_id')->unsigned();
            //Tạo liên kết khóa ngoại
            $table->foreign('organization_id')->references('id')->on('organizations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offers');
    }
}
