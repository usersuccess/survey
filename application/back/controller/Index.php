<?php
namespace app\back\controller;
use think\Controller;//把核心文件夹下的controller引用
use think\Db;
use think\Session;
use app\back\model\Admin;
class Index extends Controller
{
   /* public function index()
    {
        return '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_bd568ce7058a1091"></thinkad>';
    }*/
    public function index(){
    return view();
    }
    public function show(){
        return view();
    }
    public function update(){
        $emp=Session::get('admin');
        $pwd=input('post.pwd');
        $result=$this->validate(
            ['pwd'=>$pwd],
            ['pwd'=>'require|min:3'],
            ['pwd.require'=>'密码不为空',
                'pwd.min'=>'密码长度不小于3个字符']
        );
        if($result==1) {
            $res = Db::name('admin')->where('user', $emp)->update(['pwd' => $pwd]);
            if ($res) {
                $this->success('修改成功', 'index/index');
            } else {
                $this->error('修改失败');
            }
        }else{
            $this->error($result);
        }
    }
}
