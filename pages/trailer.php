<?php
    require_once('./database/connectDatabase.php');
    $connect = new connectDatabase();
    $trailerSql = "SELECT * FROM phim";
    $trailerQuery = $connect->executeQuery($trailerSql);
?>

<div class="trailer">
    <?php
        while( $rowTrailer = mysqli_fetch_assoc($trailerQuery) ) {
            if($rowTrailer['MAPM'] == $_GET['MAPM']) {
    ?>
                <img src="./img/<?php echo $rowTrailer['NAMEANH'] ?>" alt="test" width="500" height="750">
                <div id="play-icon">
                    <i class="fa-regular fa-circle-play" style="color: white;"></i>
                </div>
    <?php
            }
        }
        $connect->disconnect();
    ?>
</div>