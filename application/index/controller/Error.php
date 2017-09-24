<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/25
 * Time: 14:14
 */
namespace app\index\controller;
use think\Controller;
class Error extends  Controller{
    public function index(){
        $controller=$this->request->controller();//获取当前控制器
        $this->error("{$controller}控制器不存在",'login/index');
    }
    public function _empty($name){//空操作
        //echo"{$name}不存在";
        $this->error("{$name}不存在",'login/index');
    }
}