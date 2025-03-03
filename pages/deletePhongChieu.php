<?php
require_once('../database/connectDatabase.php');
$conn = new connectDatabase();

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "DELETE FROM phongchieu 
        WHERE MAPHONGCHIEU = '$id' 
        AND MAPHONGCHIEU NOT IN (SELECT MAPHONGCHIEU FROM ghe) 
        AND MAPHONGCHIEU NOT IN (SELECT MAPHONGCHIEU FROM lichchieuphim)";
        $result = $conn->executeQuery($query);

        // Kiểm tra xem có bản ghi nào bị ảnh hưởng không
        if(mysqli_affected_rows($conn->conn) > 0) {
            echo '<script>
                    window.history.replaceState({}, document.title, window.location.href.split("?")[0]);
                    window.location.href = "../admin.php?page=phongchieu&message=Xóa phòng chiếu thành công";
                </script>';
        } else {
            echo '<script>
                    window.history.replaceState({}, document.title, window.location.href.split("?")[0]);
                    window.location.href = "../admin.php?page=phongchieu&message=Xóa phòng chiếu thất bại. Có bản ghi liên quan.";
                </script>';
        }
    } else {
        echo 'ID không được cung cấp.';
    }


    if(isset($_GET['sid'])) {
        $id = $_GET['sid'];
        // Kiểm tra xem mã loại ghế có tồn tại trong bảng 'ghe' không
        $check_query = "SELECT * FROM ghe WHERE MALOAIGHE = '$id'";
        $check_result = $conn->executeQuery($check_query);
        if ($check_result->num_rows > 0) {
            // Nếu mã loại ghế đã tồn tại trong bảng 'ghe', không thực hiện xóa
            echo '<script>
                    window.history.replaceState({}, document.title, window.location.href.split("?")[0]);
                    window.location.href = "../admin.php?page=phongchieu&message=Không thể xóa loại ghế này vì có bản ghi liên quan.";
                </script>';
        } else {
            // Nếu không có sự xuất hiện của mã loại ghế trong bảng 'ghe', thực hiện xóa
            $query = "DELETE FROM loaighe WHERE MALOAIGHE = '$id'";
            $result = $conn->executeQuery($query);
            if($result) {
                echo '<script>
                        window.history.replaceState({}, document.title, window.location.href.split("?")[0]);
                        window.location.href = "../admin.php?page=phongchieu&message=Xóa loại ghế thành công";
                    </script>';
            } else {
                echo 'Không thể thực hiện truy vấn.';
            }
        }
    }
    
    
?>