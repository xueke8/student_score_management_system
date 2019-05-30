<?php

namespace App\Admin\Controllers;

use App\Class_;
use App\Student;
use App\Http\Controllers\Controller;
use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class StudentController extends Controller
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
            ->header('学生')
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
            ->header('学生')
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
            ->header('学生')
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
            ->header('学生')
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
        $grid = new Grid(new Student());

        $grid->id('学号')->sortable();
        $grid->name('姓名')->display(function () {
            return '<a href="/admin/students/' . $this->id . '">' . $this->name . '</a>';
        })->sortable();
        $grid->class_('班级')->display(function () {
            return '<a href="/admin/classes/' . $this->class_->id . '">' . $this->class_->name . '</a>';
        })->sortable();
        $grid->sex('性别')->sortable();
        $grid->phone('联系电话')->sortable();
        $grid->id_number('身份证号')->sortable();
        $grid->address('家庭住址')->sortable();
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
        $show = new Show(Student::findOrFail($id));

        $show->id('学号');
        $show->class_('班级')->as(function (Class_ $class_) {
            return $class_->name;
        });
        $show->sex('性别');
        $show->phone('联系电话');
        $show->id_number('身份证号码');
        $show->address('家庭住址');
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
        $form = new Form(new Student());

        $form->display('id', '学号')->rules('required');
        $form->text('name', '姓名')->rules('required');
        $form->select('class_id', '班级')->options('/api/classes')->rules('required');
        $form->radio('sex', '性别')->options(['男' => '男', '女' => '女'])->default('男');
        $form->mobile('phone', '联系电话');
        $form->text('id_number', '身份证号码');
        $form->text('address', '家庭住址');

        $form->password('password', '密码')->rules('required|confirmed');
        $form->password('password_confirmation', '确认密码')->rules('required')
            ->default(function ($form) {
                return $form->model()->password;
            });

        $form->ignore('password_confirmation');

        $form->display('created_at', '创建时间');
        $form->display('updated_at', '更新时间');

        $form->saving(function (Form $form) {
            if ($form->password && $form->model()->password != $form->password) {
                $form->password = bcrypt($form->password);
            }
        });

        return $form;
    }
}
