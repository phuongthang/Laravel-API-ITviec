<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cvs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image');
            $table->string('position');
            $table->string('fullname');
            $table->string('email');
            $table->string('phone');
            $table->string('description');
            $table->string('address');
            $table->integer('status')->default(0);
            $table->integer('flag_delete')->default(1);
            $table->integer('active')->default(0);
            $table->timestamps();

            //Cột khóa ngoại 
            $table->integer('user_id')->unsigned();
            //Tạo liên kết khóa ngoại
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cvs');
    }
}
