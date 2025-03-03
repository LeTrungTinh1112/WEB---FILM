<?php
function leapyear($year)
{
    if ($year % 4 == 0) {
        if ($year % 100 != 0) return true;
        else if ($year % 400 == 0) return true;
    }
    return false;
}
function calendar($month, $year)
{
    switch ($month) {
        case 1:
        case 3:
        case 5:
        case 7:
        case 8:
        case 10:
        case 12:
            return 31;
            break;
        case 2:
            if (leapyear($year)) return 29;
            else return 28;
            break;
        case 4:
        case 6:
        case 9:
        case 11:
            return 30;
            break;
    }
}

function nameDayVietnamese($num)
{
    switch ($num) {
        case 0:
            return "Thứ 2";
            break;
        case 1:
            return "Thứ 3";
            break;
        case 2:
            return "Thứ 4";
            break;
        case 3:
            return "Thứ 5";
            break;
        case 4:
            return "Thứ 6";
            break;
        case 5:
            return "Thứ 7";
            break;
        case 6:
            return "Chủ nhật";
            break;
    }
}
function numberDay($day)
{
    switch ($day) {
        case "Mon":
            return 2;
            break;
        case "Tue":
            return 3;
            break;
        case "Wed":
            return 4;
            break;
        case "Thu":
            return 5;
            break;
        case "Fri":
            return 6;
            break;
        case "Sat":
            return 7;
            break;
        case "Sun":
            return 8;
            break;
    }
}
date_default_timezone_set('Asia/Ho_Chi_Minh');
if (!isset($_GET['day'])) {

    if (!isset($_POST['start_date']) && !isset($_POST['end_date'])) {
        $startDate = date("Y-m-d");
        $endDate = new DateTime($startDate);

        // Thêm 21 ngày vào ngày ban đầu
        $endDate->modify('+20 days');
        $endDate = $endDate->format('Y-m-d');
        // echo '<div id="add_phim_lichchieuphim" name="'.$day.'">Thêm phim<i class="fa-solid fa-plus"></i></div>';
    }else{


        $startDate = $_POST['start_date'];
 
        $endDate = $_POST['end_date'];

    }
    showLichchieuphimHeader($startDate, $endDate);
    showLichchieuphimtheongay($startDate);
} else  showLichchieuphimtheongay($_GET['day']);

function showLichchieuphimHeader($startDate, $endDate)
{

    $parts = explode("-", $startDate);
    $day = $parts[2];
    $month = $parts[1];
    $year = $parts[0];
    $numberdayOfWeekNumber = date("w", strtotime($startDate));
    $ngay1 = new DateTime($startDate);
    $ngay2 = new DateTime($endDate);

    // Tính khoảng cách giữa hai ngày
    $khoangCach = $ngay1->diff($ngay2);
    $khoangCach = $khoangCach->days +1 ;
    echo '<div id="lichchieuphim_wrap">
    <div id="lichchieuphim_header">
        <span class="lichchieuphim_header_btn" id="btn_left_Ngay" style="display:none;"><i class="fa-solid fa-chevron-left" name="btn_left" ></i></span>
        <span class="lichchieuphim_header_btn " id="btn_right_Ngay"><i class="fa-solid fa-chevron-right" name="btn_right" ></i></span>
        <nav id="lichchieuphim_daytime"> 
        <ul>';
    // (isset($_GET['day'])<=calendar($month,$year))?isset($_GET['day']):$day
    for ($i = 0; $i < $khoangCach; $i++) {
        if ($day <= calendar($month, $year)) {
            echo '<li class="btn_changeDayLichchieuphim" ';
            if ($i == 0) echo 'id="lichchieuphim_selected"';
            echo ' name="' . $year . '/' . $month . '/' . $day . '"><span class="lichchieuphim_day">';
            echo $day++;
            if ($month != (int)date('m')) echo '/' . $month;
            echo '</span><span class="lichchieuphim_mota">';
            if ($i == 0) echo 'Hôm nay';
            else      echo nameDayVietnamese($numberdayOfWeekNumber);
            if (++$numberdayOfWeekNumber == 7) $numberdayOfWeekNumber = 0;
            echo '</span></li>';
        } else {
            if ($year == 12) $year++;
            $month++;
            $day = 1;
            $i--;
        }
    }
    echo '</ul>
        </nav>
    </div>';
}

