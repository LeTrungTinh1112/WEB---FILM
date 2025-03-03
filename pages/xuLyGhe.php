<?php
// Kết nối CSDL
require_once('../database/connectDatabase.php');
$conn = new connectDatabase();

if(isset($_POST['maPhongChieu'])) {
    $maPhongChieu = $_POST['maPhongChieu'];

    $query = "SELECT * FROM ghe WHERE MAPHONGCHIEU = '$maPhongChieu' ORDER BY HANGGHE, STT";
    $result = $conn->executeQuery($query);

    if(mysqli_num_rows($result) > 0) {
        $html = '<h2>Màn Hình</h2>';
        $html .= '<div class="seat-map" style="display: flex; flex-wrap: wrap;">';

        $currentRow = '';

        while ($row = mysqli_fetch_assoc($result)) {
            $hangGhe = $row['HANGGHE'];
            $trangThai = $row['TRANGTHAI'];
            $stt = $row['STT'];
            $maLoaiGhe = $row['MALOAIGHE'];
            $backgroundColor = '';

            // Xác định màu sắc dựa trên mã loại ghế
            switch ($maLoaiGhe) {
                case 'STD':
                    $backgroundColor = 'brown'; // Màu nâu
                    break;
                case 'BIZ':
                    $backgroundColor = 'yellow'; // Màu vàng
                    break;
                case 'DOI':
                    $backgroundColor = 'pink'; // Màu hồng
                    break;
                default:
                    $backgroundColor = 'white'; // Mặc định màu trắng
                    break;
            }

            if ($currentRow !== $hangGhe) {
                if ($currentRow !== '') {
                    $html .= '</div>';
                    // Thêm dòng trống giữa các hàng ghế
                    $html .= '<br>';
                }
                $html .= '<div class="seat-row" style="display: flex; flex-wrap: nowrap;">';
                // Hiển thị số hàng ghế trên mỗi hàng
                $html .= '<div style="width: 2em; height: 2em; margin: 0.5em; display: flex; justify-content: center; align-items: center;">' . $hangGhe . '</div>';
                $currentRow = $hangGhe;
            }

            // Thêm hàng thứ tự và ghế trên mỗi ghế
            $html .= '<div class="seat" style="background-color: ' . $backgroundColor . '; width: 2em; height: 2em; margin: 0.5em; display: flex; justify-content: center; align-items: center;">' . $stt . '</div>';
        }
        $html .= '</div>';

        // Thêm chú thích về màu sắc của các loại ghế
        $html .= '<div style="margin-top: 1em;">';
        $html .= '<span style="background-color: brown; width: 1.5em; height: 1.5em; display: inline-block; margin-right: 1em;"></span> Thường (Nâu) ';
        $html .= '<span style="background-color: yellow; width: 1.5em; height: 1.5em; display: inline-block; margin-right: 1em;"></span> VIP (Vàng) ';
        $html .= '<span style="background-color: pink; width: 1.5em; height: 1.5em; display: inline-block; margin-right: 1em;"></span> Cặp Đôi (Hồng) ';
        $html .= '</div>';

        echo $html;
    } else {
        echo "<p>Không có dữ liệu ghế cho phòng chiếu này.</p>";
    }
} else {
    echo "<p>Không có mã phòng chiếu được gửi.</p>";
}



?>
