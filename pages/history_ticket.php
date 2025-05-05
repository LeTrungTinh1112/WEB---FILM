<?php
$tenDN="";
if(isset($_SESSION['TenDN'])){
    $tenDN = $_SESSION['TenDN'];
    require_once('./database/connectDatabase.php');
$conn = new connectDatabase();
$sql = "SELECT MAPHONGCHIEU, suatchieu.NGAY, THOIGIANBATDAU, TENPHIM, NAMEANH, MAVE
    FROM ve
    JOIN lichchieuphim ON ve.MALICHCHIEU = lichchieuphim.MALICHCHIEU
    JOIN suatchieu ON lichchieuphim.MASC = suatchieu.MASC
    JOIN phim ON lichchieuphim.MAPM = phim.MAPM
    WHERE USERNAME = '$tenDN' ";

$result = $conn->executeQuery($sql);
}
?>

<title>Lịch sử mua vé</title>
<div class="main_lsmv">
        <!-- <div class="panel_filter">
            <a class="logo" href="index.php">
                <img class="logo_item" src="./img/logo.jpg" alt="">
            </a>
            <div class="panel_filter-tittle">
                Lịch sử vé xem phim
            </div>
            <div class="panel_filter-wrap">
                <div class="filter_cbb">
                    <select class="filter_cbb-item" name="filter_cbb-item">
                        <option value="Tất cả">Tất cả</option>
                        <option value="Vé phim sắp chiếu">Vé phim sắp chiếu</option>
                        <option value="Vé phim đã sử dụng">Vé phim đã sử dụng</option>
                    </select>
                </div>
                <div class="filter_search">
                    <input type="text" class="search-item" id="search" name="search"
                        placeholder="Type to search...">
                    <span class="search-icon">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                </div>
            </div>

        </div> -->
        <div class="ticket-history">
            <!-- <a class="ticket" href="index.php?pages=ticket.php">
                <img src="./img/hanhtinhkhi.jpg" alt="Phim 1">
                <div class="ticket-info">
                    <span class="film_name">Hành tinh khỉ</span>
                    <span class="text_ticket">Phòng chiếu: A1</span>
                    <span class="text_ticket">Ngày giờ chiếu: 13/04/2024 - 18:00</span>
                </div>
            </a> -->
            <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<a class='ticket' href='index.php?pages=ticket.php&mave=" . $row["MAVE"] . "'>";
                        echo "<img src='./img/".$row["NAMEANH"]."'>";
                        echo "<div class='ticket-info'>";
                        echo "<span class='film_name'>".$row["TENPHIM"]."</span>";
                        echo "<span class='text_ticket'>Phòng chiếu: ".$row["MAPHONGCHIEU"]."</span>";
                        echo "<span class='text_ticket'>Ngày giờ chiếu: ".$row["NGAY"]."-".$row["THOIGIANBATDAU"]."</span>";

                        echo "</div>";
                        echo "</a>";
                        
                    }
                    echo "</div>";
                } else {
                    echo"</div>";
                    echo"<div class='no_ticket'>Người dùng chưa từng mua vé</div>";
                }
                $conn->disconnect();
            ?>
            
            <!-- Thêm các vé xem phim khác vào đây -->
        
    </div>