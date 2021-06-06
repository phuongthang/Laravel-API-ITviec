<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('position')->nullable();
            $table->string('salary')->nullable();
            $table->string('location')->nullable();
            $table->string('description')->nullable();
            $table->string('required')->nullable();
            $table->integer('count')->default(1);
            $table->integer('status')->default(0);
            $table->integer('flag_delete')->default(1);
            $table->integer('active')->default(0);
            $table->timestamps();

            //Cột khóa ngoại 
            $table->integer('organization_id')->unsigned();
            //Tạo liên kết khóa ngoại
            $table->foreign('organization_id')->references('id')->on('organizations');

            $table->integer('province')->unsigned();
            //Tạo liên kết khóa ngoại
            $table->foreign('province')->references('id')->on('provinces');

            $table->integer('district')->unsigned();
            //Tạo liên kết khóa ngoại
            $table->foreign('district')->references('id')->on('districts');

            $table->integer('ward')->unsigned();
            //Tạo liên kết khóa ngoại
            $table->foreign('ward')->references('id')->on('districts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
