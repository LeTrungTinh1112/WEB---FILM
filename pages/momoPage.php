<?php

session_start();
// Kiểm tra trạng thái thanh toán sau khi người dùng quay lại
if (isset($_GET['resultCode'])) {
    if ($_GET['resultCode'] == '0') {
        $_SESSION['payment_status'] = 'momo_success'; // Lưu trạng thái thanh toán thành công
        echo "<p>Thanh toán thành công!</p>";
        updateDataBase($_SESSION['data2']); // Cập nhật cơ sở dữ liệu
    } else {
        $_SESSION['payment_status'] = 'momo_failed'; // Lưu trạng thái thanh toán thất bại
        echo "<p>Thanh toán thất bại!</p>";
    }
}
function updateDataBase($data2){
    if ($data2 !== null) {
        $connect = new connectDatabase();
        // Truy xuất các phần tử của mảng $data và gán cho các biến tương ứng
        $username = $data2['username'];
        $malichchieu = $data2['malichchieu'];
        $maghes = $data2['maghes'];
        $tongtien = $data2['tongtien'];
        $ngay = $data2['ngay'];
        $thoigian = $data2['thoigian'];
        $phuongthucthanhtoan = $data2['phuongthucthanhtoan'];
        $bapnuocs = $data2['bapnuocs'];
        // Tạo mã vé tự động
        $veSql = "SELECT COUNT(*) AS total_rows FROM ve";
        $veQuery = $connect->executeQuery($veSql);
        $result = mysqli_fetch_assoc($veQuery);
        $totalRows = intval($result['total_rows']) + 1;

        $remainingLength = 4; // độ dài phần sau tiền tố 'MV'
        $mave =  'MV' . str_pad($totalRows, $remainingLength, '0', STR_PAD_LEFT);

        // UPDATE table chitietve_dichvu
        foreach($bapnuocs as $tendichvu => $thongtin) {
            $madichvu = $thongtin['madichvu'];
            $soluong = $thongtin['soluong'];

            if($soluong > 0) {
                $upDateChiTietVeDichVuSql  = " INSERT INTO chitietve_dichvu(MAVE, MADICHVU, SOLUONG)
                VALUES ('$mave', '$madichvu', '$soluong') ";
                $connect->executeQuery($upDateChiTietVeDichVuSql); // trả về true nếu thành công, ngược lại là false
            }  
        }

        // UPDATE table ve
        $upDateSql  = " INSERT INTO ve(MAVE, USERNAME, MALICHCHIEU, TONGTIEN, NGAY, THOIGIAN, PHUONGTHUCTHANHTOAN,DATHANHTOAN)
                        VALUES ('$mave', '$username', '$malichchieu', '$tongtien', '$ngay', '$thoigian', '$phuongthucthanhtoan','true')
                    ";
        $upDateQuery = $connect->executeQuery($upDateSql); // trả về true nếu thành công, ngược lại là false

        // UPDATE chitietve_ghe 
        foreach($maghes as $maghe => $price) {
            $upDateChiTietVeGheSql  = " INSERT INTO chitietve_ghe(MAVE, MAGHE, PRICE)
                        VALUES ('$mave', '$maghe', '$price') ";
            $connect->executeQuery($upDateChiTietVeGheSql); // trả về true nếu thành công, ngược lại là false
        }

        echo '<script>
    alert("Cập nhật vé đã mua thành công");
    window.location.href = "index.php";
</script>';

    } else {
        // Xử lý trường hợp không nhận được dữ liệu hoặc dữ liệu không hợp lệ
        echo "Không nhận được dữ liệu hoặc dữ liệu không hợp lệ";
    }
}