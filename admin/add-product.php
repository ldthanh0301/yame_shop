<?php
    require_once './auth/auth.php';

    if (!isset($_SESSION['role']) || $_SESSION['role'] < 2) {
        header("Location: ./404.php");
        die();
    }
?>
<?php
    require_once '../connectDB/database.php';
    require_once '../models/Product.php';
    
    $db = Database::getInstance();
    $con = $db->connectDB;
    //lấy loai hàng hóa
    $result = $con->query('select * from loaihanghoa');
    $categorys =$result->fetch_all(MYSQLI_ASSOC);
 
    // xử lý submit form add product
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $info = $_POST['info'];
        $quantity = $_POST['quantity'];
        $isSuccess = true;
        
        $Product = new Product();
        $MSHH = $Product->insert($name, $info, $price, $quantity, $category);
        
        //file chứa danh sách ảnh upload
        $images = $_FILES['images'];

        if (!$MSHH) {
            $isSuccess = false;
        }else {
            $isSuccess = $Product->uploadImages($MSHH,$images,'../products-img/');
        }

    }
    
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm</title>
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

                <form class="container-fluid" method='post' action="" id="form-add-products" enctype="multipart/form-data">
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
                        <label for="product-name">Têm sản phẩm</label>
                        <input type="text" class="form-control" id="product-name" name="name" placeholder="Nhập tên sản phẩm" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Giá</label>
                        <input type="number" class="form-control" id="price" name="price" placeholder="Nhập giá" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Số lượng sản phẩm</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Nhập số lượng" required>
                    </div>
                    <div class="form-group">
                        <label for="category">Loại sản phẩm</label>

                        <select id="category" name="category" class="form-control custom-select" required >
                            <option selected value="">-- Chọn loại sản phẩm --</option>
                            <?php 

                                foreach ($categorys as $item) {

                                    echo "<option value={$item['MaLoaiHang']}>{$item['TenLoaiHang']}</option>";
                                }
                            ?>
                          
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="info">Mô tả sản phẩm</label>
                        <textarea class="form-control" id="info" name="info" placeholder="Nhập mô tả sản phẩm" required></textarea>
                    </div>
                    
                    <div  class="form-group">
                        <label for="image">Ảnh sản phẩm</label>
                        <input type="file" class="form-control" id="image" name="images[]" multiple required>
                        <div id="review-image" sclass="review-image mt-4">
                            <div class="row">
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
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