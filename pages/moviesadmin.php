<?php

$listphim = getListMovie();
if (count($listphim) == 0) {
    echo "<div style=' text-align: center;'><h3>Không có kết quả tìm kiếm phù hợp</h3></div>";
    return;
}

function showChitietPhim($phim){
   
        echo '<div id="movie_change_infor">';

        echo '<div id="show_infor_movie_old" class="show_change_movie">';
        foreach ($phim as $row) {
            if ($row['MAPM'] == ($_GET['MAPM'])) {
                $theloai = getListTheloai($row['MAPM']);
                echo '<img src="./img/' . $row['NAMEANH'] . '">';
                echo ' <span class="show_infor_movie">';
                echo '<span class="infor_age_movie"';
                switch ($row['DOTUOI']) {
                    case 0:
                        echo ' style="background-color: blue;">';
                        echo 'P</span>';
                        break;
                    case 13:
                        echo ' style="background-color: #ddbc3f;">';
                        echo $row['DOTUOI'] . '+</span>';
                        break;
                    case 16:
                        echo ' style="background-color: #e88021;">';
                        echo $row['DOTUOI'] . '+</span>';
                        break;
                    case 18:
                        echo ' style="background-color: red;">';
                        echo $row['DOTUOI'] . '+</span>';
                        break;
                    default:
                        echo ' style="background-color: violet;">';
                        echo $row['DOTUOI'] . '+</span>';
                        break;
                }

                echo '<h3 style="text-transform:uppercase;">' . $row['TENPHIM'] . '</h3> ';
                echo '<div class="quocgia_movie">' . $row['QUOCGIA'] . '</div>';
                echo '<div class="thoiluong_movie">' . $row['THOILUONG'] . '</div>';
                echo '<div class="noidung_movie">' . $row['MOTA'] . '</div>';
                echo ' <div class="table_day_theloai">';
                echo '<div>Ngày chiếu</div>
                         <div>Thể loại</div>';
                echo '<div class="ngaychieu_movie">' . $row['NGAYCHIEU'] . '</div>';
                echo '<div class="theloai_movie">';

                if (!empty($theloai) && is_array($theloai)) {
                    foreach ($theloai as $key => $t) {
                        echo " " . $t['TENTHELOAI'];
                        if ($key != count($theloai) - 1) echo ",";
                    }
                }
                echo '</div>';
                echo '</div>';
                echo '<div>
            <div style="margin-bottom:4px;">Diễn viên</div>
            <span class="dienvien_movie">';
                $dienvien = getListDienvien($row['MAPM']);
                if (!empty($dienvien) && is_array($dienvien)) {
                    foreach ($dienvien as $key => $t) {
                        echo " " . $t['TENDV'];
                        if ($key != count($dienvien) - 1) echo ",";
                    }
                } else {
                    echo "Chưa cập nhật thông tin này";
                }
                echo '</span>
            </div>';
                echo ' <a href="' . $row['PATHTRAILER'] . '" class="show_trailer_movie" target="_blank">Click để xem Trailer</a>';
                echo '<div class="click_show_change_movie">
                            <i class="fa-solid fa-trash" name="' . $row['MAPM'] . '"></i>
                            <span id="click_show_infor_movie_new" name="show">Chỉnh sửa phim<i class="fa-solid fa-arrow-right" style="padding-left:10px;"></i><span>
                          </div>';
                echo '</span>';
                echo '</div>';
                echo '<span id="btn_exit"><i class="fa-solid fa-x"></i></span>';
                echo '<form style="padding:0;" action="./pages/addMovieadmin.php" method="POST" id="form_updatePhim" name="' . $row['MAPM'] . '">';
                echo '<div id="show_infor_movie_new" class="show_change_movie">';
                echo ' <span class="show_infor_movie">';

                echo '<div id="change_picture_movie">
                                <span>Thay đổi ảnh</span>
                                <input type="file" style="margin:8px 0;border:0;" name="NAMEANH" accept=".png, .jpg" name="NAMEANH">
                              </div>';
                echo '<div id="change_danhgia_movie" class="change_infor_movie">
                                     <span>Đánh giá</span>
                                     <input type="number" style="margin:8px 0;" placeholder="' . $row['DANHGIA'] . '" name="DANHGIA" step="0.1" min="0" max="10">
                                </div>';
                echo '<div id="change_dotuoi_movie" class="change_infor_movie">
                                     <span>Độ tuổi</span>
                                     <input type="number" style="margin:8px 0;" placeholder="' . $row['DOTUOI'] . '" name="DOTUOI">
                                </div>';
                echo '<div id="change_name_movie" class="change_infor_movie">
                                     <span>Tên phim</span>
                                     <input type="text" style="margin:8px 0;" placeholder="' . $row['TENPHIM'] . '" name="TENPHIM">
                              </div>';
                echo '
            <div id="change_quocgia_movie" class="change_infor_movie">
            <span>Quốc gia</span>
            <input type="text" style="margin:8px 0;" placeholder="' . $row['QUOCGIA'] . '" pattern="^[\\p{L} ]+$" title="Vui lòng chỉ nhập chữ cái" name="QUOCGIA">
            </div>';
                echo '            <div id="change_thoiluong_movie" class="change_infor_movie">
            <span>Thời lượng</span>
            <input type="number" style="margin:8px 0;" placeholder="' . $row['THOILUONG'] . '" name="THOILUONG">
            </div>';
                echo '            <div id="change_noidung_movie" class="change_infor_movie">
            <span>Nội dung</span>
            <input type="text" style="margin:8px 0;" placeholder="' . $row['MOTA'] . '" name="MOTA">
            </div>';
                echo '            <div id="change_ngaychieu_movie" class="change_infor_movie">
            <span>Ngày chiếu</span>
            <input type="date" style="margin:8px 0;" value="' . $row['NGAYCHIEU'] . '" name="NGAYCHIEU">
            </div>';
                echo '<div id="change_theloai_movie" class="change_infor_movie">
                         <span>Thể loại</span>
                         <span id="list_theloai">
                         <div id="click_show_theloai"   name="show" >Click để chọn thể loại</div>
                         <span id="show_list_theloai">';
                $fulltheloai = getListFullTheloai();
                foreach ($fulltheloai as $t) {
                    echo '<label for="' . $t['MATHELOAI'] . '">
                                                     <input type="checkbox" id="' . $t['MATHELOAI'] . '"';
                    foreach ($theloai as $tl) {
                        if ($t['MATHELOAI'] == $tl['MATHELOAI'])
                            echo 'checked';
                    }


                    echo ' name="THELOAI[]" value="' . $t['MATHELOAI'] . '">
                                                     <span>' . $t['TENTHELOAI'] . '</span>
                                                 </label>';
                }
                echo '</span>
                         </span>
                         </div>';
                //start hện diễn viên
                echo '<div id="change_dienvien_movie" class="change_infor_movie">
                         <span>Diễn viên</span>
                         <span id="list_dienvien">
                         <div id="click_show_dienvien"   name="show" >Click để chọn diễn viên</div>
                         <span id="show_list_dienvien">';
                $fulldienvien = getListFullDienvien();
                foreach ($fulldienvien as $t) {
                    echo '<label for="' . $t['MADV'] . '">
                                                     <input type="checkbox" id="' . $t['MADV'] . '"';
                    foreach ($dienvien as $tl) {
                        if ($t['MADV'] == $tl['MADV'])
                            echo 'checked';
                    }


                    echo ' name="DIENVIEN[]" value="' . $t['MADV'] . '">
                                                     <span>' . $t['TENDV'] . '</span>
                                                 </label>';
                }
                echo '</span>
                         </span>
                         </div>';
                //end hện diễn viên
                echo '            <div id="change_trailer_movie" class="change_infor_movie">
                        <span>Trailer</span>
                        <input type="text" style="margin:8px 0;" placeholder="' . $row['PATHTRAILER'] . '" name="PATHTRAILER">
                        </div>';
                echo '
                        <div id="btn_wrap_change_user">
                            <button type="reset">Xóa tất cả</button>
                            <button type="submit">Xác nhận</button>
                        </div>';
                echo '</span>';
                echo '</div>';
                echo '</form>';
                echo '</div>';
                break;
            }
        }
   
}
function showMovies($phim)
{
    echo '<div id="movies" >';
    echo '<div id="btn_add_phim" name="">Thêm phim <i class="fa-solid fa-plus" style="padding-left:10px;"></i></div>';
    foreach ($phim as $row) {
        echo '<span class="movie" name="' . $row['MAPM'] . '">';
        echo '<img src="./img/' . $row['NAMEANH'] . '">';
        echo '<h4>' . $row['TENPHIM'] . '</h4>';
        $theloai = getListTheloai($row['MAPM']);
        echo '<h5>';
        if (!empty($theloai) && is_array($theloai)) {
            foreach ($theloai as $key => $t) {
                echo " " . $t['TENTHELOAI'];
                if ($key != count($theloai) - 1) echo ",";
            }
        }
        echo '</h5>';
        echo '<span class="age_movie"';
        switch ($row['DOTUOI']) {
            case 0:
                echo ' style="background-color: blue;">';
                echo 'P</span>';
                break;
            case 13:
                echo ' style="background-color: #ddbc3f;">';
                echo $row['DOTUOI'] . '+</span>';
                break;
            case 16:
                echo ' style="background-color: #e88021;">';
                echo $row['DOTUOI'] . '+</span>';
                break;
            case 18:
                echo ' style="background-color: red;">';
                echo $row['DOTUOI'] . '+</span>';
                break;
            default:
                echo ' style="background-color: violet;">';
                echo $row['DOTUOI'] . '+</span>';
                break;
        }

        echo '<div class="click_change_infor_movie">Click để xóa/sửa</div>';
        echo '</span>';
    }
    echo '</div>';

    
}
// if (file_exists('../pages/pagination.php'))
//     require_once('../pages/pagination.php');
// else
//     require_once('./pages/pagination.php');

