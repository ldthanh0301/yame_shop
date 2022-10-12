<?php
    if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {        
        header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
        die(  );
    }
?>

<?php
require_once "../connectDB/database.php";
class Customer
{
  private $con ;
  public function __construct()
  {
    $this->con = Database::getInstance()->connectDB;
  }
 
  public function getCustomers() {
    $query = "SELECT * FROM `KhachHang`";
    $result = $this->con->query($query)->fetch_all(MYSQLI_ASSOC);
    return $result;
  }

  public function detail($id) {
    $query = "SELECT * FROM `KhachHang` where MSKH = '$id'";
    $result = $this->con->query($query)->fetch_assoc();
    return $result; 
  }
  public function getAddresses($id)
  {
    $query = "SELECT * FROM `DiaChiKH` where MSKH = '$id'";
    $result = $this->con->query($query)->fetch_all(MYSQLI_ASSOC);
    return $result; 
  }
  // thêm khách hàng
  public function insert($fullname,$email,$address,$phoneNumber) {
    $id = 'KH' . substr(uniqid(),4,7);
    $query = "INSERT INTO `KhachHang`(`MSKH`,`HoTenKH`, `Email`, `SoDienThoai`) VALUES ('$id','$fullname','$email','$phoneNumber')";
    $result = $this->con->query($query);
    if(!$result) {
      return 0;
    }
    $soDC =$this->insertAddress($id,$address);
    if (!$soDC) {
      return 0;
    }
    return (object)['mskh'=>$id, "soDC"=>$soDC];
  }
  // insert địa chỉ
  function insertAddress($id,$address) {
    $query = "INSERT INTO `diachikh`(`MSKH`,`DiaChi`) VALUES ('$id','$address')";
    $result = $this->con->query($query);
    if(!$result) {
      return 0;
    }
    $soDC = $this->con->insert_id;
    return $soDC;
  }
  // đăng ký
  public function register($fullname,$email,$address,$phoneNumber,$username,$password) {
    $id = 'KH' . substr(uniqid(),4,7);
    $query = "INSERT INTO `KhachHang`(`MSKH`,`HoTenKH`, `Email`, `SoDienThoai`,`username`,`password`) VALUES ('$id','$fullname','$email','$phoneNumber','$username','$password')";
    $result = $this->con->query($query);
    if(!$result) {
      return 0;
    }
    $query = "INSERT INTO `diachikh`(`MSKH`,`DiaChi`) VALUES ('$id','$address')";
    $result = $this->con->query($query);
    if(!$result) {
      return 0;
    }
    return $id;
  }
  // Đăng nhập
  public function login($username,$password) {
    $query = "SELECT `HoTenKH`,`MSKH`,`username`,`Email` FROM `KhachHang` where username = '$username' and password = '$password'";
    $result = $this->con->query($query);
    if (!$result) {
      return null;
    }
    return $result->fetch_assoc(); 
  }

  public function update($id, $fullname, $address,$phoneNumber, $email) {
      $query = "update `KhachHang` set `HoTenKH` = '$fullname', `SoDienThoai` = '$phoneNumber', `Email`= '$email' where MSKH = '$id'";
      $result = $this->con->query($query);
      if (!$result) {
        return 0;
      }
      $query = "update `diachikh` set `DiaChi` = '$address' where MSKH = '$id'";
      $result = $this->con->query($query);
      return $result;
  }

  public function delete($id) {
      $query = "delete from `KhachHang` where MSKH = '$id'";
      $result = $this->con->query($query);
      return $result;
  }
   
}
?>