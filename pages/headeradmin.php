<?php
// Gỡ lỗi: In giá trị $_GET để kiểm tra
// var_dump($_GET); // Bỏ comment để gỡ lỗi, sau đó comment lại

// Kiểm tra và xử lý $_GET['page']
$page = isset($_GET['page']) && is_scalar($_GET['page']) ? $_GET['page'] : '';

$chucnang = '';
if ($page) {
    switch ($page) {
        case "dienvienadmin":
            $chucnang = "Quản lí diễn viên";
            break;
        case "ngayleadmin":
            $chucnang = "Quản lí ngày lễ";
            break;
        case "suatchieuadmin":
            $chucnang = "Quản lí suất chiếu";
            break;
        case "usersadmin":
            $chucnang = "Quản lí nguời dùng";
            break;
        case "moviesadmin":
            $chucnang = "Quản lí phim";
            break;
        case "lichchieuphimadmin":
            $chucnang = "Quản lí lịch chiếu phim";
            break;
        case "dichvuadmin":
            $chucnang = "Quản lí dịch vụ";
            break;
        case "lsdatveadmin":
            $chucnang = "Lịch sử đặt vé";
            break;
        case "baocaodoanhthu":
            $chucnang = "Thống kê";
            break;
        case "phanquyenadmin":
            $chucnang = "Phân quyền chức năng";
            break;
        case "uudaiadmin":
            $chucnang = "Ưu đãi";
            break;
        case "phongchieu":
            $chucnang = "Quản lí phòng chiếu";
            break;
        case "theloaiadmin":
            $chucnang = "Quản lí thể loại";
            break;
        default:
            $chucnang = '';
            break;
    }
}

// Đảm bảo $USERNAME là chuỗi
$username = isset($USERNAME) && is_scalar($USERNAME) ? htmlspecialchars($USERNAME) : 'Unknown';

?>
<span><?php echo htmlspecialchars($chucnang); ?></span>
<span>
    <i class="fa-solid fa-user-tie"></i>
    <span><?php echo $username; ?></span>
</span>