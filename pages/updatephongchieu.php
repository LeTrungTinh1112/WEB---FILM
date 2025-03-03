<?php
require_once('../database/connectDatabase.php');
$conn = new connectDatabase();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['edit_maphongchieu']) && isset($_POST['edit_tenphongchieu']) && isset($_POST['edit_soghe']) && isset($_POST['edit_trangThai'])) {
        $maPhongChieu = $_POST['edit_maphongchieu'];
        $tenPhongChieu = $_POST['edit_tenphongchieu'];
        $soGhe = $_POST['edit_soghe'];
        $trangThai = $_POST['edit_trangThai'];

        if (!empty($maPhongChieu) && !empty($tenPhongChieu) && !empty($soGhe)) {
            $query = "UPDATE phongchieu SET TENPHONGCHIEU='$tenPhongChieu', SOGHE='$soGhe', TRANGTHAI='$trangThai' WHERE MAPHONGCHIEU='$maPhongChieu'";
            $result = $conn->executeQuery($query);
            if ($result) {
                echo '<script>
                        window.history.replaceState({}, document.title, window.location.href.split("?")[0]);
                        window.location.href = "../admin.php?page=phongchieu&message=Cập nhật phòng chiếu thành công";
                    </script>';
            } else {
                echo "Có lỗi xảy ra khi cập nhật phòng chiếu";
            }
        } else {
            echo "Dữ liệu không hợp lệ";
        }
    }

    if(isset($_POST['edit_maloaighe']) && isset($_POST['edit_tenloaighe']) && isset($_POST['edit_price'])) {
        $maLoaiGhe = $_POST['edit_maloaighe'];
        $tenLoaiGhe = $_POST['edit_tenloaighe'];
        $price = $_POST['edit_price'];

        if(!empty($maLoaiGhe) && !empty($tenLoaiGhe) && !empty($price)) {
            $query = "UPDATE loaighe SET TENLOAIGHE='$tenLoaiGhe', PRICE='$price' WHERE MALOAIGHE = '$maLoaiGhe'";
            $result = $conn->executeQuery($query);
            if($result) {
                echo '<script>
                        window.history.replaceState({}, document.title, window.location.href.split("?")[0]);
                        window.location.href = "../admin.php?page=phongchieu&message=Cập nhật loại ghế thành công";
                    </script>';
            }
        } else {
            echo "Có lỗi xảy ra khi cập nhật loại ghế";
        }
    } else {
        echo "Dữ liệu không hợp lệ";
    }
}
?>
