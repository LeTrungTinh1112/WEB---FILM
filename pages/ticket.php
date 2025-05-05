<?php
$maVe="";
if(isset($_GET['mave'])){
    $maVe=$_GET['mave'];
    require_once('./database/connectDatabase.php');
$conn = new connectDatabase();
$sql = "SELECT   suatchieu.NGAY AS NGAYCHIEU, ve.NGAY AS NGAYDATVE, THOIGIAN, PHUONGTHUCTHANHTOAN, TONGTIEN, TENPHONGCHIEU, THOIGIANBATDAU, TENPHIM, HOTEN, EMAIL, SODIENTHOAI, PHANTRAMUUDAI
    FROM ve
    JOIN lichchieuphim ON ve.MALICHCHIEU = lichchieuphim.MALICHCHIEU
    JOIN suatchieu ON lichchieuphim.MASC = suatchieu.MASC
    JOIN phim ON lichchieuphim.MAPM = phim.MAPM
    JOIN taikhoan ON ve.USERNAME = taikhoan.USERNAME
    JOIN phongchieu ON lichchieuphim.MAPHONGCHIEU = phongchieu.MAPHONGCHIEU
    LEFT JOIN uudai ON ve.MAUUDAI = uudai.CODE
    WHERE ve.MAVE = '$maVe' ";

$result = $conn->executeQuery($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
} else {
    echo "<script>console.log('khong co ve')</script>";
}

$sqlDichVu = "SELECT SoLuong, TENDICHVU, PRICE
    FROM ve
    JOIN chitietve_dichvu ON ve.MAVE = chitietve_dichvu.MAVE
    JOIN dichvu ON chitietve_dichvu.MADICHVU = dichvu.MADICHVU
    WHERE ve.MAVE = '$maVe' ";

$sqlGhe = "SELECT MAGHE
FROM ve
JOIN chitietve_ghe ON ve.MAVE = chitietve_ghe.MAVE
WHERE ve.MAVE = '$maVe' ";

$sqlGiaGhe = "SELECT PRICE
FROM ve
JOIN chitietve_ghe ON ve.MAVE = chitietve_ghe.MAVE
WHERE ve.MAVE = '$maVe' ";
}
$resultDichVu = $conn->executeQuery($sqlDichVu);
$resultGiaDichVu = $conn->executeQuery($sqlDichVu);
$resultGhe = $conn->executeQuery($sqlGhe);
$resultGiaGhe = $conn->executeQuery($sqlGiaGhe);
if ($resultGiaGhe->num_rows > 0) {
    $totalsVe = 0;
    while($rowGiaGhe = $resultGiaGhe->fetch_assoc()) {
        $totalsVe += $rowGiaGhe['PRICE'];
    } 
}
if ($resultGiaDichVu->num_rows > 0) {
    $totals = 0;
    while($row1 = $resultGiaDichVu->fetch_assoc()) {
        $total =  $row1["SoLuong"] * $row1["PRICE"];
        $totals += $total;
    }
    $tongconglun = $totalsVe + $totals;
} else {
    echo "<script>console.log('khong co ve')</script>";
    $tongconglun = $totalsVe;
}

$conn->disconnect();
?>

