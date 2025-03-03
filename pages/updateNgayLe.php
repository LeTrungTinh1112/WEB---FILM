<?php
require_once('../database/connectDatabase.php');
$conn = new connectDatabase();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['edit_ngay']) && isset($_POST['edit_phanTramGiaTang'])) {
        $ngay = $_POST['edit_ngay'];
        $phanTramGiaTang = $_POST['edit_phanTramGiaTang'];

        if (!empty($ngay) && !empty($phanTramGiaTang)) {
            $query = "UPDATE ngayle SET PHANTRAMGIATANG='$phanTramGiaTang' WHERE NGAY='$ngay'";
            $result = $conn->executeQuery($query);
            if ($result) {
                echo '<script>
                        window.history.replaceState({}, document.title, window.location.href.split("?")[0]);
                        window.location.href = "../admin.php?page=chucnangLichchieuphim&message=Cập nhật ngày lễ thành công";
                      </script>';
            } else {
                echo "Có lỗi xảy ra khi cập nhật ngày lễ";
            }
        } else {
            echo "Dữ liệu không hợp lệ";
        }
    }
}
?>
