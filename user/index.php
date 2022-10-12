<?php 
    require_once '../connectDB/database.php';

    $db = Database::getInstance();
    $con = $db->connectDB;
    //lấy loai hàng hóa
    $result = $con->query('SELECT * FROM `hanghoa`as hh JOIN hinhhanghoa as hhh ON hh.MSHH = hhh.MSHH');
    $products =$result->fetch_all(MYSQLI_ASSOC);
 
?>
<?php 
    $title = "Trang chủ";
    include_once('./partials/head.php') 
?>
<body>
    <div id="app">
        <!-- header -->
        <?php include_once('./partials/header.php')?>
        <!-- main -->
        <main id="main">
            <div class="container-fluid container-fluid--max-width">
                <!-- Begin: Slider -->
                <?php include_once('./partials/slider.php')?>
               <!-- End: Slider-->

                <!-- Begin:Main content -->
                <div class="main-content">
                    <span class=main-content__title>Top sản phẩm bán chạy</span>
                    <span class=main-content__sub-title>Đừng bỏ lỡ hãy mua ngay</span>
                    <!--  List product -->
                    <div class="list-products">
                        <div class="row">
                            <?php foreach($products as $product) { ?>
                            <div class="col-3">
                                <div  class="product-card">
                                    <a href="./detail-product.php?id=<?php echo $product['MSHH']?>">
                                        <img class="product-card__img" src="../products-img/<?php echo $product['TenHinh'] ?>" alt="<?php echo $product['TenHH'] ?>" >
                                    </a>
                                    <div class="product-card__option">
                                        <span class="product-card__price"><?php echo $product['Gia'] ?></span>
                                        <button class="btn btn-sm btn-danger" onclick="addToCart('<?php echo $product['MSHH']?>')" >Thêm vào giỏ</button>
                                    </div>
                                </div>
                            </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
                <hr>
                <!-- deal product -->
                <div class="main-content">
                    <span class=main-content__title>Các chương trình khuyến mãi</span>
                    <span class=main-content__sub-title>Đừng bỏ lỡ các chương trình khuyến mãi Hot tại Yame.vn</span>
                    <div class="list-products-sale">
                        <div class="row">
                            <div class="col-6">
                                <div class="product-sale">
                                    <img src="./assets/img/products-sale/hinh1.jpg" alt="ảnh" class="product-sale__img">
                                    <span class="product-sale__title">FLASH SALE THÁNG 10</span>
                                    <span class="product-sale__info">Time: 11 - 14/10/2021</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="product-sale">
                                    <img src="./assets/img/products-sale/hinh2.jpg" alt="ảnh" class="product-sale__img">
                                    <span class="product-sale__title">FLASH SALE THÁNG 10</span>
                                    <span class="product-sale__info">Time: 11 - 14/10/2021</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <!-- socials activity -->
                <div class="main-content">
                    <a class="main-content__link mb-4" href="#"><i class="fas fa-sync-alt"></i>Xem thêm nhiều tin khác</a>
                    <img  class="main-content__img img-fluid mb-3" src="./assets/img/socials/intagram.jpg" alt="ảnh">
                    <div class="row row-sm mb-2">
                        <div class="col-2 col-sm">
                            <img class="img-fluid" src="./assets/img/products//vuong/hinh4.jpg" alt="ảnh">
                        </div>
                        <div class="col-2 col-sm">
                            <img class="img-fluid" src="./assets/img/products/vuong/hinh8.jpg" alt="ảnh">
                        </div>
                        <div class="col-2 col-sm">
                            <img class="img-fluid" src="./assets/img/products/vuong/hinh3.jpg" alt="ảnh">
                        </div>
                        <div class="col-2 col-sm">
                            <img class="img-fluid" src="./assets/img/products/vuong/hinh4.jpg" alt="ảnh">
                        </div>
                        <div class="col-2 col-sm">
                            <img class="img-fluid" src="./assets/img/products/vuong/hinh5.jpg" alt="ảnh">
                        </div>
                        <div class="col-2 col-sm">
                            <img class="img-fluid" src="./assets/img/products/vuong/hinh6.jpg" alt="ảnh">
                        </div>
                    </div>
                    <div class="row row-sm mb-2">
                        <div class="col-2 col-sm">
                            <img class="img-fluid" src="./assets/img/products//vuong/hinh4.jpg" alt="ảnh">
                        </div>
                        <div class="col-2 col-sm">
                            <img class="img-fluid" src="./assets/img/products/vuong/hinh8.jpg" alt="ảnh">
                        </div>
                        <div class="col-2 col-sm">
                            <img class="img-fluid" src="./assets/img/products/vuong/hinh3.jpg" alt="ảnh">
                        </div>
                        <div class="col-2 col-sm">
                            <img class="img-fluid" src="./assets/img/products/vuong/hinh4.jpg" alt="ảnh">
                        </div>
                        <div class="col-2 col-sm">
                            <img class="img-fluid" src="./assets/img/products/vuong/hinh5.jpg" alt="ảnh">
                        </div>
                        <div class="col-2 col-sm">
                            <img class="img-fluid" src="./assets/img/products/vuong/hinh6.jpg" alt="ảnh">
                        </div>
                    </div>
                </div>
                <!-- End:Main content -->
            </div>
        </main>
        <!-- Footer -->
        <?php include_once('./partials/footer.php')?>
    </div>
    <!-- script -->
    <?php include_once('./partials/scriptLink.php')?>
    <!-- Boostrap Script -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
</body>
</html>