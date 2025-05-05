<?php
require_once('../database/connectDatabase.php');
$conn = new connectDatabase();

$searchTerm = $_GET['query'];
if(!empty($searchTerm)){
    $sqlFilm = "SELECT TENPHIM,MAPM, NAMEANH, DANHGIA
    FROM phim
    WHERE TRANGTHAI = 1 AND TENPHIM LIKE '%$searchTerm%' ";
    $resultFilm = $conn->executeQuery($sqlFilm);

    if ($resultFilm->num_rows > 0) {
        while($row = $resultFilm->fetch_assoc()) {
            echo "<li class='scrollable-list_item'>";
            echo "<a href='./index.php?pages=chi-tiet-phim.php&MAPM=".$row["MAPM"]."'>";
            echo "<div class='scrollable-list__img'>";
            echo "<img src='./img/".$row['NAMEANH']."'>";
            echo "</div>";
            echo "<div class='scrollable-list__content'>";
            echo "<div class='scrollable-list__name'>".$row['TENPHIM']."</div>";
    
            $maPhim = $row["MAPM"];
            $sqlTheLoaiFilm = "SELECT TENTHELOAI
            FROM phim
            JOIN chitietphim_theloai ON phim.MAPM = chitietphim_theloai.MAPM
            JOIN theloai ON chitietphim_theloai.MATHELOAI = theloai.MATHELOAI 
            WHERE phim.MAPM = '$maPhim' ";
            $resultTheLoaiFilm = $conn->executeQuery($sqlTheLoaiFilm);
            if ($resultTheLoaiFilm->num_rows > 0) {
                // Output dữ liệu từ cột
                $tenTheLoai = "";
                while($rowTheLoai = $resultTheLoaiFilm->fetch_assoc()) {
                    $tenTheLoai .= $rowTheLoai["TENTHELOAI"] . ", ";
                }
                // Loại bỏ dấu phẩy cuối cùng
                $tenTheLoai = rtrim($tenTheLoai, ", ");
                echo "<div class='scrollable-list__type'>".$tenTheLoai."</div>";
            }
    
            echo "<div class='scrollable-list__icon'>";
            echo "<div class='scrollable-list__star'>";
            echo "<i class='fa-solid fa-star'></i>";
            echo "<span>".$row["DANHGIA"]."</span>";
            echo "</div>";
            echo "<div class='scrollable-list__signal'><img src='./img/signal-streams.svg'><span>Đang chiếu</span></div></div></div></a></li>";
        }
    
    }
}




?>


                                        
                                            
                                                
                                            
                                            
                                                
                                            
                                                
                                                    
                                                        
                                                        
                                                    
                                                    
                                    