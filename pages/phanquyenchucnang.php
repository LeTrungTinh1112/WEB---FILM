<?php
require_once('../database/connectDatabase.php');
$conn = new connectDatabase();
$jsonData = file_get_contents('php://input');
$dataArray = json_decode($jsonData, true);
print_r($dataArray);
if(!empty($dataArray)){
    $maQuyen1 = $dataArray[0][0];
    $sqlDelete = "DELETE FROM chitietquyen_chucnang WHERE MAQUYEN = '$maQuyen1'";
    $conn->executeQuery($sqlDelete);
    foreach ($dataArray as $row) {
        $sql = "INSERT INTO chitietquyen_chucnang (MAQUYEN, MACHUCNANG, HANHDONG) VALUES ('$row[0]', '$row[1]', '$row[2]') ";
        $conn->executeQuery($sql);
    }
}


if(isset($_POST['action'])){
    $maQuyen = $_POST['action'];

$sqlCN = "SELECT* FROM chucnang";
$resultCN = $conn->executeQuery($sqlCN);

function checkExistence($value1, $value2,$value3) {
    $servername = "localhost";
    $username = "root";
    $password = "Tinh2004";
    $database = "cinema";

    // Tạo kết nối
    $conn1 = new mysqli($servername, $username, $password, $database);

    // Kiểm tra kết nối
    if ($conn1->connect_error) {
        die("Kết nối không thành công: " + $conn1->connect_error);
    }

    $sql = "SELECT * FROM chitietquyen_chucnang WHERE MAQUYEN = ? AND MACHUCNANG = ? AND HANHDONG = ?";
    $stmt = $conn1->prepare($sql);
    $stmt->bind_param("sss", $value1, $value2, $value3);
    $stmt->execute();
    $result = $stmt->get_result();

    $num_rows = $result->num_rows;
    $stmt->close();
    $conn1->close();
    return $num_rows > 0;
}

if($resultCN->num_rows >0){
    while($row = $resultCN->fetch_assoc()){
        echo "<div class='phanquyen_wrap_function'>";
        echo "<div class='phanquyen_wrap_content'>";
        echo "<div class='phanquyen_name' name='".$row['MACHUCNANG']."'>".$row['TENCHUCNANG']."</div>";
        if(checkExistence($maQuyen, $row['MACHUCNANG'],'Xem')){
            echo "<input type='checkbox' name='Xem' disabled checked>";
        }else{
            echo "<input type='checkbox' name='Xem' disabled >";
        }
        if(checkExistence($maQuyen, $row['MACHUCNANG'],'Thêm')){
            echo "<input type='checkbox' name='Thêm' disabled checked>";
        }else{
            echo "<input type='checkbox' name='Thêm' disabled >";
        }
        if(checkExistence($maQuyen, $row['MACHUCNANG'],'Sửa')){
            echo "<input type='checkbox' name='Sửa' disabled checked>";
        }else{
            echo "<input type='checkbox' name='Sửa' disabled >";
        }
        if(checkExistence($maQuyen, $row['MACHUCNANG'],'Xóa')){
            echo "<input type='checkbox' name='Xóa' disabled checked>";
        }else{
            echo "<input type='checkbox' name='Xóa' disabled >";
        }
        echo "</div>";
        echo "</div>";
    }
}else{
    echo 'truy van sai';
}
}



?>
            

