<?php 
    if(isset($_GET['page'])){
        $chucnang;
        switch($_GET['page']){
            case "dienvienadmin":
                $chucnang="Quản lí diễn viên";
                break;
            case "ngayleadmin":
                $chucnang="Quản lí ngày lễ";
                break;
            case "suatchieuadmin":
                $chucnang="Quản lí suất chiếu";
                break;
            case "usersadmin":
                $chucnang="Quản lí nguời dùng";
                break;
            case "moviesadmin":
                $chucnang="Quản lí phim";
                break;
            case "lichchieuphimadmin":
                $chucnang="Quản lí lịch chiếu phim";
                break;
            case "dichvuadmin":
                $chucnang="Quản lí dịch vụ";
                break;
            case "lsdatveadmin":
                $chucnang="Lịch sử đặt vé";
                break;
            case "baocaodoanhthu":
                $chucnang="Thống kê";
                break;
            case "phanquyenadmin":
                $chucnang="Phân quyền chức năng";
                break;
            case "uudaiadmin":
                $chucnang="Ưu đãi";
                break;
            case "phongchieu":
                $chucnang="Quản lí phòng chiếu";
                break;
            case "theloaiadmin":
                $chucnang="Quản lí thể loại";
                break;
        }
        echo '<span>'. $chucnang .'</span>';
    }else echo '<span></span>';
    echo '<span>
        <i class="fa-solid fa-user-tie"></i>
        <span>'.$USERNAME.'</span>
    </span>';

?>