<?php
    session_start();
    if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = (object) array('totalPrice'=>0, 'products'=>[]);
    }
    if (isset($_GET['action'])) {
        require_once('../../models/Product.php');
        $Product = new Product();
        
        switch ($_GET['action']){
            
            case 'add': {
                if (!isset($_GET['id']) ){
                    echo json_encode(array('status'=>'0','message'=>'Không tồn tài MSHH sản phẩm'));
                    return;
                }

                $id = $_GET['id'];

                $product  = $Product->detail($id);
                $productImages = $Product->getImages($id);
                $images = [];
                
                foreach($productImages as $image) {
                 
                    array_push($images,array('MaHinh'=>$image['MaHinh'],'TenHinh'=>$image['TenHinh']));
                }
                // sản phẩm mới
                $product = array('MSHH'=> $product['MSHH'],'name'=>$product['TenHH'],
                    'price'=>$product['Gia'], 'quantity'=>1,'totalPrice'=>$product['Gia'],
                    'totalQuantity'=>$product['SoLuongHang'],'images'=>$images);
                
                // Tính tổng tiền
                $_SESSION['cart']->totalPrice = $_SESSION['cart']->totalPrice + $product['totalPrice'];
                // Thêm vào cart 
                array_push($_SESSION['cart']->products,$product);

                echo json_encode($_SESSION['cart']);
                return;
            }
            case 'remove': {
                if (!isset($_GET['index']) ){ 
                    echo json_encode(array('status'=>'0','message'=>'Không tồn tài index sản phẩm'));
                    return;
                }
                if(count($_SESSION['cart']->products) ==0) {
                    echo json_encode(array([]));
                    return;
                }

                $index = $_GET['index'];
                // Lấy sản phẩm và trừ tổng lại
                $product = $_SESSION['cart']->products[$index];
                $_SESSION['cart']->totalPrice = $_SESSION['cart']->totalPrice - $product['totalPrice'];
                // Xóa sản phẩm
                array_splice($_SESSION['cart']->products,$index,1); 
               
                echo json_encode($_SESSION['cart']);
                return;
            }
            // cập nhật  số lượng
            case 'update': {

                if(!isset($_GET['quantity'])|| !isset($_GET['index'])) {
                    echo json_encode(array('status'=>'0','message'=>'Không tồn tại index sản phẩm'));
                    return;
                }
                $quantity = $_GET['quantity'];
                $index = $_GET['index'];
                // lấy sản phẩm cũ và trừ tổng
                $product = $_SESSION['cart']->products[$index];
                $_SESSION['cart']->totalPrice = $_SESSION['cart']->totalPrice - $product['totalPrice'];
                // cập nhật lại số lượng và tổng giá
                $_SESSION['cart']->products[$index]['quantity'] = $quantity;
                $unitPrice =  $quantity * $_SESSION['cart']->products[$index]['price'];
                $_SESSION['cart']->products[$index]['totalPrice'] =  $unitPrice;
                // Tính lại tổng mới
                $_SESSION['cart']->totalPrice = $_SESSION['cart']->totalPrice +  $unitPrice;
                
                echo json_encode($_SESSION['cart']);

                return ;
            }
            default: {
                echo json_encode($_SESSION['cart']);
                return;
            }
        }

    };
    
?>