
    <?php

    if (!isset($_POST['selectFilm'])) {
        if (isset($_POST['ngay']))
            $ngay = $_POST['ngay'];
        else
            $ngay = date("2024-05-06");
        $list = getListPhimKhongcoLichchieuvaoNgay($ngay);
        $listSC = getListSuatchieu($ngay);
        if (!isset($_POST['PC']) && !isset($_POST['SC']) && !isset($_POST['newSCvaPC'])) {

            echo '
<form action="./pages/addLichchieuphim.php" id="form_addLichchieuphim" method="POST" >
    <div id="btn_exit_formAddLCP" onclick="hide_formAddLCP(1);"><i class="fa-solid fa-x"></i></div>
    <input type="text" value="' . $ngay . '" disabled style="width:100px;text-align:center;">
    <h1 style=" color: var(--primary_color);">Thêm lịch chiếu phim</h1>
    <input type="hidden" name="ngay" value="' . $ngay . '">
    
    <label for="selectFilm">
    Chọn phim
    <select name="selectFilm" id="selectFilm" onchange="show_SuatchieuvaPhongchieu_LCP();">';
            foreach ($list as $row) {
                echo '<option value="' . $row['MAPM'] . '">' . $row['TENPHIM'] . '</option>';
            }

            echo '</select>
    </label>';
            echo '<div id="wrapAll_selectSuatchieuandPhC" style="width:100%;height:200px;overflow: auto;">';
            echo '<div class="wrap_selectSuatchieuandPhC">
     <span class="btn_exit" onclick="removeSelectSCvaPC(this);"><i class="fa-solid fa-x fa-fw"></i></span>
    <h4 style="text-transform: none;">Suất chiếu và phòng chiếu</h4>';
            echo '<div class="selectSuatchieuandPhC" name="' . $ngay . '" >';
            echo '<select name="selectSC[]" onchange="showListSCcothechon(this);">';
            $index = 0;
            foreach ($listSC as $sc) {
                if ($index++ == 0)
                    echo "<option value='" . $sc["MASC"] . "' selected>" . $sc["THOIGIANBATDAU"] . "</option>";
                else
                    echo "<option value='" . $sc["MASC"] . "' >" . $sc["THOIGIANBATDAU"] . "</option>";
            }
            echo '</select>';
            echo '<select name="selectPC[]">';

            $mascdautien = $listSC[0]['MASC'];
            $maphim = $list[0]['MAPM'];
            $listMASCdachon = [];
            $listMAPCdachon = [];
            $array = getListPhongchieuTheo($mascdautien, $ngay, $maphim, $listMASCdachon, $listMAPCdachon);


            $index = 0;
            foreach ($array as $row) {
                if ($index++ == 0)
                    echo "<option value='" . $row["MAPHONGCHIEU"] . "' selected>" . $row["TENPHONGCHIEU"] . "</option>";
                else
                    echo "<option value='" . $row["MAPHONGCHIEU"] . "' >" . $row["TENPHONGCHIEU"] . "</option>";
            }
            echo '</select>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '<div class="wrap_selectSuatchieuandPhC" style="width: fit-content;padding:10px;cursor: pointer;font-weight:600;margin-top:5px;">';
            echo '<span class="btn_add" onclick="add_SuatchieuvaPhongchieu_LCP(this);" name="' . $ngay . '">Thêm</span>';
            echo '</div>';


            echo '<input type="submit" value="Xác nhận" id="btn_submit">
    
</form>';
        } else if (isset($_POST['SC'])) {
            $listSC = getListSuatchieu($ngay);
            foreach ($listSC as $sc) {
                echo "<option value='" . $sc["MASC"] . "'>" . $sc["THOIGIANBATDAU"] . "</option>";
            }
        } else if (isset($_POST['newSCvaPC'])) {
            echo '<div class="wrap_selectSuatchieuandPhC">
        <span class="btn_exit" onclick="removeSelectSCvaPC(this);"><i class="fa-solid fa-x fa-fw"></i></span>
       <h4 style="text-transform: none;">Suất chiếu và phòng chiếu</h4>';
            echo '<div class="selectSuatchieuandPhC" name="' . $ngay . '">';
            echo '<select name="selectSC[]" onchange="showListSCcothechon(this);">';
            $listSC = getListSuatchieu($ngay);
            $index = 0;
            foreach ($listSC as $sc) {
                if ($index++ == 0)
                    echo "<option value='" . $sc["MASC"] . "' selected>" . $sc["THOIGIANBATDAU"] . "</option>";
                else
                    echo "<option value='" . $sc["MASC"] . "' >" . $sc["THOIGIANBATDAU"] . "</option>";
            }
            echo '</select>';
            echo '<select name="selectPC[]">';

            $listMASC = $_POST['selectSC'];
            $listMAPC = $_POST['selectPC'];

            $mascdautien = $listSC[0]['MASC'];
            $maphim = $_POST['mapihm'];
            $listMASCdachon = json_decode($listMASC, true);
            $listMAPCdachon = json_decode($listMAPC, true);
            $array = getListPhongchieuTheo($mascdautien, $ngay, $maphim, $listMASCdachon, $listMAPCdachon);


            $index = 0;
            foreach ($array as $row) {
                if ($index++ == 0)
                    echo "<option value='" . $row["MAPHONGCHIEU"] . "' selected>" . $row["TENPHONGCHIEU"] . "</option>";
                else
                    echo "<option value='" . $row["MAPHONGCHIEU"] . "' >" . $row["TENPHONGCHIEU"] . "</option>";
            }
            echo '</select>';
            echo '</div>';
            echo '</div>';
        } else {

            $MASC = $_POST['MASC'];
            $maphim = $_POST['mapihm'];
            $listMASCdachon = json_decode($_POST['selectSC'], true);
            $listMAPCdachon = json_decode($_POST['selectPC'], true);
            $array = getListPhongchieuTheo($MASC, $ngay, $maphim, $listMASCdachon, $listMAPCdachon);
            $index = 0;
            foreach ($array as $row) {
                if ($index++ == 0)
                    echo "<option value='" . $row["MAPHONGCHIEU"] . "' selected>" . $row["TENPHONGCHIEU"] . "</option>";
                else
                    echo "<option value='" . $row["MAPHONGCHIEU"] . "' >" . $row["TENPHONGCHIEU"] . "</option>";
            }
        }
    } else {
       
       
        $ngay = $_POST['ngay'];
        $MAPM = $_POST['selectFilm'];
        $listMASCdachon = $_POST['selectSC'];
        $listMAPCdachon = $_POST['selectPC'];
       
        $listPhimkhongchieuvaongay = getListPhimKhongcoLichchieuvaoNgay($ngay);
        $listSC = getListSuatchieu($ngay);
        for($i=0;$i<count($listMASCdachon);$i++){
            if($listMASCdachon[$i] == "") continue;
            else{
                if($listMAPCdachon[$i] == "") continue;
                else {
                   
                    foreach ($listSC as $sc) {
                        if ($sc['MASC'] == $listMASCdachon[$i]){
                            $MALICHCHIEU = createMALICHCHIEU();
                            $THOIGIANBATDAU = $sc['THOIGIANBATDAU'];
                           
                            $tgketthuc=getTHOIGIANKETTHUC($MAPM, $listPhimkhongchieuvaongay, $THOIGIANBATDAU);
                         
                        }
                            
                    }
                    addLichchieuphimInSQL($listMASCdachon[$i], $MAPM, $MALICHCHIEU, $listMAPCdachon[$i], $tgketthuc);
                   
                   
                }
                   
            }
        }
        header("Location: ../admin.php?page=lichchieuphimadmin");
        exit;
    }

    
    function getTHOIGIANKETTHUC($maphim, $listPhimkhongchieuvaongay, $THOIGIANBATDAU)
    {
        // Đặt múi giờ hiện tại
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        // Thời gian hiện tại
        $current_time = strtotime($THOIGIANBATDAU);

        foreach ($listPhimkhongchieuvaongay as $phim) {
            if ($phim['MAPM'] == $maphim) {
                $thoiluong = intval($phim['THOILUONG']);
                $hour = floor($thoiluong / 60); // Số giờ là phần nguyên của kết quả chia
                $minute = $thoiluong % 60; // Số phút là phần dư của kết quả chia

                // Thêm số giờ và số phút vào thời gian hiện tại
                $new_time = strtotime("+$hour hours $minute minutes", $current_time);
                $new_time_formatted = date('H:i', $new_time);
                return $new_time_formatted;
            }
        }
    }

    function getListPhongchieuTheo($MASC, $ngay, $maphim, $listMASCdachon, $listMAPCdachon)
    {
        $listSC = getListSuatchieu($ngay);
        $listLCP = getListLichchieuphim($ngay);
        $listPC = getListPhongchieu();
        foreach ($listSC as $sc) {
            if ($sc['MASC'] == $MASC)
                $THOIGIANBATDAU = $sc['THOIGIANBATDAU'];
        }
        $listPhimkhongchieuvaongay = getListPhimKhongcoLichchieuvaoNgay($ngay);
        $THOIGIANKETTHUC = getTHOIGIANKETTHUC($maphim, $listPhimkhongchieuvaongay, $THOIGIANBATDAU);

        // Kiểm tra xem $listLCP có phần tử không trước khi truy cập
        if (count($listLCP) > 0) {
            for ($i = 0; $i < count($listMASCdachon); $i++) {
                // Tạo một mảng mới để lưu thông tin mới

                $newSchedule = array();

                // Gán các giá trị vào mảng mới
                $newSchedule['MAPM'] = $maphim;
                $newSchedule['MASC'] = $MASC;
                $newSchedule['MAPHONGCHIEU'] = $listMAPCdachon[$i];
                $newSchedule['THOIGIANKETTHUC'] = $THOIGIANKETTHUC;
                $newSchedule['THOIGIANBATDAU'] = $THOIGIANBATDAU;
                // Thêm mảng mới vào cuối mảng $listLCP
                $listLCP[count($listLCP)] = $newSchedule;
            }
        } else {
            for ($i = 0; $i < count($listMASCdachon); $i++) {
                // Tạo một mảng mới để lưu thông tin mới

                $newSchedule = array();

                // Gán các giá trị vào mảng mới
                $newSchedule['MAPM'] = $maphim;
                $newSchedule['MASC'] = $MASC;
                $newSchedule['MAPHONGCHIEU'] = $listMAPCdachon[$i];
                $newSchedule['THOIGIANKETTHUC'] = $THOIGIANKETTHUC;
                $newSchedule['THOIGIANBATDAU'] = $THOIGIANBATDAU;
                // Thêm mảng mới vào cuối mảng $listLCP
                $listLCP[$i] = $newSchedule;
            }
        }
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

    function createMALICHCHIEU()
    {
        $max = 0;
        $listLichchieuphim = getListLichchieuphim("All");
        foreach ($listLichchieuphim as $row) {
            $MALICHCHIEUlast = $row['MALICHCHIEU'];
            $so = preg_replace("/[^0-9]/", "", $MALICHCHIEUlast);
            $stt = (int)$so;
            if ($stt > $max) $max = $stt;
        }
        return "LC" . ($max + 1);
    }

    function createMASC()
    {
        $max = 0;
        $listLichchieuphim = getListSuatchieu("all");
        foreach ($listLichchieuphim as $row) {
            $MASClast = $row['MASC'];
            $so = preg_replace("/[^0-9]/", "", $MASClast);
            $stt = (int)$so;
            if ($stt > $max) $max = $stt;
        }
        return "SC" . ($max + 1);
    }

    function addSuatchieuInSQL($MASC, $ngay, $THOIGIANBATDAU)
    {
        echo 'Vao them suat chieu';
        require_once('../database/connectDatabase.php');
        $connection = new connectDatabase();
        // Thực hiện truy vấn (ví dụ)

        $query = "INSERT INTO suatchieu(MASC, NGAY, THOIGIANBATDAU) VALUES ('$MASC', '$ngay', '$THOIGIANBATDAU');"; // Truy vấn SQL của bạn
        $result = $connection->executeQuery($query);
    }

    function addLichchieuphimInSQL($MASC, $MAPM, $MALICHCHIEU, $MAPHONGCHIEU, $THOIGIANKETTHUC)
    {
        require_once('../database/connectDatabase.php');
        $connection = new connectDatabase();
        // Thực hiện truy vấn (ví dụ)

        $query = "INSERT INTO lichchieuphim(MAPM,MASC, MAPHONGCHIEU,MALICHCHIEU,THOIGIANKETTHUC) VALUES ('$MAPM','$MASC','$MAPHONGCHIEU','$MALICHCHIEU', '$THOIGIANKETTHUC');"; // Truy vấn SQL của bạn
        $result = $connection->executeQuery($query);
    }

    function getListPhimKhongcoLichchieuvaoNgay($ngay){

        require_once('../database/connectDatabase.php');
        //lay ra cac maphim va tenphim trong bảng phim
        $list = array();
        $connection = new connectDatabase();
        // Thực hiện truy vấn (ví dụ)
        // $query = "SElECT MAPM,TENPHIM,THOILUONG
        // FROM phim
        // WHERE TRANGTHAI = 1 AND MAPM NOT IN (
        // SELECT MAPM
        // FROM suatchieu,lichchieuphim
        // WHERE NGAY='" . $ngay . "' AND suatchieu.MASC = lichchieuphim.MASC )"; // Truy vấn SQL của bạn
        $query="SElECT MAPM,TENPHIM,THOILUONG
        FROM phim
        WHERE TRANGTHAI = 1";
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
            echo 'thất bại lay full phim khong co lich chieu vao ngay ' . $ngay;
            return null;
            // Xử lý khi truy vấn thất bại
        }
        return $list;
    }
    function getListSuatchieu($ngay)
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
    ?>
   
