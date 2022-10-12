<?php
    require_once "./auth/auth.php";
    require_once '../connectDB/database.php';
?>
<?php
    $db = Database::getInstance();
    $con = $db->connectDB;
    //lấy loai hàng hóa
    $result = $con->query('select * from loaihanghoa');
    $categorys =$result->fetch_all(MYSQLI_ASSOC);
    
    // xóa danh mục sản phẩm 
    if (isset($_GET['action']) && $_GET['action'] ==='delete') { 
        $id = $_GET['id'];
        $result = $con->query("delete from loaihanghoa where MaLoaiHang = $id");
       
        header("Location: ./category.php");
        die();
    }

    // xử lý submit form add product
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $name = $_POST['name'];
        $query = "INSERT INTO `loaihanghoa`(`TenLoaiHang`) VALUES ('{$name}');";
        $isSuccess = true;
        
        $result = $con->query($query);
        // Thêm thành công thì hiển thị lại danh mục
        if ($result) {
            $result = $con->query('select * from loaihanghoa');
            $categorys =$result->fetch_all(MYSQLI_ASSOC);
        }
    }
    
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm danh mục sản phẩm</title>
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
                <?php include('./partitions/dashboard-top.php')?>

                <form class="container" method='post' action="" id="form-add-products">
                    <legend class="form__title">Thêm sản phẩm mới</legend>
                    <?php 
                        if (isset($isSuccess) && !$isSuccess) {
                            echo '<h6 class="notify--danger">Lỗi khi thêm sản phẩm!!!!</h6>';
                        }
                        if (isset($isSuccess) && $isSuccess) {
                            echo '<h6 class="notify--success">Thêm thành công!!!!</h6>';
                        }
                    ?>
                    <div class="form-group">
                        <label for="categorys">Danh sách các danh mục</label>
                        
                        <ul id="categorys" class="categorys">
                            <?php 
                                if (count($categorys) ===0) {
                                    echo '- Danh mục hiện trống';
                                }
                                foreach ($categorys as $item) {
    
                                    echo "<li>{$item['TenLoaiHang']} <a href=?id=$item[MaLoaiHang]&action=delete class='btn btn-sm btn-danger'>x</a></li>";
                                }
                            ?>
                        </ul>
                    </div>
                    
                    <div class="form-group">
                        <label for="category-name">Tên danh mục</label>
                        <input type="text" class="form-control" id="category-name" name="name" placeholder="Nhập tên danh mục" required>
                    </div>
                 
                    
                    <button type="submit" class="btn btn-primary">Thêm danh mục</button>
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