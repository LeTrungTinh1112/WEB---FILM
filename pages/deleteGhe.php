<?php
require_once('../database/connectDatabase.php');
$conn = new connectDatabase();

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "DELETE FROM ghe WHERE MAGHE = '$id'";
        $result = $conn->executeQuery($query);
        if($result) {
            echo '<script>
                    window.history.replaceState({}, document.title, window.location.href.split("?")[0]);
                    window.location.href = "../admin.php?page=phongchieu&message=Xóa ghế thành công";
                </script>';

        } else {
            echo 'Khong truy van duoc';
        }
    }
?>