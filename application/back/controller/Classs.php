<?php
/**
 * Created by PhpStorm.
 * User: 547
 * Date: 2017/8/31
 * Time: 14:39
 */
namespace app\back\controller;
use think\Controller;
use think\Db;

class Classs extends Controller{
    public function index(){
        $class=Db::name('class')->select();
        $this->assign('class',$class);
        return view();
    }

    public function  create(){
        $data['class_name']=input('post.class_name');
        $data['status']=0;
        if(!empty($data['class_name'])){
            if(Db::name('class')->insert($data)){
                $this->success('操作成功','classs/index');
            }else{
                $this->error('操作失败','classs/index');
            }
        }else{
            echo "<script>alert('班级姓名不能为空！');location.href='index'</script>";
        }
    }

    public function update($id,$status){
        $data['status']=$status;
        if(Db::name('class')->where('id',$id)->update($data)){
            $this->success('操作成功','classs/index');
        }else{
            $this->error('操作失败','classs/index');
        }
    }

    public function delete($id){
        if(Db::name('class')->where('id',$id)->delete()){
            $this->success('删除成功','classs/index');
        }else{
            $this->error('删除失败','classs/index');
        }
    }

}