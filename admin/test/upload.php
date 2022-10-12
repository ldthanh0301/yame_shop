<?php
    require '../../database/database.php';
    echo __DIR__;
    $arr = array('a');
    echo !empty($arr);
    // $db = Database::getInstance();
    // $con = $db->connectDB;

    // if ($_SERVER['REQUEST_METHOD']=== 'POST') {
        
    //     $imagesName = $_FILES['image']['name'];
    //     $imagesTmpPath = $_FILES['image']['tmp_name'];
    //     $length = count($imagesName);
    //     $isSuccess = true;

    //     for ($i =0 ;$i<$length; $i++) {
    //         $imageName = $imagesName[$i];
    //         $ext = pathinfo($imageName, PATHINFO_EXTENSION);
    //         $tmpPath = $imagesTmpPath[$i];
    //         $imgID = uniqid('image'); 
            
    //         $imageName = $imgID. '.' . $ext;
    //         $path = 'upload/'.$imageName;
    //         move_uploaded_file($tmpPath,$path);
    //         $query = "INSERT INTO `hinhhanghoa`(`MSHH`, `TenHinh`) VALUES ('3','$imageName')";
    //         $result = $con->query($query);
    //         if (!$result) {
    //             $isSuccess = false;
    //             break;
    //         }
    //     }

    // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="" enctype="multipart/form-data">
        <input type="file" name="image[]" id="" multiple>
        <input type="submit" value="submit">
    </form>
</body>
</html>