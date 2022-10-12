<?php
    session_start();
    if (!isset($_SESSION['MSKH'])) {
        header("Location: ./404.php");
        die();
    }
?>
<?php
    require_once '../models/Customer.php';
    $Customer = new Customer();
    $id = $_SESSION['MSKH'];
    $customer = $Customer->detail($id);
    $addresses = $Customer->getAddresses($id);
    if($_SERVER['REQUEST_METHOD'] ==="POST") {
        $fullname = $_POST['fullname'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $phoneNumber = $_POST['phone-number'];

        $isSuccess = $Customer->update($id, $fullname,$address ,$phoneNumber,$email);

        $customer = $Customer->detail($id);
    }
?>




<?php 
    $title = "Chi chỉnh sửa thông tin cá nhân";
    include_once('./partials/head.php');
?>

<body>
    <div class="app">
        <!-- header -->
        <?php include('./partials/header.php'); ?>

        <div id="main">
            <div>
                <form class="container" method='post' action="" id="form-edit-customer" enctype="multipart/form-data">
                    <legend class="form__title">Chỉnh sửa thông tin cá nhân</legend>
                    <?php 
                        if (isset($isSuccess) && !$isSuccess) {
                            echo '<h6 class="notify--danger">Lỗi khi cập nhật!!!!</h6>';
                        }
                        if (isset($isSuccess) && $isSuccess) {
                            echo '<h6 class="notify--success">Cập nhật thành công!!!!</h6>';
                        }
                    ?>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="MSNV" name="MSNV" value="<?php echo $customer['MSKH']?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="fullname">Họ và tên</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $customer['HoTenKH']?>" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Địa chỉ </label>
                        <input type="text" class="form-control" id="address" name="address" value="<?php echo $addresses[0]['DiaChi']?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email </label>
                        <input type="text" class="form-control" id="email" name="email" value="<?php echo $customer['Email']?>" required>
                    </div>
                    <div class="form-group">
                        <label for="phone-number">Số điện thoại</label>
                        <input type="number" class="form-control" id="phone-number" name="phone-number" value="<?php echo $customer['SoDienThoai']?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Boostrap Script -->
    <?php include_once('./partials/scriptLink.php')?>

</body>
</html>