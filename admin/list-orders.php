<?php 
    require_once './auth/auth.php';
    
    require_once '../models/Order.php';
    $Order = new Order();
    $orders = $Order->getOrders();
    if(isset($_GET['status'])) {
        $status = $_GET['status'];
        $orders= $Order->getTypeOrder($status);
    }

    // hủy đơn hàng 
    if ($_SERVER["REQUEST_METHOD"] =='POST') {
        $id = $_POST['deleteId'];
        $result = $Order->delete($id);

        if ($result) {
            // $orders = $Order->getTypeOrder(0);
            $countPending = count($Order->getTypeOrder(0));
            $countApproved = count($Order->getTypeOrder(1));
            $countDelivering = count($Order->getTypeOrder(2));
            $countDelivered = count($Order->getTypeOrder(3));
        }
    }
    // $countStatus = $Order->countOrders();
    $countPending = count($Order->getTypeOrder(0));
    $countApproved = count($Order->getTypeOrder(1));
    $countDelivering = count($Order->getTypeOrder(2));
    $countDelivered = count($Order->getTypeOrder(3));
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý đơn hàng</title>
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
                            <a href='?status=0' class="dashboard-top__info">
                                <div>Chờ duyệt</div>
                                <span style="font-size:1.2rem;color:var(--clr-success)"><?php echo $countPending?></span>
                            </a>
                        </div>
                        <div class="col col-3">
                            <a href='?status=1' class="dashboard-top__info">
                                <div>Đã duyệt</div>
                                <span style="font-size:1.2rem;color:var(--clr-success)"><?php echo $countApproved?></span>
                            </a>
                        </div>
                        <div class="col col-3">
                            <a href="?status=2" class="dashboard-top__info">
                                <div>Đang giao</div>
                                <span style="font-size:1.2rem;color:var(--clr-success)"><?php echo $countDelivering?></span>
                            </a>
                        </div>
                        <div class="col col-3">
                            <a href="?status=2" class="dashboard-top__info">
                                <div>Đã giao</div>
                                <span style="font-size:1.2rem;color:var(--clr-success)"><?php echo $countDelivered?></span>

                            </a>
                        </div>
                    </div>
                </div>
                <table class="table no-border">
                    <thead>
                        <th>STT</th>
                        <th>Mã đơn hàng</th>
                        <th>Mã khách hàng</th>
                        <th>Tổng tiền</th>
                        <th>Tùy chọn</th>
                    </thead>
                    <tbody>
                        <?php
                            $i=1;
                            foreach($orders as $order) {
                                echo "<tr>
                                    <td>{$i}</td>
                                    <td>{$order['SoDonDH']}</td>
                                    <td>{$order['HoTenKH']}</td>
                                    <td>{$order['TongTien']}</td>
                                    <td>
                                        <a href='./detail-order.php?id={$order['SoDonDH']}' class='btn btn-primary btn-sm' >Chi tiết đơn hàng</a>
                                        <button onclick=deleteProduct('$order[SoDonDH]') class='btn btn-danger btn-sm'>Hủy</button>
                                    </td>
                                </tr>";
                                $i++;
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
       
  
        <!-- Modal -->
        <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <!-- form xóa xác nhận xóa sản phẩm -->
            <form action="" method="post" id="formConfirmDelete" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xác nhận</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Bạn có chắc muốn xóa sản phẩm này??
                    <input type="text" id="deleteId" name="deleteId" hidden>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-danger">Xác nhận</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- Boostrap Script -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        var formConfirmDelete = document.getElementById('formConfirmDelete');
        var test ;
        function deleteProduct(id) {
            $('#confirmDelete').modal({
                show:true
            })
            formConfirmDelete.onsubmit = function(e) {
                test= e.target;
                let deleteId = e.target.elements.deleteId;
                deleteId.value = id
            };
        }
    </script>
</body>
</html>