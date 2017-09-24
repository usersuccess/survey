<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/27
 * Time: 22:48
 */
namespace app\index\validate;
use think\Validate;
class Mark extends Validate{
    protected $rule = [
        ['description', 'require|min:5|max:200', '建议必须填写|建议不能短于5个字符|建议不超过两百个字符'],
        ['others', 'require|min:5|max:200', '建议必须填写|建议不能短于5个字符|建议不超过两百个字符'],
    ];
}