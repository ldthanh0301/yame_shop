<?php
    print_r($_POST);
    if ($_SERVER['REQUEST_METHOD'] =='POST' && $_POST['deleteId']) {
        require_once '../connectDB/database.php';
    
        $db = Database::getInstance();
    
        $con = $db->connectDB;
        $MSHH = $_POST['deleteId'];
        $query = "Delete from hanghoa where MSHH = $MSHH ";
        echo 'vào rồi';
        
       
        $con->query($query);
        if ($con) {
            header("Location: ./list-products.php");
            die();
        }
    }
