<?php
namespace app\index\controller;
use think\Controller;
use think\Session;
use app\index\model\Mark;
use think\Db;
//use think\Request;
/*
 * view()
 * request()
 * input()
 * redirect()
 * */
/*class Index extends  Controller
{


        public function index()
        {
            if(Db::execute("insert into think_data values(null,'hi')")){
                $this->success('添加成功','show');
            }else{
                $this->error('添加失败');
            }
           /* echo $this->request->module()."<br>";
            echo $this->request->controller()."<br>";
            echo $this->request->action()."<br>";*/
            //return array('tom','52');
           //return  $this->fetch();
       /* $request=Request::instance();
        echo $request->url();//获取当前页面请求地址
    }

    public function add(){
        $name=$this->request->param('user');
        if($name=="tom"){
            //$this->redirect('show');
            $this->success('用户名正确','show');
        }else{
            $this->error('用户名错误','index');
        }
        //echo $this->request->param('user');
        //echo input('post.user');//用get方法提交的,post.是一个数组
        //print_r(input('post.'));
    }
    public function show(){
       $data=Db::query("select * from think_data");
        $this->assign('data',$data);
        return $this->fetch();
    }

}*/
class Index extends Controller{
    public function index(){//显示数据
        //Db::query('set names utf8');

         $emp=Session::get('emp');
        if(!$emp)
        {
            $this->success('请先登录','login/index');
        }
        $class_id=Session::get('class');
        $teacher=Db::table('teacher')->where('class_id',$class_id)->select();
        $form = Db::table('form')->where(['class_id'=>$class_id])->find();
        Session::set('form',$form['id']);
        $content = json_decode($form['content']);//json对象解析数组
        $content_str= join(',',$content);//数组合并一个字符串
        $content_arr = Db::table('content')->where('id','in',$content_str)->select();
        $n = 1;
        foreach ($content_arr as $v){
            $arr[$v['id']] = $n;
            $n = $n+1;
        }//给form取出的题号做一个数组指向


        foreach($teacher as $key => $v){
                $res=Db::table('mark')->where(['teacher_id'=>$v['id'],'student_num'=>$emp])->find();
                if($res){
                    unset( $teacher[$key]);//该老师已经评测过了就删除
                }
        }
        if(empty($teacher)){
            $this->error('您已经评测完成','show');
        }

        //dump($teacher);

        $this->assign('arr',$arr);
        $this->assign('content',$content_arr);
        $this->assign('teacher',$teacher);
        return view();
    }
    public function show(){
        $mark=new Mark();
        $emp=Session::get('emp');
        $data=$mark->where('student_num',$emp)->select();

        $this->assign('data',$data);
       return view();
    }
    public function save(){//保存添加的数据
        $mark=new Mark;
        $data['student_num']=Session::get('emp');
       $data['teacher_id']=input('select');
        $data['form_id']=Session::get('form');
        $data['description']=input('description');
        $data['others']=input('others');
      // $content=Db::table('content')->select();//查询多少数据
        $class_id=Session::get('class');
        $form = Db::table('form')->where(['class_id'=>$class_id])->find();
        $arr = '';
        Session::set('form',$form['id']);
        $content = json_decode($form['content']);//json对象解析数组
        foreach($content as $key=>$v)
        {
            $content[$key+1]=$v;
        }
        unset($content[0]);//做一个数组题号指向content序号的数组
       foreach ($content as $key=>$v){
            if(empty(input("post.survey{$v}"))){
                //echo "<script>alert('未选择评价');location.href='index';</script>";
                $this->error("第{$key}题未选择评价");
                die;
            }else{
                $arr .=input("post.survey{$v}");
            }
        }
        $data['status']=$arr;
        if($mark->validate(true)->save($data)) {
            $this->success('完成评测', 'index');
        }else {
            $this->error($mark->getError());
        }

    }
    public function xiugai(){
        return view();
    }

public function update()
{
    $emp = Session::get('emp');
    $pwd = input('post.pwd');
    $result = $this->validate(
        ['pwd' => $pwd],
        ['pwd' => 'require|min:3'],
        ['pwd.require' => '密码不为空',
            'pwd.min' => '密码长度不小于3个字符']
    );
    if ($result == 1) {
        $res = Db::name('student')->where('student_num', $emp)->update(['pwd' => $pwd]);
        if ($res) {
            $this->success('修改成功', 'index/index');
        } else {
            $this->error('修改失败');
        }
    } else {
        $this->error($result);
    }

}

}