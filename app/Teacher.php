<?php

namespace App;

use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Teacher extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'department_id', 'sex', 'phone'
    ];

    protected $table = 'teachers';

    public function user()
    {
        return $this->belongsTo(Administrator::class, 'user_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
