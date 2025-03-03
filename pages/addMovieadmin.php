
<?php

date_default_timezone_set('Asia/Ho_Chi_Minh');
$day = str_replace("/", "-", date("Y/m/d"));
if(!isset($_POST['thaotac'])){
    echo '<form action="./pages/addMovieadmin.php"  id="form_addMovie" onsubmit="addMovieadmin();">';
echo '<div id="btn_exit"><i class="fa-solid fa-x"></i></div>';
echo '<div id="show_add_movie_new" class="show_change_movie">';
echo ' <span class="show_infor_movie">';

echo '<div id="change_picture_movie">
                                <span>Chọn ảnh</span>
                                <input type="file"  accept=".png, .jpg" style="margin:8px 0;border: 0;" name="NAMEANH" required>
                              </div>';
echo '<div id="change_danhgia_movie" class="change_infor_movie">
                                     <span>Đánh giá</span>
                                     <input type="number" style="margin:8px 0;" placeholder="6.7" name="DANHGIA" step="0.1" min="0" max="10">
                                </div>';
echo '<div id="change_dotuoi_movie" class="change_infor_movie">
                                     <span>Độ tuổi</span>
                                     <input type="number" style="margin:8px 0;" placeholder="18" name="DOTUOI">
                                </div>';
echo '<div id="change_name_movie" class="change_infor_movie">
                                     <span>Tên phim *</span>
                                     <input type="text" style="margin:8px 0;" placeholder="MAI" name="TENPHIM" required>
                                     <h5 class="errorDataAdmin" name="TENPHIM"></h5>
                              </div>';
echo '
            <div id="change_quocgia_movie" class="change_infor_movie">
            <span>Quốc gia * </span>
            <input type="text" style="margin:8px 0;" placeholder="Việt Nam" name="QUOCGIA" pattern="^[\\p{L} ]+$" title="Vui lòng chỉ nhập chữ cái" required>
            </div>';
echo '            <div id="change_thoiluong_movie" class="change_infor_movie">
            <span>Thời lượng * </span>
            <input type="number" style="margin:8px 0;" placeholder="115 phút" name="THOILUONG" required>
            <h5 class="errorDataAdmin" name="THOILUONG"></h5>
            </div>';
echo '            <div id="change_noidung_movie" class="change_infor_movie">
            <span>Nội dung * </span>
            <input type="text" style="margin:8px 0;" placeholder="Mô tả phim" name="MOTA" required>
            <h5 class="errorDataAdmin" name="MOTA"></h5>
            </div>';
echo '            <div id="change_ngaychieu_movie" class="change_infor_movie">
            <span>Ngày chiếu * </span>
            
            
            <input type="date" style="margin:8px 0;" value="' . $day . '" name="NGAYCHIEU" min="' . $day . '" required>
            <h5 class="errorDataAdmin" name="NGAYCHIEU"></h5>
            </div>';
echo '<div id="change_theloai_movie" style="margin:5px 0;" class="change_infor_movie" onclick="clickToSelectTheloaiPhim(this);">
                         <span>Thể loại * </span>
                         <span id="list_theloai">
                         <div id="click_show_theloai"   name="show" >Click để chọn thể loại</div>
                         <span id="show_list_theloai">';
$fulltheloai = getListFullTheloai();
foreach ($fulltheloai as $t) {
    echo '<label for="' . $t['MATHELOAI'] . '">
                                                     <input type="checkbox" id="' . $t['MATHELOAI'] . '" name="THELOAI[]" value="' . $t['MATHELOAI'] . '">
                                                     <span>' . $t['TENTHELOAI'] . '</span>
                                                 </label>';
}
echo '</span>
                         </span>
                         <h5 class="errorDataAdmin" id="errorTL"></h5>
                         </div>';
                         //chọn diễn viên
                         echo '<div id="change_dienvien_movie" style="margin:5px 0;" class="change_infor_movie" onclick="clickToSelectDienvienPhim(this);">
                         <span>Diễn viên * </span>
                         <span id="list_dienvien">
                         <div id="click_show_dienvien"   name="show" >Click để chọn diễn viên</div>
                         <span id="show_list_dienvien">';
$fulldienvien = getListFullDienvien();
foreach ($fulldienvien as $t) {
    echo '<label for="' . $t['MADV'] . '">
                                                     <input type="checkbox" id="' . $t['MADV'] . '" name="DIENVIEN[]" value="' . $t['MADV'] . '">
                                                     <span>' . $t['TENDV'] . '</span>
                                                 </label>';
}
echo '</span>
                         </span>
                         <h5 class="errorDataAdmin" id="errorTL"></h5>
                         </div>';
                         //end chọn diễn viên
echo '            <div id="change_trailer_movie" class="change_infor_movie">
                        <span>Trailer</span>
                        <input type="text" style="margin:8px 0;" placeholder="https://www.youtube.com/watch?v=5APPENpUdu0" name="PATHTRAILER">
                        </div>';
echo '
                        <div id="btn_wrap_change_user">
                            <button type="reset">Xóa tất cả</button>
                            <button type="submit">Xác nhận</button>
                        </div>';
echo '</span>';
echo '</div>';
echo '</form>';
}else{
    $thaotac = $_POST['thaotac'];
    switch($thaotac){
        case "add":
            addMovie();
            echo "Thêm phim mới thành công";
            break;
        case "update":
            updateMovie();
            echo "Sửa phim thành công";
            break;
        case "delete":
            
            deletePhimInSQL();
            echo "Xóa phim thành công";
            break;
    }
    
}

