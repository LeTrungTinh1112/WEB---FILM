<?php 
    echo '<div id="history_ticket_wrap">
    <div class="history_ticket header_history_ticket">
            <span>Mã vé</span>
            <span>Mã lịch chiếu</span>
            <span>USERNAME</span>
            <span>Thời gian</span>
            <span>Thành tiền</span>
            <span></span>
    </div>
    <div class="content_history_ticket">';
    $lsdatve=getListLichsudatve();
    foreach($lsdatve as $row){
        echo '<div class="history_ticket">';
        echo '<span>'.$row['MAVE'].'</span>';
        echo '<span>'.$row['MALICHCHIEU'].'</span>';
        echo '<span>'.$row['USERNAME'].'</span>';
        echo '<span>
                <span>'.$row['NGAY'].'</span>,
                <span>'.$row['THOIGIAN'].'</span>
            </span>';
        echo '<span>
                <span>'.$row['TONGTIEN'].'</span>
                <i class="fa-solid fa-dong-sign"></i>
            </span>';
        echo '<span class="icon-show" style="cursor:pointer;width:10px;" name="'.$row['MAVE'].'"><i class="fa-regular fa-eye"></i></span>';
        echo ' </div>';
    }         
    echo '</div>
</div>';

if(isset($_GET['MAVE'])) {
    $mave = $_GET['MAVE'];
    require_once('../database/connectDatabase.php');
    $conn = new connectDatabase();
    $query = "SELECT ve.MAVE, ve.TONGTIEN, ve.PHUONGTHUCTHANHTOAN, taikhoan.USERNAME, lichchieuphim.MALICHCHIEU, phim.TENPHIM, suatchieu.NGAY, suatchieu.THOIGIANBATDAU, phongchieu.TENPHONGCHIEU, uudai.PHANTRAMUUDAI
    FROM ve 
    JOIN taikhoan ON ve.USERNAME= taikhoan.USERNAME
    JOIN lichchieuphim ON ve.MALICHCHIEU = lichchieuphim.MALICHCHIEU
    JOIN phim ON lichchieuphim.MAPM = phim.MAPM
    JOIN suatchieu ON lichchieuphim.MASC = suatchieu.MASC
    JOIN phongchieu ON lichchieuphim.MAPHONGCHIEU = phongchieu.MAPHONGCHIEU
    LEFT JOIN uudai ON ve.MAUUDAI = uudai.CODE
    WHERE ve.MAVE = '$mave'";
    $result = $conn->executeQuery($query);
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
    } else{
        echo "<script> alert('MA VE KHONG TONTAI')</script>";
    }

    $queryDichVu = "SELECT dichvu.TENDICHVU, chitietve_dichvu.SOLUONG, dichvu.PRICE
    FROM chitietve_dichvu 
    JOIN dichvu ON chitietve_dichvu.MADICHVU = dichvu.MADICHVU
    WHERE chitietve_dichvu.MAVE = '$mave'";

    $queryGhe = "SELECT chitietve_ghe.MAGHE
    FROM ve 
    JOIN chitietve_ghe ON ve.MAVE = chitietve_ghe.MAVE
    WHERE ve.MAVE = '$mave'";

    $countGhe = "SELECT COUNT(*) as soluongghe FROM chitietve_ghe WHERE MAVE = '$mave'";

    $resultDichVu = $conn->executeQuery($queryDichVu);
    $resultGhe = $conn->executeQuery($queryGhe);
    $resultCountGhe = $conn->executeQuery($countGhe);
    

echo '<div class="ticket-history" id="ticket-history" >';
echo '<div class="ticket-title"> CHI TIẾT VÉ XEM PHIM <i id="icon-close" class="fa-solid fa-xmark"></i></div>';
echo '<div class="ticket">';
echo '<div class="ticket-info">';
echo '<div><strong>Mã vé:</strong> '.$row['MAVE'].'</div>';
echo '<div><strong>Tên phim:</strong> '.$row['TENPHIM'].'</div>';
echo '<div><strong>Ngày chiếu:</strong> '.$row['NGAY'].' </div>';
echo '<div><strong>Giờ chiếu:</strong>'.$row['THOIGIANBATDAU'].'</div>';
echo '<div><strong>Tên phòng chiếu:</strong> '.$row['TENPHONGCHIEU'].'</div>';
echo '<div><strong>Số ghế:</strong>';
if($resultCountGhe->num_rows > 0){
    $rowCountGhe = $resultCountGhe->fetch_assoc();
        echo $rowCountGhe['soluongghe'];
}
echo '</div>';
echo '<div><strong>Mã ghế:</strong>'; 
    if($resultGhe->num_rows > 0){
        while($rowGhe = $resultGhe->fetch_assoc()){
            echo $rowGhe['MAGHE'] . ' ';
        }
    }
echo '</div>';
echo '</div>';
echo '<tr>';
echo '<div class="service-list">';
echo '<div class="service-title">';
echo '<strong>Dịch vụ:</strong>';
echo '</div>';
if($resultDichVu->num_rows > 0){
    while($rowDV = $resultDichVu->fetch_assoc()) {
echo '<div class="service">';
echo '<div class="service-type">'.$rowDV['TENDICHVU'].'</div>';
echo ' <div>Số lượng: '.$rowDV['SOLUONG'].'</div>';
echo '<div>Giá: '.$rowDV['PRICE'].'</div>';
echo '</div>';
    }
}
echo '</div>';
echo '<div class="ticket-info">';
echo '<div><strong>Phương thức thanh toán:</strong>'.$row['PHUONGTHUCTHANHTOAN'].'</div>';
echo '<div><strong>Khuyến mã:</strong> ' . (($row['PHANTRAMUUDAI'] > 0) ? $row['PHANTRAMUUDAI'] . '%' : '0%') . '</div>';
echo '<div><strong>Tổng tiền:</strong>'.$row['TONGTIEN'].'</div>';
echo '</div>';
echo '</div>';
echo '</div>';
}

function getListLichsudatve(){
    $lsdatve=array();
    if(isset($_GET['MAVE'])){
        require_once('../database/connectDatabase.php');
    } else{
        require_once('./database/connectDatabase.php');
    }

$connection = new connectDatabase();

$query = "SELECT * FROM ve "; 
$result = $connection->executeQuery($query);

if ($result) {
    while ($row = $result->fetch_assoc()) {
       $lsdatve[]=$row;
    }
} else {
    echo'thất bại';
    return null;
}
return $lsdatve;
}

?>