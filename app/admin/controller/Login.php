<?php
/**
 * Created by PhpStorm.
 * User: TCKJ
 * Date: 2017/8/2
 * Time: 19:13
 */

namespace app\admin\controller;

use houdunwang\view\View;
use app\admin\controller\Common;
use Gregwar\Captcha\CaptchaBuilder;
use houdunwang\core\Controller;
use system\model\User;
use system\model\Grade;

class Login extends Controller
{
    public function lists()
    {
        if (IS_POST) {
            $post = $_POST;
//            p($_POST);
            //判断验证码
            if (strtolower($_SESSION['captcha']) != $_POST['captcha']) {
                return $this->error('验证码错误');
            }
/////////////////////////////////////////////////////////////////////////////////////
            //判断用户名
            $data = User::where("username='{$post['username']}'")->get();
//            p($data);
//            Array
//            (
//                [0] => Array
//                (
//                    [uid] => 1
//            [username] => admin
//            [password] => admin
//        )
//
//)

            if ($data[0]['username'] != $post['username']) {
                return $this->error('用户名不存在');
            }
/////////////////////////////////////////////////////////////////////////////////////////
//判断密码
//            $data = User::where("username='{$post['username']}'")->get();
            if ( ! password_verify( $post['password'], $data[0]['password'] ) ) {
                return $this->error( '密码错误' );
            }
///////////////////////////////////////////////////////////////////////////////////////////
//判断七天免登录
            if (isset( $post['click'])){
                setcookie(session_name(),session_id(),time()+7*24*3600,'/');
            }else{
                setcookie(session_name(),session_id(),0,'/');
            }


//////////////////////////////////////////////////////////////////////////////////////////////
            //存session
            $a=$_SESSION['user'] = [
                'uid'      => $data[0]['uid'],
                'username' => $data[0]['username'],
            ];


//            foreach ($data as $k => $v) {//遍历数据库 可以多个用户名登录
//               $a= $_SESSION['user'] = [
//                    'uid' => $v['uid'],
//                    'username' => $v['username'],
//
//                ];
//                p($a);
//            }

            return $this->setRedirect('?s=admin/entry/index')->success('登陆成功');
        }
//
        return View::make();


    }

////////////////////////////////////////////////////////////////////////////////////////////////

    public function out()
    {
        session_unset();//删除session变量
        session_destroy();//删除session文件
        return $this->setRedirect('?s=admin/login/lists')->success('退出成功');

    }


/////////////////////////////////////////////////////////////////////////////////////////////
    //验证码

    public function captcha()
    {
        $str = substr(md5(microtime(true)), 0, 3);
        $captcha = new CaptchaBuilder($str);
        $captcha->build();
        header('Content-type: image/jpeg');
        $captcha->output();
        //把验证码存入到session
        //把值存入到session
        $_SESSION['captcha'] = strtolower($captcha->getPhrase());
    }


}