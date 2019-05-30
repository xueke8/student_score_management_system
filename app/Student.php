<?php

namespace App;

use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'class_id', 'sex', 'phone', 'id_number', 'address'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $table = 'students';

    public function user()
    {
        return $this->belongsTo(Administrator::class, 'user_id', 'id');
    }

    public function class_()
    {
        return $this->belongsTo(Class_::class, 'class_id');
    }

    public function scores()
    {
        return $this->hasMany(Score::class);
    }
}
