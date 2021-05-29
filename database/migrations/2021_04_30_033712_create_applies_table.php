<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('image');
            $table->integer('status')->default(0);
            $table->timestamps();

            //Cột khóa ngoại 
            $table->integer('user_id')->unsigned();
            //Tạo liên kết khóa ngoại
            $table->foreign('user_id')->references('id')->on('users');

            //Cột khóa ngoại 
            $table->integer('organization_id')->unsigned();
            //Tạo liên kết khóa ngoại
            $table->foreign('organization_id')->references('id')->on('organizations');

            //Cột khóa ngoại 
            $table->integer('job_id')->unsigned();
            //Tạo liên kết khóa ngoại
            $table->foreign('job_id')->references('id')->on('jobs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applies');
    }
}
