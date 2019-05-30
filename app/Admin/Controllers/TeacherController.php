<?php

namespace App\Admin\Controllers;

use App\Department;
use App\Teacher;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class TeacherController extends Controller
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
            ->header('Index')
            ->description('description')
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
            ->description('description')
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
            ->description('description')
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
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Teacher);

        $grid->id('教师号')->sortable();
        $grid->name('姓名')->sortable()->display(function (){
            return '<a href="/admin/teachers/' . $this->id . '">' . $this->name . '</a>';
        });
        $grid->department('系部')->display(function () {
            return '<a href="/admin/departments/' . $this->department->id . '">' . $this->department->name . '</a>';
        })->sortable();
        $grid->sex('性别')->sortable();
        $grid->phone('联系电话')->sortable();
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
        $show = new Show(Teacher::findOrFail($id));

        $show->id('教师号');
        $show->department('系部')->as(function (Department $department) {
            return $department->name;
        });
        $show->name('姓名');
        $show->sex('性别');
        $show->phone('联系电话');
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
        $form = new Form(new Teacher);

        $form->text('name', '姓名')->rules('required');
        $form->select('department_id', '系部')
            ->options('/api/departments')
            ->rules('required');;
        $form->radio('sex', '性别')->options(['男' => '男', '女' => '女'])->default('男');
        $form->mobile('phone', '联系电话');

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
