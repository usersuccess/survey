<?php
/**
 * Created by PhpStorm.
 * User: 吕明翰
 * Date: 2017/8/28
 * Time: 19:22
 */
namespace app\back\controller;
use think\Controller;
use think\Db;
use think\Session;
use app\back\model\Form;
use app\back\model\Content;
use app\back\model\Teacher;
class Evaluate extends Controller{
    public function index(){
        $data = Content::select();
        $teacher = Teacher::select();
        $class = Db::name('class')->select();
        $this->assign('teacher',$teacher);
        $this->assign('class',$class);
        $this->assign('data',$data);
        return view();
    }
    public function save(){
        $form = new Form;
        $data['class_id'] = input('post.class');
        $data['content'] = input('post.content/a');
        if(Form::where(['class_id'=>$data['class_id']])->find()){
            $this->error('所选班级已有评测表');
        }elseif($form->validate(true)->save($data)){
            $this->success('保存成功!','Evaluate/index');
        }else{
            $this->error($form->getError());
        }
    }
    public function show(){
        $class = input('post.class');
        $class_name = Db::name('class')->where('id',$class)->find();
        $form = Form::where(['class_id'=>$class])->find();
        if($form){
            $content = json_decode($form->content);
            $content_str = join(',',$content);
            $content_arr = Content::where('id','in',$content_str)->select();
            $this->assign('content',$content_arr);
            $this->assign('class',$class_name);
            return view();
        }else{
            echo "<script>alert('此班级无评测表');location.href='index'</script>";
        }

    }
    public function delete($id){
        Form::destroy(['class_id'=>$id]);
        $this->success('删除成功!','evaluate/index');
    }
    public function start($id){
        $status =Db::name('class')->where('id',$id)->value('status');
        if($status){
            $this->error('评测已开启','index');
        }else{
            $start = Db::name('class')->where('id',$id)->update(['status'=>1]);
            if($start){
                $this->success('评测开启成功','index');
            }else{
                $this->error('开启失败');
            }
        }
    }
    public function end($id){
        $status =Db::name('class')->where('id',$id)->value('status');
        if($status == 0){
            $this->error('评测已关闭','index');
        }else{
            $start = Db::name('class')->where('id',$id)->update(['status'=>0]);
            if($start){
                $this->success('评测关闭成功','index');
            }else{
                $this->error('关闭失败');
            }
        }
    }
    public function add(){
        return view();
    }
    public function add_post(){
        $ct = new Content;
        $content = input('post.content');
        if($ct->save(['content'=>$content])){
            $this->success('添加成功!','Evaluate/index');
        }else{
            $this->error('添加失败!');
        }
    }
    public function edit($id){
        $content = Content::where('id',$id)->find();
        $this->assign('data',$content);
        return view();
    }
    public function edit_post($id){
        $content = input('post.content');
        Content::where('id',$id)->update(['content'=>$content]);
        $this->success('修改成功!','Evaluate/index');
    }
    public function del($id){
        $content = Content::get($id);
        if($content){
            DB::execute("truncate table mark");
            DB::execute("truncate table form");
            DB::execute("update class set status = 0 ");
            $content->delete();
            $this->success('删除成功!','evaluate/index');
        }else{
            $this->error('删除的数据不存在');
        }
    }
    public function data(){
        $class = DB::name('class')->select();//班级
        $data[] = '';
        //  $teachers = DB::name('teacher')->value('id');
        foreach ($class as $key=>$v){//循环班级
            if(!(DB::name('teacher')->where('class_id',$v['id'])->find())){//如果没有老师，就把该数组列为空
                unset($class[$key]);
            }else {
                $teacher = DB::name('teacher')->where('class_id', $v['id'])->select();//查询每一个班级的老师
                $arr = array();
                foreach ($teacher as $t) {
                    $arr[$t['id']] = $t['teacher_name'];//空数组存放$arr[]指向班级老师的名字

                    /* if($t['teacher_name']==''){
                         $t['teacher_name']='还未安排老师';
                     }*/
                    $data[$v['id']] = $arr;
                }
            }
        }
        $this->assign('data',$data);
        //   $this->assign('teacher',$teachers);
        $this->assign('class',$class);
        return view();
    }
    public function data_show($id){
        $c_id = $id;
        $t_id = input('post.teacher');
        Session::set('c_id',$c_id);
        Session::set('t_id',$t_id);
        $form = DB::name('form')->where('class_id',$c_id)->find();
        if($form['content']==''){
            $this->error('无评测项目','evaluate/index');
        }
        $content = json_decode($form['content']);
        if(!isset($form['id'])){
            $this->error('无评测项目','evaluate/index');
        }
        $mark = DB::name('mark')->where(['form_id'=>$form['id'],'teacher_id'=>$t_id])->select();
        $record[]='';
        foreach ($mark as $m){
            $n = 0;
            foreach ($content as $c){
                if(!isset($record[$c])){
                    $record[$c] = '';
                }
                $record[$c] = $record[$c].",".substr($m['status'],$n,1);
                $n = $n+1;
            }
        }
        unset($record[0]);
        $content_name = DB::name('content')->select();
        foreach ($content_name as $a){
            $arr[$a['id']] = $a['content'];
        }
        $this->assign('record',$record);
        $this->assign('content',$arr);
        return view();
    }
    public function read(){
        $c_id = Session::get('c_id');
        $t_id = Session::get('t_id');
        $form = DB::name('form')->where('class_id',$c_id)->find();
        $mark = DB::name('mark')->where(['form_id'=>$form['id'],'teacher_id'=>$t_id])->select();
        $this->assign('mark',$mark);
        return view();
    }

}