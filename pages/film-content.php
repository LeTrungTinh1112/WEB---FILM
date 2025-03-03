<?php
    $connect = new connectDatabase();
    if(isset($_GET['MAPM'])) {
        $MAPM = $_GET['MAPM'];
        $filmContentSql1 = "SELECT * FROM chitietphim_theloai ctptl 
                        INNER JOIN theloai tl ON ctptl.MATHELOAI = tl.MATHELOAI 
                        WHERE ctptl.MAPM = '$MAPM'";
        $filmContentQuery1 = $connect->executeQuery($filmContentSql1);

        $filmContentSql2 = "SELECT * FROM chitietphim_dienvien ctpdv
                        INNER JOIN dienvien dv ON ctpdv.MADV = dv.MADV
                        WHERE ctpdv.MAPM = '$MAPM'";
        $filmContentQuery2 = $connect->executeQuery($filmContentSql2);

        $filmContentSql3 = "SELECT * FROM phim 
                            WHERE MAPM = '$MAPM'";
        $filmContentQuery3  = $connect->executeQuery($filmContentSql3);

    } else {
        echo "Không Tìm Thấy Mã Phim";
    }
?>

<div class="filmContent">
    <div id="container-category">
        <div class="title">
            <h5>Nhà sản xuất: </h5>
        </div>
        <div class="category">   
              
        </div>

        <div class="title">
            <h5>Thể loại: </h5>
        </div>
        <div class="category">
            <?php
                while( $rowTL = mysqli_fetch_assoc($filmContentQuery1) ) {
            ?>
                <div>
                    <?php echo $rowTL['TENTHELOAI'] ?>
                </div>     
            <?php
                }
            ?>
        </div>

        <div class="title">
            <h5>Đạo diễn: </h5>
        </div>
        <div class="category">
    
        </div>

        <div class="title">
            <h5>Diễn viên: </h5>
        </div>
        <div class="category">
            <?php
                while( $rowDV = mysqli_fetch_assoc($filmContentQuery2) ) {
            ?>
                <div style="border: none">
                    <figure>
                        <img src="./img/<?php echo $rowDV['NAMEANH'] ?>" alt="Elephant at sunset" 
                            style="width: 100px;height: 100px; border: 1px dotted black; border-radius: 50%"/>
                        <figcaption style="text-align: center;"><?php echo $rowDV['TENDV'] ?></figcaption>
                    </figure>
                </div>     
            <?php
                }
                
            ?>
        </div>
    </div>
    
    <div class="content-title">
        <h4>Nội Dung Phim: </h4>
        <div class="content">
            <?php
                while( $rowND = mysqli_fetch_assoc($filmContentQuery3) ) {
            ?>
                <p>
                    <?php echo $rowND['MOTA'] ?>
                </p>   
            <?php
                }

                $connect->disconnect();
            ?>
            <p></p>
        </div>
    </div>
</div>
