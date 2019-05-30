<?php

namespace App\Http\Controllers\Teacher;

use App\Course;
use App\Score;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function showCourseTable()
    {
        $teacher = Auth::guard('teacher')->user();

        $courses = DB::table('course_classes')->join('courses', 'courses.id', '=', 'course_classes.course_id')
            ->join('classes', 'classes.id', '=', 'course_classes.class_id')
            ->where('courses.teacher_id', $teacher->id)
            ->select(['courses.name as course_name', 'classes.name as class_name', 'year', 'semester', 'courses.credit'])
            ->get();

        return view('teacher.course')->with('courses', $courses);
    }

    public function showScoreTable(Request $request)
    {
        $teacher = Auth::guard('teacher')->user();
        $courses = $teacher->courses;

        $course_id = $request->get('course_id', 1);
        $class_id = $request->get('class_id', 1);

        $classes = Course::find($request->get('course_id', 1))->classes;

        $scores = Score::join('course_classes', function (JoinClause $joinClause) {
            $joinClause->on('course_classes.class_id', '=', 'scores.class_id')
                ->on('course_classes.course_id', '=', 'scores.course_id');
        })
            ->where(function (Builder $builder) use ($course_id, $class_id) {
                if ($course_id) {
                    $builder->where('scores.course_id', $course_id);
                }
                if ($class_id) {
                    $builder->where('scores.class_id', $class_id);
                }
            })->get();


        return view('teacher.score')
            ->with('courses', $courses)
            ->with('classes', $classes)
            ->with('scores', $scores)
            ->with('course_id', $course_id)
            ->with('class_id', $class_id);
    }

    public function postScore(Request $request)
    {
        $this->validate($request, [
            'course_id' => 'required',
            'class_id' => 'required',
            'student_id' => 'required',
            'type' => 'required',
            'score' => 'required|min:0|max:255',
            'credit' => 'required|min:0|max:255'
        ]);

        $save = $request->only(['course_id', 'class_id', 'student_id', 'type', 'score', 'credit', 'remark',]);
        $score = new Score($save);
        $score->save();

        return redirect()->back();
    }
}
