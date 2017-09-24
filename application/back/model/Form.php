<?php
/**
 * Created by PhpStorm.
 * User: 吕明翰
 * Date: 2017/8/28
 * Time: 19:23
 */
namespace app\back\model;
use think\Model;
class Form extends Model{
    public function setContentAttr($value){
        return  json_encode($value);
    }
}