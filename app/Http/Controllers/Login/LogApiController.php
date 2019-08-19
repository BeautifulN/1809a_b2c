<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redis;

class LogApiController extends Controller
{
    public function apilog()
    {
        $str = file_get_contents("php://input");
//        echo '密文+base64:'.$str;
        $arr = base64_decode($str);  //base64解开
//        echo '密文'.$arr;
        $pk = openssl_get_publickey('file://'.storage_path('app/key/public.pem'));
        openssl_public_decrypt($arr,$dec_data,$pk);
//        echo '明文:'.$dec_data;
        $post_json = json_decode($dec_data);
//        print_r($post_json);die;
        $nickname = $post_json->nickname;
        $pwd = $post_json->pwd;
        $info = [
            'nickname'   => $nickname,
            'pwd'        => $pwd,
        ];

        $res = DB::table('user1')->where(['nickname'=>$nickname])->first();
        if ($res)
        {
            $token = $this->token($res->id);
            $token_key = 'APPtowtoken:id' .$res->id;
            Redis::set($token_key,$token);
            Redis::expire($token_key,18005);

            $arr = ['error'=>50001,'msg'=>'登录成功','token'=>$token];
            json_encode($arr,JSON_UNESCAPED_UNICODE);
            return $arr;
        }else{
            $arr = ['error'=>50002,'msg'=>'登录失败'];
            json_encode($arr,JSON_UNESCAPED_UNICODE);
            return $arr;

        }
    }

    public function token($id)
    {
        $token = substr(sha1($id . time() . Str::random(15)),5,20);
        return $token;
    }
}
