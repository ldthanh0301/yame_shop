<?php
    session_start();
    if (!isset($_SESSION['MSKH'])) {
        header("Location: ./404.php");
        die();
    }
?>
<?php
    require_once '../models/Customer.php';
    require_once '../models/Order.php';
    $Customer = new Customer();
    $Order = new Order();
    $id = $_SESSION['MSKH'];
    $orders = $Order->getOrderByCustomer($id);
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
    $title = "Danh sách đơn đặt hàng";
    include_once('./partials/head.php');
?>

<body>
    <div class="app">
        <!-- header -->
        <?php include('./partials/header.php'); ?>

        <div id="main" class="mx-5">
            <div>
                <h3 class="form__title">Danh sách các đơn hàng</h3>
                <div class="d-flex">
                    <?php foreach($orders as $order) { ?>
                    <div class="card mx-3" style="width: 18rem;">
                        <a href='detail-order.php?id=<?php echo $order['SoDonDH']?>' class="card-header">
                            Mã đơn hàng: <?php echo $order['SoDonDH'] ?>
                        </a>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Ngày đặt hàng:<?php echo $order['NgayDH'] ?></li>
                            <li class="list-group-item">Trạng thái đơn hàng:
                                <?php switch ($order['TrangThaiDH']){
                                        case 0: echo 'Chờ duyệt';
                                            break;
                                        case 1: echo 'Đã duyệt';
                                            break;
                                        case 2: echo 'Đang giao';
                                            break;
                                        case 3: echo 'Đã nhận';
                                            break;
                                        default: 
                                            echo '';
                                    }
                                ?>
                            </li>
                            <li class="list-group-item">
                                <?php echo number_format($order['TongTien']) ?>
                                <span>Đ</span>
                            </li>
                        </ul>
                    </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
    <!-- Boostrap Script -->
    <?php include_once('./partials/scriptLink.php')?>

</body>
</html>