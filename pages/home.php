<?php
require_once('./database/connectDatabase.php');
$conn = new connectDatabase();
$sqlPDC = "SELECT TENPHIM, NAMEANH, MAPM, DANHGIA, DOTUOI 
    FROM phim
    WHERE TRANGTHAI = 1 ";
$resultPDC = $conn->executeQuery($sqlPDC);

$sqlPSC = "SELECT TENPHIM, NAMEANH, MAPM, DANHGIA, DOTUOI 
    FROM phim
    WHERE TRANGTHAI = 0 ";
$resultPSC = $conn->executeQuery($sqlPSC);

$sqlFilm = "SELECT TENPHIM, NAMEANH, MAPM, DANHGIA, DOTUOI 
    FROM phim
    WHERE TRANGTHAI = 1 OR TRANGTHAI = 2";
$resultFilm = $conn->executeQuery($sqlFilm);
function chuoiTheLoai($maPM) {
    $sql = "SELECT TENTHELOAI
            FROM phim
            JOIN chitietphim_theloai ON phim.MAPM = chitietphim_theloai.MAPM
            JOIN theloai ON chitietphim_theloai.MATHELOAI = theloai.MATHELOAI 
            WHERE phim.MAPM = '$maPM'";
    $conn = new connectDatabase();
    $result = $conn->executeQuery($sql);
    $conn->disconnect();
    if ($result->num_rows > 0) {
        $tenTheLoai = "";
        while($rowTheLoai = $result->fetch_assoc()) {
            $tenTheLoai .= $rowTheLoai["TENTHELOAI"] . ", ";
        }
        // Loại bỏ dấu phẩy cuối cùng
        $tenTheLoai = rtrim($tenTheLoai, ", ");
        return $tenTheLoai;
    } else {
        return "Không có thể loại";
    }
}

?>

