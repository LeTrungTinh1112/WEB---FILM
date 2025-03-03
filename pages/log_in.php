<?php
    session_start();
    if(isset($_POST["btn_logIn"])){
        $chuoiEmpty="";
        $count=0;
        $tenDN = $_POST['TenDNorEmail'];
        $password = $_POST['Password'];


        $sqlDN = "SELECT USERNAME, PASSWORD FROM taikhoan";
        require_once('../database/connectDatabase.php');
        $conn = new connectDatabase();

        $result = $conn->executeQuery($sqlDN);
        $flag = 0;

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $userNameSQL = $row["USERNAME"];
                $passSQL = $row["PASSWORD"];
                if($tenDN==$userNameSQL&&$password==$passSQL){
                    $flag++;
                    break;
                }
            }
        } else {
            echo "Không có dữ liệu trong bảng.";
        }

        if(empty($tenDN)){
            $chuoiEmpty = "errorTenDN=empty";
            $count++;
        }else if($flag==0){
            $chuoiEmpty = "errorTenDN=wrong";
            $count++;
        }

        if(empty($password)){
            if($chuoiEmpty==""){
                $chuoiEmpty = "errorPass=empty";  
            }else{
                $chuoiEmpty .="&errorPass=empty";  
            }
            $count++;
        }else if($flag==0){
            if($chuoiEmpty==""){
                $chuoiEmpty = "errorPass=wrong";  
            }else{
                $chuoiEmpty .="&errorPass=wrong";  
            }
            $count++;
        }

        if($count>0){
//            echo "<script>window.location.href = 'index.php?pages=contentUser.php&id=pass&" .$chuoiEmpty. "';</script>";
            header('location:log_sign.php?pages=log_in&'.$chuoiEmpty);
        }else{
            $_SESSION['TenDN'] = $userNameSQL;
            header('location:../index.php');

        }
        $conn->disconnect();

    }
?>
<title>Đăng nhập</title>
<div class="wrapper_login">
            <div class="title">
                <h2>Đăng nhập vào Meme</h2>
            </div>
            <form action="log_sign.php?pages=log_in" class="form_login" name="form_login" method="POST">                    
                <div class="form_login__item">
                    <div class="form_login__item-icon">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div class="form_login__item-input">
                        <input class="input_item1" type="text" placeholder="Tên tài khoản" name="TenDNorEmail">
                    </div>
                </div>
                    <span class="error" style="margin-left: 81px;">
                    <?php
                        if(isset($_GET['errorTenDN'])&&$_GET['errorTenDN']=='empty'){
                            echo "Không được để thông tin trống.";
                        }else if(isset($_GET['errorTenDN'])&&$_GET['errorTenDN']=='wrong'){
                            echo "Tên đăng nhập không tồn tại hoặc không đúng.";
                        }
                    ?>
                    </span>
                
                <div class="form_login__item">
                    <div class="form_login__item-icon">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <div class="form_login__item-input">
                        <input id="myElement" class="input_item1 password" type="password" placeholder="Mật khẩu" name="Password">
                        <span class="toggle-password eye_pass">
                            <i class="fa-solid fa-eye"></i>
                        </span>
                    </div>
                    
                </div>
                <span class="error" style="margin-left: 81px;">
                <?php
                        if(isset($_GET['errorPass'])&&$_GET['errorPass']=='empty'){
                            echo "Không được để thông tin trống.";
                        }else if(isset($_GET['errorPass'])&&$_GET['errorPass']=='wrong'){
                            echo "Mật khẩu có thể chưa đúng.";
                        }
                    ?>
                    </span>
                <div class="btn__update-wrap">
                    <input type="submit" value="Đăng nhập" class="btn_log_sign" name="btn_logIn">
                </div>
            </form>
            <div class="wrap__link">
                <div class="forgot">
                    <a href="./log_sign.php?pages=forget_password">Quên mật khẩu?</a>
                </div>
                <div class="create__account">
                    <a href="./log_sign.php?pages=sign_in">Tạo tài khoản</a>
                </div>
            </div>
        </div>
