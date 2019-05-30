<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Exporter;
use App\Profession;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ProfessionController extends Controller
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
            ->header('专业')
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
            ->header('专业')
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
            ->header('专业')
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
            ->header('专业')
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
        $grid = new Grid(new Profession);

        $grid->filter(function (Grid\Filter $filter) {
            $filter->like('name','名称');
            $filter->like('code','专业代码');
        });

        $exporter = new Exporter();
        $exporter->options('专业列表.xlsx', [
            'id' => 'ID',
            'name' => '名称',
            'code' => '专业代码',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ]);
        $grid->exporter($exporter);

        $grid->id('ID');
        $grid->name('名称');
        $grid->code('专业代码');
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
        $show = new Show(Profession::findOrFail($id));

        $show->id('ID')->sortable();
        $show->name('名称')->sortable();
        $show->code('专业代码')->sortable();
        $show->created_at('创建时间')->sortable();
        $show->updated_at('更新时间')->sortable();

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Profession);

        $form->text('name', '名称');
        $form->text('code', '专业代码');

        return $form;
    }
}
