<?php

namespace App\Model;

use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class GoodsAttrValueModel extends Model
{
    //use ModelTree;
    protected $table = 'p_goods_attr_value';
    protected $primaryKey = 'id';
}
