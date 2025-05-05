<?php
    $connect = new connectDatabase();
    $filmInfoSql = "SELECT * FROM phim";
    $filmInfoQuery = $connect->executeQuery($filmInfoSql);
?>


<div class="filmInfo">
    <?php
            while( $rowFilmInfo = mysqli_fetch_assoc($filmInfoQuery) ) {
                if($rowFilmInfo['MAPM'] == $_GET['MAPM']) {
    ?>

    <figure class="img">
        <img src="./img/<?php echo $rowFilmInfo['NAMEANH'] ?>" alt="">
    </figure>
    
    <div>
    <div class="name">
        <h2><?php echo $rowFilmInfo['TENPHIM'] ?></h2>

        <div class="container-info" id="time">
            <div id="clock-icon">
                <i class="fa-regular fa-clock" style="color: #63E6BE;"></i>
                <p><?php echo $rowFilmInfo['THOILUONG'] ?></p>
            </div>
            <div id="calendar-icon">
                <i class="fa-regular fa-calendar" style="color: #63E6BE;"></i>
                <p><?php echo $rowFilmInfo['NGAYCHIEU'] ?></p>
            </div>
        </div>

        <div class="container-info" id="like">
            <i class="fa-solid fa-heart" style="color: #63E6BE; font-size: 25px;"></i>
            <p><?php echo $rowFilmInfo['LUOTXEM'] ?></p>
        </div>

        <div class="container-info" id="region">
            <label for="region"><span style="font-size: 16px;font-weight: bold;">Quốc gia:</span> <span><?php echo $rowFilmInfo['QUOCGIA'] ?></span></label>
        </div>
    </div>
    <?php include('film-content.php');?>
    </div>
    <?php
            }
        }

    ?>
</div>