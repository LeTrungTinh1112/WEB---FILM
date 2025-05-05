<?php
    require_once("../database/connectDatabase.php");
    $conn = new connectDatabase();


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['edit_maGhe']) && isset($_POST['edit_maPhongChieu']) && isset($_POST['edit_maLoaiGhe']) && isset($_POST['edit_stt']) && isset($_POST['edit_hangGhe']) && isset($_POST['trangThai'])) {
            $maGhe = $_POST['edit_maGhe'];
            $maPhongChieu = $_POST['edit_maPhongChieu'];
            $maLoaiGhe = $_POST['edit_maLoaiGhe'];
            $stt = $_POST['edit_stt'];
            $hangGhe = $_POST['edit_hangGhe'];
            $trangThai = $_POST['trangThai'];
            
            if (!empty($maGhe) && !empty($maPhongChieu) && !empty($maLoaiGhe) && !empty($stt) && !empty($hangGhe)) {
                $query = "UPDATE ghe SET MAPHONGCHIEU='$maPhongChieu', MALOAIGHE='$maLoaiGhe', STT='$stt', HANGGHE='$hangGhe', TRANGTHAI='$trangThai'  WHERE MAGHE='$maGhe'";
                $result = $conn->executeQuery($query);
                if ($result) {
                    echo '<script>
                            window.history.replaceState({}, document.title, window.location.href.split("?")[0]);
                            window.location.href = "../admin.php?page=phongchieu&message=Cập nhật ghế thành công";
                          </script>';
                } else {
                    echo "Có lỗi xảy ra khi cập nhật ghế";
                }
            } else {
                echo "Dữ liệu không hợp lệ";
            }
        }
    }

?>