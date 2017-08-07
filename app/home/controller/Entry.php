<?php

namespace app\home\controller;
use houdunwang\core\Controller;
use houdunwang\view\View;
use houdunwang\model\Model;
use system\model\Stu;
use system\model\Grade;
use system\model\Material;
class Entry extends Controller
{
    public function index()

    {
        //关联表
        $data = Model::q("SELECT * FROM stu s JOIN grade g ON s.gid=g.gid");
//        p($data);
        return View::make()->with(compact('data'));

    }

    public function detailed()
    {
        $sid = $_GET['sid'];
//            p($sid);
        //获取单挑旧数据
        $data = Model::q("SELECT * FROM stu s JOIN grade g ON s.gid=g.gid HAVING sid=" . "{$sid}");
//        p($data);
        return View::make()->with(compact('data'));
    }
}