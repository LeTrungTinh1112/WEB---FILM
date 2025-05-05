<?php
require_once('../database/connectDatabase.php');
$conn = new connectDatabase();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['edit_ngay']) && isset($_POST['edit_thoigianbatdau']) && isset($_POST['edit_masuatchieu'])) {
        $ngay = $_POST['edit_ngay'];

        $thoiGianBatDau = $_POST['edit_thoigianbatdau'];
        $maSuatChieu = $_POST['edit_masuatchieu'];

        if (!empty($ngay) && !empty($thoiGianBatDau) && !empty($maSuatChieu)) {
            $ngay = $conn->conn->real_escape_string($ngay);
            $thoiGianBatDau = $conn->conn->real_escape_string($thoiGianBatDau);
            $maSuatChieu = $conn->conn->real_escape_string($maSuatChieu);

            $query = "UPDATE suatchieu SET NGAY='$ngay', THOIGIANBATDAU='$thoiGianBatDau' WHERE MASC='$maSuatChieu'";
            $result = $conn->executeQuery($query);

            if ($result) {
                echo '<script>
                            window.history.replaceState({}, document.title, window.location.href.split("?")[0]);
                            window.location.href = "../admin.php?page=phongchieu&message=Cập suất chiếu thành công";
                          </script>';
            } else {
                echo "Có lỗi xảy ra khi cập nhật suất chiếu: ";
            }
        } else {
            echo "Dữ liệu không hợp lệ";
        }
    } else {
        echo "Thiếu dữ liệu đầu vào";
    }
}
