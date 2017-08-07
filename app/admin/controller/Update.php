<?php
/**
 * Created by PhpStorm.
 * User: TCKJ
 * Date: 2017/8/2
 * Time: 22:39
 */

namespace app\admin\controller;

use houdunwang\view\View;
use system\model\User;
use app\admin\controller\Common;

class Update extends Common
{
    public function update()
    {

        if (IS_POST) {
            $user = User::where("uid=" . $_SESSION['user']['uid'])->get();
//        p($user);
            $post = $_POST;
//        p($_POST);
//原密码判断
            if(!password_verify($post['password'],$user[0]['password'])){
                return $this->error('旧密码错误');
            }
//两次密码判断
            if ($post['newpassword'] != $post['confirm']) {
                return $this->success('两次密码不相同');
            }

//            $data = ['password'=>password_hash($post['newPassword'],PASSWORD_DEFAULT)];
            //重组数组
            $data = ['password'=>password_hash($post['newpassword'],PASSWORD_DEFAULT)];
//            p($data);
            User::where('uid=' . $_SESSION['user']['uid'])->update($data);

            //清除session重新登录
            session_unset();
            session_destroy();
            return $this->setRedirect('?s=admin/login/lists')->success('修改成功');

        }
        return View::make();
    }
}