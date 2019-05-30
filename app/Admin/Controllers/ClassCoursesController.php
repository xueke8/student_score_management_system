<?php

namespace App\Admin\Controllers;

use App\Class_;
use App\Course;
use App\CourseClasses;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ClassCoursesController extends Controller
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
            ->header('班级课程')
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
            ->header('班级课程')
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
            ->header('班级课程')
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
            ->header('班级课程')
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
        $grid = new Grid(new CourseClasses);

        $grid->id('Id');
        $grid->class('班级')->display(function () {
            return '<a href="/admin/classes/' . $this->id . '">' . $this->class_->name . '</a>';
        })->sortable();
        $grid->course('课程')->display(function () {
            return '<a href="/admin/courses/' . $this->id . '">' . $this->course->name . '</a>';
        })->sortable();
        $grid->year('学年')->display(function ($year) {
            return $year . '-' . ($year + 1);
        })->sortable();
        $grid->semester('学期');
        $grid->created_at('创建时间');
        $grid->updated_at('更新时间');

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
        $show = new Show(CourseClasses::findOrFail($id));

        $show->id('Id');
        $show->class_('班级')->as(function (Class_ $class) {
            return $class->name;
        });
        $show->course('课程')->as(function (Course $course){
            return $course->name;
        });
        $show->year('学年');
        $show->semester('学年');
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
        $form = new Form(new CourseClasses);

        $form->select('class_id', '班级')->options('/api/classes')->default(request('class_id'))->rules('required');
        $form->select('course_id', '课程')->options('/api/courses')->rules('required');
        $form->select('year', '学年')->options([
            date('Y') - 2 => (date('Y') - 2) . '-' . (date('Y') - 1),
            date('Y') - 1 => (date('Y') - 1) . '-' . (date('Y')),
            date('Y') => date('Y') . '-' . (date('Y') - 1),
            date('Y') + 1 => (date('Y') + 1) . '-' . (date('Y') + 2),
            date('Y') + 2 => (date('Y') + 2) . '-' . (date('Y') + 3),
            date('Y') + 3 => (date('Y') + 3) . '-' . (date('Y') + 4),
            date('Y') + 4 => (date('Y') + 4) . '-' . (date('Y') + 5)
        ])->rules('required');
        $form->select('semester', '学期')->options([
            '上学期' => '上学期',
            '下学期' => '下学期',
        ])->rules('required');

        return $form;
    }
}
