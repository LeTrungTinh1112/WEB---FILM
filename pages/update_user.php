<form action="index.php?pages=contentUser.php" name="formInformationUser" method="POST">
        <div class="right-side__tittle">
            <h1>Cập nhật thông tin</h1>
        </div>
        <div class="right-side__wrapper">
            <div class="right-info__item">
                <label class="right-info__item-name">Tên tài khoản</label>
                <input type="text" class="right-info__item-input readonly" name="UserName" readonly>
            </div>
            <div class="right-info__item">
                <label for="Tên của bạn" class="right-info__item-name">Tên của bạn</label>
                <input type="text" class="right-info__item-input" id="Tên của bạn" name="HoTen">
                <div class="errorUser"><?php
                if(isset($_GET['errorName'])&&$_GET['errorName']=='empty'){
                    echo 'Không được để trống thông tin';
                }else if(isset($_GET['errorName'])&&$_GET['errorName']=='wrong'){
                    echo 'Tên sai!!!';
                }
                ?></div>
            </div>
            <div class="right-info__item">
                <label for="Địa chỉ email" class="right-info__item-name">Địa chỉ email</label>
                <input type="text" class="right-info__item-input" id="Địa chỉ email" name="Email">
                <div class="errorUser"><?php
                if(isset($_GET['errorEmail'])&&$_GET['errorEmail']=='empty'){
                    echo 'Không được để trống thông tin';
                }else if(isset($_GET['errorEmail'])&&$_GET['errorEmail']=='wrong'){
                    echo 'Email sai!!!';
                }else if(isset($_GET['errorEmail'])&&$_GET['errorEmail']=='trung'){
                    echo 'Email trung roi con cho!!!';
                }
                ?></div>
            </div>
            <div class="right-info__item">
                <label for="Số điện thoại" class="right-info__item-name">Số điện thoại</label>
                <input type="text" class="right-info__item-input" id="Số điện thoại" name="SoDienThoai">
                <div class="errorUser"><?php
                if(isset($_GET['errorSdt'])&&$_GET['errorSdt']=='wrong'){
                    echo 'Số điện thoại sai!!!';
                }
                ?></div>
            </div>
        </div>
        <div class="btn__update-wrap">
            <input type="submit" value="Cập nhật" class="btn__update" name="btn_update">
        </div>
</form>

<?php 
$tenDN ="";

if(isset($_SESSION['TenDN'])){
    $tenDN = $_SESSION['TenDN'];
    
}
        require_once('./database/connectDatabase.php');
        $conn = new connectDatabase();
        if(isset($_POST['btn_update'])){
            $inputHoTen = $_POST['HoTen'];
            $inputEmail = $_POST['Email'];
            $inputSoDienThoai = $_POST['SoDienThoai'];
            $chuoiError = "";
            $count=0;
            $sqlEmail = "SELECT EMAIL FROM taikhoan WHERE USERNAME <> '$tenDN' AND EMAIL = '$inputEmail'";
            $resultEmail = $conn->executeQuery($sqlEmail);
            
            if(empty($inputHoTen)){
                $count++;
                $chuoiError = "errorName=empty";
            }else if(!preg_match('/^[a-zA-Z]+(?:\s[a-zA-Z]+)*$/', $inputHoTen)){
                $count++;
                $chuoiError = "errorName=wrong";
            }

            if(empty($inputEmail)){
                if($chuoiError==""){
                    $chuoiError = "errorEmail=empty";  
                }else{
                    $chuoiError .="&errorEmail=empty";  
                }
                $count++;
            }else if(!preg_match('/^[a-zA-Z0-9]+@gmail\.com$/', $inputEmail)){
                if($chuoiError==""){
                    $chuoiError = "errorEmail=wrong";  
                }else{
                    $chuoiError .="&errorEmail=wrong";  
                }
                $count++;
            }else if ($resultEmail->num_rows > 0) {
                    if($chuoiError==""){
                        $chuoiError = "errorEmail=trung";  
                    }else{
                        $chuoiError .="&errorEmail=trung";  
                    }
                    $count++;
                }

            if(!empty($inputSoDienThoai)){
                if(!preg_match('/^0\d{9}$/', $inputSoDienThoai)){
                    if($chuoiError==""){
                        $chuoiError = "errorSdt=wrong";  
                    }else{
                        $chuoiError .="&errorSdt=wrong";  
                    }
                    $count++;
                }
            }

            if($count>0){
                echo "<script>window.location.href = 'index.php?pages=contentUser.php&" .$chuoiError. "';</script>";

            }else{
                // echo "<script>alert('Cap nhat thanh cong');</script>";
                $sqlUpdate = "UPDATE taikhoan SET EMAIL = '$inputEmail', HOTEN = '$inputHoTen', SODIENTHOAI = '$inputSoDienThoai' WHERE USERNAME ='$tenDN'";
                $resultUpdate = $conn->executeQuery($sqlUpdate);
            }
        }

        $sqlDN = "SELECT HOTEN, EMAIL, SODIENTHOAI FROM taikhoan WHERE USERNAME = '$tenDN' ";
        $result = $conn->executeQuery($sqlDN);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hoTenSQL = $row["HOTEN"];
            $emailSQL = $row["EMAIL"];
            $sdtlSQL = $row["SODIENTHOAI"];
            echo "<script>formInformationUser.UserName.value ='$tenDN';</script>";
            echo "<script>formInformationUser.HoTen.value ='$hoTenSQL';</script>";
            echo "<script>formInformationUser.Email.value ='$emailSQL';</script>";
            echo "<script>formInformationUser.SoDienThoai.value ='$sdtlSQL';</script>";
        } else {
            echo "Không có dữ liệu trong bảng.";
        }

        
        
        $conn->disconnect(); 
?>