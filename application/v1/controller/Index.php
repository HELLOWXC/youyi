<?php
namespace app\v1\controller;

class Index
{
    //获取令牌
    public function getToken()
    {
        $jwt = new \Jwt;
        $payload=['appid'=>input('param.appid'),'appkey'=>input('param.appkey'),'expire_time'=>time()+60];
        return toJson(0,'ok',200,['token'=>$jwt->getToken($payload),'expire_time'=>$payload['expire_time']]);
    }
    //检验令牌是否有效
    public function checkToken(){
        $jwt = new \Jwt;

        if($jwt->verifyToken(input('param.access_token'))){
            return toJson(0,'ok');
        }else{
            return toJson(4010,'token不正确');
        }
    }
}
