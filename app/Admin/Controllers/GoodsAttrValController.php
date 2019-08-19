<?php

namespace App\Admin\Controllers;

use App\Model\GoodsAttrModel;
use App\Model\GoodsAttrValueModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class GoodsAttrValController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '属性值管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new GoodsAttrValueModel);

        $grid->column('id', __('Id'));
        $grid->column('attr_id', __('Attr id'));
        $grid->column('title', __('Title'));
        $grid->column('order', __('Order'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(GoodsAttrValueModel::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('attr_id', __('Attr id'));
        $show->field('title', __('Title'));
        $show->field('order', __('Order'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new GoodsAttrValueModel);

        $form->select('attr_id', __('属性名'))->options(GoodsAttrModel::selectOptions());
        $form->text('title', __('属性值'));
        $form->number('order', __('排序'))->default(1);

        return $form;
    }
}
