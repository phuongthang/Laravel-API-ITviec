<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->string('content');
            $table->integer('status');
            $table->integer('flag_delete')->default(1);
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
        Schema::dropIfExists('reviews');
    }
}
