<?php
/**
 * Created by PhpStorm.
 * User: 吕明翰
 * Date: 2017/8/28
 * Time: 19:57
 */
namespace app\back\model;
use think\Db;
use think\Model;
class Teacher extends Model{
    protected function getClassIdAttr($c){
        $a=Db::name('class')->select();
        foreach ($a as $v){
            $aa[$v['id']]=$v['class_name'];
        }
        //$a=['1'=>'php1班','2'=>'php2班'];
        return $aa[$c];
    }
}