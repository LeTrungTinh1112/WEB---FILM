<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" form="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/shortcut_icon.jpg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/base_user.css">
    <link rel="stylesheet" href="../css/log_in.css">
</head>

<body>
    <!-- Start -->
    <div class="main">
    <?php
    if(isset($_GET['pages'])){
        $pages=$_GET['pages'];
        switch($pages){
            case 'log_in':
                include "./log_in.php";
                break;
            case 'sign_in':
                include "./sign_in.php";
                break;
            case 'forget_password':
                include "./forget_password.php";
                break;
            case 'sign_in_success':
                include "./sign_in_success.php";
                break;
        }
    }
    ?>
        
    </div>
</body>
<script src="../js/eye_passwd.js"></script>

</html>