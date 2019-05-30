<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';

    public function classes()
    {
        return $this->hasMany(Class_::class, 'department_id');
    }

    public function teachers()
    {
        return $this->hasMany(Teacher::class, 'department_id');
    }
}
