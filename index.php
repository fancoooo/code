<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="font/css/all.css">
    <link rel="stylesheet" href="css/login.css">
    <script src="script/jquerynew.js"></script>
    <script src="script/jquery.js"></script>
    
    <title>Document</title>
</head>
<body>
<?php
    if(isset($_SESSION['user'])){
        header('Location: public/'.$_SESSION['user'].'.php');
    }
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
            <h2 class="text-white text-center">ĐĂNG NHẬP HỆ THỐNG</h2>
            <form class="form-group">
                <h4 class="text-center"><i class="fa fa-user user"></i></h4>
                <div class="control">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Username" autofocus require>
                    <i class="fa fa-envelope-open-text"></i>
                </div>
                <div class="control">
                    <input type="password" class="form-control" name="pass" id="pass" placeholder="PassWord" require>
                    <i class="fa fa-lock"></i>
                </div>
                <center><input type="button" class="btn btn-dark" name="login" value="Đăng Nhập"></center>
            </form>
        </div>
    </div>
</div>
<script src="script/login.js"></script>
</body>
</html>