function createMAPM(){
    $max =0;
    $listPhim = getListPhim();
    foreach($listPhim as $row){
        $MAPMlast = $row['MAPM'];
        $so = preg_replace("/[^0-9]/", "", $MAPMlast);
        $stt = (int)$so;
        if($stt > $max) $max = $stt;
    }
    return "PM".($max+1);
}

function createMATHELOAI(){
    $max =0;
    $listTL = getListFullTheloai();
    foreach($listTL as $row){
        $MATHELOAIlast = $row['MATHELOAI'];
        $so = preg_replace("/[^0-9]/", "", $MATHELOAIlast);
        $stt = (int)$so;
        if($stt > $max) $max = $stt;
    }
    return "TL".($max+1);
}

function addChitietTheloaiInSQL($MAPM,$THELOAI){
    require_once('../database/connectDatabase.php');
    $connection = new connectDatabase();
    // Thực hiện truy vấn (ví dụ)
    
    $query = "INSERT INTO chitietphim_theloai(MAPM,MATHELOAI) VALUES";
    $values="";
    foreach ($THELOAI as $value) {
        $values=$values." ('$MAPM','$value') ";
        if((array_search($value, $THELOAI)+1) == count($THELOAI))
            $values=$values.";";
        else
            $values=$values.",";
    }
    $result = $connection->executeQuery($query.$values);
}

function addChitietDienvienInSQL($MAPM,$DIENVIEN){
    require_once('../database/connectDatabase.php');
    $connection = new connectDatabase();
    // Thực hiện truy vấn (ví dụ)
    
    $query = "INSERT INTO chitietphim_dienvien(MAPM,MADV) VALUES";
    $values="";
    foreach ($DIENVIEN as $value) {
        $values=$values." ('$MAPM','$value') ";
        if((array_search($value, $DIENVIEN)+1) == count($DIENVIEN))
            $values=$values.";";
        else
            $values=$values.",";
    }
   
    $result = $connection->executeQuery($query.$values);
    
}

function addPhimInSQL($MAPM,$PATHTRAILER,$MOTA,$THOILUONG,$NGAYCHIEU,$QUOCGIA,$DANHGIA,$DOTUOI,$LUOTXEM,$TENPHIM,$NAMEANH){
    require_once('../database/connectDatabase.php');
    $connection = new connectDatabase();
    // Thực hiện truy vấn (ví dụ)
   
    $query = "INSERT INTO phim(MAPM,PATHTRAILER,MOTA,THOILUONG,NGAYCHIEU,QUOCGIA,DANHGIA,DOTUOI,LUOTXEM,TRANGTHAI,TENPHIM,NAMEANH) VALUES ('$MAPM','$PATHTRAILER','$MOTA','$THOILUONG','$NGAYCHIEU','$QUOCGIA','$DANHGIA','$DOTUOI','$LUOTXEM',1,'$TENPHIM','$NAMEANH');"; // Truy vấn SQL của bạn
    $result = $connection->executeQuery($query);
}

