<?php 
    include('../database/connectDatabase.php');
    $conn = new connectDatabase();
    if(isset($_POST['them_phongchieu'])) {
        
        $maphongchieu = $_POST['maphongchieu'];
        $tenphongchieu = $_POST['tenphongchieu'];
        $soghe = $_POST['soghe'];
        $trangthai = isset($_POST['trangthai']);
        $query_check_duplicate = "SELECT MAPHONGCHIEU FROM phongchieu WHERE MAPHONGCHIEU = '$maphongchieu'";
        $result_check_duplicate = $conn->executeQuery($query_check_duplicate);

        if($maphongchieu == "" || empty($maphongchieu)) {
            header('location: ../admin.php?message= Bạn cần điền mã phòng chiếu');
        } else {
            if(mysqli_num_rows($result_check_duplicate) > 0) {
                header('location: ../admin.php?page=phongchieu&message=Mã phòng chiếu đã tồn tại, vui lòng chọn một mã khác');
                exit();
            } else {
                $query = "INSERT INTO phongchieu (MAPHONGCHIEU, TENPHONGCHIEU, SOGHE, TRANGTHAI) VALUES ('$maphongchieu', '$tenphongchieu', '$soghe', '$trangthai')";
                $result = $conn->executeQuery($query);
            
                if(!$result) {

                } else {
                    echo '<script>
                        window.history.replaceState({}, document.title, window.location.href.split("?")[0]);
                        window.location.href = "../admin.php?page=phongchieu&message=Thêm phòng chiếu thành công";
                    </script>';  
                }
            }
        }
    }

    if(isset($_POST['them_loaighe'])) {
        $maloaighe = $_POST['maloaighe'];
        $tenloaighe = $_POST['tenloaighe'];
        $price = $_POST['price'];
        $query_check_duplicate = "SELECT MALOAIGHE FROM loaighe WHERE MALOAIGHE = '$maloaighe'";
        $result_check_duplicate = $conn->executeQuery($query_check_duplicate);

        
            if(mysqli_num_rows($result_check_duplicate) > 0) {
                header('location: ../admin.php?page=phongchieu&message=Mã loại ghế đã tồn tại, vui lòng chọn một mã khác');
                exit();
            } else {
                $query = "INSERT INTO loaighe (MALOAIGHE, TENLOAIGHE, PRICE) VALUES ('$maloaighe', '$tenloaighe', '$price')";
                $result = $conn->executeQuery($query);
            
                if(!$result) {

                } else {
                    echo '<script>
                        window.history.replaceState({}, document.title, window.location.href.split("?")[0]);
                        window.location.href = "../admin.php?page=phongchieu&message=Thêm loại ghế thành công";
                    </script>';  
                }
            }
        }
    
?>