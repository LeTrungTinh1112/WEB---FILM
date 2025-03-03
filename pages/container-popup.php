<?php
    $connect = new connectDatabase();
    $containerPopupSql = "SELECT * FROM phim";
    $containerPopupQuery = $connect->executeQuery($containerPopupSql);
?>

<div class="container-popup">
    <div id="icon-close-popup">
            &times;
    </div>

    <?php
        while( $rowContainerPopup = mysqli_fetch_assoc($containerPopupQuery) ) {
            if($rowContainerPopup['MAPM'] == $_GET['MAPM']) {
    ?>

        <iframe id="video" width="560" height="315" src="<?php echo $rowContainerPopup['PATHTRAILER'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    <?php
        }
    }
    $connect->disconnect();
    ?>
</div>