function deletePhimInSQL(){
    $MAPM=$_POST['MAPM'];
    require_once('../database/connectDatabase.php');
    $connection = new connectDatabase();
    // Thực hiện truy vấn (ví dụ)
   
    $query = "UPDATE phim SET TRANGTHAI=2 WHERE MAPM ='$MAPM'"; // Truy vấn SQL của bạn
    $result = $connection->executeQuery($query);
}
function updateChitietTheloaiInSQL($MAPM,$THELOAI){
    require_once('../database/connectDatabase.php');
    $connection = new connectDatabase();
    // Thực hiện truy vấn (ví dụ)
    $listtheloaiPhim=getListTheloai($MAPM);
    if(isset($listtheloaiPhim)){
        foreach($listtheloaiPhim as $tl){
            $query="DELETE FROM chitietphim_theloai WHERE MAPM='".$MAPM."' AND MATHELOAI='".$tl['MATHELOAI']."'";
            $result = $connection->executeQuery($query);
        }
    }
    
    addChitietTheloaiInSQL($MAPM,$THELOAI);

}
function updateChitietDienvienInSQL($MAPM,$DIENVIEN){
    require_once('../database/connectDatabase.php');
    $connection = new connectDatabase();
    // Thực hiện truy vấn (ví dụ)
    $listdienvienPhim=getListDienvien($MAPM);
    if(isset($listdienvienPhim)){
        foreach($listdienvienPhim as $tl){
            $query="DELETE FROM chitietphim_dienvien WHERE MAPM='".$MAPM."' AND MADV='".$tl['MADV']."'";
            $result = $connection->executeQuery($query);
        }
    }
    
    addChitietDienvienInSQL($MAPM,$DIENVIEN);

}


function updatePhimInSQL($MAPM,$PATHTRAILER,$MOTA,$THOILUONG,$NGAYCHIEU,$QUOCGIA,$DANHGIA,$DOTUOI,$TENPHIM,$NAMEANH){
    
    
    require_once('../database/connectDatabase.php');
    $connection = new connectDatabase();
    // Thực hiện truy vấn (ví dụ)   
    $listFullPhim=getListPhim();
    foreach( $listFullPhim as $p){
        if($p['TRANGTHAI']!=0 && $MAPM == $p['MAPM'])
        {
            if($p['PATHTRAILER']!=$PATHTRAILER){
                $query = "UPDATE phim SET PATHTRAILER='$PATHTRAILER' WHERE MAPM ='$MAPM'"; 
                $result = $connection->executeQuery($query);
            }
            if($p['MOTA']!=$MOTA  && $MOTA!=""){
                $query = "UPDATE phim SET MOTA='$MOTA' WHERE MAPM ='$MAPM'"; 
                $result = $connection->executeQuery($query);
            }
            if($p['THOILUONG']!=$THOILUONG && $THOILUONG!=""){
                $query = "UPDATE phim SET THOILUONG='$THOILUONG' WHERE MAPM ='$MAPM'"; 
                $result = $connection->executeQuery($query);
            }
            if($p['NGAYCHIEU']!=$NGAYCHIEU && $NGAYCHIEU!=""){
                $query = "UPDATE phim SET NGAYCHIEU='$NGAYCHIEU' WHERE MAPM ='$MAPM'"; 
                $result = $connection->executeQuery($query);
            }
            if($p['QUOCGIA']!=$QUOCGIA && $QUOCGIA!=""){
                $query = "UPDATE phim SET QUOCGIA='$QUOCGIA' WHERE MAPM ='$MAPM'"; 
                $result = $connection->executeQuery($query);
            }
            if($p['DANHGIA']!=$DANHGIA  && $DANHGIA!=""){
                $query = "UPDATE phim SET DANHGIA='$DANHGIA' WHERE MAPM ='$MAPM'"; 
                $result = $connection->executeQuery($query);
            }
            if($p['DOTUOI']!=$DOTUOI  && $DOTUOI!=""){
                $query = "UPDATE phim SET DOTUOI='$DOTUOI' WHERE MAPM ='$MAPM'"; 
                $result = $connection->executeQuery($query);
            }
            if($p['TENPHIM']!=$TENPHIM && $TENPHIM!=""){
                $query = "UPDATE phim SET TENPHIM='$TENPHIM' WHERE MAPM ='$MAPM'"; 
                $result = $connection->executeQuery($query);
            }
            if($p['NAMEANH']!=$NAMEANH && $NAMEANH!=""){
                $query = "UPDATE phim SET NAMEANH='$NAMEANH' WHERE MAPM ='$MAPM'"; 
                $result = $connection->executeQuery($query);
            }   
            break;
        }
    }
}
function updateMovie(){
    
    $NAMEANH=$_FILES['NAMEANH']['name'];
    //     //lấy tên thì  $NAMEANH['name'];
        $DANHGIA=$_POST['DANHGIA'];
        

        $DOTUOI=$_POST['DOTUOI'];
        
        $TENPHIM=$_POST['TENPHIM'];
        $QUOCGIA=$_POST['QUOCGIA'];
        $THOILUONG=$_POST['THOILUONG'];
        $MOTA=$_POST['MOTA'];
        $NGAYCHIEU=$_POST['NGAYCHIEU'];
        $THELOAI=$_POST['THELOAI'];
        $PATHTRAILER=$_POST['PATHTRAILER'];
        $DIENVIEN=$_POST['DIENVIEN'];
        $MAPM=$_POST['MAPM'];
        updateChitietDienvienInSQL($MAPM,$DIENVIEN);
       updateChitietTheloaiInSQL($MAPM,$THELOAI);
        updatePhimInSQL($MAPM,$PATHTRAILER,$MOTA,$THOILUONG,$NGAYCHIEU,$QUOCGIA,$DANHGIA,$DOTUOI,$TENPHIM,$NAMEANH);
}

