<?php
require_once('../database/connectDatabase.php');
$conn = new connectDatabase();
// Lấy từ khóa tìm kiếm từ tham số GET
$searchTerm = $_GET['query'];
$searchTheLoai = $_GET['theLoai'];
$searchQuocGia = $_GET['quocGia'];
$searchNam = $_GET['nam'];
// Truy vấn cơ sở dữ liệu
if($searchTheLoai!="Thể loại"){
    if($searchNam!="Năm"){
        if($searchQuocGia!="Quốc gia"){
            $sqlFilm = "SELECT TENPHIM, NAMEANH, MAPM, DANHGIA, DOTUOI
        FROM phim
        
        WHERE (TRANGTHAI = 1 OR TRANGTHAI = 2) AND TENPHIM LIKE '%$searchTerm%' AND QUOCGIA = '$searchQuocGia'AND YEAR(NGAYCHIEU) =$searchNam AND
        MAPM IN (SELECT MAPM 
            FROM chitietphim_theloai
            JOIN theloai ON chitietphim_theloai.MATHELOAI = theloai.MATHELOAI
            where TENTHELOAI = '$searchTheLoai')";
        }else{
            $sqlFilm = "SELECT TENPHIM, NAMEANH, MAPM, DANHGIA, DOTUOI
        FROM phim
        WHERE (TRANGTHAI = 1 OR TRANGTHAI = 2) AND TENPHIM LIKE '%$searchTerm%' AND YEAR(NGAYCHIEU) =$searchNam AND
        MAPM IN (SELECT MAPM 
            FROM chitietphim_theloai
            JOIN theloai ON chitietphim_theloai.MATHELOAI = theloai.MATHELOAI
            where TENTHELOAI = '$searchTheLoai')";
        }
    }else{
        if($searchQuocGia!="Quốc gia"){
            $sqlFilm = "SELECT TENPHIM, NAMEANH, MAPM, DANHGIA, DOTUOI
        FROM phim
        WHERE (TRANGTHAI = 1 OR TRANGTHAI = 2) AND TENPHIM LIKE '%$searchTerm%' AND QUOCGIA = '$searchQuocGia' AND
        MAPM IN (SELECT MAPM 
            FROM chitietphim_theloai
            JOIN theloai ON chitietphim_theloai.MATHELOAI = theloai.MATHELOAI
            where TENTHELOAI = '$searchTheLoai')";
        }else{
            $sqlFilm = "SELECT TENPHIM, NAMEANH, MAPM, DANHGIA, DOTUOI
        FROM phim
        WHERE (TRANGTHAI = 1 OR TRANGTHAI = 2) AND TENPHIM LIKE '%$searchTerm%' AND
        MAPM IN (SELECT MAPM 
            FROM chitietphim_theloai
            JOIN theloai ON chitietphim_theloai.MATHELOAI = theloai.MATHELOAI
            where TENTHELOAI = '$searchTheLoai')";
        }
    }

}else{
    if($searchNam!="Năm"){
        if($searchQuocGia!="Quốc gia"){
            $sqlFilm = "SELECT TENPHIM, NAMEANH, MAPM, DANHGIA, DOTUOI
        FROM phim
        WHERE (TRANGTHAI = 1 OR TRANGTHAI = 2) AND TENPHIM LIKE '%$searchTerm%' AND QUOCGIA = '$searchQuocGia'AND YEAR(NGAYCHIEU) =$searchNam";
        }else{
            $sqlFilm = "SELECT TENPHIM, NAMEANH, MAPM, DANHGIA, DOTUOI
        FROM phim
        WHERE (TRANGTHAI = 1 OR TRANGTHAI = 2) AND TENPHIM LIKE '%$searchTerm%' AND YEAR(NGAYCHIEU) =$searchNam";
        }
    }else{
        if($searchQuocGia!="Quốc gia"){
            $sqlFilm = "SELECT TENPHIM, NAMEANH, MAPM, DANHGIA, DOTUOI
        FROM phim
        WHERE (TRANGTHAI = 1 OR TRANGTHAI = 2) AND TENPHIM LIKE '%$searchTerm%' AND QUOCGIA = '$searchQuocGia'";
        }else{
            $sqlFilm = "SELECT TENPHIM, NAMEANH, MAPM, DANHGIA, DOTUOI
        FROM phim
        WHERE (TRANGTHAI = 1 OR TRANGTHAI = 2) AND TENPHIM LIKE '%$searchTerm%' ";
        }
    }
}




$resultFilm = $conn->executeQuery($sqlFilm);
// Hiển thị kết quả
if ($resultFilm->num_rows > 0) {
    while($row = $resultFilm->fetch_assoc()) {
        echo "<div class='grid__column-2-4'>";
        echo"<a class='product-item' href='./index.php?pages=chi-tiet-phim.php&maPhim=".$row["MAPM"]."'>";
        echo"<div class='product-item__img' style='background-image: url(./img/".$row["NAMEANH"].");'></div>";
        echo"<div class='wrap__name'>";
        echo"<h4 class='product-item__movie-name individual textMenuFilm'>".$row["TENPHIM"]."</h4>";

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
            echo"<h6 class='product-item__category-name individual'>".$tenTheLoai."</h6>";
        }

        
        echo"</div>";
        echo"<div class='product-item__action'>";
        echo"<span class='product-item__star'><i class='goldStar fa-solid fa-star'></i></span>";
        echo"<span class='product-item__mark darkColor'>".$row["DANHGIA"]."</span>";
        echo"</div>";
        echo"<div class='product-item__age-limit'>";
        echo"<div class='product-item__age-limit-label'>";
        echo $row["DOTUOI"]."+";
        echo"</div>";
        echo"</div>";
        echo"<div class='product-item__play'>";
        echo"<span class='product-item__play-icon'><i class='fa-solid fa-play'></i></span>";
        echo"</div>";
        echo"</a>";
        echo"</div>";
        
    }
} else {
    echo "<div class='khongcophim'>Rất tiếc, không tìm thấy phim phù hợp với lựa chọn của bạn<div>";
}
?>