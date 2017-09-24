<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/25
 * Time: 9:22
 */
namespace app\index\controller;
use think\Controller;
use think\Db;
use app\index\model\Admin;
use think\Session;
use think\captcha\Captcha;
use think\File;

class Login extends Controller{
    public function index(){
        return view();
    }
    public function save(){
        $data['student_num']=input('post.student_num');
        $data['pwd']=input('post.pwd');
        $result=$this->validate($data,'Admin.index');
        if($result!==true){
            $this->error($result);
        }else {
            $user = Db::table('student')->where(['student_num' => $data['student_num'],
                'pwd' => ($data['pwd'])])->find();
            if ($user) {
                /*$user = $user->toArray();*/
                $status =Db::name('class')->where('id',$user['class_id'])->value('status');
                if($status == 0 ){
                    $this->error('没有可用的评测');
                }else{
                    Session::set('name', $user['student_name']);
                    Session::set('emp',$user['student_num']);//把学号保存在session
                    Session::set('class',$user['class_id']);
                    $this->success('欢迎您', 'index/index');
                }
            } else {
                $this->error('用户名或者密码错误');
            }
        }
    }
    public function logout(){
        if(Session::has('name')){
            Session::delete('name');
            Session::clear();
            $this->success('退出成功!','login/index');
        }else{
            $this->error('login/index');
        }
    }
    public function _empty($name){//空操作
        //echo"{$name}不存在";
        $this->error("{$name}不存在",'login/index');
    }
    public function show(){
        return view();
    }


}