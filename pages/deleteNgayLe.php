<?php
require_once('../database/connectDatabase.php');
$conn = new connectDatabase();

    if(isset($_GET['sid'])) {
        $id = $_GET['sid'];
        $query = "DELETE FROM suatchieu WHERE MASC = '$id'";
        $result = $conn->executeQuery($query);
        if($result) {
            echo '<script>
                    window.history.replaceState({}, document.title, window.location.href.split("?")[0]);
                    window.location.href = "../admin.php?page=chucnangLichchieuphim&message=Xóa phòng chiếu thành công";
                </script>';

        } else {
            echo 'Khong truy van duoc';
        }
    }
?>