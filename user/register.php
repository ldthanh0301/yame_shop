<?php
    ob_start();
    session_start();
    
    require_once '../models/Customer.php';
    
    if($_SERVER['REQUEST_METHOD'] ==="POST") {
        $fullname = $_POST['fullname'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $phoneNumber = $_POST['phone-number'];
        $username  = $_POST['username'];
        $password  = $_POST['password'];
        $passwordConfirm  = $_POST['password-confirm'];
        $msg ='Tạo tài khoản thành công';
        $Customer = new Customer();
        if ($password ===$passwordConfirm) {
            $result = $Customer->register($fullname,$email,$address,$phoneNumber,$username,md5($password));
            if(!$result) {
                $msg= "Lỗi khi tạo tài khoản";
            }
        } else {
            $msg = 'Xác nhận mật khẩu sai';
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
            background-color: #f5f9f1;
        }
        .register-form {
            margin: 15px 0;
            padding: 30px;
            width: 700px;
            border-radius: 30px;
            box-shadow: 1px 1px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        .register-form legend {
            font-size: 28px;
        }
    </style>
</head>
<body>
    <div class="app">
        <form class="register-form" action="" method="post">
            <div class="user-info">
                <h3 >Đăng ký tài khoản</h3>
                <?php
                    if (isset($msg)) {
                        echo "<h6 class='notify--success'>$msg</h6>";
                    }
                ?>
                <div class="form-group">
                    <label for="fullname">Họ và tên:</label>
                    <input id="fullname" class="form-control" type="text" name="fullname">
                </div>
                <div class="form-group">
                    <label for="phone-number">Số điện thoại:</label>
                    <input id="phone-number" class="form-control" type="text" name="phone-number">
                </div>
                <div class="form-group">
                    <label for="address">Địa chỉ giao hàng</label>
                    <input id="address" class="form-control" type="text" name="address">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input id="email" class="form-control" type="text" name="email">
                </div>
                <div class="form-group">
                        <label for="username">Tài khoản</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Nhập tài khoản" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mật khẩu</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Nhập số mật khẩu" required>
                    </div>
                    <div class="form-group">
                        <label for="password-confirm">Xác nhận mật khẩu</label>
                        <input type="password" class="form-control" id="password-confirm" name="password-confirm" placeholder="Nhập xác nhận mật khẩu" required>
                    </div>
                <input type="reset"  class="btn btn-danger" value="Hủy">
                <input type="submit" class="btn btn-primary" value="Đăng ký">
                <hr>
                <div>
                    <span>Bạn đã có tài khoản?</span>
                    <a href="./login.php">Đăng nhập</a>
                </div>
            </div>
        </form>
    </div>
    <!-- Boostrap Script -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>