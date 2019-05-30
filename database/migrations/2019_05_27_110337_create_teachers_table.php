<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->increments('id')->comment('教师号');
            $table->string('password',60)->comment('密码');
            $table->unsignedInteger('department_id')->comment('所属系部ID');
            $table->string('name')->comment('姓名');

            $table->enum('sex', ['男', '女'])->nullable()->comment('性别');
            $table->string('phone')->nullable()->comment('联系电话');
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
        Schema::dropIfExists('teachers');
    }
}