// if (file_exists('../pages/list_page_admin.php'))
//     require_once('../pages/list_page_admin.php');
// else
//     require_once('./pages/list_page_admin.php');

    $total_records = count($listphim);
    $limit = 8;
    
    // Xác định trang hiện tại
    $current_page = isset($_GET['index']) ? $_GET['index'] : 1;
    
    // Tính toán OFFSET
    $offset = ($current_page - 1) * $limit;
    
    // Truy vấn cơ sở dữ liệu để lấy dữ liệu phân trang
    for ($batdau = $offset; $batdau < $offset+$limit; $batdau++) {
        if(isset($listphim[$batdau]))
            $listPhimtheoPage[] = $listphim[$batdau];
        else break;
    }
    showMovies($listPhimtheoPage);
    if(isset($_GET['MAPM'])){
        showChitietPhim($listphim);
       
    }
   
    // Tạo các liên kết phân trang
    $total_pages = ceil($total_records / $limit);
    echo '<span id="list_page">';
    echo '<ul name="'.$current_page.'">';
    for ($i = 1; $i <= $total_pages; $i++) {
        if($i == $current_page)
            echo "<li id='active'><a href='../pages/moviesadmin.php?index=$i'>$i</a></li> ";
        else
            echo "<li ><a href='../pages/moviesadmin.php?index=$i'>$i</a></li> ";
    }
    echo '</ul>';
    echo '</span>';
 

