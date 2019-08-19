<?php

namespace App\Http\Controllers;

use App\Model\SkuModel;
use Illuminate\Http\Request;

use App\Model\GoodsModel;
use App\Model\GoodsAttrModel;
use App\Model\GoodsAttrValueModel;

class GoodsController extends Controller
{
    //

    public function detail($goods_id)
    {
        $detail = GoodsModel::find($goods_id)->toArray();
        echo '<pre>';print_r($detail);echo '</pre>';

        //获取属性
        $attr_arr = explode(',',$detail['attr']);
        echo '<pre>';print_r($attr_arr);echo '</pre>';
        foreach($attr_arr as $k=>$v){
            $attr_info = GoodsAttrModel::select('id','title')->find($v)->toArray();
            $attr_value[$attr_info['id']]['attr_name'] = $attr_info['title'];
            $attr_value[$attr_info['id']]['attr_v'] = GoodsAttrValueModel::select('id','title')->where(['attr_id'=>$v])->get()->toArray();
        }
        //echo '<pre>';print_r($attr_value);echo '</pre>';

        $data = [
            'goods_id'  => $goods_id,
            'attr'  => $attr_value,
        ];
        //获取属性值
        return view('goods.detail',$data);
    }

    public function getPrice(Request $request)
    {
        //echo '<pre>';print_r($_GET);echo '</pre>';
        $goods_id = $request->input('id');
        $attr_path = rtrim($request->input('attr_path'),',');

        //echo 'goods_id : '.$goods_id;echo '</br>';
        //echo 'attr_path: '.$attr_path;echo '</br>';

        //获取商品信息
        $info = SkuModel::where(['goods_id'=>$goods_id,'attr_path'=>$attr_path])->first();
        if($info){
            echo json_encode($info->toArray());
        }
        //echo '<pre>';print_r($info);echo '</pre>';
    }
}
