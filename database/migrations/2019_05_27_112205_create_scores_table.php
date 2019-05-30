<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('class_id')->comment('班级ID');
            $table->unsignedInteger('student_id')->comment('学生ID');
            $table->unsignedInteger('course_id')->comment('课程ID');
            $table->enum('type', ['初考', '补考', '毕业清考'])->comment('成绩类型');
            $table->unsignedSmallInteger('score')->comment('成绩');
            $table->unsignedSmallInteger('credit')->comment('获得学分');
            $table->string('remark')->nullable()->comment('备注');
            $table->unique(['class_id', 'student_id', 'course_id']);
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
        Schema::dropIfExists('scores');
    }
}
