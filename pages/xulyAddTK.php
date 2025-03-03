<?php
    require_once('../database/connectDatabase.php');
    $conn = new connectDatabase();
    $error ="";
    $count=0;

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $USERNAME = $_POST['USERNAME'];
        $PASSWORD = $_POST['PASSWORD'];
        $EMAIL = $_POST['EMAIL'];
        $HOTEN = $_POST['HOTEN'];
        $MAQUYEN = $_POST['MAQUYEN'];
        $SODIENTHOAI = $_POST['SODIENTHOAI'];


        $queryUsername = "SELECT USERNAME FROM taikhoan WHERE USERNAME = '$USERNAME'";
        $resultUsername = $conn->executeQuery($queryUsername);
        if(empty($USERNAME)){
            $count++;
            $error .="&errorUsername=empty";
        }else if($resultUsername->num_rows > 0){
            $count++;
            $error .= "&errorUsername=exist";
        }else if(!preg_match('/^[a-zA-Z][a-zA-Z0-9]{5,}$/', $USERNAME)){
            $count++;
            $error .= "&errorUsername=char";
        }else{
            $error .= "&username=". $USERNAME;
        }

        if(empty($HOTEN)) {
            $count++;
            $error .= "&errorHoten=empty";
        }else{
            $error .= "&hoten=". $HOTEN;
        }

        if(empty($PASSWORD)) {
            $count++;
            $error .="&errorPassword=empty";
        }else if(!preg_match('/^.{8,}$/', $PASSWORD)){
            $count++;
            $error .= "&errorPassword=char";
        }else{
            $error .= "&password=". $PASSWORD;
        }
        
        $queryEmail = "SELECT EMAIL FROM taikhoan WHERE EMAIL = '$EMAIL'";
        $resultEmail = $conn->executeQuery($queryEmail);
        if(empty($EMAIL)) {
            $count++;
            $error .= "&errorEmail=empty";
        }else if($resultEmail->num_rows > 0){
            $count++;
            $error .= "&errorEmail=exist";
        }else if(!preg_match('/^[a-zA-Z0-9]+@gmail\.com$/',$EMAIL)){
            $count++;
            $error .= "&errorEmail=char";
        }else{
            $error .= "&email=". $EMAIL;
        }
       
        $querySDT = "SELECT SODIENTHOAI FROM taikhoan WHERE SODIENTHOAI = '$SODIENTHOAI'";
        $resultSDT = $conn->executeQuery($querySDT);
        if(empty($SODIENTHOAI)) {
            $count++;
            $error .= "&errorSDT=empty";
        }else if($resultSDT->num_rows > 0){
            $count++;
            $error .= "&errorSDT=exist";
        }else if(!preg_match('/^0\d{10}$/', $SODIENTHOAI)){
            $count++;
            $error .= "&errorSDT=char";
        }else{
            $error .= "&sdt=". $SODIENTHOAI;
        }

        if(empty($MAQUYEN)) {
            $count++;
            $error .= "&errorQuyen=empty";
        } else {
            $error .= "&quyen=". $MAQUYEN;
        }
    }

    if($count > 0){
        header("location: ../admin.php?page=usersadmin&error=input" . $error);
    } else{
        $TRANGTHAI = 1;
        $NAMEIMG = "userImg.jpg";
        $NGAY = new DateTime();
        $NGAYTAOTK = $NGAY->format('Y-m-d');

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $TIME = date('H:i:s');
        $sqlUser = "INSERT INTO taikhoan (USERNAME,PASSWORD,NGAYTAOTK,TRANGTHAI,EMAIL,HOTEN,NAMEANH,MAQUYEN,THOIGIANTAOTK,SODIENTHOAI) 
                    VALUES('$USERNAME', '$PASSWORD','$NGAYTAOTK',$TRANGTHAI,'$EMAIL','$HOTEN','$NAMEIMG','$MAQUYEN','$TIME', '$SODIENTHOAI')";
        $resultAdd = $conn->executeQuery($sqlUser);
        header("location: ../admin.php?page=usersadmin");
    }
    $conn->disconnect();
?>