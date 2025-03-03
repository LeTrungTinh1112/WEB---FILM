<div class="wrapper_forgot">
            <div class="title_forgot">
                <h2>Quên mật khẩu</h2>
            </div>
            <div class="paragraph_forgot">
                <p>Bạn quên mật khẩu của mình? Đừng lo lắng! Hãy cung cấp cho chúng tôi email bạn sử dụng để đăng ký tài
                    khoản Meme.
                    Chúng tôi sẽ gửi lại mật khẩu cũ cho bạn.</p>
            </div>
            <form action="log_sign.php?pages=forget_password" class="form_forgot" name="form_forget_pass" method="POST">
                <div class="form_forgot__item">
                    <div class="form_forgot__item-label">
                        <label for="email">Địa chỉ email của bạn</label>
                    </div>
                    <div class="form_forgot__item-input">
                        <input type="text" name="Email" id="email">
                    </div>
                    <button type="submit" class="btn_password" name="btn_password">
                        <span>Gửi mật khẩu cho tôi</span>
                    </button>
                </div>

                <div class="signin-transition-2">
                <p class="question-account-2">Bạn lấy được tài khoản chưa ?</p>
                <a class="form-signin-2" href="./log_sign.php?pages=log_in">Đăng nhập</a>
                </div>

            </form>
            <div class="notification_password">
                <span>
                    <?php
                    if(isset($_GET['pass'])&&$_GET['pass']=='KhongToanTai'){
                        echo "Email không tồn tại";
                    }else if(isset($_GET['pass'])&&$_GET['pass']!='KhongToanTai'){
                        echo "Mật khẩu của bạn là: ".$_GET['pass'] ;
                    }
                    ?>
                </span>
            </div>
        </div>

<?php

    if(isset($_POST["btn_password"])){
        $inputEmail = $_POST['Email'];
        $sql = "SELECT PASSWORD FROM taikhoan WHERE EMAIL = '$inputEmail'";
        require_once('../database/connectDatabase.php');
        $conn = new connectDatabase();
        $result = $conn->executeQuery($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            header('Location: log_sign.php?pages=forget_password&pass='. $row["PASSWORD"]);
            exit();
        } else {
            header('Location: log_sign.php?pages=forget_password&pass=KhongToanTai');
            exit();
        }

        $conn->disconnect();
    }

?>