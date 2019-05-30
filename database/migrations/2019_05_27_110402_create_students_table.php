<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id')->comment('学号');
            $table->string('password', 60)->comment('密码');
            $table->unsignedInteger('class_id')->comment('所属班级的ID');
            $table->string('name')->comment('姓名');

            $table->enum('sex', ['男', '女'])->nullable()->comment('性别');
            $table->string('phone')->nullable()->comment('电话号码');
            $table->string('id_number')->nullable()->comment('身份证号码');
            $table->string('address')->nullable()->comment('家庭住址');
            $table->rememberToken();
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
        Schema::dropIfExists('students');
    }
}
