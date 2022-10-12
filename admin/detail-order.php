<?php
    require_once './auth/auth.php';
?>
<?php
    require_once '../models/Order.php';
    $Order = new Order();
    $orders = $Order->getOrders();
    if(isset($_GET['status'])) {
        $status = $_GET['status'];
        $orders= $Order->getTypeOrder($status);
    }
    $countPending = count($Order->getTypeOrder(0));
    $countApproved = count($Order->getTypeOrder(1));
    $countDelivering = count($Order->getTypeOrder(2));
    $countDelivered = count($Order->getTypeOrder(3));
    require_once '../connectDB/database.php';
    $db = Database::getInstance();
    $con = $db->connectDB;
    //lấy loại hàng hóa
    //check id để lấy thông tin sản phẩm 
    if ($_GET) {
        $id = $_GET['id'];
        $query = "SELECT * FROM `dathang`as dh  join `chitietdathang` as cdh join `khachhang` as kh join `diachikh` as dkh JOIN hanghoa as hh on dh.SoDonDH = cdh.SoDonDH and kh.MSKH = dh.MSKH and hh.MSHH = cdh.MSHH and dkh.MSKH = kh.MSKH where dh.SoDonDH=$id";
        $result = $con->query($query);
        $order  = $result->fetch_assoc();
        $detailOrder  = $Order->detailOrder($id);
    }
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        $isSuccess = true;
        $id = $_POST['id'];
        $status= $_POST['status'];

        $isSuccess = $Order->update($id, $status);
        // 
        // $query = "update `dathang` set `TrangThaiDH` = $status where SoDonDH = $id";
        // $result = $con->query($query);
        // if (!$result) {
        //     $isSuccess =false;
        // }
        // $query = "SELECT * FROM `dathang`as dh  join `chitietdathang` as cdh join `khachhang` as kh join `diachikh` as dkh JOIN hanghoa as hh on dh.SoDonDH = cdh.SoDonDH and kh.MSKH = dh.MSKH and hh.MSHH = cdh.MSHH and dkh.MSKH = kh.MSKH where dh.SoDonDH=$id";
        $order = $Order->detail($id);
        // cập nhật số lượng 
        $countPending = count($Order->getTypeOrder(0));
        $countApproved = count($Order->getTypeOrder(1));
        $countDelivering = count($Order->getTypeOrder(2));
        $countDelivered = count($Order->getTypeOrder(3));
    }
    function getOrder($con, $query) {
        $result = $con->query($query);
        return $result->fetch_assoc();
    }
   
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin đơn hàng</title>
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
                            <a href='./list-orders.php?status=0' class="dashboard-top__info">
                                <div>Chờ duyệt</div>
                                <span style="font-size:1.2rem;color:var(--clr-success)"><?php echo $countPending?></span>
                            </a>
                        </div>
                        <div class="col col-3">
                            <a href='./list-orders.php?status=1' class="dashboard-top__info">
                                <div>Đã duyệt</div>
                                <span style="font-size:1.2rem;color:var(--clr-success)"><?php echo $countApproved?></span>
                            </a>
                        </div>
                        <div class="col col-3">
                            <a href="./list-orders.php?status=2" class="dashboard-top__info">
                                <div>Đang giao</div>
                                <span style="font-size:1.2rem;color:var(--clr-success)"><?php echo $countDelivering?></span>
                            </a>
                        </div>
                        <div class="col col-3">
                            <a href="./list-orders.php?status=2" class="dashboard-top__info">
                                <div>Đã giao</div>
                                <span style="font-size:1.2rem;color:var(--clr-success)"><?php echo $countDelivered?></span>

                            </a>
                        </div>
                    </div>
                </div>
                <?php 
                    if (isset($isSuccess) && !$isSuccess) {
                        echo '<h6 class="notify--danger">Lỗi khi cập nhật trạng thái!!!!</h6>';
                    }
                    if (isset($isSuccess) && $isSuccess) {
                        echo '<h6 class="notify--success">Cập nhật thành công!!!!</h6>';
                    }
                ?>
                <form action="" method="POST" class="container-fluid py-4" style="background-color: white;">
                    <div >
                        <h4> Thông tin đơn hàng</h4>
                        <div>
                            Mã Khách hàng: <?php echo $order['MSKH'] ?>
                        </div>
                        <div>
                            Tên khách hàng: <?php echo $order['HoTenKH'] ?>
                        </div>
                        <div>
                           Số điện thoại: <?php echo $order['SoDienThoai'] ?>
                        </div>
                        <div>
                           Email: <?php echo $order['Email'] ?>
                        </div>
                        <div>
                            Địa chỉ giao hàng: <?php echo $order['DiaChi'] ?>
                        </div>
                        <hr>
                        <div>
                            Giảm giá: <?php echo $order['GiamGia'] ?>
                         </div>
                        <div>
                            Tổng tiền: <?php echo $order['TongTien'] ?>
                         </div>
                         <hr>
                         <div  style="max-width:300px">
                           Trạng thái:
                           <select class="form-control" id="exampleFormControlSelect1" name="status">
                            <option value="0" <?php if($order['TrangThaiDH']== 0) echo 'selected'?>>Chờ duyệt</option>
                            <option value="1" <?php if($order['TrangThaiDH']== 1) echo 'selected'?>>Đã duyệt</option>
                            <option value="2" <?php if($order['TrangThaiDH']== 2) echo 'selected'?>>Đang giao</option>
                            <option value="3" <?php if($order['TrangThaiDH']== 3) echo 'selected'?>>Đã nhận</option>
                          </select>
                         </div>
                    </div>
                    <hr>
                    <div>
                        <span> Danh sách sản phẩm</span>

                        <table class="table no-border">
                            <thead>
                                <th>STT</th>
                                <th>Mã sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th>Thành tiền</th>
                            </thead>
                            <?php 
                                $index = 0;
                                foreach ($detailOrder as $product) {
                                    $index++ ;
                            ?>
                            <tr>
                                <td>1</td>
                                <td><?php echo $product['MSHH']?></td>
                                <td><?php echo $product['TenHH']?></td>
                                <td><?php echo $product['SoLuong']?></td>
                                <td><?php echo $product['Gia']?></td>
                                <td><?php echo $product['GiaDatHang']?></td>
                            </tr>
                            <?php }?>
                        </table>
                        <input type="number" name="id" value="<?php echo $order['SoDonDH']?>" hidden readonly>
                    </div>
                    <hr>
                    <div>
                        <button class="btn btn-danger">Hủy</button>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
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