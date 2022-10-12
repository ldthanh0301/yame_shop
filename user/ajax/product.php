<?php
    session_start();
    if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = (object) array('totalPrice'=>0, 'products'=>[]);
    }
    if (isset($_GET['action'])) {
        require_once('../../models/Product.php');
        $Product = new Product();
        switch ($_GET['action']){
            case "totalPice": {
                break;
            }
        }
    }else {
        echo "Thiếu action";
        die();
    }
?>