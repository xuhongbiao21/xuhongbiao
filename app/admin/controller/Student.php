<?php

namespace app\admin\controller;//定义命名空间autoload会自动引入文件
use houdunwang\core\Controller;//使用这个目录下的类 工具类
use houdunwang\model\Model;//自动找到类的方法
use houdunwang\view\View;//自动找到模版的类
use system\model\Grade;//学生类
use system\model\Material;////自动找到类的方法
use system\model\Stu;//数据库类
use app\admin\controller\Common;

class Student extends Common
{//继承工具类
    /**
     * 显示学生
     */
    public function lists()
    {
        //因为要显示班级信息所以需要关联
        $data = Model::q("SELECT * FROM stu s JOIN grade g ON s.gid=g.gid");
        //调用工具类的方法 跳转和提示
        return View::make()->with(compact('data'));
    }

    /**
     * 添加学生
     * @return $this
     */
    public function store()
    {
//        p($_POST);
        if (IS_POST) {//是否为post提交
            //处理爱好，因为爱好提交过来是一个数组无法直接插入到数据库，把数组变为字符串
            if (isset($_POST['hobby'])) {
                $_POST['hobby'] = implode(',', $_POST['hobby']);
            }
            Stu::save($_POST);//先查询字段在添加
//            p($a);
            //调用工具类的方法 跳转和提示
//            return $this->setRedirect('?s=admin/student/lists')->success('保存成功');
        }
        //获得班级信息
        $gradeData = Grade::get();
        //头像信息
        $materialData = Material::get();
        //调用工具类的方法 跳转和提示
        return View::make()->with(compact('gradeData', 'materialData'));
    }

    /**
     * 修改
     */
    public function update()
    {
        $sid = $_GET['sid'];//当前编辑的id

        if (IS_POST) {//是否为post提交

            //处理爱好，因为爱好提交过来是一个数组无法直接插入到数据库，把数组变为字符串
            if (isset($_POST['hobby'])) {
                $_POST['hobby'] = implode(',', $_POST['hobby']);
            }
            //p($_POST);
            Stu::where("sid={$sid}")->update($_POST);//输入条件自动找到Base（）里面update方法 传入参数
            //返回当前对象到Model 继承了工具类 调用了里面的添加和跳转方法
            return $this->success('修改成功')->setRedirect('?s=admin/student/lists');
        }

        //获取旧数据
        $oldData = Stu::find($sid);
//        p($oldData);
        //处理爱好，因为爱好提交过来是一个数组无法直接插入到数据库，把数组变为字符串
        $oldData['hobby'] = explode(',', $oldData['hobby']);
//		p($oldData);
        //获得班级信息
        $gradeData = Grade::get();
//        p($gradeData);
        //头像信息
        $materialData = Material::get();
//        p($materialData);
        //调用工具类的方法 跳转和提示
        return View::make()->with(compact('oldData', 'gradeData', 'materialData'));

    }


    /**
     * 删除
     */
    public function remove()
    {
        //先判断有没有条件 没有就停止运行 有条件在删除当前这一条
        Stu::where("sid={$_GET['sid']}")->destory();
        //调用工具类的方法 跳转和提示
        return $this->setRedirect('?s=admin/student/lists')->success('删除成功');
    }
}