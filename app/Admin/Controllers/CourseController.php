<?php

namespace App\Admin\Controllers;

use App\Course;
use App\Http\Controllers\Controller;
use App\Teacher;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class CourseController extends Controller
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
            ->header('课程')
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
            ->header('课程')
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
            ->header('课程')
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
            ->header('课程')
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
        $grid = new Grid(new Course);

        $grid->id('Id')->sortable();
        $grid->teacher('教师')->display(function () {
            return '<a href="/admin/teachers/' . $this->teacher->id . '">' . $this->teacher->name . '</a>';
        })->sortable();
        $grid->name('名称')->display(function () {
            return '<a href="/admin/courses/' . $this->id . '">' . $this->name . '</a>';
        })->sortable();
        $grid->credit('学分')->sortable();
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
        $show = new Show(Course::findOrFail($id));

        $show->id('Id');
        $show->teacher('教师')->as(function (Teacher $teacher) {
            return $teacher->name;
        });
        $show->name('名称');
        $show->credit('学分');
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
        $form = new Form(new Course);

        $form->select('teacher_id', '教师')
            ->options('/api/teachers')
            ->rules('required');
        $form->text('name', '名称')->rules('required');
        $form->number('credit', '学分')->rules('required');

        return $form;
    }
}
