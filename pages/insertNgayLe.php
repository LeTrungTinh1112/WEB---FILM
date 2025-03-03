<?php 
    include('../database/connectDatabase.php');
    $conn = new connectDatabase();
    if(isset($_POST['them_ngayle'])) {
        
        $ngay = $_POST['ngay'];
        $phanTramGiaTang = $_POST['phanTramGiaTang'];
        $query_check_duplicate = "SELECT NGAY FROM ngayle WHERE NGAY = '$ngay'";
        $result_check_duplicate = $conn->executeQuery($query_check_duplicate);


        if(mysqli_num_rows($result_check_duplicate) > 0) {
            header('location: ../admin.php?page=chucnangLichchieuphim&message=Ngày lễ đã tồn tại, vui lòng chọn một ngày khác');
            exit();
        } else {
            $query = "INSERT INTO ngayle (NGAY, PHANTRAMGIATANG) VALUES ('$ngay', '$phanTramGiaTang')";
            $result = $conn->executeQuery($query);
        
            if(!$result) {

            } else {
                echo '<script>
                    window.history.replaceState({}, document.title, window.location.href.split("?")[0]);
                    window.location.href = "../admin.php?page=chucnangLichchieuphim&message=Thêm ngày lễ thành công";
                    </script>';  
           }
            }
        }
    
?>