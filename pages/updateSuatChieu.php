<?php
    require_once('../database/connectDatabase.php');
    $conn = new connectDatabase();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['edit_ngay']) && isset($_POST['gioBatDau']) && isset($_POST['phutBatDau']) && isset($_POST['edit_maSuatChieu'])) {
            $ngay = $_POST['edit_ngay'];
            $gioBatDau = $_POST['gioBatDau'];
            $phutBatDau = $_POST['phutBatDau'];
            $thoiGianBatDau = str_pad($gioBatDau, 2, '0', STR_PAD_LEFT) . ':' . str_pad($phutBatDau, 2, '0', STR_PAD_LEFT) . ':00';
            $maSuatChieu = $_POST['edit_maSuatChieu'];

            if (!empty($ngay) && !empty($thoiGianBatDau) && !empty($maSuatChieu)) {
                $ngay = $conn->conn->real_escape_string($ngay);
                $thoiGianBatDau = $conn->conn->real_escape_string($thoiGianBatDau);
                $maSuatChieu = $conn->conn->real_escape_string($maSuatChieu);

                $query = "UPDATE suatchieu SET NGAY='$ngay', THOIGIANBATDAU='$thoiGianBatDau' WHERE MASC='$maSuatChieu'";
                $result = $conn->executeQuery($query);

                if ($result) {
                    echo '<script>
                            window.history.replaceState({}, document.title, window.location.href.split("?")[0]);
                            window.location.href = "../admin.php?page=chucnangLichchieuphim&message=Cập nhật suất chiếu thành công";
                        </script>';
                } else {
                    echo "Có lỗi xảy ra khi cập nhật suất chiếu: " . $conn->getError();
                }
            } else {
                echo "Dữ liệu không hợp lệ";
            }
        } else {
            echo "Thiếu dữ liệu đầu vào";
        }
    }



?>
