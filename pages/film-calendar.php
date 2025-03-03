<?php
    require_once("./database/connectDatabase.php");
    $connect = new connectDatabase();
    if(isset($_GET['MAPM'])) {
        $MAPM = $_GET['MAPM'];
        $filmCalendarSql1 = "SELECT * FROM lichchieuphim lcp
                        INNER JOIN suatchieu sc ON lcp.MASC = sc.MASC
                        WHERE lcp.MAPM = '$MAPM'";
        $filmCalendarQuery1 = $connect->executeQuery($filmCalendarSql1);

        $filmCalendarSql2 = "SELECT * FROM lichchieuphim lcp
                        INNER JOIN suatchieu sc ON lcp.MASC = sc.MASC
                        INNER JOIN phim p ON lcp.MAPM = p.MAPM
                        WHERE lcp.MAPM = '$MAPM'";
        $filmCalendarQuery2 = $connect->executeQuery($filmCalendarSql2);

    } else {
        echo "Không Tìm Thấy Mã Phim";
    }
?>

<div class="filmCalendar">
    <h4>Lịch Chiếu</h4>

    <div class="calendar">
        <div class="list-days">
            <?php
            // Xử lý sự kiện không hiện lịch chiếu cùng ngày nhiều lần
                $kiemTraNgays = array();

                while( $rowNC = mysqli_fetch_assoc($filmCalendarQuery1) ) {

                    $kiemTraTonTai = false;

                    foreach($kiemTraNgays as $kiemTraNgay) {
                        if($kiemTraNgay == $rowNC['NGAY']) {
                            $kiemTraTonTai = true;
                        }
                    }

                    $current_time = new DateTime();
                    $specified_time_str = $rowNC['NGAY'] . $rowNC['THOIGIANBATDAU'];
                    $specified_time = new DateTime($specified_time_str);
                    
                    if(!$kiemTraTonTai && $specified_time >= $current_time ) {
                        $kiemTraNgays[] = $rowNC['NGAY'];
            ?>
                        <div class="day" 
                            masuatchieu = "<?php echo $rowNC['MASC']; ?>"
                            ngaychieu = "<?php echo $rowNC['NGAY']; ?>"   
                        >
                                <label style="font-size:14px;">Ngày Chiếu</label>
                                <p><?php echo $rowNC['NGAY']; ?> </p>
                        </div>

            <?php
                    }
                }
            ?>
        </div>

        <div class="list-hours">
            <?php 
                $filmCalendarQuery1 = $connect->executeQuery($filmCalendarSql1);
                $kiemTraTonTai = false;

                while( $rowNC = mysqli_fetch_assoc($filmCalendarQuery1) ) {
                    $current_time = new DateTime();
                    $specified_time_str = $rowNC['NGAY'] . $rowNC['THOIGIANBATDAU'];
                    $specified_time = new DateTime($specified_time_str);
                    
                    if($specified_time >= $current_time) { ?>
                        <div class="temp" style="display: flex;">
                            <p>--Mời Bạn Chọn Suất Chiếu-- </p>
                        </div>
                    <?php 
                        $kiemTraTonTai = true; 
                        break;}?>
            <?php } ?>
            
            <?php 
                if(!$kiemTraTonTai) { ?>
                    <div class="temp" style="display: flex;">
                            <p>--Hiện Không Có Suất Chiếu Nào--</p>
                        </div>
            <?php } ?>

            <?php
                $kiemTraHours = array();

                while( $rowTG = mysqli_fetch_assoc($filmCalendarQuery2)) {
                    $kiemTraTonTai = false;

                    foreach($kiemTraHours as $ngay => $thoigian) {
                        if($thoigian == $rowTG['THOIGIANBATDAU'] && $ngay == $rowTG['NGAY']) {
                            $kiemTraTonTai = true;
                        }
                    }

                    if(!$kiemTraTonTai) {
                        $kiemTraHours[$rowTG['NGAY']] = $rowTG['THOIGIANBATDAU'];
            ?>
                        <div class="hour" 
                            style="display: none;" 
                            tenphim = "<?php echo $rowTG['TENPHIM']; ?>"
                            maphim = "<?php echo $rowTG['MAPM']; ?>"
                            masuatchieu = "<?php echo $rowTG['MASC']; ?>"
                            ngaychieu = "<?php echo $rowTG['NGAY']; ?>"
                        >
                            <p><?php echo $rowTG['THOIGIANBATDAU']; ?></p>
                        </div>
            <?php
                    }
                }
                $connect->disconnect();
            ?>
        </div>
    </div>

    <!-- Pre and Next -->
    <div class="pre">
        <div id="btn-left">&lsaquo;</div>
    </div>

    <div class="next">
    <div id="btn-right"> &rsaquo;</div>
    </div>
</div>
