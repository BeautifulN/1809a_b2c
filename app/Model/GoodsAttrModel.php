<?php

namespace App\Model;

use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class GoodsAttrModel extends Model
{
    use ModelTree;
    //
    protected $table = 'p_goods_attr';
    protected $primaryKey = 'id';
}
