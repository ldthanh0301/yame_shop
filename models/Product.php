<?php
    if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {        
        header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
        die(  );
    }
?>

<?php
require_once __DIR__."/../connectDB/database.php";
class Product
    { 
        private $con ;
        public function __construct()
        {
          $this->con = Database::getInstance()->connectDB;
        }
        public function getProducts() {
            $query = "SELECT * FROM `HangHoa`";
            $result = $this->con->query($query)->fetch_all(MYSQLI_ASSOC);
            return $result;
        }
        public function detail($id) {
            $query = "SELECT * FROM `HangHoa` where MSHH = '$id'";
            $result = $this->con->query($query)->fetch_assoc();
            return $result; 
        }
                
        public function insert($name,$info,$price,$quantity,$category) {
            $id = 'P' . substr(uniqid(),3,9);
            $query = "INSERT INTO `hanghoa`(`MSHH`, `TenHH`, `MoTa`, `Gia`, `SoLuongHang`, `MaLoaiHang`) VALUES ('$id','$name','$info','$price','$quantity','$category')";
            $result = $this->con->query($query);
            if(!$result) {
                return 0;
            }
            return $id;
        }
        public function uploadImages($MSHH,$images,$pathFolder) {
            $imagesName = $images['name'];
            $imagesTmpPath = $images['tmp_name'];
            $length = count($imagesName);
            $isSuccess = true;

            for ($i =0 ;$i<$length; $i++) {
                $imageName = $imagesName[$i];
                $ext = pathinfo($imageName, PATHINFO_EXTENSION);
                $tmpPath = $imagesTmpPath[$i];
                $imgID = uniqid('image'); 
                
                $imageName = $imgID. '.' . $ext;
                $query = "INSERT INTO `hinhhanghoa`(`MSHH`, `TenHinh`) VALUES ('$MSHH','$imageName')";
                $result = $this->con->query($query); 
                if (!$result) {
                    $isSuccess = false;
                    break;
                }
                $path = $pathFolder.$imageName;
                move_uploaded_file($tmpPath,$path);
            }

            return $isSuccess;
        }
        public function getImages($id) {
            $query = "select * from hinhhanghoa where hinhhanghoa.MSHH ='{$id}'";
            $result = $this->con->query($query);
            if(!$result) {
                return 0;
            }
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        public function getImagesAll() {
            $query = "select * from hinhhanghoa";
            $result = $this->con->query($query);
            if(!$result) {
                return 0;
            }
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        public function deleteImages($id) {
            $status= true;
            $linkImages = $this->getImages($id);
            $query = "delete from `hinhhanghoa` where MSHH = '$id'";
            $result = $this->con->query($query);
            if (!$status) {
                return 0;
            }
            foreach ($linkImages as $link) {
                $path = __DIR__.'/../products-img/'.$link['TenHinh'];
                if(!unlink($path)) {
                    $status = false;
                    break;
                } 
            }
            return $result;
        }
        public function update($id,$name,$info,$price,$quantity,$category) {
            $query = "UPDATE `hanghoa` SET `TenHH`='$name',`MoTa`='$info',`Gia`='$price',`SoLuongHang`='$quantity',`MaLoaiHang`='$category' WHERE MSHH = '$id'";
            $result = $this->con->query($query);
            return $result;
        }

        public function delete($id) {
            $result = $this->deleteImages($id);
            if (!$result) {
                return 0;
            }
            $query = "delete from `hanghoa` where MSHH = '$id'";
            $result = $this->con->query($query);
            return $result;
        }
        public function getTypeProduct($type) {
            $query = "SELECT * FROM `hanghoa`where MaLoaiHang = $type";
            $result = $this->con->query($query)->fetch_all(MYSQLI_ASSOC);
            return $result;
        }
    }
?>