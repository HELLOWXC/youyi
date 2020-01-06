<?php

namespace app\v1\controller;

use app\v1\model\Cart;
use think\Controller;
use think\Request;
use app\v1\model\Goods as GoodsModel;

class Goods extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //接收传值的信息
        $offset = input('param.offset');
        $limit = input('param.limit');
        $keywords = input('param.keywords');
        $order = explode('-',input('param.order')); //price-asc

        $goods = GoodsModel::where(function($query) use($keywords){
            if($keywords){
                $query->where("goodsname","like","%$keywords%")
                    ->whereOr("keywords","like","%$keywords%");
            }
        })
            ->order($order[0],$order[1])
            ->limit($offset,$limit)
            ->select();
        if (count($goods)>0){
            return toJson(0,'ok',200,$goods);
        }else{
            return tojson(4001,'未查到相关商品信息',404);
        }

    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
//        echo "ddd";
        //接收用户id
        $mid = input('param.mid');
        //查找商品信息
        $goods = GoodsModel::find($id);
        $data['goods'] = $goods;
        //购物车商品总数量
        $cartNum = Cart::where('mid',$mid)->sum('buynum');
        $data['cartNum'] = $cartNum;
        return toJson(0,'ok',200,$data);
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
