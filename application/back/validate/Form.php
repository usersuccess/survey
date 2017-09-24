<?php
/**
 * Created by PhpStorm.
 * User: 吕明翰
 * Date: 2017/8/29
 * Time: 16:47
 */
namespace app\back\validate;
use think\Validate;
class Form extends Validate{
    protected  $rule=[
        'content'=>'require',
    ];
    protected  $message=[
        'content.require'=>'评测项目不能为空',
    ];
}