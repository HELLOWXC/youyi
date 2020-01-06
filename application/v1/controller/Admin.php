<?php

namespace app\v1\controller;

use app\v1\model\Goods;
use think\Controller;
use think\Request;
use app\v1\model\Admin as admins;

class Admin extends Controller
{
    /**
     * 显示资源列表
     * get route::get('admin','admin/index')
     * @return \think\Response
     */
    public function index()
    {
        //
//        echo 'index hello';
        //$info = admins::where('id > 1000')->limit(5)->select();
        $info = admins::limit(5)->select();
        if (count($info)>0){
            $data['code'] = 0;  //业务错误码
            $data['message'] = 'ok';  //提示信息
            $data['info'] = $info;
            return json($data);
        }else{
            $data['code'] = 4001;  //业务错误码
            $data['message'] = '查询的信息不存在';  //提示信息
            return json($data,404);
        }


    }

    /**
     * 显示创建资源表单页.
     *get方式 route::get('admin','admin/create')
     * @return \think\Response
     */
    public function create()
    {
        //
        return view();
    }

    /**
     * 保存新建的资源
     * post  route::post('admin','admin')
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
        echo 'hello save';
        print_r(input('param.'));
    }

    /**
     * 显示指定的资源
     *get route::get('admin','admin/:id')
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
//        echo 'hello id';
        $info = Goods::where('id',$id)->find();
//        print_r($info);
        if (count($info)>0){
            $data['code'] = 0;
            $data['message'] = 'ok';
            $data['info'] = $info;
            return json($data);
        }else{
            $data['code'] = 4001;
            $data['message'] = '查找的信息不存在';
            return json($data,404);
        }
    }

    /**
     * 显示编辑资源表单页.
     *get  route::get('admin','admin/:id/edit')
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
        echo 'hello this is edit';
    }

    /**
     * 保存更新的资源
     * put  route::put('admin','admin/:id')
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
        echo "hello this is update";


    }

    /**
     * 删除指定资源
     * delete
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
        echo 'hello this is delete';



    }
}
