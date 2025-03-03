<title>Thông tin tài khoản</title>
<?php
$tenDN="";
    if(isset($_SESSION['TenDN'])){
        $tenDN = $_SESSION['TenDN'];
    }
    require_once('./database/connectDatabase.php');
    $conn = new connectDatabase();

    if(isset($_POST["btn"])){
        if(isset($_FILES['fileInput'])){
            $anh = "./img/" . basename($_FILES["fileInput"]["name"]);
            $tenAnh = $_FILES["fileInput"]["name"];
            if($_FILES['fileInput']["size"]==0){
                echo "Anh chua chon";
            }else if(file_exists($anh)){
                $sqlUpdateImg = "UPDATE taikhoan SET NAMEANH = '$tenAnh' WHERE USERNAME ='$tenDN'";
                $resultUpdateImg = $conn->executeQuery($sqlUpdateImg);
            }else{
                move_uploaded_file($_FILES['fileInput']['tmp_name'], './img/' . $_FILES["fileInput"]["name"]);
                $sqlUpdateImg = "UPDATE taikhoan SET NAMEANH = '$tenAnh' WHERE USERNAME ='$tenDN'";
                $resultUpdateImg = $conn->executeQuery($sqlUpdateImg);
            }
        }else{
            echo "<script>alert('up load bi loai')</script>";
        }
    }


    $sqlTenAnh = "SELECT NAMEANH FROM taikhoan WHERE USERNAME = '$tenDN' ";
    $resultTenAnh = $conn->executeQuery($sqlTenAnh);
        if ($resultTenAnh->num_rows > 0) {
            // Lặp qua từng hàng dữ liệu và hiển thị
            $row = $resultTenAnh->fetch_assoc();
            $TenImg = $row["NAMEANH"];
        } else {
            echo "Không có dữ liệu trong bảng.";
        }

    $conn->disconnect(); 
?>

<div class="wrapper">
    <div class="left-side">
        <div class="left-side__wrapper">
            <div class="display-status">
                <span><i class="fa-solid fa-user"></i></span>
                <span>

                <?php
                    if(isset($_GET['id'])&&$_GET['id']==='pass'){
                        echo "Đổi mật khẩu";
                    }else{
                        echo "Thông tin tài khoản";
                    }
                ?>
                </span>
            </div>
            <div class="background-avatar">
                <div class="avatar">
                <div class="avatar_item" style="background-image: url('./img/<?php echo $TenImg ?>');" onclick="document.getElementById('fileInput').click()"></div>
                    <form action="index.php?pages=contentUser.php" name="formUp" method="post" enctype="multipart/form-data">
                        <input type="file" id="fileInput" name="fileInput" style="display: none;" onchange="document.getElementById('btn').click()">
                        <input type="submit" id="btn" name="btn" style="display: none;">
                    </form>
                </div>
            </div>
            <div class="user-name">
                <h1>
                    <?php echo $tenDN ?>
                </h1>
            </div>
            <div class="option__wrapper">
                <div class="option-item information_user">
                    <span><i class="fa-solid fa-user"></i></span>
                    <span>Thông tin tài khoản</span>
                </div>

                <div class="option-item change_password">
                    <span><i class="fa-solid fa-lock"></i></span>
                    <span>Đổi mật khẩu</span>
                </div>
            </div>
        </div>
    </div>
    <div class="right-side">
    <?php 
    // basename($_SERVER['PHP_SELF']) === 'informationUser.php'
    if(isset($_GET['id'])&&$_GET['id']==='pass'){
        include "update_pass_user.php";
    }else{
        include "update_user.php";
    }
    ?>
    </div>
</div>
<script>
    document.querySelector(".information_user").addEventListener("click",()=>{
        window.location.href = "index.php?pages=contentUser.php";
    });
    document.querySelector(".change_password").addEventListener("click",()=>{
        window.location.href = "index.php?pages=contentUser.php&id=pass";
    });

</script>
