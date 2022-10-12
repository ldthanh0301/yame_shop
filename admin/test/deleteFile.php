<?php 
    require_once '../../models/Product.php';  
    $Product = new Product();
    $id = 'P6df64d2fb';
    $linkImages = $Product->getImages($id);
    // foreach($linkImages as $link) {

        
    $path = $_SERVER['DOCUMENT_ROOT'].'/yame-shop/image617a0c6134c85.jpg';
    
    // var_dump($path) ;
    $status =unlink('../../products-img/image617a0c6134c85.jpg');
    if(!$status) {
        echo "<script>console.log('Lỗi khi xóa file ảnh')<script/>";
    } 
    // }
?>