<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/27
 * Time: 20:20
 */
namespace app\index\model;
use think\Db;
use think\Model;
class Mark extends Model
{
    protected function getTeacherIdAttr($c){
        $a=Db::name('teacher')->select();
        foreach ($a as $v){
            $aa[$v['id']]=$v['teacher_name'];
        }
        //$a=['1'=>'吴忠胜','2'=>'肖翔宁'];
        return $aa[$c];
    }
    /*public function getContentAttr($value){
        return  json_decode($value);
    }*/

}