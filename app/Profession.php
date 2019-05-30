<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    public function classes()
    {
        return $this->hasMany(Class_::class,'profession_id');
    }
}
