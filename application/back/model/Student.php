<?php
/**
 * Created by PhpStorm.
 * User: 547
 * Date: 2017/8/30
 * Time: 19:43
 */
namespace app\back\model;
use think\Model;
use think\Db;
class Student extends Model{
    protected function getClassIdAttr($c){
        $a=Db::name('class')->select();
        foreach ($a as $v){
            $aa[$v['id']]=$v['class_name'];
        }
        //$a=['1'=>'php1班','2'=>'php2班'];
        return $aa[$c];
    }
}