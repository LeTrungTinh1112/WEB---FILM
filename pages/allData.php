<?php
require_once('../database/connectDatabase.php');
$conn = new connectDatabase();

$query = "SELECT * FROM ghe ORDER BY STT, MAPHONGCHIEU, HANGGHE, MAGHE";
$result = $conn->executeQuery($query);

if (!$result) {
    echo 'Failed';
} else {
    echo '<table class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>Mã Phòng Chiếu</th>
                    <th>Mã Loại Ghế</th>
                    <th>Số Thứ Tự</th>
                    <th>Hàng Ghế</th>
                    <th>Trạng Thái</th>
                    <th>Mã Ghế</th>
                    <th>Cập Nhật</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>';

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>
                <td>' . $row['MAPHONGCHIEU'] . '</td>
                <td>' . $row['MALOAIGHE'] . '</td>
                <td>' . $row['STT'] . '</td>
                <td>' . $row['HANGGHE'] . '</td>
                <td>' . $row['TRANGTHAI'] . '</td>
                <td>' . $row['MAGHE'] . '</td>
                <td><button class="btn btn-success" onclick="openEditGheForm(\'' . $row['MAPHONGCHIEU'] . '\', \'' . $row['MALOAIGHE'] . '\', \'' . $row['STT'] . '\', \'' . $row['HANGGHE'] . '\', \'' . $row['TRANGTHAI'] . '\', \'' . $row['MAGHE'] . '\')">Cập Nhật</button></td>
                <td><a href="./pages/deleteGhe.php?id=' . $row['MAGHE'] . '" class="btn btn-danger">Xóa</a></td>
            </tr>';
    }

    echo '</tbody></table>';
}
?>
