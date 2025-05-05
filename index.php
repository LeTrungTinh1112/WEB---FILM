<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/trangchu.css">
    <?php
    if (isset($_GET['pages'])) {
        $pages = $_GET['pages'];
        switch ($pages) {
            case 'contentUser.php':
                echo'<link rel="stylesheet" href="./css/base_user.css">
                     <link rel="stylesheet" href="./css/user.css">';
                     
                break;
            case 'discount.php':
                echo '<link rel="stylesheet" href="./css/base.css">
                <link rel="stylesheet" href="./css/discount.css">';
                break;
            case 'history_ticket.php':
                echo '<link rel="stylesheet" href="./css/base_user.css">
                <link rel="stylesheet" href="./css/ticket_css.css">';
                break;
            case 'ticket.php':
                echo '<link rel="stylesheet" href="./css/base_user.css">
                <link rel="stylesheet" href="./css/ticket_css.css">';
                break;
            case 'chi-tiet-phim.php':
                echo '<link rel="stylesheet" href="./css/ChiTietPhim.css">';
                break;
        }
    }
    ?>

</head>

<body>
    <?php
        include "./pages/header.php";
     ?>

    <?php
    if(isset($_GET['pages'])){
        $pages=$_GET['pages'];
        switch($pages){
            case 'discount.php':
                include "./pages/discount.php";
                echo '<script src="./js/discount.js"></script>';
                break;
            case 'contentUser.php':
                include "./pages/contentUser.php";
                break;
            case 'history_ticket.php':
                include "./pages/history_ticket.php";
                break;
            case 'ticket.php':
                include "./pages/ticket.php";
                break;
            case 'chi-tiet-phim.php':
                include "./pages/chi-tiet-phim.php";   
                echo '<script defer src="./js/chi-tiet-film.js"></script>';
                break;
        }
    }else{
        include "./pages/home.php";
        echo '<script src="./js/trangChujs.js"></script>';
    }
    include "./pages/footer.php";
    ?>
    
    
</body>
<script src="./js/header.js"></script>
</html>
