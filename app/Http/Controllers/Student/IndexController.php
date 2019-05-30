<?php

namespace App\Http\Controllers\Student;

use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function courses(Request $request)
    {
        $year = $request->get('year');
        $semester = $request->get('semester');

        $class_courses = Auth:: guard('student')->user()
            ->class_->classCourses()
            ->where(function (\Illuminate\Database\Eloquent\Builder $builder) use ($year, $semester) {
                if ($year) {
                    $builder->where('year', $year);
                }
                if ($semester) {
                    $builder->where('semester', $semester);
                }
            })->get();

        return view('student.course')->with('class_courses', $class_courses);
    }

    public function scores(Request $request)
    {
        $year = $request->get('year');
        $semester = $request->get('semester');

        $scores = DB::table('scores')
            ->join('courses', 'courses.id', '=', 'scores.course_id')
            ->join('course_classes', function (JoinClause $join) {
                $join->on('scores.course_id', '=', 'course_classes.course_id')
                    ->on('scores.class_id', '=', 'course_classes.class_id');
            })
            ->where(function (Builder $builder) use ($year, $semester) {
                if ($year) {
                    $builder->where('year', $year);
                }
                if ($semester) {
                    $builder->where('semester', $semester);
                }
            })
            ->get([
                'scores.id', 'courses.name as course_name', 'course_classes.year',
                'course_classes.semester', 'scores.type', 'scores.score', 'scores.credit',
                'scores.remark', 'scores.created_at', 'scores.updated_at'
            ]);

        return view('student.score')->with('scores', $scores);
    }
}
