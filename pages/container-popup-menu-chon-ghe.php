<?php
    $connect = new connectDatabase();
    if(isset($_GET['MAPM'])) {
        $MAPM = $_GET['MAPM'];
        $tenPhimSql = "SELECT * FROM phim p
                    INNER JOIN lichchieuphim lcp ON p.MAPM = lcp.MAPM
                    INNER JOIN suatchieu sc ON lcp.MASC = sc.MASC
                    WHERE p.MAPM = '$MAPM'";
        $tenPhimQuery = $connect->executeQuery($tenPhimSql);
    } else {
        echo "Không Tìm Thấy Mã Phim";
    }
?>


<div class="container-popup-menu-chon-ghe">
    <div class="header-menu-chon-ghe">
        <h3>Mua vé xem phim</h3>
        <div id="icon-close-menu-chon-ghe">&times;</div>
    </div>

    <div id="menu-chon-ghe">
        <h4>Màn Hình</h2>

        <div id="row-ghe">
            
        </div>

        <div id="icon-loai-ghe">
            <div class="row">
                <div class="loai-ghe" style="background-color: gray;"></div><p>Đã đặt</p>
                <div class="loai-ghe"  style="background-color: #b0e5c4;"></div><p>Ghế bạn chọn</p>
                <div class="loai-ghe"  style="background-color: #d5636384;"></div><p>Ghế thường</p>
            </div>
            
            <div class="row">
                <div class="loai-ghe"  style="background-color: red;"></div><p>Ghế VIP</p>
                <div class="loai-ghe"  style="background-color: rgb(250, 37, 161);"></div><p>Ghế đôi</p>   
            </div>

            <!-- Chọn Phòng Chiếu -->
            <div class="row" id="phong-chieu">
                <span>Chọn phòng:</span>

                <div id="chon-phong">

                </div>
            </div>
        </div>
    </div>

    <div id="mua-ve">
        <input type="hidden" id="hide-ma-lich-chieu">
        <div id="tieu-de-phim">
           
        </div>

        <div id="cho-ngoi">
            <span style="font-size: 14px;">Chỗ ngồi: </span>
            
            <div id="so-ghe-da-chon">
                
            </div>
        </div>

        <div id="tong-tien">
            <div>
                <p style="font-size: 14px;">Tạm tính: </p>
                <div style="margin-top: 5px;" id="tam-tinh">0</div>
            </div>

            <div id="btn-mua-ve">
                <p>Mua vé</p>
            </div>
        </div>
    </div>
</div>
