<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\GoodsModel;
use App\Model\GoodsModel2;

class TestController extends Controller
{
    public function list1()
    {
        $goods_list1 = DB::table('p_goods')->get()->all();
        $goods_list2 = DB::connection('slave')->table('p_goods')->get()->all();
        echo '<pre>';print_r($goods_list1);echo '</pre>';
        echo '<hr>';
        echo '<pre>';print_r($goods_list2);echo '</pre>';
        echo '<hr>';
        $goods_list3 = GoodsModel::all()->toArray();
        $goods_list4 = GoodsModel2::all()->toArray();
        echo '<pre>';print_r($goods_list3);echo '</pre>';
        echo '<pre>';print_r($goods_list4);echo '</pre>';
    }
}
