<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<link rel="stylesheet" href="./static/bt3/css/bootstrap.min.css">
<link rel="stylesheet" href="./static/css/animate.css">
<body>
<h1>我是详细信息</h1>
<a href="?s=admin/entry/index">点我进入后台</a>
<div style="width: 1000px;margin: auto" class="animated zoomInRight">
    <table class="table table-hover table-bordered" style="text-align: center">
        <thead>
        <tr>
            <th>编号</th>
            <th>姓名</th>
            <th>性别</th>
            <th>头像</th>
            <th>年龄</th>
            <th>爱好</th>
            <th>班级</th>
        </tr>
        </thead>
        <?php foreach ($data as $v) : ?>
            <tr>
                <td><?php echo $v['sid'] ?></td>
                <td><?php echo $v['sname'] ?></td>
                <td><?php echo $v['sex'] ?></td>
                <td>
                    <img src="<?php echo $v['profile'] ?>" alt="" width="100" height="40">
                </td>
                <td><?php echo $v['birthday'] ?></td>
                <td><?php echo $v['hobby'] ?></td>
                <td><?php echo $v['gname'] ?></td>

            </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>