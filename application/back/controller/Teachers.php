<?php
/**
 * Created by PhpStorm.
 * User: 547
 * Date: 2017/8/30
 * Time: 19:52
 */
namespace app\back\controller;
use think\Controller;
use think\Db;
use app\back\model\Teacher;

class Teachers extends Controller{
    public function index(){
        $teacher = Teacher::paginate(5);
        //$student=Student::select();
        $this->assign('teacher',$teacher);
        return view();
    }

    public function create(){
        $class=Db::name('class')->select();
        $this->assign('class',$class);
        return view();
    }

    public function save(){
        $teacher=new Teacher();
        $data['teacher_name']=input('post.teacher_name');
        $data['class_id']=input('post.class_id');
        if($teacher->validate(true)->save($data)){
            $this->success('添加成功','teachers/index');
        }else{
            $this->error($teacher->getError());
        }

    }

    public function edit($id){
        $data=Db::name('teacher')->where('id',$id)->find();
        $class=Db::name('class')->select();
        $this->assign('class',$class);
        $this->assign('data',$data);
        return view();
    }

    public function update(){
        $teacher=new Teacher();
        $data['id']=input('post.id');
        $data['teacher_name']=input('post.teacher_name');
        $data['class_id']=input('post.class_id');
        if($teacher->validate(true)->isUpdate(true)->save($data)){
            $this->success('更新成功','teachers/index');
        }else{
            $this->error($teacher->getError());
        }
    }

    public function delete($id){
        $teacher=Teacher::get($id);
        if($teacher){
            if($teacher->delete()){
                $this->success('删除成功！','index');
            }
            $this->error('删除失败！','index');
        }else{
            $this->error('数据不存在！');
        }
    }

    public function select(){
        return view();
    }

    public function select_num(){
        $num=input('post.num');
        if($num){
            $data=student::where('student_num',$num)->find();
            if($data){
                $this->assign('student',$data);
                return view('students/select');
            }else{
                $this->error('该学号不存在','students/select');
            }
        }else{
            $this->error('请输入你所的查询学生的学号','students/select');
        }
    }

    public function select_name(){
        $name=input('post.name');
        if($name){
            $data=student::where('student_name',$name)->find();
            if($data){
                $this->assign('student',$data);
                return view('students/select');
            }else{
                $this->error('该名称不存在','students/select');
            }
        }else{
            $this->error('请输入你所的查询学生的名字','students/select');
        }
    }
}