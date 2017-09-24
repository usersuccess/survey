<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/25
 * Time: 9:48
 */
namespace app\index\validate;
use think\Validate;
class Admin extends Validate{
    protected  $rule=[
        'student_num'=>'require',
        'pwd'=>'require'
    ];
    protected  $message=[
        'student_num.require'=>'用户名不能为空',
        'pwd.require'=>'密码不能为空'
    ];
    public $scene=[
        'index'=>['student_num','pwd']
    ];

}