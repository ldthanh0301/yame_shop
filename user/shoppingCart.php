<?php
    session_start();
?>
<?php 
    $title = "Chi tiết giỏ hàng";
    include_once('./partials/head.php');
?>
<body>
    <?php include_once('./partials/header.php')?>
    <h1 class="shopping-cart-title">Giỏ hàng của bạn</h1>
    <div class="container"  id="result-fetch-cart">
        <div class="row row-justify-evenly">
            <!-- lấy danh sách sản phẩm trong giỏ hàng -->
                  
           
            <div class="container">     
                <div class="product-info">
                    <h3>Thông tin sản phẩm</h3>
                    <div id="cart-list-items">

                    <?php 
                        if(!empty($_SESSION['cart']->products)){
                            $index=0;
                            foreach($_SESSION['cart']->products as $product){ 
                    ?>
                        <div class="product-info__row">
                            
                            <div class="row">
                                <div class="col-1">
                                    <button type="button" onclick="handleRemoveProductFromCart(<?php echo $index?>)" class="btn btn-danger" style="border-radius: 8px;">
                                        <i style="font-size: 1.5rem;color: white;" class="far fa-times-circle"></i>
                                    </button>
                                </div>
                                <div class="col-2">
                                    <img style='width:100px' src="../products-img/<?php echo $product['images'][0]['TenHinh']?>" alt="Ảnh review">
                                </div>    
                                <div class="col-5">
                                    <div>
                                        <span>Mã sản phẩm:</span>
                                        <input style="width: 100px;" type='text' value="<?php echo $product["MSHH"]?>" name="MSHH" readonly/>
                                    </div>
                                    <span><?php echo $product["name"]?></span>
                                    
                                    <div class="div">
                                        <span>Số lượng còn lại:</span>
                                        <span><?php echo $product['totalQuantity']?></span>
                                        <span>cái</span>
                                    </div>
                                    <div>
                                        <span>Giá sản phẩm</span>
                                        <span><?php echo $product['price']?></span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="product-info__quantity">
                                        <div class="row">
                                            <div class="col-6">
                                                <h6>Số lượng sản phẩm</h6>
                                                    <input class="form-control" name='quantity' data-index="<?php echo $index ?>" data-price="<?php echo $product['price']?>" onchange='handleChangeQuantity(this)' type="number" value='<?php echo $product['quantity']?>'  min='1' max="<?php echo $product['totalQuantity'] ?>">
                                            </div>
                                            <div class="col-6">
                                                <h6>Thành tiền</h6>
                                                <span class="js-price"><?php echo number_format($product['price'])?></span>
                                                <span>Đ</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    
                    <?php 
                            $index++;
                        } // Close tag php
                    }
                    ?>
                    </div>
                    <hr>
                    <div class="product-info_total">
                        <span>Tổng tiền:</span>
                        <div>
                            <span class="js-total-price">
                            <?php 
                                $carts = $_SESSION['cart'];
                                echo number_format($carts->totalPrice)
                            ?>
                            </span>
                            <span>Đ</span>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <hr>
        <a href="./order.php?action=cart" class="btn btn-danger btn-lg float-right">Đặt hàng </a>     
        <div class="clearfix mb-4"></div>     
    </div>
    <!-- script -->
    <?php include_once('./partials/scriptLink.php')?>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="./assets/js/order.js"></script>
    <script type="text/javascript">
        function handleRemoveProductFromCart(index) {
            // xóa sản phẩm
            $.get("./ajax/cart.php",{action:'remove',index:index},function(carts) {
                let root= $('#table_list_items');
                
                carts = JSON.parse(carts);
                // chỉ lại giỏi hàng TRên header 
                showCartInHeader(carts.products)
                // hiển thị giỏi hàng chính
                displayCarts(carts.products,root);
            })
        }
        function calTotalPrice(e){
            let index = e.dataset.index;
            let quantity = parseInt(e.value);
            $.get('./ajax/cart.php',{action:'update',index:index,quantity:quantity},function(carts) {
                let root= $('#table_list_item');
                carts = JSON.parse(carts);
                displayCarts(carts.products,root);
            })
        }

    </script>
</body>
</html>