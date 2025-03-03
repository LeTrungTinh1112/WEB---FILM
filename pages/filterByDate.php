<?php
require_once('../database/connectDatabase.php');
$conn = new connectDatabase();

$selectedDate = $_POST['selectedDate'];

$query = "SELECT * FROM suatchieu WHERE NGAY = '$selectedDate'";
$result = $conn->executeQuery($query);

$html = '<table class="table table-hover table-bordered table-striped">
            <thead>
                <th>Mã Suất Chiếu</th>
                <th>Ngày</th>
                <th>Thời Gian Bắt Đầu</th>
                <th>Cập Nhật</th>
                <th>Xóa</th>
            </thead>
            <tbody>';

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $html .= '<tr>
                    <td>'.$row['MASC'].'</td>
                    <td>'.$row['NGAY'].'</td>
                    <td>'.$row['THOIGIANBATDAU'].'</td>
                    <td><button class="btn btn-success" onclick="openEditNgayLeForm(\''.$row['MASC'].'\', \''.$row['NGAY'].'\', \''.$row['THOIGIANBATDAU'].'\')">Cập Nhật</button></td>
                    <td><a href="./pages/deleteNgayLe.php?sid='.$row['MASC'].'" class="btn btn-danger">Xóa</a></td>
                </tr>';
    }
} else {
    $html .= '<tr><td colspan="5">Không có suất chiếu nào cho ngày này.</td></tr>';
}

$html .= '</tbody></table>';

echo $html;
?>
