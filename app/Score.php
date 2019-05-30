<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $table = 'scores';

    protected $fillable = ['class_id', 'student_id', 'course_id', 'type', 'score', 'credit', 'remark'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function class_()
    {
        return $this->belongsTo(Class_::class, 'class_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
