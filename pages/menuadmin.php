<?php


if (isset($_SESSION['TenDN'])) {
    $USERNAME = $_SESSION['TenDN'];
} else {
    $USERNAME = "chưa có";
}

if (isset($_GET['mode'])) {
    $mode = $_GET['mode'];
    switch ($mode) {
        case "day": {
                echo '<img src="img/Logo1.png">';
                break;
            }
        case "night": {
                echo '<img src="img/logoweb_admin_dark.png">';
                break;
            }
    }
} else {
    echo '<img src="img/Logo1.png">';
}

$MAQUYEN = getMAQUYENtheoUSERNAME($USERNAME);
$chucnang = getCNtheoMAQUYEN($MAQUYEN);
array_push($chucnang, "Vé");
array_push($chucnang, "Thống kê");
array_push($chucnang, "Đăng xuất");


$liItem = '';
foreach ($chucnang as $tenchucnang) {
    $href;
    $nameChucnang;
    $icon;
    $flag = true;
    switch ($tenchucnang) {
        case "Tài khoản":
            $nameChucnang = "qlnguoidung";
            $icon = "fa-solid fa-user";
            $href = "admin.php?page=usersadmin";
            break;
        case "Thể loại":
            $nameChucnang = "theloai";
            $icon = "fa-solid fa-list fa-fw";
            $href = "admin.php?page=theloaiadmin";
            break;
        case "Dịch vụ":
            $nameChucnang = "qldichvu";
            $icon = "fa-solid fa-mug-saucer";
            $href = "admin.php?page=dichvuadmin";
            break;
        case "Phòng chiếu":
            $nameChucnang = "qldichvu";
            $icon = "fa-solid fa-door-open";
            $href = "admin.php?page=phongchieu";    
            break;
        case "Vé":
            $nameChucnang = "qldatve";
            $icon = "fa-solid fa-ticket";
            $href = "admin.php?page=lsdatveadmin";
            break;
        case "Thống kê":
            $nameChucnang = "bcdoanhthu";
            $icon = "fa-solid fa-chart-column";
            $href = "admin.php?page=baocaodoanhthu";
            break;
        case "Phân quyền":
            $nameChucnang = "phanquyencn";
            $icon = "fa-solid fa-file-pen";
            $href = "admin.php?page=phanquyenadmin";
            break;
        case "Ưu đãi":
            $nameChucnang = "uudaiadmin";
            $icon = "fa-solid fa-tag";
            $href = "admin.php?page=uudaiadmin";
            break;
        case "Lịch chiếu phim":
            $nameChucnang = "phongchieuad";
            $icon = "fa-solid fa-calendar-days";
            $href = "admin.php?page=lichchieuphimadmin";
            break;
        case "Suất chiếu":
            $nameChucnang = "phongchieuad";
            $icon = "fa-solid fa-clock";
            $href = "admin.php?page=suatchieuadmin";
            break;
        case "Ngày lễ":
            $nameChucnang = "phongchieuad";
            $icon = "fa-solid fa-face-laugh-squint";
            $href = "admin.php?page=ngayleadmin";
            break;
        case "Diễn viên":
            $nameChucnang = "phongchieuad";
            $icon = "fa-solid fa-masks-theater";
            $href = "admin.php?page=dienvienadmin";
            break;
        case "Ghế":
            $nameChucnang = "phongchieuad";
            $icon = "fa-solid fa-couch";
            $href = "admin.php?page=phongchieu";
            break;
        case "Loại ghế":
            $nameChucnang = "phongchieuad";
            $icon = "fa-regular fa-magnifying-glass-dollar";
            $href = "admin.php?page=phongchieu";
            break;
        case "Phim":
            $nameChucnang = "phongchieuad";
            $icon = "fa-solid fa-film";
            $href = "admin.php?page=moviesadmin";
            break;
        case "Đăng xuất":
            $nameChucnang = "dangxuat";
            $icon = "fa-regular fa-circle-left";
            // chay dong nay
            // if(isset($_SESSION['TenDN'])){
            //     unset($_SESSION['TenDN']);
            // }
            // header('location:./index.php');
            $href = "admin.php?page=index";
            break;
    }
    if ($tenchucnang != "Đăng xuất" && isset($_GET['mode'])) {
        $href = $href . '&mode=' . $_GET['mode'];
    }
    $liItem = $liItem . "<a  href='" . $href . "'><li name='" . $nameChucnang . "'><i class='" . $icon . "'></i><span>" . $tenchucnang . "</span></li></a>";
}
echo ' 
        <ul>
        ' . $liItem . '
        </ul>
    ';
function getMAQUYENtheoUSERNAME($USERNAME)
{
    require_once('./database/connectDatabase.php');
    // Thực hiện kết nối đến cơ sở dữ liệu

    $connection = new connectDatabase();

    // Thực hiện truy vấn (ví dụ)
    $query = "SELECT MAQUYEN FROM taikhoan WHERE USERNAME = '" . $USERNAME . "'"; // Truy vấn SQL của bạn
    $result = $connection->executeQuery($query);
    $MAQUYEN = null;
    if ($row = $result->fetch_assoc()) {
        $MAQUYEN = $row['MAQUYEN'];
    }
    $connection->disconnect();
    return $MAQUYEN;
    
}
function getCNtheoMAQUYEN($MAQUYEN)
{
    $chucnang = array();
    //Include file chứa class connectDatabase
    require_once('./database/connectDatabase.php');
    // Thực hiện kết nối đến cơ sở dữ liệu

    $connection = new connectDatabase();

    // Thực hiện truy vấn (ví dụ)
    $query = "SELECT DISTINCT TENCHUCNANG FROM chitietquyen_chucnang,chucnang where maquyen='" . $MAQUYEN . "'AND chitietquyen_chucnang.MACHUCNANG = chucnang.MACHUCNANG;"; // Truy vấn SQL của bạn
    $result = $connection->executeQuery($query);

    // Xử lý kết quả nếu cần
    if ($result) {
        // Thực hiện các thao tác với kết quả
        while ($row = $result->fetch_assoc()) {

            array_push($chucnang, $row['TENCHUCNANG']);
        }
    } else {
        echo 'thất bại';
        // Xử lý khi truy vấn thất bại
    }

    // Ngắt kết nối đến cơ sở dữ liệu khi đã xong
    $connection->disconnect();
    return $chucnang;
}
