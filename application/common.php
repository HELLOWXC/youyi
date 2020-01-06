<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件


function toJson($code,$message='',$httpCode=200,$data=[]){
    $jsonData['code'] = $code;
    if($message){
        $jsonData['message'] = $message;
    }

    if($data){
        $jsonData['data'] = $data;
    }

    return json($jsonData,$httpCode);

}