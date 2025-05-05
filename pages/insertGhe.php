<?php
    require_once('../database/connectDatabase.php');
    $conn = new connectDatabase();
    if(isset($_POST['them_ghe'])) {
        $maPhongChieu = $_POST['maPhongChieu'];
        $maLoaiGhe = $_POST['maLoaiGhe'];
        $stt = $_POST['stt'];
        $hangGhe = $_POST['hangGhe'];
        $trangThai = isset($_POST['trangThai']) ? $_POST['trangThai'] : '';
        $maGhe = $maPhongChieu . $hangGhe . $stt;
        $query_check_duplicate = "SELECT MAGHE FROM ghe WHERE MAGHE = '$maGhe'";
        $result_check_duplicate = $conn->executeQuery($query_check_duplicate);




            if(mysqli_num_rows($result_check_duplicate) > 0) {
                header('location: ../admin.php?page=phongchieu&message=Mã ghế đã tồn tại, vui lòng chọn một mã khác');
                exit();
            } else {
                $query = "INSERT INTO ghe (MAPHONGCHIEU, MALOAIGHE, STT, HANGGHE, TRANGTHAI, MAGHE) VALUES ('$maPhongChieu', '$maLoaiGhe', '$stt', '$hangGhe', '$trangThai', '$maGhe')";
                $result = $conn->executeQuery($query);
            
                if(!$result) {
                    echo 'failed';
                } else {
                        echo '<script>
                            window.history.replaceState({}, document.title, window.location.href.split("?")[0]);
                            window.location.href = "../admin.php?page=phongchieu&message=Thêm ghế thành công";
                        </script>';  
                }
                
            }
            
        }
    
?>