<?php

namespace app\v1\controller;

use app\v1\model\Member;
use function Couchbase\defaultDecoder;
use think\Controller;
use think\Request;
use app\v1\model\Goods as GoodsModel;
use app\v1\model\Cart as CartModel;

class Cart extends Controller
{
   //加入购物车
    public function addToCart(){
//        echo "sss";

        //接收加入购物车的信息
        $data['mid'] = input('param.mid');
        $data['gid'] = input('param.gid');
        $data['buynum'] = input('param.buynum');
        $data['add_time'] =time();
        //判断购物车中是否存在商品信息，若存在则更新数量，不存在则插入一条新数据
        if (CartModel::where('mid',$data['mid'])->where('gid',$data['gid'])->find()){
            //更新数据
            if (CartModel::where('mid',$data['mid'])->where('gid',$data['gid'])->setInc('buynum',$data['buynum'])){
                return toJson(0,'加入购物车成功1');
            }else{
                return toJson(40010,'加入购物车失败');
            }
        }else{
            //插入一条新数据
            if (CartModel::insert($data)){
                return toJson(0,'加入购物车成功 2');
            }else{
                return toJson(40010,'加入购物车失败');
            }
        }

    }
    //购物车列表
    public function cartList(){

        $mid = input('param.mid');
        $goods =CartModel::alias('c')
                         ->join('goods g','g.id=c.gid')
                         ->where('mid',$mid)
                         ->field('c.id,c.buynum,c.active,goodsname,price,image')
                         ->select();
        return toJson(0,'ok',200,$goods);
    }
}
