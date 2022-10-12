<?php
    ob_start();
    session_start();
    
    require_once '../models/Customer.php';
    $msg ='';

    if ($_SERVER['REQUEST_METHOD'] =='POST' && !empty($_POST['username']) 
        && !empty($_POST['password'])) {
        $username =$_POST['username'] ;
        $password =$_POST['password'] ;
        $password = md5($password);

        $Customer = new Customer();
        $customer = $Customer->login($username, $password);
        //staff != null thì set session
        if ($customer) {                   
            $_SESSION['MSKH'] = $customer['MSKH'];
            $_SESSION['timeout'] = time();
            $_SESSION['username'] = $customer['username'];
            $_SESSION['sess_user'] =  session_id();
            $_SESSION['HoTenKH'] = $customer['HoTenKH'];
           
            header('Location: ./index.php');
        }else {
            $msg = 'Sai tài khoản hoặc mật khẩu';
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../font/fontawesome-5.15.4-web/fontawesome-free-5.15.4-web/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/base.css">
    <style> 
        .app {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f5f9f1;
        }
        .login-form {
            padding: 30px;
            width: 700px;
            border-radius: 30px;
            box-shadow: 1px 1px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        .login-form legend {
            font-size: 28px;
        }
    </style>
</head>
<body>
    <div class="app">
        <form class="login-form" action="" method="post">
            <legend>Đăng nhập</legend>
            <?php echo "<span>$msg</span>"?>
            <div class="form-group">
                <label for="username">Tài khoản</label>
                <input id="username" class="form-control" type="text" name="username" placeholder="Nhập tài khoản">
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input id="password" class="form-control" type="password" name="password" placeholder="Nhập mật khẩu">
            </div>
            <div>
                <button class="btn btn-danger" type="reset">Hủy</button>
                <button class="btn btn-primary" type="submit">Đăng nhập</button>
            </div>
            <hr>
            <div>
                <span>Bạn chưa có tài khoản?</span>
                <a href="./register.php">Đăng ký ngay</a>
            </div>
        </form>
    </div>
    <!-- Boostrap Script -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>