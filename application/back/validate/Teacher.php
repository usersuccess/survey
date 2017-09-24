<?php
/**
 * Created by PhpStorm.
 * User: 547
 * Date: 2017/8/31
 * Time: 9:48
 */
namespace app\back\validate;
use think\Validate;
class Teacher extends Validate{
    protected  $rule=[
        'teacher_name|姓名'=>'require',
    ];
    protected  $message=[

        'teacher_name.require'=>'姓名不能为空',
    ];

}