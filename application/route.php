<?php
/*use think\Route;//加载类
Route::resource('emp','index/emp');*/
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
/*use think\Route;//加载类
Route::rule('read/[:id]/[:name]',
Route::resource('emp','index/emp');
'index/emp/read');//设置规则,当你用read/的时候直接访问index/emp/read*/
return [
   /* 'emp/index'=>'index/emp/index',
    'emp/create'=>'index/emp/create',
    'emp/:id'=>['index/emp/read',['method'=>'get']],
    'emp/:id'=>['index/emp/update',['method'=>'PUT']],
    'emp/:id'=>['index/emp/delete',['method'=>'DELETE']]*///路由

   '__pattern__' => [
        'name' => '\w+',//全局匹配
    ],
   /* '__res__'=>[
        'emp'=>'index/emp'
    ],*///资源路由加载
    /*'emp/index'=>'index/emp/index',
    'emp/add'=>'index/emp/add',
    'emp/store'=>'index/emp/store',
    'emp/read/:id'=>'index/emp/read',
    'emp/edit/:id'=>'index/emp/edit',
    'emp/delete/:id'=>'index/emp/delete',*/

  /* '[emp]'=>[
        'index'=>'index/emp/index',
        'add'=>'index/emp/add',
        'store'=>'index/emp/store',
        ':id'=>['index/emp/read',['method'=>'get'],['id'=>'\d{1,3}']],//emp/30
        ':name'=>['index/emp/edit',['method'=>'get'],['name'=>'\w+']],
        'delete/:id'=>'index/emp/delete',
    ],*/
//    '[index]'=>[
//      'index'=>'index/index/index',
//        'create'=>'index/index/create',
//        'save'=>['index/index/save',['method'=>'post']],
//        'delete/:id'=>['index/index/delete',['method'=>'DELETE'],['id'=>'\d+']],
//        'edit/:id'=>['index/index/edit',['method'=>'get'],['id'=>'\d+']],
//        'update/:id'=>['index/index/update',['method'=>'PUT'],['id'=>'\d+']]
//    ]
   /* '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],
    'emp/index' =>'index/emp/index',
    'add/:name'=>['index/emp/add',['method'=>'get'],['name'=>'[a-z0-9]{1,5}']],*/
    /*'read/[:id]'=>['index/emp/read',['method'=>'get'],['id'=>'\d{2,4}']],*/
   /* 'read/:id/:data'=>['index/emp/read',['method'=>'get'],['id'=>'\d{2}','data'=>'\w+']],*/
   /* 'emp/index' =>'index/emp/index',
    'read/[:id]$'=>function($id=10){//闭包访问,函数内部在包含一个函数
            return $id;
    }*/
];
