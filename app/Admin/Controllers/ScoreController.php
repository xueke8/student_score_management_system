<?php

namespace App\Admin\Controllers;

use App\Class_;
use App\Course;
use App\CourseClasses;
use App\Score;
use App\Http\Controllers\Controller;
use App\Student;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ScoreController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('成绩')
            ->description('列表')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('详情')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('编辑')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('新增')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Score);

        $grid->id('Id')->sortable();
        $grid->student_id('学号')->display(function () {
            return $this->student_id;
        })->sortable();
        $grid->student('姓名')->display(function () {
            return '<a href="/admin/students/' . $this->id . '">' . $this->student->name . '</a>';
        })->sortable();
        $grid->class('班级')->display(function () {
            return '<a href="/admin/classes/' . $this->id . '">' . $this->student->class_->name . '</a>';
        })->sortable();
        $grid->course('课程')->display(function () {
            return '<a href="/admin/courses/' . $this->id . '">' . $this->course->name . '</a>';
        })->sortable();
        $grid->year('学年')->display(function () {
            $year = CourseClasses::where('class_id', $this->class_id)->where('course_id', $this->course_id)->first()->year;
            return $year . '-' . ($year + 1);
        })->sortable();
        $grid->semester('学期')->display(function () {
            return CourseClasses::where('class_id', $this->class_id)->where('course_id', $this->course_id)->first()->semester;
        })->sortable();
        $grid->type('类型')->sortable();
        $grid->score('成绩')->sortable();
        $grid->credit('学分')->sortable();
        $grid->remark('备注')->sortable();
        $grid->created_at('创建时间')->sortable();
        $grid->updated_at('更新时间')->sortable();

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Score::findOrFail($id));

        $show->id('Id');
        $show->student('学生')->as(function (Student $student) {
            return $student->name;
        });
        $show->course('课程')->as(function (Course $course) {
            return $course->name;
        });
        $show->type('类型');
        $show->year('学年');
        $show->semester('学期');
        $show->score('成绩');
        $show->remark('备注');
        $show->created_at('创建时间');
        $show->updated_at('更新时间');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Score);

        $classes = Class_::all(['id', 'name']);
        $class_data = [];
        foreach ($classes as $class) {
            $class_data[$class->id] = $class->name;
        }

        $form->select('class_id', '班级')
            ->options('/api/classes')
            ->load('student_id', '/api/students')->rules('required');
        $form->select('student_id', '学生')
            ->load('course_id', '/api/courses')
            ->rules('required');
        $form->select('course_id', '课程')->rules('required');

        $form->radio('type', '类型')
            ->options(['初考' => '初考', '补考' => '补考', '毕业清考' => '毕业清考'])
            ->default('初考')->rules('required');
        $form->number('score', '成绩')->rules('required|max:100|min:0')->default(0);
        $form->number('credit', '学分')->rules('required|max:10|min:0')->default(0);
        $form->textarea('remark', '备注');

        return $form;
    }
}