<title>Trang chủ</title>
<div class="main_home">
<div class="phimdangchieu">
    <!-- Thêm thẻ video làm nền -->
    <video autoplay muted loop id="myVideo">
        <source src="http://localhost/doan_web2/Video/VideoBG1.mp4" type="video/mp4">
        Your browser does not support HTML5 video.
    </video>

    <div class="grid">
        <div class="grid__row">
            <div class="grid__full-width">
                <span class="btn_next-film" id="btn_next_phimdangchieu">
                    <i class="fa-solid fa-chevron-right"></i>
                </span>
                <span class="btn_prev-film" id="btn_prev_phimdangchieu">
                    <i class="fa-solid fa-chevron-left"></i>
                </span>
                <div class="grid__column wrap-bottom">

                    <div class="home-tittle">
                        <span class="sparkle">
                            Phim Đang Chiếu
                        </span>
                    </div>
                    <div class="home-product">
                        <div class="grid__row_no_wrap" id="slide_phimdangchieu">

                            <?php
                                if ($resultPDC->num_rows > 0) {
                                    while($row = $resultPDC->fetch_assoc()) {
                                        echo "<div class='grid__column-2-4'>";
                                        echo"<a class='product-item' href='./index.php?pages=chi-tiet-phim.php&MAPM=".$row["MAPM"]."'>";
                                        echo"<div class='product-item__img' style='background-image: url(./img/".$row["NAMEANH"].");'></div>";
                                        echo"<div class='wrap__name'>";
                                        echo"<h4 class='product-item__movie-name'>".$row["TENPHIM"]."</h4>";

                                        $maPhim = $row["MAPM"];
                                        $tenTheloai = chuoiTheLoai($maPhim);
                                        echo"<h6 class='product-item__category-name'>".$tenTheloai."</h6>";

                                        
                                        echo"</div>";
                                        echo"<div class='product-item__action'>";
                                        echo"<span class='product-item__star'><i class='goldStar fa-solid fa-star'></i></span>";
                                        echo"<span class='product-item__mark'>".$row["DANHGIA"]."</span>";
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
                                    echo "<script>console.log('khong co phim')</script>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        <div class="phimsapchieu">
            <div class="grid">
                <div class="grid__row">
                    <div class="grid__full-width">
                        <span class="btn_next-film individual" id="btn_next_phimsapchieu">
                            <i class="fa-solid fa-chevron-right"></i>
                        </span>
                        <span class="btn_prev-film individual" id="btn_prev_phimsapchieu">
                            <i class="fa-solid fa-chevron-left"></i>
                        </span>
                        <div class="grid__column wrap-bottom">
                            <div class="home-tittle">
                                <span class="text-phimsapchieu">
                                    Phim sắp chiếu
                                </span>
                            </div>
                            <div class="home-product">
                                <div class="grid__row_no_wrap" id="slide_phimsapchieu">

                                    <!-- <div class="grid__column-2-4">
                                        <a class="product-item" href="#">
                                            <div class="product-item__img"
                                                style="background-image: url(./img/ngoidenkyquai.jpg);"></div>
                                            <div class="wrap__name">
                                                <h4 class="product-item__movie-name individual">Ngôi đền quỷ quái</h4>
                                                <h6 class="product-item__category-name individual">Kinh dị</h6>
                                            </div>

                                            <div class="product-item__age-limit">
                                                <div class="product-item__age-limit-label">
                                                    13+
                                                </div>
                                            </div>
                                            <div class="product-item__play">
                                                <span class="product-item__play-icon">
                                                    <i class="fa-solid fa-play"></i>
                                                </span>
                                            </div>
                                        </a>
                                    </div> -->

                                    <?php
                if ($resultPSC->num_rows > 0) {
                    while($row = $resultPSC->fetch_assoc()) {
                        echo "<div class='grid__column-2-4'>";
                        echo"<a class='product-item' href='./index.php?pages=chi-tiet-phim.php&MAPM=".$row["MAPM"]."'>";
                        echo"<div class='product-item__img' style='background-image: url(./img/".$row["NAMEANH"].");'></div>";
                        echo"<div class='wrap__name'>";
                        echo"<h4 class='product-item__movie-name individual'>".$row["TENPHIM"]."</h4>";

                        $maPhim = $row["MAPM"];
                        $tenTheloai = chuoiTheLoai($maPhim);
                        echo"<h6 class='product-item__category-name individual'>".$tenTheloai."</h6>";

                        
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
                    echo "<script>console.log('khong co phim')</script>";
                }
            ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="menuphim">
            <div class="grid">
                <div class="grid__row">
                    <div class="grid__full-width">
                        <div class="grid__column wrap-bottom">
                            <div class="home-filter">
                                <span class="text-menu">
                                    Tìm phim chiếu rạp trên MeMe
                                </span>

                                <div class="home-filer__navbar">
                                    <select class="cbb_category home-filer__navbar-item" name="cbb_category" id="cbb_category">
                                        <option value="Thể loại">Thể loại</option>
                                        <?php
                                        $sqlTenTL = "SELECT* FROM theloai";
                                        $resultTL = $conn->executeQuery($sqlTenTL);
                                        if ($resultTL->num_rows > 0) {
                                            while($rowTL = $resultTL->fetch_assoc()) {
                                                echo "<option value='".$rowTL['TENTHELOAI']."'>".$rowTL['TENTHELOAI']."</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                    <select class="cbb_country home-filer__navbar-item" name="cbb_country" id="cbb_country">
                                        <option value="Quốc gia">Quốc gia</option>
                                        <?php
                                        $countries = array(
                                            "Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Antigua và Barbuda", "Argentina", "Armenia", "Úc", "Áo",
                                            "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Bỉ", "Belize", "Benin", "Bhutan",
                                            "Bolivia", "Bosnia và Herzegovina", "Botswana", "Brasil", "Brunei", "Bulgaria", "Burkina Faso", "Burundi", "Cabo Verde", "Campuchia",
                                            "Cameroon", "Canada", "Cộng hòa Trung Phi", "Chad", "Chile", "Trung Quốc", "Colombia", "Comoros", "Congo", "Costa Rica",
                                            "Croatia", "Cuba", "Síp", "Cộng hòa Séc", "Cộng hòa Dân chủ Congo", "Đan Mạch", "Djibouti", "Dominica", "Cộng hòa Dominica", "Timor-Leste",
                                            "Ecuador", "Ai Cập", "El Salvador", "Guinea Xích Đạo", "Eritrea", "Estonia", "Eswatini", "Ethiopia", "Fiji", "Phần Lan",
                                            "Pháp", "Gabon", "Gambia", "Gruzia", "Đức", "Ghana", "Hy Lạp", "Grenada", "Guatemala", "Guinea",
                                            "Guinea-Bissau", "Guyana", "Haiti", "Honduras", "Hungary", "Iceland", "Ấn Độ", "Indonesia", "Iran", "Iraq",
                                            "Ireland", "Israel", "Ý", "Bờ Biển Ngà", "Jamaica", "Nhật Bản", "Jordan", "Kazakhstan", "Kenya", "Kiribati",
                                            "Kuwait", "Kyrgyzstan", "Lào", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Litva",
                                            "Luxembourg", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Quần đảo Marshall", "Mauritania", "Mauritius",
                                            "Mexico", "Micronesia", "Moldova", "Monaco", "Mông Cổ", "Montenegro", "Maroc", "Mozambique", "Myanmar", "Namibia",
                                            "Nauru", "Nepal", "Hà Lan", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Bắc Triều Tiên", "Bắc Macedonia", "Na Uy",
                                            "Oman", "Pakistan", "Palau", "Palestine", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Ba Lan",
                                            "Bồ Đào Nha", "Qatar", "Romania", "Nga", "Rwanda", "Saint Kitts và Nevis", "Saint Lucia", "Saint Vincent và Grenadines", "Samoa", "San Marino",
                                            "Sao Tome và Principe", "Ả Rập Saudi", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Quần đảo Solomon",
                                            "Somalia", "Nam Phi", "Hàn Quốc", "Nam Sudan", "Tây Ban Nha", "Sri Lanka", "Sudan", "Suriname", "Thụy Điển", "Thụy Sĩ",
                                            "Syria", "Tajikistan", "Tanzania", "Thái Lan", "Togo", "Tonga", "Trinidad và Tobago", "Tunisia", "Thổ Nhĩ Kỳ", "Turkmenistan",
                                            "Tuvalu", "Uganda", "Ukraine", "Các Tiểu vương quốc Ả Rập Thống nhất", "Vương quốc Anh", "Mỹ", "Uruguay", "Uzbekistan", "Vanuatu", "Vatican",
                                            "Venezuela", "Việt Nam", "Yemen", "Zambia", "Zimbabwe"
                                        );
                                        for($i=0;$i < count($countries);$i++){
                                            echo "<option value='".$countries[$i]."'>".$countries[$i]."</option>";

                                        }
                                        ?>

                                    </select>
                                    <select class="cbb_years home-filer__navbar-item" name="cbb_years" id="cbb_years">
                                        <option value="Năm">Năm</option>
                                        <?php
                                        $current_year = date("Y");
                                        $current_year_int = intval($current_year);
                                        for($nam=$current_year_int;$nam>1960;$nam--){
                                            echo "<option value='".$nam."'>".$nam."</option>";
                                        }
                                        ?>

                                    </select>
                                    <div class="search-container">
                                        <input type="text" class="home-filer__navbar-item searchHome" id="searchFilmMenu" name="search" placeholder="Type to search...">
                                        <span class="search-icon">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </span>
                                    </div>
                                </div>
                                </form>
                            </div>
                            <div class="home-product"  id='conchimnon'>

                                <!-- <div class="grid__row" id="conchimnon">
                    
                                </div> -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

