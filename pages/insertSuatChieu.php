<?php 
require_once('../database/connectDatabase.php');
$conn = new connectDatabase();

if(isset($_POST['them_suatchieu'])) {
    $ngay = $_POST['ngay'];
    $gioBatDau = $_POST['gioBatDau'];
    $phutBatDau = $_POST['phutBatDau'];
    $thoiGianBatDau = str_pad($gioBatDau, 2, '0', STR_PAD_LEFT) . ':' . str_pad($phutBatDau, 2, '0', STR_PAD_LEFT) ;

    // Lấy giá trị lớn nhất của MASC và tăng thêm 1 để tạo mã mới
    // $query_max_id = "SELECT MAX(RIGHT(MASC, 4)) AS max_id FROM suatchieu";
    $query_max_id = "SELECT MASC AS max_id FROM suatchieu";
    $result_max_id = $conn->executeQuery($query_max_id);
    
    if($result_max_id->num_rows > 0) {
        $max = 0;
        while ($row = $result_max_id->fetch_assoc()) {
            $MASClast = $row['max_id'];
            $so = preg_replace("/[^0-9]/", "", $MASClast);
            $stt = (int)$so;
            if ($stt > $max) $max = $stt;
        }
        $new_ma_suatchieu = 'SC'.($max+1);
        
    } else {
        echo 'failed';
    }

    // Kiểm tra xem đã tồn tại suất chiếu cho ngày đã chọn chưa
    $query_check_duplicate = "SELECT MASC FROM suatchieu WHERE NGAY = '$ngay' AND THOIGIANBATDAU = '$thoiGianBatDau'";
    $result_check_duplicate = $conn->executeQuery($query_check_duplicate);

    if(mysqli_num_rows($result_check_duplicate) > 0) {
        header('location: ../admin.php?page=suatchieuadmin&message=Suất chiếu đã tồn tại, vui lòng chọn một ngày khác');
        exit();
    } else {
        if(isset($ngay)) {
            $query_insert_suatchieu = "INSERT INTO suatchieu (MASC, NGAY, THOIGIANBATDAU) VALUES ('$new_ma_suatchieu', '$ngay', '$thoiGianBatDau')";
            $result_insert_suatchieu = $conn->executeQuery($query_insert_suatchieu);

            if($result_insert_suatchieu) {
                echo '<script>
                    window.history.replaceState({}, document.title, window.location.href.split("?")[0]);
                    window.location.href = "../admin.php?page=suatchieuadmin&message=Thêm suất chiếu thành công";
                </script>';  
            } else {
                echo "Lỗi khi thêm suất chiếu: ";
            }
        } else {
            echo 'failed';
        }
        
    }
}

?>
