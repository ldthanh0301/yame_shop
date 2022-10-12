<?php
    require_once './auth/auth.php';
    if (!isset($_SESSION['role']) || $_SESSION['role'] < 3) {
        header("Location: ./404.php");
        die();
    }
?>
<?php
    require_once '../models/Staff.php';
    $Staff = new Staff();
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $staff = $Staff->detail($id);
    }

    if($_SERVER['REQUEST_METHOD'] ==="POST") {
        $fullname = $_POST['fullname'];
        $address = $_POST['address'];
        $position = $_POST['position'];
        $phoneNumber = $_POST['phone-number'];
        $id = $_POST['MSNV'];
        $isSuccess = $Staff->update($id, $fullname, $position, $address ,$phoneNumber);

        $staff = $Staff->detail($id);
    }
    $countShipper = count($Staff->getTypeStaff(0));
    $countCensor = count($Staff->getTypeStaff(1));
    $countManager = count($Staff->getTypeStaff(2));
    $countAdmin = count($Staff->getTypeStaff(3));
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa thông tin nhân viên</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/font/fontawesome-5.15.4-web/fontawesome-free-5.15.4-web/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/admin.css">
</head>
<body>
    <div class="app">
        <!-- header -->
        <?php include('./partitions/header.php'); ?>

        <div id="main">
            <!-- siderbar -->
            <?php include('./partitions/sidebar.php'); ?>
            <div class="dashboard">
                <div class="dashboard-top">
                    <div class="row gx-3">
                        <div class="col col-3">
                            <a href='./list-staffs.php?status=0' class="dashboard-top__info">
                                <div>Giao Hàng</div>
                                <span style="font-size:1.2rem;color:var(--clr-success)"><?php echo $countShipper?></span>
                            </a>
                        </div>
                        <div class="col col-3">
                            <a href='./list-staffs.php?status=1' class="dashboard-top__info">
                                <div>Kiểm duyệt</div>
                                <span style="font-size:1.2rem;color:var(--clr-success)"><?php echo $countCensor?></span>
                            </a>
                        </div>
                        <div class="col col-3">
                            <a href="./list-staffs.php?status=2" class="dashboard-top__info">
                                <div>Quản lý</div>
                                <span style="font-size:1.2rem;color:var(--clr-success)"><?php echo $countManager?></span>
                            </a>
                        </div>
                        <div class="col col-3">
                            <a href="./list-staffs.php?status=2" class="dashboard-top__info">
                                <div>Quản trị</div>
                                <span style="font-size:1.2rem;color:var(--clr-success)"><?php echo $countAdmin?></span>

                            </a>
                        </div>
                    </div>
                </div>
                <form class="container-fluid" method='post' action="" id="form-edit-staff" enctype="multipart/form-data">
                    <legend class="form__title">Chỉnh sửa thông tin nhân viên</legend>
                    <?php 
                        if (isset($isSuccess) && !$isSuccess) {
                            echo '<h6 class="notify--danger">Lỗi khi cập nhật!!!!</h6>';
                        }
                        if (isset($isSuccess) && $isSuccess) {
                            echo '<h6 class="notify--success">Cập nhật thành công!!!!</h6>';
                        }
                    ?>
                    <div class="form-group">
                        <label for="MSNV">Mã số nhân viên</label>
                        <input type="text" class="form-control" id="MSNV" name="MSNV" value="<?php echo $staff['MSNV']?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="fullname">Họ và tên</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $staff['HoTenNV']?>" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Địa chỉ </label>
                        <input type="text" class="form-control" id="address" name="address" value="<?php echo $staff['DiaChi']?>" required>
                    </div>
                    <div class="form-group">
                        <label for="phone-number">Số điện thoại</label>
                        <input type="number" class="form-control" id="phone-number" name="phone-number" value="<?php echo $staff['SoDienThoai']?>" required>
                    </div>
                    <div class="form-group">
                        <label for="position">Chức vụ</label>

                        <select id="position" name="position" class="form-control custom-select" required >
                            <option value="">-- Chọn loại chức vụ--</option>
                            <option value=0 <?php if($staff['ChucVu'] ==0) echo "selected"?>>Giao hàng</option>"
                            <option value=1 <?php if($staff['ChucVu'] ==1) echo "selected"?>>Kiểm duyệt</option>"
                            <option value=2 <?php if($staff['ChucVu'] ==2) echo "selected"?>>Quản lý</option>"
                            <option value=3 <?php if($staff['ChucVu'] ==3) echo "selected"?>>Quản trị</option>"
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Boostrap Script -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="../assets/js/admin.js"></script>               

</body>
</html>