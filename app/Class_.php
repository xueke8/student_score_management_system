<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Class_ extends Model
{
    protected $table = 'classes';

    /**
     * 建立一对多关联 所属系部
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    /**
     * 建立一对多关联 所属专业
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profession()
    {
        return $this->belongsTo(Profession::class, 'profession_id');
    }

    /**
     * 建立一对多关联 所有学生
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function students()
    {
        return $this->hasMany(Student::class, 'class_id');
    }

    /**
     * 建立多对多关联 所有课程
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_classes', 'class_id', 'course_id');
    }

    /**
     * 建立一对多关联 所有班级课程
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function classCourses()
    {
        return $this->hasMany(CourseClasses::class, 'class_id');
    }

    /**
     * 建立一对多关联 所有成绩
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function scores()
    {
        return $this->hasMany(Score::class,'class_id');
    }
}
