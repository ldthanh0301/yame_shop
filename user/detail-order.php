<?php
    session_start();
    if (!isset($_SESSION['MSKH'])) {
        header("Location: ./404.php");
        die();
    }
?>
<?php
    require_once '../models/Order.php';
    $Order = new Order();
    if ($_GET) {
        $id = $_GET['id'];
        $order  = $Order->detail($id);
        $detailOrder  = $Order->detailOrder($id);
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
                <div>
                        <h3> Danh sách sản phẩm</h3>
                        <span>
                            Trạng thái đơn hàng: 
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
                        </span>
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
                        <hr>
                        <span>Tổng tiền: <?php echo $order['TongTien']?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Boostrap Script -->
    <?php include_once('./partials/scriptLink.php')?>

</body>
</html>