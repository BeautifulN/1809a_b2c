<?php

namespace App\Admin\Actions\GoodsController;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class Sku extends RowAction
{
    public $name = 'sku管理';

//    public function handle(Model $model)
//    {
//        // $model ...
//        //return $this->response()->success('Success message.')->refresh();
//    }

    public function href()
    {
        //echo $id;
        //echo $this->getKey();die;
        $key = $this->getKey();
        return '/admin/sku-detail/'.$key;
    }

}
