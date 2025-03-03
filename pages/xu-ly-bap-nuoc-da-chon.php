<?php
    $data = json_decode(file_get_contents('php://input'), true);

    if (!empty($data)) {
        foreach ($data as $key => $value) {
            // Trong mỗi vòng lặp, bạn cần kiểm tra xem có tồn tại 'soluong' trong mỗi phần tử không
            if (isset($value['soluong']) && $value['soluong'] > 0) {
                $soluong = $value['soluong'];
                echo "<div>$soluong x $key</div>";
            }
        }
    } else {
        echo "<div>Trống</div>";
    }
?>