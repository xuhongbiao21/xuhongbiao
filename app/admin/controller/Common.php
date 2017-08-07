<?php
/**
 * Created by PhpStorm.
 * User: TCKJ
 * Date: 2017/8/2
 * Time: 19:16
 */

namespace app\admin\controller;
use houdunwang\core\Controller;

class Common extends Controller
{
    public function __construct()
    {
        //如果没有登陆
        if(!isset($_SESSION['user'])){
            go('?s=admin/login/lists');
        }
    }

}