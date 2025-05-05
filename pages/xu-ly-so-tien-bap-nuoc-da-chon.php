<?php
    $data = json_decode(file_get_contents('php://input'), true);

    if (!empty($data)) {
        foreach ($data as $key => $value) {
            // Trong mỗi vòng lặp, bạn cần kiểm tra xem có tồn tại 'soluong' trong mỗi phần tử không
            if (isset($value['price']) && isset($value['soluong']) && $value['soluong'] > 0) {
                $soTien = intval($value['soluong']) * intval($value['price']);
                echo "<div>$soTien đ</div>";
            }
        }
    } else {
        echo "<div>Trống</div>";
    }
?>