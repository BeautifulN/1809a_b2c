<?php

namespace App\Admin\Controllers;

use App\Model\GoodsAttrValueModel;
use App\Model\GoodsModel;
use App\Model\SkuModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

use App\Model\GoodsAttrModel;

class SkuController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Sku管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SkuModel);

        $grid->column('id', __('Id'));
        $grid->column('goods_id', __('Goods id'));
        $grid->column('goods_sn', __('Goods sn'));
        $grid->column('sku', __('Sku'));
        $grid->column('desc', __('Desc'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('price0', __('Price0'));
        $grid->column('price', __('Price'));
        $grid->column('store', __('Store'));
        $grid->column('is_onsale', __('Is onsale'));

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
        $show = new Show(SkuModel::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('goods_id', __('Goods id'));
        $show->field('goods_sn', __('Goods sn'));
        $show->field('sku', __('Sku'));
        $show->field('desc', __('Desc'));
        $show->field('updated_at', __('Updated at'));
        $show->field('price0', __('Price0'));
        $show->field('price', __('Price'));
        $show->field('store', __('Store'));
        $show->field('is_onsale', __('Is onsale'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new SkuModel);

        $form->text('goods_id', __('Goods id'));
        $form->text('goods_sn', __('Goods sn'));
        $form->text('sku', __('Sku'));
        $form->text('desc', __('Desc'));
        $form->number('price0', __('Price0'));
        $form->number('price', __('Price'));
        $form->number('store', __('Store'));
        //$form->switch('is_onsale', __('Is onsale'));

        return $form;
    }

    public function skuDetail(Content $content,$id)
    {
        $form = new Form(new SkuModel);
        $form->setAction('/admin/sku-detail-update?id='.$id);
        $form->text('goods_id', __('Goods id'))->default($id);
        $form->text('goods_sn', __('商品编号'));

        //获取当前商品属性
        $attr = GoodsModel::find($id)->toArray();
        $attr_arr = explode(',',$attr['attr']);
        $i = 0;
        foreach($attr_arr as $k=>$v)
        {
            $attr_info = GoodsAttrModel::find($v);
            $attr_value = GoodsAttrValueModel::select('id','title')->where(['attr_id'=>$v])->orderBy('order','asc')->get()->toArray();
            $option = [];
            foreach($attr_value as $k1=>$v1){
                $option[$v1['id']] = $v1['title'];
            }
            $form->select('attr'.$i, __($attr_info->title))->options($option);
            //$form->select('attr-'.$v, __($attr_info->title))->options($option);
            $i++;
        }

        $form->text('sku', __('Sku'));
        $form->text('desc', __('Desc'));
        $form->number('price0', __('定价'));
        $form->number('price', __('售价'));
        $form->number('store', __('库存'));
        //$form->switch('is_onsale', __('Is onsale'));

        return $content->body($form);
    }

    public function skuUpdate()
    {
        $attr_path = '';
        for($i=0;$i<3;$i++)
        {
            if(isset($_POST['attr'.$i])){
                $attr_path .= $_POST['attr'.$i] . ',';
                unset($_POST['attr'.$i]);
            }
        }

        $_POST['attr_path'] = rtrim($attr_path,',');
        unset($_POST['_token']);
        //echo '<pre>';print_r($_POST);echo '</pre>';
        SkuModel::insert($_POST);
        admin_toastr('添加成功','success');
        return redirect('/admin/sku-detail/'.$_POST['goods_id']);
    }

}
