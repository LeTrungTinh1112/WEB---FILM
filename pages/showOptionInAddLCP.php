<?php 
$ngay=$_POST['ngay'];
$listSC=getListSuatchieu($ngay);
$listLCP=getListLichchieuphim($ngay);
$listPC=getListPhongchieu();
if(isset($_POST['SC'])){
    $MASC=$_POST['SC'];
    
    
    if($MASC == ""){
        if(count($listSC)!=0){
            foreach($listSC as $sc){
                echo "<option value='".$sc["MASC"]."'>".$sc["THOIGIANBATDAU"]."</option>";
            }
        }
        echo"Chưa có";
       
    }else{
    
    }

}else if(isset($_POST['PC'])){
    $MAPC=$_POST['PC'];
    if($MAPC == ""){
        echo '<option>Hien danh sach cac phong chieu o day</option>';
    }
}

function getListSuatchieuvaPhongchieu($listSC,$listPC,$listLCP){
    $list = array();

}
function getListLichchieuphim($ngay){
   
    $list = array();
    require_once('../database/connectDatabase.php');
    $connection = new connectDatabase();

    // Thực hiện truy vấn (ví dụ)
    $query = "SELECT * FROM suatchieu,lichchieuphim WHERE suatchieu.MASC = lichchieuphim.MASC AND NGAY = '$ngay'"; // Truy vấn SQL của bạn
    $result = $connection->executeQuery($query);

    // Xử lý kết quả nếu cần
    if ($result) {
        // Thực hiện các thao tác với kết quả
        while ($row = $result->fetch_assoc()) {
            if ($row === null) {
                return null;
            }
            $list[]=$row;
        }
    } else {
        echo 'thất bại roi kiaaa';
        return null;
        // Xử lý khi truy vấn thất bại
    }
return $list;
}
function getListPhongchieu(){
   
    $list = array();
    require_once('../database/connectDatabase.php');
    $connection = new connectDatabase();

    // Thực hiện truy vấn (ví dụ)
    $query = "SELECT 	* FROM phongchieu"; // Truy vấn SQL của bạn
    $result = $connection->executeQuery($query);

    // Xử lý kết quả nếu cần
    if ($result) {
        // Thực hiện các thao tác với kết quả
        while ($row = $result->fetch_assoc()) {
            if ($row === null) {
                return null;
            }
            $list[]=$row;
        }
    } else {
        echo 'thất bại roi kiaaa';
        return null;
        // Xử lý khi truy vấn thất bại
    }
return $list;
}
function getListSuatchieu($ngay){
   
    $list = array();
    require_once('../database/connectDatabase.php');
    $connection = new connectDatabase();

    // Thực hiện truy vấn (ví dụ)
    $query = "SELECT 	* FROM suatchieu WHERE NGAY = '$ngay'"; // Truy vấn SQL của bạn
    $result = $connection->executeQuery($query);

    // Xử lý kết quả nếu cần
    if ($result) {
        // Thực hiện các thao tác với kết quả
        while ($row = $result->fetch_assoc()) {
            if ($row === null) {
                return null;
            }
            $list[]=$row;
        }
    } else {
        echo 'thất bại roi kiaaa';
        return null;
        // Xử lý khi truy vấn thất bại
    }
return $list;
}
?>