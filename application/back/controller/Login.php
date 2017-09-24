<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/26
 * Time: 9:51
 * 后台管理员登录
 */
namespace app\back\controller;
use think\Controller;
use think\Db;
use think\Session;
use app\back\model\Admin;
class Login extends Controller{
    public function index(){
        return view();
    }
    public function save(){

            $data['user']=input('post.user');
            $data['pwd']=input('post.pwd');
            $result=$this->validate($data,'Admin.index');
            if($result!==true){
                $this->error($result);
            }else {
                $user = Db::table('admin')->where(['user' => $data['user'],
                    'pwd' =>($data['pwd'])])->find();
                if ($user) {
                        /*$user = $user->toArray();*/
                        Session::set('admin',$user['user']);
                        //$this->success('欢迎您', 'index/index');
                    $this->success('欢迎','index/index');

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
            $this->error('退出成功','login/index');
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