<title>Chi tiết vé</title>
<div class="main_ve">
        <div class="grid">
            <div class="grid__row">
                <div class="grid__column-4">
                    <div class="app_side-left">
                        <div class="label_tittle">
                            <span class="label_tittle-text">
                                Chi tiết vé
                            </span>
                        </div>

                        <div class="info_user-wrap">
                            <div class="info_user-tittle">
                                <span class="info_user-tittle-text">
                                    Thông tin khách hàng
                                </span>
                            </div>
                            <div class="horizontal-line"></div>
                            <div class="info-user_item">
                                <div class="info-user_item-label">
                                    <span class="info-user_item-label_text">
                                        Họ và tên:
                                    </span>
                                </div>
                                <div class="info-user_item-input">
                                    <span class="info-user_item-input_text">
                                    <?php echo $row["HOTEN"]; ?>
                                    </span>
                                </div>
                            </div>
                            <div class="info-user_item">
                                <div class="info-user_item-label">
                                    <span class="info-user_item-label_text">
                                        Email:
                                    </span>
                                </div>
                                <div class="info-user_item-input">
                                    <span class="info-user_item-input_text">
                                    <?php echo $row["EMAIL"]; ?>
                                    </span>
                                </div>
                            </div>
                            <div class="info-user_item">
                                <div class="info-user_item-label">
                                    <span class="info-user_item-label_text">
                                        Điện thoại:
                                    </span>
                                </div>
                                <div class="info-user_item-input">
                                    <span class="info-user_item-input_text">
                                    <?php echo $row["SODIENTHOAI"]; ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="info_user-wrap">
                            <div class="info_user-tittle">
                                <span class="info_user-tittle-text">
                                    Tổng giá vé
                                </span>
                            </div>
                            <div class="horizontal-line"></div>
                            <div class="info-user_item">
                                <div class="money_item-label">
                                    <span class="info-user_item-label_text">
                                        Tổng tiền:
                                    </span>
                                </div>
                                <div class="money_item-input">
                                    <span class="info-user_item-input_text">
                                    <?php echo $tongconglun; ?>đ
                                    </span>
                                </div>
                            </div>
                            <div class="info-user_item">
                                <div class="money_item-label">
                                    <span class="info-user_item-label_text">
                                        Khuyến mãi:
                                    </span>
                                </div>
                                <div class="money_item-input">
                                    <span class="info-user_item-input_text">
                                        <?php
                                        $tienPhaiTra = $row["TONGTIEN"];
                                        $tienUD = $tongconglun - $tienPhaiTra;
                                        echo $tienUD;
                                        ?>
                                    </span>
                                </div>
                            </div>
                            <div class="info-user_item">
                                <div class="money_item-label">
                                    <span class="info-user_item-label_text">
                                        Sau khuyến mãi:
                                    </span>
                                </div>
                                <div class="money_item-input">
                                    <span class="info-user_item-input_text">
                                    <?php 
                                    echo $tienPhaiTra;?>đ
                                    </span>
                                </div>
                            </div>
                            <div class="info-user_item">
                                <div class="money_item-label">
                                    <span class="info-user_item-label_text">
                                        Thanh toán bằng:
                                    </span>
                                </div>
                                <div class="money_item-input">
                                    <span class="info-user_item-input_text">
                                    <?php echo $row["PHUONGTHUCTHANHTOAN"]; ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid__column-8">
                    <div class="app_side-right">
                        <div class="ticket_side">
                            <div class="info_user-tittle">
                                <span class="info_user-tittle-text">
                                    Vé
                                </span>
                            </div>
                            <div class="horizontal-line"></div>
                            <div class="detail_item">
                                <div class="detail_item-label">
                                    <span class="detail_item-label_text">
                                        Phim
                                    </span>
                                </div>
                                <div class="detail_item-content">
                                    <span class="detail_item-content_text bold">
                                    <?php echo $row["TENPHIM"]; ?>
                                    </span>
                                </div>
                            </div>

                            <div class="detail_item">
                                <div class="detail_item-label">
                                    <span class="detail_item-label_text">
                                        Mã vé
                                    </span>
                                </div>
                                <div class="detail_item-content">
                                    <span class="detail_item-content_text bold">
                                    <?php echo $maVe; ?>
                                    </span>
                                </div>
                            </div>

                            <div class="detail_item">
                                <div class="detail_item-label">
                                    <span class="detail_item-label_text">
                                        Ngày chiếu
                                    </span>
                                </div>
                                <div class="detail_item-content">
                                    <span class="detail_item-content_text">
                                    <?php echo $row["NGAYCHIEU"]; ?>
                                    </span>
                                </div>
                            </div>

                            <div class="detail_item">
                                <div class="detail_item-label">
                                    <span class="detail_item-label_text">
                                        Giờ chiếu
                                    </span>
                                </div>
                                <div class="detail_item-content">
                                    <span class="detail_item-content_text bold">
                                    <?php echo $row["THOIGIANBATDAU"]; ?>
                                    </span>
                                </div>
                            </div>

                            <div class="detail_item">
                                <div class="detail_item-label">
                                    <span class="detail_item-label_text">
                                        Rạp
                                    </span>
                                </div>
                                <div class="detail_item-content">
                                    <span class="detail_item-content_text">
                                        MeMe
                                    </span>
                                </div>
                            </div>

                            <div class="detail_item">
                                <div class="detail_item-label">
                                    <span class="detail_item-label_text">
                                        Phòng chiếu
                                    </span>
                                </div>
                                <div class="detail_item-content">
                                    <span class="detail_item-content_text">
                                    <?php echo $row["TENPHONGCHIEU"]; ?>
                                    </span>
                                </div>
                            </div>

                            <div class="detail_item">
                                <div class="detail_item-label">
                                    <span class="detail_item-label_text">
                                        Ghế
                                    </span>
                                </div>
                                <div class="detail_item-content">
                                    <span class="detail_item-content_text bold">
                                    
                                    <?php
                            if ($resultGhe->num_rows > 0) {
                                $tenGhe = "";
                                while($rowGhe = $resultGhe->fetch_assoc()) {
                                    $ghe = substr($rowGhe["MAGHE"], 3);
                                    $tenGhe .= $ghe . ", ";
                                }
                                $tenGhe = rtrim($tenGhe, ", ");
                            }
                            echo $tenGhe;
                            ?>
                                    </span>
                                </div>
                            </div>

                            <div class="detail_item">
                                <div class="detail_item-label" style="flex:2;">
                                    <span class="detail_item-label_text">
                                        Ngày đặt vé
                                    </span>
                                </div>
                                <div class="detail_item-content">
                                    <span class="detail_item-content_text">
                                    <?php echo $row["NGAYDATVE"]; ?>
                                    </span>
                                </div>
                            </div>
                            <div class="detail_item">
                                <div class="detail_item-label" style="flex:2;">
                                    <span class="detail_item-label_text">
                                        Thời gian đặt vé
                                    </span>
                                </div>
                                <div class="detail_item-content">
                                    <span class="detail_item-content_text">
                                    <?php echo $row["THOIGIAN"]; ?>
                                    </span>
                                </div>
                            </div>
                            

                            
                            
                            
                            <div class="padding_bottom"></div>

                            <div class="detail_item horizontal-line ggg">
                                <div class="detail_item-label Padding10">
                                    <span class="detail_item-label_text">
                                        Tổng
                                    </span>
                                </div>
                                <div class="detail_item-content Padding10">
                                    <span class="detail_item-content_text">
                                        
                                    <?php 
                                echo $totalsVe;
                             ?>đ
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="food_side">
                            <div class="info_user-tittle">
                                <span class="info_user-tittle-text">
                                    Thực phẩm
                                </span>
                            </div>
                            <div class="horizontal-line"></div>
                            <?php
                            if ($resultDichVu->num_rows > 0) {
                                while($row = $resultDichVu->fetch_assoc()) {
                                    echo "<div class='detail_food-item'>";
                                    echo "<div class='detail_food-item_name'>";
                                    echo "<span class='detail_food-item_name-text bold'>".$row["TENDICHVU"]."</span>";
                                    echo "</div>";
                                    echo "<div class='detail_food-item_price'>";
                                    echo "<div class='detail_food-item_price-multi'>";
                                    echo "<span class='detail_food-item_quantity'>".$row["SoLuong"]."</span>";
                                    echo "<span class='bold'>X</span>";
                                    echo "<span class='detail_food-item_cost'>".$row["PRICE"]."đ</span>";
                                    echo "</div>";
                                    $giaTungDV = $row["SoLuong"] * $row["PRICE"];
                                    echo "<div class='detail_food-item_price-total'>";
                                    echo "<span class='detail_food-item_price-total_text bol'>".$giaTungDV."đ</span>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</div>";
                                }
                                
                            } else {
                                echo "<script>console.log('khong co ve')</script>";
                            }
                            ?>
                            <!-- <div class="detail_food-item">
                                <div class="detail_food-item_name">
                                    <span class="detail_food-item_name-text bold">Bắp rang bơ</span>
                                </div>
                                <div class="detail_food-item_price">
                                    <div class="detail_food-item_price-multi">
                                        <span class="detail_food-item_quantity">1</span>
                                         <span class="bold">X</span>
                                        <span class="detail_food-item_cost">40.000đ</span>
                                    </div>
                                    <div class="detail_food-item_price-total">
                                        <span class="detail_food-item_price-total_text bold">40.000đ</span>
                                    </div>
                                </div>
                            </div> -->


                            <div class="padding_bottom"></div>
                            <div class="detail_item horizontal-line ggg">
                                <div class="detail_item-label Padding10">
                                    <span class="detail_item-label_text">
                                        Tổng
                                    </span>
                                </div>
                                <div class="detail_item-content Padding10 ">
                                    <span class="detail_item-content_text">
                                        <?php echo $totals; ?>đ
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid__row">
                <div class="grid__full-width btn_back-wrap">
                    <div class="btn_back">
                        Quay lại
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
    document.querySelector(".btn_back").addEventListener("click",()=>{
        window.location.href = "index.php?pages=history_ticket.php";
    });
</script>