
<?php
$dichvu = getListDichvu();
echo '<div id="dichvu_wrap" >';
foreach($dichvu as $row){
    echo '<div class="dichvu">';
        echo '<img src="./img/'.$row['NAMEANH'].'">';
        echo '<span class="mota">';
        echo '<h5>'.$row['MADICHVU'].'</h5>';
        echo '<h4>'.$row['TENDICHVU'].'</h4>';
        echo '<h5>'.$row['MOTA'].'</h5>';
        echo '<h4>'.$row['PRICE'].'<i class="fa-solid fa-dong-sign fa-fw"></i></h4>';
        echo '</span>';
        echo '<i class="fa-solid fa-pen-to-square fa-fw"></i>';
    echo '</div>';
}
echo '</div>';


function getListDichvu(){
    $dichvu=array();
    require_once('./database/connectDatabase.php');
// Thực hiện kết nối đến cơ sở dữ liệu

$connection = new connectDatabase();

// Thực hiện truy vấn (ví dụ)
$query = "SELECT * FROM dichvu "; // Truy vấn SQL của bạn
$result = $connection->executeQuery($query);

// Xử lý kết quả nếu cần
if ($result) {
    // Thực hiện các thao tác với kết quả
    while ($row = $result->fetch_assoc()) {
       $dichvu[]=$row;
    }
} else {
    echo'thất bại';
    return null;
    // Xử lý khi truy vấn thất bại
}
return $dichvu;
}
?>