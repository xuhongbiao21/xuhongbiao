<?php
//定义命名空间autoload会自动引入文件
namespace app\admin\controller;
//使用这个目录下的类 工具类
use houdunwang\core\Controller;
//使用这个目录下的类 模版类
use houdunwang\view\View;
//使用这个目录下的类 由于同名
use system\model\Grade as GradeModel;
use app\admin\controller\Common;
class Grade extends Common
{ //继承了 工具类
    /**
     * 班级列表
     */
    public function lists()
    {
        $data = GradeModel::get();//就是查询数据库的数据 为了分配变量
        //返回自己 调出模版
        return View::make()->with(compact('data'));
    }

    /**
     * 添加
     */
    public function store()
    {
        if (IS_POST) {//是否为post提交
            GradeModel::save($_POST);//先查询字段在添加
            //调用工具类的方法 跳转和提示
            return $this->setRedirect('?s=admin/grade/lists')->success('添加成功');
        }
        //返回自己 调出模版
        return View::make();
    }

    /**
     * 编辑
     */
    public function update()
    {
        $gid = $_GET['gid'];//获取编辑的id
        if (IS_POST) {//是否为post提交
            GradeModel::where("gid={$gid}")->update($_POST);//先判断有没有条件 如果有就编辑当前这一条
            //调用工具类的方法 跳转和提示
            return $this->setRedirect('?s=admin/grade/lists')->success('修改成功');

        }
        //获取旧数据
        $oldData = GradeModel::find($gid);
        //返回自己 调出模版 分配变量到html
        return View::make()->with(compact('oldData'));
    }

    /**
     * 删除
     */
    public function remove()
    {
        //先判断有没有条件 没有就停止运行 有条件在删除当前这一条
        GradeModel::where("gid={$_GET['gid']}")->destory();
        //调用工具类的方法 跳转和提示
        return $this->setRedirect('?s=admin/grade/lists')->success('删除成功');
    }
}