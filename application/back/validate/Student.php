<?php
/**
 * Created by PhpStorm.
 * User: 547
 * Date: 2017/8/31
 * Time: 9:48
 */
namespace app\back\validate;
use think\Validate;
class Student extends Validate{
    protected  $rule=[
        'student_num|学号'=>'require',
        'student_name|姓名'=>'require',
    ];
    protected  $message=[
        'student_num.require'=>'学号不能为空',
        'student_name.require'=>'姓名不能为空',
    ];

}