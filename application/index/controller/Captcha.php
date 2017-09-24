<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/25
 * Time: 14:40
 */
namespace app\index\controller;
use think\Controller;
class Captcha extends Controller{
    //验证码表单
    public function index(){
        return $this->fetch();
    }
    public function check($code='')
    {
        $captcha = new \think\captcha\Captcha();
        if (!$captcha->check($code)) {
            $this->error('验证码错误');
        } else {
            $this->success('验证码正确');
        }
    }
}