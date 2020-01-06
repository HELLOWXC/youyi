<?php

namespace app\v1\controller;

use app\v1\model\Member;
use function Couchbase\defaultDecoder;
use think\Controller;
use think\Request;
use app\v1\model\Goods as GoodsModel;

class Login extends Controller
{
   //获取用户openid
    public function openid(){
//        echo 'ssss';
        $code = input('param.code');
//        print_r($code);

        $url = 'https://api.weixin.qq.com/sns/jscode2session?appid=wxaa202bacd0470ce6&secret=50851e6515611152f1e30931e641014d&js_code='.$code.'&grant_type=authorization_code';
        $res = $this->curl($url);
        $arr = json_decode($res,true);
//        print_r($arr);
//        exit();
        //判断用户是否存在
        if($member = Member::where('xcx_openid',$arr['openid'])->find()){
            return toJson(0,'用户存在',200,$member);
        }else{
            return toJson(1,'用户不存在',200,$arr);
        }
    }

    //注册会员
    public function register(){
        //接收用户信息
        $data = input('param.');
        $data['add_time'] = time();

//        print_r($data);
        //注册
        if ($id = Member::insertGetId($data)){
            $data['id'] = $id;
            return toJson(0,'ok',200,$data);
        }else{
            return toJson(40020,'error',200);
        }
    }

    //更改用户头像
    public function changeAvatar(){
        $id = input('param.id');
//        echo $id;
        //获取上传头像
        $file = request()->file('file');
        //配置头像大小及类型
        $conf =['size'=>1048576, 'ext'=>'jpg,jpeg,png,gif', ];
        if ($info = $file->validate($conf)->move('upload')){
            $avatar = 'http://www.api.com/'.$info->getPath().'/'.$info->getFilename();
//            echo $avatar;
            //更新数据库
            if ($res =  Member::where('id',$id)->update(['avatar'=>$avatar])){

//                print_r($res);
                return toJson(0,'ok',200,['avatar'=>$avatar]);
            }
             else{
                return toJson(40010,'error',404);
            }
        }else{
            return toJson(40010,'error',404);
        }
    }

    //万能的curl
    public function curl($url,$type='get',$data=''){
        //1.初始化curl
        $curl = curl_init();
        //2.配置curl
        //配置要访问的url地址
        curl_setopt($curl,CURLOPT_URL,$url);
        //配置将请求结果以文档流的方式返回，而不是在页面上直接显示
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);

        //判断是否为post请求
        if($type == 'post'){
            //设置请求访问为post
            curl_setopt($curl,CURLOPT_POST,1);
            curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
        }

        //关闭SSL验证
        curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);


        //3.发送请求,获取请求结果
        $res = curl_exec($curl);

        //4.关闭curl
        curl_close($curl);

        return $res;
    }
}
