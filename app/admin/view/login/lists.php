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

<div style="width: 600px;margin: auto" class="animated bounceIn flip">
    <h1 style="text-align: center">后台登录</h1>
    <form action="" method="post" role="form">
        <div class="form-group">
            用户名:<input type="text" class="form-control" name="username" id="" required>
            密码:<input type="password" class="form-control" name="password" id=""  required>
            验证码:<input type="text" class="form-control" name="captcha" id=""  required>
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="" id="" name="click">
                </label>
                七天免登陆：
            </div>
            <br>
            <img src="<?php echo '?s=admin/login/captcha'?>" alt="" onclick="this.src=this.src+'&mt=' + Math.random()">
        </div>
        <button type="submit" class="btn btn-primary">登录</button>
    </form>
</div>
</body>
</html>