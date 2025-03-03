<!--  Xử lý sự kiện hiển thị ghế theo mã phòng chiếu -->
<?php
    require_once('../database/connectDatabase.php');
    if(isset($_GET['MAPHONGCHIEU'])) {
        $connect = new connectDatabase();

        $MAPHONGCHIEU = $_GET['MAPHONGCHIEU'];
        $gheSql = " SELECT * FROM ghe g
                    INNER JOIN loaighe lg ON lg.MALOAIGHE = g.MALOAIGHE
                    WHERE MAPHONGCHIEU = '$MAPHONGCHIEU'";
        $gheQuery = $connect->executeQuery($gheSql);

        // Kiểm tra số ghế đã đặt
        $MALICHCHIEU = $_GET['MALICHCHIEU'];
        $kiemTraVeSql = "  SELECT * FROM ve v
                        INNER JOIN chitietve_ghe ctv ON v.MAVE = ctv.MAVE
                        WHERE v.MALICHCHIEU = '$MALICHCHIEU'";
        $kiemTraVeQuery = $connect->executeQuery($kiemTraVeSql);

        $rowDonA = array(); 
        $rowDonB = array(); 
        $rowDonC = array(); 
        $rowDonD = array(); 
        $rowDonE = array(); 
        $rowDonF = array(); 
        $rowDonG = array(); $rowDoiG = array(); 
        $rowDonH = array(); $rowDoiH = array(); 
        $kiemTraTonTaiPhongChieu = true;
        $gheDaMuaArr = array();

        while($gheDaMuaArrRow = mysqli_fetch_assoc($kiemTraVeQuery)) {
            $gheDaMuaArr[] = $gheDaMuaArrRow['MAGHE'];
        }

        while($gheRow = mysqli_fetch_assoc($gheQuery)) {
            if($gheRow['HANGGHE'] == 'A' && $gheRow['MALOAIGHE'] == 'STD' || $gheRow['HANGGHE'] == 'A' && $gheRow['MALOAIGHE'] == 'BIZ') {
                $rowDonA[$gheRow['MAGHE']] = array(
                    "maloaighe" => $gheRow['MALOAIGHE'],
                    "price" => $gheRow['PRICE'],
                    "trangthai" => $gheRow['TRANGTHAI']
                );
            }

            if($gheRow['HANGGHE'] == 'B' && $gheRow['MALOAIGHE'] == 'STD' || $gheRow['HANGGHE'] == 'B' && $gheRow['MALOAIGHE'] == 'BIZ') 
            {
                $rowDonB[$gheRow['MAGHE']] = array(
                    "maloaighe" => $gheRow['MALOAIGHE'],
                    "price" => $gheRow['PRICE'],
                    "trangthai" => $gheRow['TRANGTHAI']
                );
            }

            if($gheRow['HANGGHE'] == 'C' && $gheRow['MALOAIGHE'] == 'STD' || $gheRow['HANGGHE'] == 'C' && $gheRow['MALOAIGHE'] == 'BIZ') 
            {
                $rowDonC[$gheRow['MAGHE']] = array(
                    "maloaighe" => $gheRow['MALOAIGHE'],
                    "price" => $gheRow['PRICE'],
                    "trangthai" => $gheRow['TRANGTHAI']
                );
            }

            if($gheRow['HANGGHE'] == 'D' && $gheRow['MALOAIGHE'] == 'STD' || $gheRow['HANGGHE'] == 'D' && $gheRow['MALOAIGHE'] == 'BIZ') 
            {
                $rowDonD[$gheRow['MAGHE']] = array(
                    "maloaighe" => $gheRow['MALOAIGHE'],
                    "price" => $gheRow['PRICE'],
                    "trangthai" => $gheRow['TRANGTHAI']
                );
            }

            if($gheRow['HANGGHE'] == 'E' && $gheRow['MALOAIGHE'] == 'STD' || $gheRow['HANGGHE'] == 'E' && $gheRow['MALOAIGHE'] == 'BIZ') 
            {
                $rowDonE[$gheRow['MAGHE']] = array(
                    "maloaighe" => $gheRow['MALOAIGHE'],
                    "price" => $gheRow['PRICE'],
                    "trangthai" => $gheRow['TRANGTHAI']
                );
            }

            if($gheRow['HANGGHE'] == 'F' && $gheRow['MALOAIGHE'] == 'STD' || $gheRow['HANGGHE'] == 'F' && $gheRow['MALOAIGHE'] == 'BIZ') 
            {
                $rowDonF[$gheRow['MAGHE']] = array(
                    "maloaighe" => $gheRow['MALOAIGHE'],
                    "price" => $gheRow['PRICE'],
                    "trangthai" => $gheRow['TRANGTHAI']
                );
            }

            if($gheRow['HANGGHE'] == 'G' && $gheRow['MALOAIGHE'] == 'STD' || $gheRow['HANGGHE'] == 'G' && $gheRow['MALOAIGHE'] == 'BIZ' || 
            $gheRow['HANGGHE'] == 'G' && $gheRow['MALOAIGHE'] == 'DOI') {
                if($gheRow['MALOAIGHE'] == 'STD' || $gheRow['HANGGHE'] == 'G' && $gheRow['MALOAIGHE'] == 'BIZ')
                {
                    $rowDonG[$gheRow['MAGHE']] = array(
                        "maloaighe" => $gheRow['MALOAIGHE'],
                        "price" => $gheRow['PRICE'],
                        "trangthai" => $gheRow['TRANGTHAI']
                    );
                }
                if($gheRow['MALOAIGHE'] == 'DOI')
                {
                    $rowDoiG[$gheRow['MAGHE']] = array(
                        "maloaighe" => $gheRow['MALOAIGHE'],
                        "price" => $gheRow['PRICE'],
                        "trangthai" => $gheRow['TRANGTHAI']
                    );
                }
            
            if($gheRow['HANGGHE'] == 'H' && $gheRow['MALOAIGHE'] == 'STD' || $gheRow['HANGGHE'] == 'H' && $gheRow['MALOAIGHE'] == 'BIZ' || 
            $gheRow['HANGGHE'] == 'H' && $gheRow['MALOAIGHE'] == 'DOI') {
                if($gheRow['MALOAIGHE'] == 'STD' || $gheRow['HANGGHE'] == 'H' && $gheRow['MALOAIGHE'] == 'BIZ')
                {
                    $rowDonH[$gheRow['MAGHE']] = array(
                        "maloaighe" => $gheRow['MALOAIGHE'],
                        "price" => $gheRow['PRICE'],
                        "trangthai" => $gheRow['TRANGTHAI']
                    );
                }
                if($gheRow['MALOAIGHE'] == 'DOI')
                {
                    $rowDoiH[$gheRow['MAGHE']] = array(
                        "maloaighe" => $gheRow['MALOAIGHE'],
                        "price" => $gheRow['PRICE'],
                        "trangthai" => $gheRow['TRANGTHAI']
                    );
                }
            }
        }
    }
            // <!-- Row A -->
            echo    '<div class="ghe-don">';
                        $i = 1;
                        foreach($rowDonA as $key => $value) { 
                            if(in_array($key, $gheDaMuaArr)) {
                                $name = 'daMua';
                            } else {
                                $name = $value["maloaighe"] == 'BIZ'? 'ghe-vip': '';
                            }
                            
                            $price = $value["price"];
                            $trangthai = $value["trangthai"];
                            echo "<div maghe='$key' class='$name' price='$price' trangthai='$trangthai'>".
                                "A$i";
                                ++$i;
                            echo "</div>";
                        }
            echo    '</div>';

            // <!-- Row B -->
            echo    '<div class="ghe-don">';
                        $i = 1;
                        foreach($rowDonB as $key => $value) { 
                            if(in_array($key, $gheDaMuaArr)) {
                                $name = 'daMua';
                            } else {
                                $name = $value["maloaighe"] == 'BIZ'? 'ghe-vip': '';
                            }

                            $price = $value["price"];
                            $trangthai = $value["trangthai"];
                            echo "<div maghe='$key' class='$name' price='$price' trangthai='$trangthai'>".
                                "B$i";
                                ++$i;
                            echo "</div>";
                        }
            echo    '</div>';

            // <!-- Row C -->
            echo    '<div class="ghe-don">';
                    $i = 1;
                    foreach($rowDonC as $key => $value) { 
                        if(in_array($key, $gheDaMuaArr)) {
                                $name = 'daMua';
                            } else {
                                $name = $value["maloaighe"] == 'BIZ'? 'ghe-vip': '';
                            }
                            
                        $price = $value["price"];
                        $trangthai = $value["trangthai"];
                        echo "<div maghe='$key' class='$name' price='$price' trangthai='$trangthai'>".
                            "C$i";
                            ++$i;
                        echo "</div>";
                    }
            echo    '</div>';

            // <!-- Row D -->
            echo    '<div class="ghe-don">';
                    $i = 1;
                    foreach($rowDonD as $key => $value) { 
                        if(in_array($key, $gheDaMuaArr)) {
                            $name = 'daMua';
                        } else {
                            $name = $value["maloaighe"] == 'BIZ'? 'ghe-vip': '';
                        }
                        
                        $price = $value["price"];
                        $trangthai = $value["trangthai"];
                        echo "<div maghe='$key' class='$name' price='$price' trangthai='$trangthai'>".
                            "D$i";
                            ++$i;
                        echo "</div>";
                    }
            echo    '</div>';

            // <!-- Row E -->
            echo    '<div class="ghe-don">';
                    $i = 1;
                    foreach($rowDonE as $key => $value) { 
                        if(in_array($key, $gheDaMuaArr)) {
                            $name = 'daMua';
                        } else {
                            $name = $value["maloaighe"] == 'BIZ'? 'ghe-vip': '';
                        }
                        
                        $price = $value["price"];
                        $trangthai = $value["trangthai"];
                        echo "<div maghe='$key' class='$name' price='$price' trangthai='$trangthai'>".
                            "E$i";
                            ++$i;
                        echo "</div>";
                    }
            echo    '</div>';

            // <!-- Row F -->
            echo    '<div class="ghe-don">';
                    $i = 1;
                    foreach($rowDonF as $key => $value) { 
                        if(in_array($key, $gheDaMuaArr)) {
                            $name = 'daMua';
                        } else {
                            $name = $value["maloaighe"] == 'BIZ'? 'ghe-vip': '';
                        }
                        
                        $price = $value["price"];
                        $trangthai = $value["trangthai"];
                        echo "<div maghe='$key' class='$name' price='$price' trangthai='$trangthai'>".
                            "F$i";
                            ++$i;
                        echo "</div>";
                    }
            echo    '</div>';

            // <!-- Row G -->
            if(!empty($rowDonG)) { 
            echo    '<div class="ghe-don">';
                    $i = 1;
                    foreach($rowDonG as $key => $value) { 
                        if(in_array($key, $gheDaMuaArr)) {
                            $name = 'daMua';
                        } else {
                            $name = $value["maloaighe"] == 'BIZ'? 'ghe-vip': '';
                        }
                        
                        $price = $value["price"];
                        $trangthai = $value["trangthai"];
                        echo "<div maghe='$key' class='$name' price='$price' trangthai='$trangthai'>".
                            "G$i";
                            ++$i;
                        echo "</div>";
                    }
            echo    '</div>';
            }

            if(!empty($rowDoiG)) {
            echo '<div class="ghe-doi">';
                    $i = 1;
                    foreach($rowDoiG as $key => $value) { 
                        if(in_array($key, $gheDaMuaArr)) {
                            $name = 'daMua';
                        } else {
                            $name = $value["maloaighe"] == 'BIZ'? 'ghe-vip': '';
                        }
                        
                        $price = $value["price"];
                        $trangthai = $value["trangthai"];
                        echo "<div maghe='$key' class='$name' price='$price' trangthai='$trangthai'>".
                            "G$i";
                            ++$i;
                        echo "</div>";
                }
            echo '</div>';
            }

            // <!-- Row H -->
            if(!empty($rowDonH)) { 
            echo    '<div class="ghe-don">';
                    $i = 1;
                    foreach($rowDonH as $key => $value) { 
                        if(in_array($key, $gheDaMuaArr)) {
                            $name = 'daMua';
                        } else {
                            $name = $value["maloaighe"] == 'BIZ'? 'ghe-vip': '';
                        }
                        
                        $price = $value["price"];
                        $trangthai = $value["trangthai"];
                        echo "<div maghe='$key' class='$name' price='$price' trangthai='$trangthai'>".
                            "H$i";
                            ++$i;
                        echo "</div>";
                    }
            echo    '</div>';
            }

            if(!empty($rowDoiH)) {
            echo '<div class="ghe-doi">';
                $i = 1;
                foreach($rowDoiH as $key => $value) { 
                    if(in_array($key, $gheDaMuaArr)) {
                        $name = 'daMua';
                    } else {
                        $name = $value["maloaighe"] == 'BIZ'? 'ghe-vip': '';
                    }
                    
                    $price = $value["price"];
                    $trangthai = $value["trangthai"];
                    echo "<div maghe='$key' class='$name' price='$price' trangthai='$trangthai'>".
                        "H$i";
                        ++$i;
                    echo "</div>";
                }
            echo '</div>';
            }

        $connect->disconnect();
    }
?>
