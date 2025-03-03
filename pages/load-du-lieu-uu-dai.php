<?php
    require_once('../database/connectDatabase.php');
    $connect = new connectDatabase();
    $tongtien = json_decode(file_get_contents('php://input'), true);

    if(isset($tongtien)) {
        $tongTienThanhToan = intval($tongtien['tongtien']);
        $uuDaiSql = "SELECT * FROM uudai
                WHERE $tongTienThanhToan >= DIEUKIEN";
        $uuDaiQuery = $connect->executeQuery($uuDaiSql);

        $uuDaiArr = array();
        while($row = mysqli_fetch_assoc($uuDaiQuery)) {
            $uuDaiArr[$row['CODE']] = array("phantramuudai" => $row['PHANTRAMUUDAI'], "tenuudai" => $row['TENUUDAI'], "dieukien" => $row['DIEUKIEN']);
        }

        // Kiếm phần trăm ưu đãi cao nhất
        $maxPhanTramUuDai = 0;
        $tenUuDai = '';
        foreach(array_values($uuDaiArr) as $value) {
            if(is_numeric($value['dieukien']))
                if($maxPhanTramUuDai <= $value['phantramuudai']) {
                    $maxPhanTramUuDai = $value['phantramuudai'];
                    $tenUuDai = $value['tenuudai'];
                }
        }

        echo "<div id='phantramuudai' style='font-size: 16px; font-weight: bold' phantramuudai='$maxPhanTramUuDai'>'$tenUuDai'</div>";
    }
?>