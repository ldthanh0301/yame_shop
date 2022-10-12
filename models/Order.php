<?php
    if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {        
        header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
        die(  );
    }
?>


<?php
require_once  __DIR__ . "/../connectDB/database.php";
class Order
{
  private $con ;
  public function __construct()
  {
    $this->con = Database::getInstance()->connectDB;
  }
 
  public function getOrders() {
    $query = "SELECT * FROM `dathang`as dh  join `chitietdathang` as cdh join `khachhang` as kh on dh.SoDonDH = cdh.SoDonDH and kh.MSKH = dh.MSKH group by dh.SoDonDH";
    $result = $this->con->query($query)->fetch_all(MYSQLI_ASSOC);
    return $result;
  }

  public function detail($SoDonDH) {
    $query = "SELECT * FROM `dathang`as dh  join `chitietdathang` as cdh join `khachhang` as kh join `diachikh` as dkh JOIN hanghoa as hh on dh.SoDonDH = cdh.SoDonDH and kh.MSKH = dh.MSKH and hh.MSHH = cdh.MSHH and dkh.MSKH = kh.MSKH where dh.SoDonDH = $SoDonDH";
    $result = $this->con->query($query)->fetch_assoc();
    return $result;
  }
  public function detailOrder($SoDonDH) {
    $query = "SELECT * FROM  `chitietdathang` as cdh JOIN hanghoa as hh on hh.MSHH = cdh.MSHH where SoDonDH = $SoDonDH";
    $result = $this->con->query($query)->fetch_all(MYSQLI_ASSOC);
    return $result;
  }
  
  public function insertOrder($MSKH, $TongTien=0, $MaDC=null,$MSNV=null) {
    if ($MSNV==null) {
      $query = "INSERT INTO `dathang`(`MSKH`,`TongTien`,`MaDC`) VALUES ('$MSKH',$TongTien,$MaDC)";
    }else {
      $query = "INSERT INTO `dathang`(`MSKH`,`TongTien`,`MaDC`,`MSNV`) VALUES ('$MSKH', $TongTien,$MaDC,'$MSNV')";
    }
    
    $result = $this->con->query($query);
    if (!$result) {
      return 0;
    }
    $SoDonDH = $this->con->insert_id;
    return $SoDonDH;
  }
  public function insertDetailOrder($SoDH, $MSHH, $quantity,$total,$soDC)
  {
    $query = "INSERT INTO `chitietdathang`(`SoDonDH`,`MSHH`,`SoLuong`,`GiaDatHang`,`MaDC`) VALUES ($SoDH, '$MSHH', $quantity,$total,$soDC)";
    
    $result = $this->con->query($query);
    return $result;
  }
  
  public function update($id,$status) {
      $query = "update `dathang` set `TrangThaiDH` = $status where SoDonDH = $id";
      $result = $this->con->query($query);
      return $result;
  }

  public function delete($id) {
      $query = "delete from `dathang` where SoDonDH = $id";
      $result = $this->con->query($query);
      return $result;
  }
  public function getTypeOrder($type) {
      $query = "SELECT * FROM `dathang`as dh  join `chitietdathang` as cdh join `khachhang` as kh on dh.SoDonDH = cdh.SoDonDH and kh.MSKH = dh.MSKH where TrangThaiDH = $type group by dh.SoDonDH";
      $result = $this->con->query($query)->fetch_all(MYSQLI_ASSOC);
      return $result;
  }
  public function getOrderByCustomer($MSKH) {
    $query = "SELECT * FROM `dathang` WHERE MSKH = '$MSKH'";
    $result = $this->con->query($query)->fetch_all(MYSQLI_ASSOC);
    return $result;
}
  public function countOrders() {
    $query = "SELECT COUNT(*)as counter FROM `dathang`  GROUP BY TrangThaiDH ";
    $result = $this->con->query($query)->fetch_all(MYSQLI_ASSOC);
    $counter = array();
    foreach($result as $count) {
      $counter[] = $count['counter'];
    } 
    if (empty($counter)){
      $counter=[0,0,0,0];
    }
    return $counter;
  }
}
  
?>