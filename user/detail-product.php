<?php 
    session_start();

    if($_GET['id']) {
        require_once '../models/Product.php';
        $id = $_GET['id'];
        $Product = new Product();
        $product =$Product->detail($id);
        $images = $Product->getImages($id);
    }
?>
<?php 
    $title = "Chi tiết sản phẩm";
    include_once('./partials/head.php');
?>
<body>
    <div id="app">
        <!-- header -->
        <?php include_once('./partials/header.php')?>
        <!-- main -->
        <main id="main">
        <div class="container">
                <div class="row">
                    <div class="col-6">
                        <div class="product-review">
                            <img class="img-fluid" src="../products-img/<?php echo $images[0]['TenHinh']?>" alt="Ảnh review">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="product-info">
                            <h1 class="product-info__title"><?php echo $product['TenHH']?></h1>
                            <hr>
                            <div class="product-info__price">
                                <h6>Giá sản phẩm</h6>
                                <span><?php echo $product['Gia']?></span>
                                <span>Đ</span>
                            </div>
                            <hr>
                            <div class="product-info__quantity">
                                <h6>Số lượng còn lại</h6>
                                <span><?php echo $product['SoLuongHang']?></span>
                                <span>cái</span>
                            </div>
                            <hr>
                            <div class="product-info__desription">
                                <h6>Mô tả sản phẩm</h6>
                                <?php echo $product['MoTa']?>
                            </div>
                            <hr>
                            <div class="product-info__control">
                                <button class="btn btn-secondary add-cart" onclick="addToCart('<?php echo $product['MSHH']?>')">Thêm vào giỏ</button>
                                <button onclick="confirmOrder('<?php echo $product['MSHH']?>')" class="btn btn-primary">Mua ngay</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" style='z-index:100000' id="confirmOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                        <!-- form xóa xác nhận xóa sản phẩm -->
                        <form action="" method="POST" id="formConfirm" class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Đặt hàng</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                                <div class="modal-body">
                                   Tạo tài khoảng để  thuận tiện hơn cho viêc mua hàng.
                                </div>
                                <div class="modal-footer" style="place-content: space-between;">
                                    <div>
                                        <a href="./register.php" class="btn btn-white">Đăng ký</a>
                                        <a href="./login.php" class="btn btn-success">Đăng nhập</a>
                                    </div>
                                    <div>
                                        <button class="btn btn-danger" data-dismiss="modal">Hủy</button>
                                        <a href="./order.php?action=item&MSHH=<?php echo $product['MSHH'] ?>"class="btn btn-primary">Mua ngay</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </main>
        <!-- Footer -->
        <?php include_once('./partials/footer.php')?>
    </div>
    <!-- Boostrap Script -->
    <?php include_once('./partials/scriptLink.php')?>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        var formConfirm = document.getElementById('formConfirm');
        function confirmOrder(id) {
            console.log(id);
            $('#confirmOrder').modal({
                show:true
            })
            formConfirm.onsubmit = function(e) {
                let deleteId = e.target.elements.deleteId;
                deleteId.value = id
            };
        }
    </script>
</body>
</html>