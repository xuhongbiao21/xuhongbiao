<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<link rel="stylesheet" href="./static/css/animate.css">
<link rel="stylesheet" href="./static/bt3/css/bootstrap.min.css">
<body>
<h1>我是前台</h1>
<a href="?s=admin/entry/index">点我进入后台</a>
<div style="width: 1000px;margin: auto" class="animated bounceIn zoomInRight">
    <table class="table table-hover table-bordered" style="text-align: center">
        <thead>
        <tr>
            <th>编号</th>
            <th>姓名</th>
            <th>性别</th>
            <th>头像</th>
            <th>操作</th>
        </tr>
        </thead>

        <?php foreach ($data as $k => $v) { ?>
            <tr>
                <td><?php echo $v['sid'] ?></td>
                <td><?php echo $v['sname'] ?></td>
                <td><?php echo $v['sex'] ?></td>
                <td>
                    <img src="<?php echo $v['profile'] ?>" alt="" width="50">
                </td>
                <td>
                    <a href="?s=home/entry/detailed&sid=<?php echo $v['sid'] ?>">进一步了解</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>
<div style="position: fixed;top:50px; right:100px">
<a href="">有账号去登录</a>
    <br>
<a href="?s=home/login/register">没账号去注册</a>
</div>
</body>
</html>