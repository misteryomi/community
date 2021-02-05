<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_metas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('post_id');
            $table->boolean('is_approved')->default(0);
            $table->integer('category_id')->nullable();
            $table->integer('type_id')->nullable();
            $table->integer('min_salary')->nullable();
            $table->integer('max_salary')->nullable();
            $table->integer('salary_type_id')->nullable();
            $table->string('url')->nullable();
            $table->string('location')->nullable();
            $table->timestamp('deadline')->nullable();
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
        Schema::dropIfExists('job_metas');
    }
}
