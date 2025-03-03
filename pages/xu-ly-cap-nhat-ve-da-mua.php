<?php
    $data = json_decode(file_get_contents('php://input'), true);
    require_once('../database/connectDatabase.php');

    if ($data !== null) {
        $connect = new connectDatabase();
        // Truy xuất các phần tử của mảng $data và gán cho các biến tương ứng
        $username = $data['username'];
        $malichchieu = $data['malichchieu'];
        $maghes = $data['maghes'];
        $tongtien = $data['tongtien'];
        $ngay = $data['ngay'];
        $thoigian = $data['thoigian'];
        $phuongthucthanhtoan = $data['phuongthucthanhtoan'];
        $bapnuocs = $data['bapnuocs'];

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
        $upDateSql  = " INSERT INTO ve(MAVE, USERNAME, MALICHCHIEU, TONGTIEN, NGAY, THOIGIAN, PHUONGTHUCTHANHTOAN)
                        VALUES ('$mave', '$username', '$malichchieu', '$tongtien', '$ngay', '$thoigian', '$phuongthucthanhtoan')
                    ";
        $upDateQuery = $connect->executeQuery($upDateSql); // trả về true nếu thành công, ngược lại là false

        // UPDATE chitietve_ghe 
        foreach($maghes as $maghe => $price) {
            $upDateChiTietVeGheSql  = " INSERT INTO chitietve_ghe(MAVE, MAGHE, PRICE)
                        VALUES ('$mave', '$maghe', '$price') ";
            $connect->executeQuery($upDateChiTietVeGheSql); // trả về true nếu thành công, ngược lại là false
        }

        echo "Cập nhật vé đã mua thành công";
    } else {
        // Xử lý trường hợp không nhận được dữ liệu hoặc dữ liệu không hợp lệ
        echo "Không nhận được dữ liệu hoặc dữ liệu không hợp lệ";
    }
    
?>