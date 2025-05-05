
    <?php

    if (isset($_POST['MAPM']))
        $MAPM = $_POST['MAPM'];
    else
        $MAPM = 'PM013';
    if (isset($_POST['ngay']))
        $ngay = $_POST['ngay'];
    else
        $ngay = '2024-05-10';
    if(!isset($_POST['update'])){
        $thongtinphim = thongtinphim($MAPM);
    if(!isset($_POST['selectSC'])){
    foreach ($thongtinphim as $row) {
        echo '   <div class="lichchieuphim_phim" id="change_lichchieuphim_phim" name="'.$MAPM.'">';
        echo " <img src='../img/" . $row['NAMEANH'] . "'>";
        echo '   <div class="lichchieuphim_right">';
        echo ' <h3 class="name_movie" style="margin:0;">' . $row['TENPHIM'] . '</h3>';
        echo ' <div><p>' . $row["THOILUONG"] . ' phút</p></div>';
        echo ' <div class="lichchieuphim_lichchieu_wrap">';
    }
    $phimvasuatchieu = listPhimvaSuatchieucuaphimtheoMAPM($MAPM, $ngay);
    foreach ($phimvasuatchieu as $row) {

        echo '  <div class="lichchieuphim_lichchieu" name="' . $row['MASC'] . '">
                    <input type="hidden"  value="' . $row['MALICHCHIEU'] . '">
                    <span class="time_start">' . $row['THOIGIANBATDAU'] . '</span>
                    <span>~<span>
                    <span class="time_end">' . $row['THOIGIANKETTHUC'] . '</span>
                    <span class="phongchieuSuatchieu"> ' . $row['MAPHONGCHIEU'] . '</span>
                </div>';
    }

    echo '
     </div>';
    
       echo '<div id="hide_choose_new_suatchieu" style="margin-top:10px;">Chọn suất chiếu để chỉnh sửa</div>';
}else{
    
        if(!isset($_POST['PC'])){
            
            if(checkSuatchieuduocchon($_POST['malichchieu'])){
                echo '<span>Không thể thay đổi!!! Do có vé đã đặt vào suất chiếu này</span>';
            }else{
                $phimvasuatchieu = listPhimvaSuatchieucuaphimtheoMAPM($MAPM, $ngay);
            echo ' <form id="div_choose_new_suatchieu" action="./pages/updateLichchieuphimadmin.php" method="POST" onsubmit="updateLCP();">'    ;
            echo '<input type="hidden" name="MAPM" value="'.$MAPM.'">';
            echo '<input type="hidden" name="ngay" value="'.$ngay.'">';
            echo '<input type="hidden" name="update" value="'.$phimvasuatchieu[0]['MALICHCHIEU'].'">';
            echo '<select name="selectSC" onchange="showListSCcothechonUpdate(this);" >';
            $listSC = getListSuatchieutheongay($ngay);
            $MASC = $_POST['selectSC'];
               
                foreach ($listSC as $sc) {
                    if ($sc['MASC'] == $MASC)
                        echo "<option value='" . $sc["MASC"] . "' selected>" . $sc["THOIGIANBATDAU"] . "</option>";
                    else
                        echo "<option value='" . $sc["MASC"] . "' >" . $sc["THOIGIANBATDAU"] . "</option>";
                }
            echo '</select>'      ;
            echo '<select name="selectPC" id="showPhongchieu">' ;
    
            
                

            $array = getListPhongchieuTheoUpdate($MASC, $ngay, $MAPM);
            
            
    
            $index = 0;
            foreach ($array as $row) {
                if ($index++ == 0)
                    echo "<option value='" . $row["MAPHONGCHIEU"] . "' selected>" . $row["TENPHONGCHIEU"] . "</option>";
                else
                    echo "<option value='" . $row["MAPHONGCHIEU"] . "' >" . $row["TENPHONGCHIEU"] . "</option>";
            }
            echo '   </select>
            <button type="submit" style="display:flex;background-color:black;color:white;width:fit-content;padding:3px;"><i class="fa-solid fa-check fa-fw"></i></button>
                   </div>'      ;
      
            }
            
        }else{

            $MASC = $_POST['MASC'];

            $array = getListPhongchieuTheoUpdate( $MASC , $ngay, $MAPM);
            $index = 0;
            foreach ($array as $row) {
                if ($index++ == 0)
                    echo "<option value='" . $row["MAPHONGCHIEU"] . "' selected>" . $row["TENPHONGCHIEU"] . "</option>";
                else
                    echo "<option value='" . $row["MAPHONGCHIEU"] . "' >" . $row["TENPHONGCHIEU"] . "</option>";
            }
        }
        
     }
    
    echo '</div>
       <span class="edit_suatchieu" id="exit_edit_suatchieu" name="'.$ngay.'" style="cursor:pointer;" onclick="hide_formUpdateLCP();"><i class="fa-solid fa-x"></i></span>
</form>';
    }else{
        $MASCluachon=$_POST['selectSC'];
        $MAPCluachon=$_POST['selectPC'];
        $MALICHCHIEU = $_POST['update'];

        $listSC = getListSuatchieutheongay($_POST['ngay']);
        foreach ($listSC as $sc) {
            if ($sc['MASC'] ==  $MASCluachon)
                $THOIGIANBATDAU = $sc['THOIGIANBATDAU'];
        }
        $THOIGIANKETTHUC = getTHOIGIANKETTHUC($_POST['MAPM'], $THOIGIANBATDAU);
        updateLCPInSQL($MASCluachon,$MAPCluachon,$MALICHCHIEU,$THOIGIANKETTHUC);
       echo 'sua thanh cong';
    }
    
    function updateLCPInSQL($MASC,$MAPHONGCHIEU,$MALICHCHIEU,$THOIGIANKETTHUC){

        require_once('../database/connectDatabase.php');
        $connection = new connectDatabase();

        // Thực hiện truy vấn (ví dụ)
        $query = "UPDATE lichchieuphim SET THOIGIANKETTHUC = '$THOIGIANKETTHUC',MASC='$MASC',MAPHONGCHIEU='$MAPHONGCHIEU' WHERE MALICHCHIEU = '$MALICHCHIEU'";
        $result = $connection->executeQuery($query);
    }
    
    function getListPhongchieuTheoUpdate($MASC, $ngay, $maphim)
    {
        $listSC = getListSuatchieutheongay($ngay);
        $listLCP = getListLichchieuphim($ngay);
        $listPC = getListPhongchieu();
        foreach ($listSC as $sc) {
            if ($sc['MASC'] == $MASC)
                $THOIGIANBATDAU = $sc['THOIGIANBATDAU'];
        }
     
        $THOIGIANKETTHUC = getTHOIGIANKETTHUC($maphim, $THOIGIANBATDAU);
        
        $array = array();
        foreach ($listSC as $sc) {

            if ($sc['MASC'] == $MASC) {
                foreach ($listPC as $pc) {
                    $flag = true;

                    $thoi_gian_1_BD = strtotime($sc['THOIGIANBATDAU']);


                    foreach ($listLCP as $lcp) {
                        //tim thay phong chieu dang duyet trong danh sach lich chieu phim
                        //kiem tra
                        //thoi gian bat dau dang xet voi thoi gian bat dau suat chieu cua lich chieu phim tim thay
                        //neu bang false
                        //neu <: kiem tra thoi gian ket thuc phim dang xet co < thoi gian bat dau suat chieu lich chieu phim dang xet
                        //neu < thi true, ngoai ra  false
                        //neu >: kiem tra thoi gian bat dau dang xet co lon hon thoi gian ket thuc suat chieu cua lich chieu phim dang xet
                        //neu > thi true, ngoai ra false
                        $thoi_gian_2_BD = strtotime($lcp['THOIGIANBATDAU']);
                        $thoi_gian_2_KT = strtotime($lcp['THOIGIANKETTHUC']);
                        if ($thoi_gian_1_BD  == $thoi_gian_2_BD && $pc['MAPHONGCHIEU'] == $lcp['MAPHONGCHIEU']) {
                            $flag = false;
                            break;
                        }
                        if ($thoi_gian_1_BD  < $thoi_gian_2_BD && $pc['MAPHONGCHIEU'] == $lcp['MAPHONGCHIEU']) {
                            if ($THOIGIANKETTHUC >=  $thoi_gian_2_BD) {
                                $flag = false;
                                break;
                            }
                        }
                        if ($thoi_gian_1_BD  > $thoi_gian_2_BD && $pc['MAPHONGCHIEU'] == $lcp['MAPHONGCHIEU']) {
                            if ($thoi_gian_1_BD <= $thoi_gian_2_KT) {
                                $flag = false;
                                break;
                            }
                        }
                    }

                    if ($flag) {
                        $phongchieu_info = array();
                        $phongchieu_info["MAPHONGCHIEU"] = $pc['MAPHONGCHIEU'];
                        $phongchieu_info["TENPHONGCHIEU"] = $pc['TENPHONGCHIEU'];
                        // Thêm mảng này vào mảng tổng hợp $array
                        $array[] = $phongchieu_info;
                    }
                }
            }
        }
        return $array;
    }
    function checkSuatchieuduocchon($MALICHCHIEU){
        require_once('../database/connectDatabase.php');
        $connection = new connectDatabase();

        // Thực hiện truy vấn (ví dụ)
        $query = "SELECT 	* FROM ve"; // Truy vấn SQL của bạn
        $result = $connection->executeQuery($query);

        // Xử lý kết quả nếu cần
        if ($result) {
            // Thực hiện các thao tác với kết quả
            while ($row = $result->fetch_assoc()) {
                if ($row['MALICHCHIEU'] === $MALICHCHIEU) 
                    return true;
            }
            return false;
        } else {
            echo 'thất bại roi kiaaa';
            return null;
            // Xử lý khi truy vấn thất bại
        }
        
    }

    function getTHOIGIANKETTHUC($maphim, $THOIGIANBATDAU)
    {
        // Đặt múi giờ hiện tại
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        // Thời gian hiện tại
        $current_time = strtotime($THOIGIANBATDAU);
        $thongtinphim=thongtinphim($maphim);
        foreach ($thongtinphim as $phim) {
           
                $thoiluong = intval($phim['THOILUONG']);
                $hour = floor($thoiluong / 60); // Số giờ là phần nguyên của kết quả chia
                $minute = $thoiluong % 60; // Số phút là phần dư của kết quả chia

                // Thêm số giờ và số phút vào thời gian hiện tại
                $new_time = strtotime("+$hour hours $minute minutes", $current_time);
                $new_time_formatted = date('H:i', $new_time);
                return $new_time_formatted;
            
        }
    }
    function getListPhongchieu()
    {

        $list = array();
        require_once('../database/connectDatabase.php');
        $connection = new connectDatabase();

        // Thực hiện truy vấn (ví dụ)
        $query = "SELECT 	* FROM phongchieu"; // Truy vấn SQL của bạn
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
    function getListLichchieuphim($ngay)
    {

        $list = array();
        require_once('../database/connectDatabase.php');
        $connection = new connectDatabase();

        // Thực hiện truy vấn (ví dụ)
        if($ngay != "All")
        $query = "SELECT * FROM suatchieu,lichchieuphim WHERE suatchieu.MASC = lichchieuphim.MASC AND NGAY = '$ngay'"; // Truy vấn SQL của bạn
        else
        $query = "SELECT * FROM lichchieuphim";
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
    function thongtinphim($maphim)
    {

        $table = array();

        require_once('../database/connectDatabase.php');
        $connection = new connectDatabase();

        // Thực hiện truy vấn (ví dụ)
        $query = "select * FROM phim WHERE MAPM = '$maphim'"; // Truy vấn SQL của bạn
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
    function listPhimvaSuatchieucuaphimtheoMAPM($maphim, $ngay)
    {

        $table = array();

        require_once('../database/connectDatabase.php');

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
    function getListSuatchieutheongay($ngay)
    {

        $list = array();
        require_once('../database/connectDatabase.php');
        $connection = new connectDatabase();
        $query;
        // Thực hiện truy vấn (ví dụ)
        if ($ngay == "all")
            $query = "SELECT 	* FROM suatchieu ";
        else
            $query = "SELECT 	* FROM suatchieu WHERE NGAY = '$ngay'"; // Truy vấn SQL của bạn
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
    ?>
