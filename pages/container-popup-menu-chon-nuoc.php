<?php
    $connect = new connectDatabase("localhost", "root", "", "cinema");
    $dichVuSql = "SELECT * FROM dichvu";
    $dichVuQuery = $connect->executeQuery($dichVuSql);

    $dichVuSql1 = "SELECT * FROM dichvu";
    $dichVuQuery1 = $connect->executeQuery($dichVuSql1);
?>

<div class="container-pop-up-menu-chon-nuoc">
    <div class="header-menu-chon-nuoc">
        <h3>Combo - Bắp Nước</h3>
        <div id="icon-close-menu-chon-nuoc">&times;</div>
    </div>

    <div id="menu-bap-nuoc">
        <?php while($dichVuRow = mysqli_fetch_assoc($dichVuQuery)) { ?>
        <div class="mon">
            <img src="./img/<?php echo $dichVuRow['NAMEANH']; ?>" alt="">

            <div class="thong-tin-dich-vu">
                <strong><div id="<?php echo $dichVuRow['MADICHVU']; ?>" class="ten-dich-vu"><?php echo $dichVuRow['TENDICHVU']; ?></div></strong>

                <div class="mo-ta-dich-vu"><?php echo $dichVuRow['MOTA']; ?></div>

                <div class="gia-dich-vu"  
                    name="<?php echo $dichVuRow['MADICHVU']; ?>">
                    <?php echo $dichVuRow['PRICE']; ?>
                </div>

                <div class="so-luong-dich-vu">
                    <button class="btn-tru" 
                    madichvu="<?php echo $dichVuRow['MADICHVU']; ?>"
                    tendichvu="<?php echo $dichVuRow['TENDICHVU']; ?>"
                    price="<?php echo $dichVuRow['PRICE']; ?>"
                    >-</button>
                    <label class="so-luong-label" 
                    madichvu="<?php echo $dichVuRow['MADICHVU']; ?>"
                    tendichvu="<?php echo $dichVuRow['TENDICHVU']; ?>"
                    price="<?php echo $dichVuRow['PRICE']; ?>">0</label>
                    <button class="btn-cong" 
                    madichvu="<?php echo $dichVuRow['MADICHVU']; ?>"
                    tendichvu="<?php echo $dichVuRow['TENDICHVU']; ?>"
                    price="<?php echo $dichVuRow['PRICE']; ?>">+</button>
                </div>
            </div>
        </div>
        <?php
            } 
        ?>
    </div>

    <div id="tong-tien-bap-nuoc">
        <div>
            <span>Tổng cộng</span>
            <span id="tong-cong">0</span>
        </div>

        <h4>Tiếp tục</h4>
    </div>
</div>
