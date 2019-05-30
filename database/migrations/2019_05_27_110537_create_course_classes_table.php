<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_classes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('course_id')->comment('课程ID');
            $table->unsignedInteger('class_id')->comment('班级ID');
            $table->year('year')->comment('学年');
            $table->enum('semester', ['上学期', '下学期'])->comment('学期');
            $table->unique(['course_id', 'class_id']);
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
        Schema::dropIfExists('courses_classes');
    }
}
