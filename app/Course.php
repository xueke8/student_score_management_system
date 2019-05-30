<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * 建立一对多关联 任课老师
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    /**
     * 建立一对多关联 所有班级
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function classes()
    {
        return $this->belongsToMany(Class_::class, 'course_classes', 'course_id', 'class_id');
    }

    public function class_courses()
    {
        return $this->hasMany(CourseClasses::class, 'course_id');
    }

    /**
     * 建立一对多关联 所有成绩
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function scores()
    {
        return $this->hasMany(Score::class);
    }
}
