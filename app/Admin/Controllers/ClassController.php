<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\ClassesExporter;
use App\Admin\Extensions\Exporter;
use App\Class_;
use App\Course;
use App\Department;
use App\Http\Controllers\Controller;
use App\Profession;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ClassController extends Controller
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
            ->header('班级')
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
            ->header('班级')
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
            ->header('班级')
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
            ->header('班级')
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
        $grid = new Grid(new Class_);

        $grid->filter(function (Grid\Filter $filter) {
            $filter->like('name', '名称');
            $filter->equal('department_id', '系部')->select('/api/departments');
            $filter->equal('profession_id', '专业')->select('/api/professions');
            $filter->like('head_teacher', '班主任');
        });

        $grid->id('ID')->sortable();
        $grid->name('名称')->display(function () {
            return '<a href="/admin/classes/' . $this->id . '">' . $this->name . '</a>';
        })->sortable();
        $grid->department('系部')->display(function () {
            return '<a href="/admin/departments/' . $this->id . '">' . $this->department->name . '</a>';
        })->sortable();
        $grid->profession('专业')->display(function () {
            return '<a href="/admin/professions/' . $this->id . '">' . $this->profession->name . '</a>';
        })->sortable();
        $grid->head_teacher('班主任')->sortable();
        $grid->column('courses', '课程')->display(function () {
            return $this->courses()->take(5)->get()->toArray();
        })->table(['id' => 'ID', 'name' => '名称'])->sortable();

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
        $show = new Show(Class_::findOrFail($id));

        $show->id('Id');

        $show->name('名称');
        $show->department('系部')->as(function (Department $department) {
            return $department->name;
        });
        $show->profession('专业')->as(function (Profession $profession) {
            return $profession->name;
        });
        $show->head_teacher('班主任');
        $show->created_at('创建时间');
        $show->updated_at('更新时间');

        $show->students('所有学生', function (Grid $grid) {
            $grid->resource('/admin/students');

            $grid->filter(function (Grid\Filter $filter) {
                $filter->like('student_id', '学号');
                $filter->equal('sex', '性别')->radio(['男' => '男', '女' => '女']);
            });

            $grid->id('学号');
            $grid->name('姓名')->display(function () {
                return '<a href="/admin/students/' . $this->id . '">' . $this->name . '</a>';
            });
            $grid->sex('性别');
            $grid->phone('联系电话');
            $grid->id_number('身份证号');
            $grid->address('住址');
            $grid->created_at('创建时间');
            $grid->updated_at('更新时间');
        });

        $show->classCourses('所有课程', function (Grid $grid) {
            $grid->resource('/admin/class-courses');

            $grid->id('ID');
            $grid->course_id('课程')->display(function () {
                return '<a href="/admin/courses/' . $this->course->id . '">' . $this->course->name . '</a>';
            });
            $grid->year('学年');
            $grid->semester('学期');
            $grid->created_at('创建时间');
            $grid->updated_at('更新时间');
        });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Class_);

        $form->text('name', '名称');
        $form->select('department_id', '系部')->options('/api/departments');
        $form->select('profession_id', '专业')->options('/api/professions');
        $form->text('head_teacher', '班主任');

        return $form;
    }
}