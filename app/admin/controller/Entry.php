<?php
//定义命名空间autoload会自动引入文件
namespace app\admin\controller;
//使用这个目录下的类
use houdunwang\core\Controller;
//使用这个目录下的类 模版类
use houdunwang\view\View;
use app\admin\controller\Common;
class Entry extends Common
{
    public function index()//后台主页面
    {
        return View::make();//调出模版

    }

}