<?php
require_once('../database/connectDatabase.php');
$conn = new connectDatabase();

    if(isset($_GET['sid'])) {
        $id = $_GET['sid'];
        $query = "DELETE FROM suatchieu 
        WHERE MASC = '$id'";
        $result = $conn->executeQuery($query);

        // Kiểm tra xem có bản ghi nào bị ảnh hưởng không
        if(mysqli_affected_rows($conn->conn) > 0) {
            echo '<script>
                    window.history.replaceState({}, document.title, window.location.href.split("?")[0]);
                    window.location.href = "../admin.php?page=phongchieu&message=Xóa SC thành công";
                </script>';
        } else {
            echo '<script>
                    window.history.replaceState({}, document.title, window.location.href.split("?")[0]);
                    window.location.href = "../admin.php?page=phongchieu&message=Xóa SC thất bại. Có bản ghi liên quan.";
                </script>';
        }
    } else {
        echo 'ID không được cung cấp.';
    }
?>