function getListMovie()
{

    // if(isset($_GET['valueName']))  $name=$_GET['valueName'];
    // if(isset($_GET['valueTheloai'])) $theloai=$_GET['valueTheloai'];

    if (file_exists('../database/connectDatabase.php'))
        require_once('../database/connectDatabase.php');
    else
        require_once('./database/connectDatabase.php');
    // Thực hiện kết nối đến cơ sở dữ liệu

    $connection = new connectDatabase();
    $phim = array();

    // Thực hiện truy vấn (ví dụ)
    if (!isset($_POST['valueName']) && !isset($_POST['valueTheloai'])) {
        $query = "SELECT * FROM phim ";
    } else {

        if ($_POST['valueName'] != "") {
            if ($_POST['valueTheloai'] != "") {
                $name = $_POST['valueName'];
                $theloai = $_POST['valueTheloai'];
                $query = "SELECT * FROM phim,chitietphim_theloai WHERE phim.MAPM = chitietphim_theloai.MAPM AND MATHELOAI = '" . $theloai . "' AND TENPHIM LIKE '%" . $name . "%';";
            } else {
                $name = $_POST['valueName'];
                $query = "SELECT * FROM phim WHERE TENPHIM LIKE '%" . $name . "%';";
            }
        } else {
            if ($_POST['valueTheloai'] != "") {
                $theloai = $_POST['valueTheloai'];
                $query = "SELECT * FROM phim,chitietphim_theloai WHERE phim.MAPM = chitietphim_theloai.MAPM AND MATHELOAI = '" . $theloai . "' ;";
            } else {
                $query = "SELECT * FROM phim ";
            }
        }
    }

    // Truy vấn SQL của bạn
    $result = $connection->executeQuery($query);








    if ($result) {
        // Thực hiện các thao tác với kết quả
        while ($row = $result->fetch_assoc()) {
            if ($row['TRANGTHAI'] == 1)
                $phim[] = $row;
        }
    } else {
        echo 'thất bại';
        return null;
        // Xử lý khi truy vấn thất bại


    }
    // Xử lý kết quả nếu cần

    return $phim;
}
function getListFullTheloai()
{
    $theloaiofphim = array();
    if (file_exists('../database/connectDatabase.php'))
        require_once('../database/connectDatabase.php');
    else
        require_once('./database/connectDatabase.php');
    $connection = new connectDatabase();

    // Thực hiện truy vấn (ví dụ)
    $query = "SELECT  MATHELOAI,TENTHELOAI FROM theloai"; // Truy vấn SQL của bạn
    $result = $connection->executeQuery($query);

    // Xử lý kết quả nếu cần
    if ($result) {
        // Thực hiện các thao tác với kết quả
        while ($row = $result->fetch_assoc()) {
            $theloaiofphim[] = $row;
        }
    } else {
        echo 'thất bại';
        return null;
        // Xử lý khi truy vấn thất bại
    }
    return $theloaiofphim;
}
function getListTheloai($MAPM)
{
    $theloaiofphim = array();
    if (file_exists('../database/connectDatabase.php'))
        require_once('../database/connectDatabase.php');
    else
        require_once('./database/connectDatabase.php');
    // Thực hiện kết nối đến cơ sở dữ liệu

    $connection = new connectDatabase();

    // Thực hiện truy vấn (ví dụ)
    $query = "SELECT  theloai.MATHELOAI,TENTHELOAI FROM theloai,chitietphim_theloai WHERE theloai.MATHELOAI = chitietphim_theloai.MATHELOAI AND MAPM='" . $MAPM . "'"; // Truy vấn SQL của bạn
    $result = $connection->executeQuery($query);

    // Xử lý kết quả nếu cần
    if ($result) {
        // Thực hiện các thao tác với kết quả
        while ($row = $result->fetch_assoc()) {
            $theloaiofphim[] = $row;
        }
    } else {
        echo 'thất bại';
        return null;
        // Xử lý khi truy vấn thất bại
    }
    return $theloaiofphim;
}
function getListFullDienvien()
{
    $dienvien = array();
    if (file_exists('../database/connectDatabase.php'))
        require_once('../database/connectDatabase.php');
    else
        require_once('./database/connectDatabase.php');
    $connection = new connectDatabase();

    // Thực hiện truy vấn (ví dụ)
    $query = "SELECT  MADV,TENDV FROM dienvien"; // Truy vấn SQL của bạn
    $result = $connection->executeQuery($query);

    // Xử lý kết quả nếu cần
    if ($result) {
        // Thực hiện các thao tác với kết quả
        while ($row = $result->fetch_assoc()) {
            $dienvien[] = $row;
        }
    } else {
        echo 'thất bại';
        return null;
        // Xử lý khi truy vấn thất bại
    }
    return $dienvien;
}
function getListDienvien($MAPM)
{
    $dienvien = array();
    if (file_exists('../database/connectDatabase.php'))
        require_once('../database/connectDatabase.php');
    else
        require_once('./database/connectDatabase.php');
    // Thực hiện kết nối đến cơ sở dữ liệu

    $connection = new connectDatabase();

    // Thực hiện truy vấn (ví dụ)
    $query = "SELECT  dienvien.MADV,TENDV FROM dienvien,chitietphim_dienvien WHERE dienvien.MADV = chitietphim_dienvien.MADV AND MAPM='" . $MAPM . "'"; // Truy vấn SQL của bạn
    $result = $connection->executeQuery($query);

    // Xử lý kết quả nếu cần
    if ($result) {
        // Thực hiện các thao tác với kết quả
        while ($row = $result->fetch_assoc()) {
            $dienvien[] = $row;
        }
    } else {
        echo 'thất bại';
        return null;
        // Xử lý khi truy vấn thất bại
    }
    return $dienvien;
}
