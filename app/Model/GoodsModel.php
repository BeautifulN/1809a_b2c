<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GoodsModel extends Model
{
    protected $table = 'p_goods';
    protected $primaryKey = 'goods_id';

    public function goodsSku()
    {
        return $this->hasMany('App\Model\SkuModel','goods_id','goods_id');
    }
}
