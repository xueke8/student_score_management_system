<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseClasses extends Model
{
    protected $table = 'course_classes';

    public function class_()
    {
        return $this->belongsTo(Class_::class, 'class_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
