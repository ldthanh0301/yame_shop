<?php 
    
    if (!isset($_SESSION)) session_start() ;
    if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = (object) array('totalPrice'=>0, 'products'=>[]);
    }
?>
<header id="header">
            <div class="header-wrapper">
                <div class="container">
                    <div class="header-main">
                        <a href="./" class="header-brand">
                            <img class="header-brand__img" src="./assets/img/logo/logo.png" alt="Logo yame">
                        </a>
                        <nav class="navbar">
                            <ul class="navbar__menu">
                                <li class="navbar__menu-item">
                                    <a href="./" class="navbar__menu-item__link">Trang chủ</a>
                                </li>
                                <?php 
                                    require_once('../connectDB/database.php');
                                    $con = Database::getInstance()->connectDB;
                                    $categorys = $con->query('select * from loaihanghoa');
                                    foreach ($categorys as $category) {
                                        echo "
                                        <li class='navbar__menu-item navbar__menu-item--dropdown'>
                                            <a href='./list-products.php?MaLoaiHang=$category[MaLoaiHang]' class='navbar__menu-item__link'>
                                                $category[TenLoaiHang]
                                            </a>
                                        </li>
                                        ";
                                    }
                                ?>
                                <!-- <li class="navbar__menu-item navbar__menu-item--dropdown">
                                    <a href="#" class="navbar__menu-item__link">
                                        Đơn giản
                                        <i class="navbar__menu-item__icon fas fa-chevron-down"></i>
                                    </a>
                                    <ul class="navbar-dropdown">
                                        <li class="navbar-dropdown__item ">
                                            <a href="#" class="navbar-dropdown__item__link">Áo thun</a>
                                        </li>
                                        <li class="navbar-dropdown__item">
                                            <a href="#" class="navbar-dropdown__item__link">Áo thun</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="navbar__menu-item navbar__menu-item--dropdown">
                                    <a href="#" class="navbar__menu-item__link">
                                        thể thao
                                        <i class="navbar__menu-item__icon fas fa-chevron-down"></i>
                                    </a>
                                    <ul class="navbar-dropdown">
                                        <li class="navbar-dropdown__item ">
                                            <a href="#" class="navbar-dropdown__item__link">Áo thun</a>
                                        </li>
                                        <li class="navbar-dropdown__item">
                                            <a href="#" class="navbar-dropdown__item__link">Áo thun</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="navbar__menu-item navbar__menu-item--dropdown">
                                    <a href="#" class="navbar__menu-item__link">
                                        áo thun
                                        <i class="navbar__menu-item__icon fas fa-chevron-down"></i>
                                    </a>
                                    <ul class="navbar-dropdown">
                                        <li class="navbar-dropdown__item">
                                            <a href="#" class="navbar-dropdown__item__link">Áo thun</a>
                                        </li>
                                        <li class="navbar-dropdown__item">
                                            <a href="#" class="navbar-dropdown__item__link">Áo thun</a>
                                        </li>
                                        <li class="navbar-dropdown__item">
                                            <a href="#" class="navbar-dropdown__item__link">Áo thun</a>
                                        </li>
                                        <li class="navbar-dropdown__item">
                                            <a href="#" class="navbar-dropdown__item__link">Áo thun</a>
                                        </li>
                                        <li class="navbar-dropdown__item">
                                            <a href="#" class="navbar-dropdown__item__link">Áo thun</a>
                                        </li>
                                    </ul>
                                </li> -->
                            </ul>
                        </nav>
                        <div class="header-option">
                            <ul class="header-option__list">
                                <li class="header-option__item cart-icon" id="addcart-nav">
                                    <a href="shoppingCart.php" class="header-option__item__link cart-nav-bar">
                                        <i class="header-option__item__icon fas fa-shopping-bag"></i>
                                        <div id="notification-add-cart">
                                            <p>
                                                <?php 
                                                    if (!isset($_SESSION['cart']->products)) 
                                                        echo '0';
                                                    else  
                                                        echo count($_SESSION['cart']->products);
                                                ?></p>
                                        </div>
                                    </a>
                                    <!-- Giỏ hàng -->
                                    <div class="cart">
                                        <ul id="cart-list-product"  class="cart_list">
                                            <?php 
                                                if (count($_SESSION['cart']->products) ==0) {
                                                    echo "<div class=\"cart_item_null\">Giỏ hàng đang trống</div>";
                                                } else {
                                                    $index = 0;
                                                    foreach($_SESSION['cart']->products as $cartItem) {
                                            ?>   
                                                    <li class="cart_item">
                                                        <a href="#" class="cart_link">
                                                            <img src="../products-img/<?php echo $cartItem['images'][0]['TenHinh']?>" class="cart_product_image"/>
                                                            <div class="cart_product">
                                                                <span class="cart_product_name"><?php echo $cartItem['name']?></span>
                                                                <span class="cart_product_price"><?php echo $cartItem['price']?>đ</span>
                                                            </div>
                                                        </a>
                                                        <button onclick="removeProductFromCart('<?php echo $index?>')" class="cart_link_delete">
                                                            <i class="far fa-times-circle"></i>
                                                        </button>
                                                    </li>
                                            <?php   
                                                        $index++;
                                                    }
                                                }
                                            ?>
                                        </ul>
                                        <hr>
                                        <div>
                                            <a href="./shoppingCart.php" class="btn btn-sm btn-danger float-right">Chi tiết giỏ hàng</a>
                                        </div>
                                    </div>
                                    <!-- Giỏ hàng -->
                                </li>
                                <li class="dropdown header-option__item">
                                    <button class="header-option__item__link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="header-option__item__icon far fa-user"></i>
                                        <span><?php if(isset($_SESSION['HoTenKH'])) echo $_SESSION['HoTenKH'];?></span>
                                    </button>
                                    <div class="dropdown-menu" style="transform: translate3d(-30px, 40px, 0px)" aria-labelledby="dropdownMenuButton">
                                        <?php
                                            if(isset($_SESSION['sess_user'])) {
                                                echo '<a class="dropdown-item" href="edit-profile.php">Thông tin tài khoản</a>';
                                                echo "<hr>";
                                                echo '<a class="dropdown-item" href="list-order.php">Danh sách các đơn đặt hàng</a>';
                                                echo "<hr>";
                                                echo "<a class='dropdown-item' href='./logout.php'>Đăng xuất</a>";
                                            } else {
                                                echo "<a class='dropdown-item' href='./login.php'>Đăng nhập</a>";
                                                echo "<a class='dropdown-item' href='./register.php'>Đăng ký</a>";
                                            }
                                        ?>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        