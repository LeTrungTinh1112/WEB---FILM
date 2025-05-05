<?php
require_once('../database/connectDatabase.php');
$conn = new connectDatabase();

// Lấy từ khóa tìm kiếm từ tham số GET
$searchTerm = $_GET['query'];
$searchTheLoai = $_GET['theLoai'];
$searchQuocGia = $_GET['quocGia'];
$searchNam = $_GET['nam'];
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$items_per_page = 5;
$offset = ($page - 1) * $items_per_page;

// Xây dựng câu truy vấn cơ sở dữ liệu
$sqlConditions = "WHERE (TRANGTHAI = 1 OR TRANGTHAI = 2) AND TENPHIM LIKE '%$searchTerm%'";

if ($searchTheLoai != "Thể loại") {
    $sqlConditions .= " AND MAPM IN (SELECT MAPM FROM chitietphim_theloai JOIN theloai ON chitietphim_theloai.MATHELOAI = theloai.MATHELOAI WHERE TENTHELOAI = '$searchTheLoai')";
}

if ($searchQuocGia != "Quốc gia") {
    $sqlConditions .= " AND QUOCGIA = '$searchQuocGia'";
}

if ($searchNam != "Năm") {
    $sqlConditions .= " AND YEAR(NGAYCHIEU) = $searchNam";
}

$sqlFilm = "SELECT TENPHIM, NAMEANH, MAPM, DANHGIA, DOTUOI FROM phim $sqlConditions LIMIT $items_per_page OFFSET $offset";
$resultFilm = $conn->executeQuery($sqlFilm);

// Hiển thị kết quả
echo "<div class='grid__row'>";
if ($resultFilm->num_rows > 0) {
    // echo "<div class='grid__row' id='conchimnon'>";
    while ($row = $resultFilm->fetch_assoc()) {
        echo "<div class='grid__column-2-4'>";
        echo "<a class='product-item' href='./index.php?pages=chi-tiet-phim.php&MAPM=" . $row["MAPM"] . "'>";
        echo "<div class='product-item__img' style='background-image: url(./img/" . $row["NAMEANH"] . ");'></div>";
        echo "<div class='wrap__name'>";
        echo "<h4 class='product-item__movie-name individual textMenuFilm'>" . $row["TENPHIM"] . "</h4>";

        $maPhim = $row["MAPM"];
        $sqlTheLoaiFilm = "SELECT TENTHELOAI FROM phim JOIN chitietphim_theloai ON phim.MAPM = chitietphim_theloai.MAPM JOIN theloai ON chitietphim_theloai.MATHELOAI = theloai.MATHELOAI WHERE phim.MAPM = '$maPhim'";
        $resultTheLoaiFilm = $conn->executeQuery($sqlTheLoaiFilm);
        if ($resultTheLoaiFilm->num_rows > 0) {
            $tenTheLoai = "";
            while ($rowTheLoai = $resultTheLoaiFilm->fetch_assoc()) {
                $tenTheLoai .= $rowTheLoai["TENTHELOAI"] . ", ";
            }
            $tenTheLoai = rtrim($tenTheLoai, ", ");
            echo "<h6 class='product-item__category-name individual'>" . $tenTheLoai . "</h6>";
        }

        echo "</div>";
        echo "<div class='product-item__action'>";
        echo "<span class='product-item__star'><i class='goldStar fa-solid fa-star'></i></span>";
        echo "<span class='product-item__mark darkColor'>" . $row["DANHGIA"] . "</span>";
        echo "</div>";
        echo "<div class='product-item__age-limit'>";
        echo "<div class='product-item__age-limit-label'>";
        echo $row["DOTUOI"] . "+";
        echo "</div>";
        echo "</div>";
        echo "<div class='product-item__play'>";
        echo "<span class='product-item__play-icon'><i class='fa-solid fa-play'></i></span>";
        echo "</div>";
        echo "</a>";
        echo "</div>";
    }
echo "</div>";

    // Phân trang
    $sqlTotal = "SELECT COUNT(*) AS total FROM phim $sqlConditions";
    $resultTotal = $conn->executeQuery($sqlTotal);
    $totalItems = $resultTotal->fetch_assoc()['total'];
    $totalPages = ceil($totalItems / $items_per_page);

    
    echo "<div class='pagination'>";

    // Nút Previous
    if($totalPages > 1){
        if ($page > 1) {
            echo "<span class='pagination__item' onclick='searchFilm(" . ($page - 1) . ")'>
            <i class='fa-solid fa-angle-left'></i>
            </span>";
        }
    
        for ($i = 1; $i <= $totalPages; $i++) {
            if ($i == $page) {
                echo "<span class='pagination__item active' onclick='searchFilm($i)'>$i</span>";
            } else {
                echo "<span class='pagination__item' onclick='searchFilm($i)'>$i</span>";
            }
        }
    
        // Nút Next
        if ($page < $totalPages) {
            echo "<span class='pagination__item' onclick='searchFilm(" . ($page + 1) . ")'>
            <i class='fa-solid fa-angle-right'></i>
            </span>";
        }
    
        echo "</div>";
    }
} else {
    echo "<div class='khongcophim'>Rất tiếc, không tìm thấy phim phù hợp với lựa chọn của bạn<div>";
    echo "</div>";
}
?>