function addMovie(){
    
    $NAMEANH=$_FILES['NAMEANH']['name'];
    //     //lấy tên thì  $NAMEANH['name'];
        $DANHGIA=$_POST['DANHGIA'];
        $DANHGIA = ($DANHGIA == "")?0:$DANHGIA;

        $DOTUOI=$_POST['DOTUOI'];
        $DOTUOI = ($DOTUOI == "")?0:$DOTUOI;
        $TENPHIM=$_POST['TENPHIM'];
        $QUOCGIA=$_POST['QUOCGIA'];
        $THOILUONG=$_POST['THOILUONG'];
        $MOTA=$_POST['MOTA'];
        $NGAYCHIEU=$_POST['NGAYCHIEU'];
        $THELOAI=$_POST['THELOAI'];
        $DIENVIEN=$_POST['DIENVIEN'];
        $PATHTRAILER=$_POST['PATHTRAILER'];

        $MAPM=createMAPM();
        addChitietDienvienInSQL($MAPM,$DIENVIEN);
        addChitietTheloaiInSQL($MAPM,$THELOAI);
        addPhimInSQL($MAPM,$PATHTRAILER,$MOTA,$THOILUONG,$NGAYCHIEU,$QUOCGIA,$DANHGIA,$DOTUOI,0,$TENPHIM,$NAMEANH);
}

function getListFullTheloai()
{
    $theloaiofphim = array();
    require_once('../database/connectDatabase.php');
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
function getListPhim(){
    $list = array();
    require_once('../database/connectDatabase.php');
    $connection = new connectDatabase();

    // Thực hiện truy vấn (ví dụ)
    $query = "SELECT 	* FROM phim"; // Truy vấn SQL của bạn
    $result = $connection->executeQuery($query);

    // Xử lý kết quả nếu cần
    if ($result) {
        // Thực hiện các thao tác với kết quả
        while ($row = $result->fetch_assoc()) {
            if ($row === null) {
                return null;
            }
            $list[]=$row;
        }
    } else {
        echo 'thất bại roi kiaaa';
        return null;
        // Xử lý khi truy vấn thất bại
    }
return $list;
}
function getListTheloai($MAPM){
    echo "dooo";
    $theloaiofphim = array();
    if (isset($_GET['pagecon']) || isset($_GET['MAPM']) || isset($_POST['MAPM']))
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
function getListDienvien($MAPM)
{
    $dienvien = array();
    if (isset($_GET['pagecon']) || isset($_GET['MAPM']) || isset($_POST['MAPM']))
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
function getListFullDienvien(){
    $dienvien = array();
    require_once('../database/connectDatabase.php');
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
?>
    
        
        
     

