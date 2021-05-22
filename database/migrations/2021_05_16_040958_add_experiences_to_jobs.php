<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExperiencesToJobs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            //Cột khóa ngoại
            $table->integer('experience_id')->unsigned();
            //Tạo liên kết khóa ngoại
            $table->foreign('experience_id')->references('id')->on('experiences');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
             //Cột khóa ngoại
             $table->integer('experience_id')->unsigned();
             //Tạo liên kết khóa ngoại
             $table->foreign('experience_id')->references('id')->on('experiences');
        });
    }
}
