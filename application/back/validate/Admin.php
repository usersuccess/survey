<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/25
 * Time: 9:48
 */
namespace app\back\validate;
use think\Validate;
class Admin extends Validate{
    protected  $rule=[
        'user'=>'require',
        'pwd'=>'require'
    ];
    protected  $message=[
        'user.require'=>'用户名不能为空',
        'pwd.require'=>'密码不能为空'
    ];
    public $scene=[
        'index'=>['user','pwd']
    ];

}
