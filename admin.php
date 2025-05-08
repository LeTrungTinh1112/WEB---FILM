<?php
session_start();
if (!isset($_SESSION['TenDN'])) {
    header('location: ./index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='shortcut icon' href='./img/iconweb2.ico' />
    <link rel="stylesheet" href="./css/admin.css" />
    <?php
    if (isset($_GET['mode']) && $_GET['mode'] == "night") {
        echo '<link rel="stylesheet" href="./css/admin_night.css" />';
    }
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <link rel="stylesheet" href="./css/thongke.css" />
    <title>MEME</title>
</head>

<body style="margin: 0;">
    <?php
    if (isset($_GET['page']) && $_GET['page'] == "index") {
        include "./pages/logout.php";
        header("Location: ./index.php");
        exit;
    }
    ?>
    <div class="wrapadmin">
        <nav class="menuadmin">
            <?php require './pages/menuadmin.php'; ?>
        </nav>
        <div class="contentadmin">
            <div class="headeradmin">
                <?php require './pages/headeradmin.php'; ?>
            </div>
            <?php
            if (isset($_GET['page'])) {
                $valid_pages = [
                    'moviesadmin',
                    'lichchieuphimadmin',
                    'dienvienadmin',
                    'ngayleadmin',
                    'suatchieuadmin',
                    'usersadmin',
                    'dichvuadmin',
                    'lsdatveadmin',
                    'baocaodoanhthu',
                    'phanquyenadmin',
                    'uudaiadmin',
                    'phongchieu',
                    'theloaiadmin'
                ];
                if (in_array($_GET['page'], $valid_pages)) {
                    switch ($_GET['page']) {
                        case "moviesadmin":
                        case "lichchieuphimadmin":
                            echo '<div class="name_model">Tìm kiếm</div>';
                            require "./pages/searchadmin.php";
                            break;
                    }
                }
            }
            ?>
            <div id="content" style="padding-top: 10px;">
                <?php
                if (isset($_GET['page'])) {
                    $valid_pages = [
                        'moviesadmin',
                        'lichchieuphimadmin',
                        'dienvienadmin',
                        'ngayleadmin',
                        'suatchieuadmin',
                        'usersadmin',
                        'dichvuadmin',
                        'lsdatveadmin',
                        'baocaodoanhthu',
                        'phanquyenadmin',
                        'uudaiadmin',
                        'phongchieu',
                        'theloaiadmin'
                    ];
                    $page_file = './pages/' . $_GET['page'] . '.php';
                    if (in_array($_GET['page'], $valid_pages) && file_exists($page_file)) {
                        require $page_file;
                    } else {
                        echo '<div id="none_select_cn">Chức năng không hợp lệ hoặc chưa được chọn</div>';
                    }
                } else {
                    echo '<div id="none_select_cn">Chưa lựa chọn chức năng</div>';
                }
                ?>
            </div>
        </div>
    </div>
    <div id="unclick_behind_this_screen"></div>

    <?php
    if (isset($_GET['page']) && $_GET['page'] == "phanquyenadmin") {
        echo '<script src="./js/phanquyenjs.js"></script>';
    } else {
        echo '<script src="./js/admin.js"></script>';
    }
    ?>
</body>

</html>