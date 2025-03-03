<?php
    $connect = new connectDatabase("localhost", "root", "", "cinema");
    $MAPM = $_GET['MAPM'];
    $thanhToanPhimSql = "SELECT * FROM phim WHERE MAPM = '$MAPM'";
    $thanhToanPhimQuery = $connect->executeQuery($thanhToanPhimSql);
?>

<div class="container-pop-up-menu-thanh-toan">
    <div class="header-menu-thanh-toan">
        <h3>Thông Tin Vé Đã Mua</h3>
        <div id="icon-close-menu-thanh-toan">&times;</div>
    </div>

    <div id="menu-thanh-toan">
        <div class="menu-thanh-toan_container" id="ten-phim-thanh-toan">
            <?php   while($thanhToanPhimRow = mysqli_fetch_assoc($thanhToanPhimQuery)) { ?>
                        <span><?php echo $thanhToanPhimRow['TENPHIM']; ?></span>
            <?php 
                } 
            ?>
        </div>

        <div class="menu-thanh-toan_container" id="time-and-date-thanh-toan">
            <div id="thoi-gian-chieu-thanh-toan">
                <span>THỜI GIAN</span>
                <div id="thoi-gian-chieu-thanh-toan_tg"></div>
            </div>

            <div id="ngay-chieu-thanh-toan">
                <span>NGÀY CHIẾU</span>
                <div id="ngay-chieu-thanh-toan_nc"></div>
            </div>
        </div>

        <div class="menu-thanh-toan_container" id="rap-thanh-toan">
            <span>RẠP</span>
            <h4 style="font-size: 18px; margin-top:10px;">MEME CINEMA</h4>
        </div>

        <div class="menu-thanh-toan_container" id="phong-chieu-thanh-toan">
            <span>PHÒNG CHIẾU</span>
            <div id="phong-chieu-thanh-toan_pc"></div>
        </div>

        <div class="menu-thanh-toan_container" id="ghe-va-so-tien-thanh-toan">
            <div id="ghe-thanh-toan">
                <span>GHẾ</span>
                <div id="ghe-thanh-toan_ghe"></div>
            </div>

            <div id="so-tien-thanh-toan">
                <span>SỐ TIỀN</span>
                <div id="so-tien-thanh-toan_sotien"></div>
            </div>
        </div>

        <div class="menu-thanh-toan_container" id="bap-nuoc-thanh-toan">
            <div id="ghe-thanh-toan">
                <span>BẮP-NƯỚC</span>
                <div id="bap-nuoc-thanh-toan_thucpham">
                    <!-- Xử lý trong file xu-ly-bap-nuoc-da-chon.php -->
                </div>
            </div>

            <div id="so-tien-thanh-toan">
                <span>SỐ TIỀN</span>
                <div id="so-tien-thanh-toan_sotien-thucpham">
                    <!-- Xử lý trong file xu-ly-so-tien-bap-nuoc-da-chon.php -->
                </div>
            </div>
        </div>

        <div class="menu-thanh-toan_container" id="uu-dai-thanh-toan">
            <span>ƯU ĐÃI</span>
            <div>
                
            </div>
        </div>

        <div class="menu-thanh-toan_container" id="tong-tien-thanh-toan">
            <span>TỔNG TIỀN</span>
            <div id="tong-tien-thanh-toan_tong-tien"></div>
        </div>

        <div class="menu-thanh-toan_container" id="phuong-thuc-thanh-toan">
            <div>CHỌN PHƯƠNG THỨC THANH TOÁN</div>
            <select>
                <option value="Banking">Ngân Hàng</option>
                <option value="Momo">Momo</option>
                <option value="ZaloPay">ZaloPay</option>
                <option value="Cashing">Tiền Mặt</option>
            </select>
        </div>

    </div>

    <div id="thanh-toan">
        <h4>Thanh Toán</h4>
    </div>
</div>

<!-- Xử lý sự kiện chọn dịch vụ -->
<script>

</script>