<?php
echo '
    <div id="theloai_wrap">
        <div class="theloai headertheloai">
            <span>Mã thể loại</span>
            <span>Tên thể loại</span>
            <span>Mô tả thể loại</span>
        </div>
        <div class="theloaicontent">';
$theloai = getListtheloai();
foreach($theloai as $row){
    echo '<div class="theloai">';
    echo '<span name="matheloai">'.$row['MATHELOAI'].'</span>';
    echo '<span name="tentheloai">'.$row['TENTHELOAI'].'</span>';
    echo '<span name="mota">'.$row['MOTA'].'</span>';
    echo '<i class="fa-solid fa-pen-to-square fa-fw"></i>';
    echo '</div>';
} 
echo'</div>
        
        </div>
    </div>

';

function getListtheloai(){
    $theloai=array();
    require_once('./database/connectDatabase.php');
// Thực hiện kết nối đến cơ sở dữ liệu

$connection = new connectDatabase();

// Thực hiện truy vấn (ví dụ)
$query = "SELECT * FROM theloai "; // Truy vấn SQL của bạn
$result = $connection->executeQuery($query);

// Xử lý kết quả nếu cần
if ($result) {
    // Thực hiện các thao tác với kết quả
    while ($row = $result->fetch_assoc()) {
       $theloai[]=$row;
    }
} else {
    echo'thất bại';
    return null;
    // Xử lý khi truy vấn thất bại
}
return $theloai;
}
?>