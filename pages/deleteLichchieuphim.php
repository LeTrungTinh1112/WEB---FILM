

    <?php
    // $listMLCP = $_POST['listLCP'];
    // $listMAPCdachon = json_decode($listMLCP, true);
    // foreach ($listMAPCdachon as $row) {
    //     if (checkSuatchieuduocchon($row)) {
    //         echo 'Xóa thất bại! Do đã có vé mua ở suất chiếu của phim này';
    //         break;
    //     }
// }
// echo 'Xóa thành công';

if (isset($_POST['ngay']))
$ngay = $_POST['ngay'];
else
$ngay = date("2024-05-14");

if (isset($_POST['MAPM']))
$MAPM = $_POST['MAPM'];
else
$MAPM = "PM013";
if(!isset($_POST['MALICHCHIEU'])){
    $phim = getPhim($MAPM);
    $listSCandPCcuaphim=listPhimvaSuatchieucuaphimtheoMAPM($MAPM,$ngay);
        echo '
        <form action="./pages/deleteLichchieuphim.php" id="form_deleteLichchieuphim" method="POST" >
            <div id="btn_exit_formAddLCP" name="'.$ngay.'" onclick="hide_formAddLCP(2);"><i class="fa-solid fa-x"></i></div>
            <input type="text" value="' . $ngay . '" disabled style="width:100px;text-align:center;">
            <h1 style=" color: var(--primary_color);">Xóa lịch chiếu phim</h1>
            
            <input type="text" value="'.$phim[0]['TENPHIM'].'" disabled style="width:max-content;text-align:center;margin-bottom:10px;">
   

            ';
            echo '<div id="wrapAll_selectSuatchieuandPhC" style="width:100%;height:200px;overflow: auto;overflow-x:hidden;">';
            foreach($listSCandPCcuaphim as $row){
                echo '<div class="wrap_deleteSuatchieuandPhC" name="'.$row['MALICHCHIEU'].'">
                <input type="hidden" name="MALICHCHIEU[]" value="' . $row['MALICHCHIEU'] . '">
 <span class="btn_exit" onclick="deletelichchieuphim(this);"><i class="fa-solid fa-x fa-fw"></i></span>
<h4 style="text-transform: none;">Suất chiếu và phòng chiếu</h4>';
echo '<div class="deleteSuatchieuandPhC">';
echo '<span>'.$row['THOIGIANBATDAU'].'</span>';
echo '<span>'.$row['TENPHONGCHIEU'].'</span>';
echo '</div>';
echo '</div>';
            }
        echo '</div>';
        


        echo '<input type="submit" value="Xóa tất cả" id="btn_submit">
        </form>';

}else{
   $malichchieu = $_POST['MALICHCHIEU'];
 //  deleteInSQL($malichchieu);
 if(is_array($malichchieu)){
    foreach($malichchieu as $malc)
    deleteInSQL( $malc);
header("Location: ../admin.php?page=lichchieuphimadmin");
exit;
 }else
 deleteInSQL($malichchieu);
 
}
       
function deleteInSQL($MALICHCHIEU)
{
   
    require_once('../database/connectDatabase.php');
    $connection = new connectDatabase();
    // Thực hiện truy vấn (ví dụ)

    $query = "DELETE FROM lichchieuphim WHERE MALICHCHIEU = '$MALICHCHIEU';"; // Truy vấn SQL của bạn
    $result = $connection->executeQuery($query);
}
    function checkSuatchieuduocchon($MALICHCHIEU)
    {
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

    function getPhim($MAPM)
    {

        $list = array();
        require_once('../database/connectDatabase.php');
        $connection = new connectDatabase();
        $query;
        // Thực hiện truy vấn (ví dụ)
       
            $query = "SELECT 	* FROM phim WHERE MAPM = '$MAPM'"; // Truy vấn SQL của bạn
        $result = $connection->executeQuery($query);

        // Xử lý kết quả nếu cần
        if ($result) {
            // Thực hiện các thao tác với kết quả
            while ($row = $result->fetch_assoc()) {
                if ($row === null) {
                    return null;
                }else if($row['MAPM'] == $MAPM){
                    $list[] = $row;
                    break;
                }
                   
            }
        } else {
            echo 'thất bại roi kiaaa';
            return null;
            // Xử lý khi truy vấn thất bại
        }
        return $list;
    }

    function listPhimvaSuatchieucuaphimtheoMAPM($maphim,$ngay){

        $table = array();
        
            require_once('../database/connectDatabase.php');
        
            $connection = new connectDatabase();
    
            // Thực hiện truy vấn (ví dụ)
            $query = "select * FROM suatchieu,lichchieuphim,phongchieu WHERE suatchieu.MASC = lichchieuphim.MASC AND MAPM='".$maphim."' AND NGAY='".$ngay."' AND lichchieuphim.MAPHONGCHIEU = phongchieu.MAPHONGCHIEU"; // Truy vấn SQL của bạn
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
    ?>
    