function showLichchieuphimtheongay($day)
{
    $listPhimtheongay = getListChitietPhimtheoNgay($day);
    echo '<div id="lichchieuphim_content">';
    echo '<div id="btn_add_lichchieuphim" name="' . $day . '" onclick="showAddFormLichchieuphim();"> <i class="fa-solid fa-plus"></i></div>';
    if ($listPhimtheongay == null)
        echo '<div id="lichchieuphim_null"><span>Chưa có lịch chiếu vào ngày này</span></div>';
    else {
        foreach ($listPhimtheongay as $phim) {
            echo '<div class="lichchieuphim_phim">';


            echo '<img src="./img/' . $phim['NAMEANH'] . '">';
            echo '<div class="lichchieuphim_right">';
            echo '  <div class="lichchieuphim_mota_phim">
                                <span class="age_movie"';
            switch ($phim['DOTUOI']) {
                case 0:
                    echo ' style="background-color: blue;">';
                    break;
                case 13:
                    echo ' style="background-color: #ddbc3f;">';
                    break;
                case 16:
                    echo ' style="background-color: #e88021;">';
                    break;
                case 18:
                    echo ' style="background-color: red;">';
                    break;
                default:
                    echo ' style="background-color: violet;">';
                    break;
            }
            if ($phim['DOTUOI'] == 0) echo 'P</span>';
            else
                echo $phim['DOTUOI'] . '+</span>';
            echo '<span class="name_movie">' . $phim['TENPHIM'] . '</span>
                                <span class="thoiluong_movie">' . $phim['THOILUONG'] . ' phút</span>
                            </div>';

            $phimvasuatchieu = listPhimvaSuatchieucuaphimtheoMAPM($phim['MAPM'], $day);
            echo '  <div class="lichchieuphim_lichchieu_wrap">';

            foreach ($phimvasuatchieu as $row) {
                if ($row['THOIGIANBATDAU'] != '') {
                    echo '  <div class="lichchieuphim_lichchieu" name="' . $row['MALICHCHIEU'] . '">
                                            <span class="time_start">' . $row['THOIGIANBATDAU'] . '</span>
                                            <span>~<span>
                                            <span class="time_end">' . $row['THOIGIANKETTHUC'] . '</span>
                                            <span class="phongchieuSuatchieu"> ' . $row['MAPHONGCHIEU'] . '</span>
                                        </div>';
                }
            }

            echo '</div>';
            echo ' </div>';
            echo ' <span class="edit_suatchieu" name="' . $phim['MAPM'] . '" id="' . $day . '" onclick="showUpdateFormLichchieuphim(this);"><i class="fa-solid fa-pen-to-square fa-fw"></i></span>';
            echo ' <span class="delete_suatchieu" id="' . $phim['MAPM'] . '" onclick="deleteLCP(this);"><i class="fa-solid fa-xmark"></i></span>';

            echo '</div>';
        }
    }
    echo '</div>';
    echo '</div>';
}



function getListChitietPhimtheoNgay($ngay)
{
    $list = array();
    if (file_exists('../database/connectDatabase.php'))
        require_once('../database/connectDatabase.php');
    else
        require_once('./database/connectDatabase.php');

    $connection = new connectDatabase();

    // Thực hiện truy vấn (ví dụ)
    $query = "SELECT 	phim.MAPM,TENPHIM,DOTUOI,THOILUONG,NAMEANH FROM lichchieuphim,suatchieu,phim WHERE NGAY= '" . $ngay . "' AND  suatchieu.MASC = lichchieuphim.MASC AND lichchieuphim.MAPM = phim.MAPM GROUP BY phim.MAPM,TENPHIM,DOTUOI,THOILUONG,NAMEANH;"; // Truy vấn SQL của bạn
    $result = $connection->executeQuery($query);

    // Xử lý kết quả nếu cần
    if ($result) {
        // Thực hiện các thao tác với kết quả
        while ($row = $result->fetch_assoc()) {
            if ($row === null) {
                return null;
            }
            $list[] = $row;
        }
    } else {
        echo 'thất bại roi kiaaa';
        return null;
        // Xử lý khi truy vấn thất bại
    }
    return $list;
}
function listPhimvaSuatchieucuaphimtheoMAPM($maphim, $ngay)
{

    $table = array();
    if (file_exists('../database/connectDatabase.php'))
        require_once('../database/connectDatabase.php');
    else
        require_once('./database/connectDatabase.php');
    $connection = new connectDatabase();

    // Thực hiện truy vấn (ví dụ)
    $query = "select * FROM suatchieu,lichchieuphim WHERE suatchieu.MASC = lichchieuphim.MASC AND MAPM='" . $maphim . "' AND NGAY='" . $ngay . "'"; // Truy vấn SQL của bạn
    $result = $connection->executeQuery($query);

    // Xử lý kết quả nếu cần
    if ($result) {
        // Thực hiện các thao tác với kết quả
        while ($row = $result->fetch_assoc()) {
            $table[] = $row;
        }
    } else {
        echo 'thất bại';
        return null;
        // Xử lý khi truy vấn thất bại
    }
    return  $table;
}
