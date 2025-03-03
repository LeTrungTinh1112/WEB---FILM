<title>Đăng ký</title>
<div class="wrapper_signin">
            <div class="title">
                <h2>Đăng ký tài khoản Meme</h2>
            </div>
            <form action="regex_sign_in.php" class="form_signin" name="form_signin" method="POST">
                <div class="form_signin__item">
                    <div class="form_signin__item-input">
                        <input name="Name" class="input_item" type="text" placeholder="Tên của bạn">
                    </div>
                    <span class="error"><?php 
                        if(isset($_GET['errorName'])&&$_GET['errorName']=='empty'){
                            echo 'Không được để thông tin trống.';
                        }else if(isset($_GET['errorName'])&&$_GET['errorName']=='wrong'){
                            echo 'Tên không được có ký tự đặc biệt hoặc số.';
                        }?> 

                    </span>
                </div>
                <div class="form_signin__item">
                    <div class="form_signin__item-input">
                        <input id="Email" name="Email" class="input_item" type="text" placeholder="Địa chỉ email của bạn">
                    </div>
                    <span class="error"><?php 
                        if(isset($_GET['errorEmail'])&&$_GET['errorEmail']=='empty'){
                            echo 'Không được để thông tin trống.';
                        }else if(isset($_GET['errorEmail'])&&$_GET['errorEmail']=='wrong'){
                            echo 'Email không hợp lệ (vd: abc@gmail.com)';
                        }else if(isset($_GET['errorEmail'])&&$_GET['errorEmail']=='trung'){
                            echo 'Email đã tồn tại.';
                        }?> 

                    </span>
                </div>
                <div class="form_signin__item">
                    <div class="form_signin__item-input">
                        <input name="Name_account" class="input_item" type="text" placeholder="Tên tài khoản">
                    </div>
                    <span class="error"><?php 
                        if(isset($_GET['errorName_account'])&&$_GET['errorName_account']=='empty'){
                            echo 'Không được để thông tin trống.';
                        }else if(isset($_GET['errorName_account'])&&$_GET['errorName_account']=='wrong'){
                            echo 'Tên đăng nhập phải chứa ít nhất một chữ cái in hoa, một số và có ít nhất 6 ký tự.';
                        }else if(isset($_GET['errorName_account'])&&$_GET['errorName_account']=='trung'){
                            echo 'Tên đăng nhập đã tồn tại.';
                        }?>
                    </span>
                </div>
                <div class="form_signin__item">
                    <div class="form_signin__item-input">
                        <input name="Password" class="input_item password" style="padding-right: 25px" type="password" placeholder="Mật khẩu">
                        <span class="toggle-password eye_pass">
                            <i class="fa-solid fa-eye"></i>
                        </span>
                    </div>
                    <span class="error"><?php 
                        if(isset($_GET['errorPassword'])&&$_GET['errorPassword']=='empty'){
                            echo 'Không được để thông tin trống.';
                        }else if(isset($_GET['errorPassword'])&&$_GET['errorPassword']=='wrong'){
                            echo 'Mật khẩu có có ít nhất 8 ký tự.';
                        }?> 
                    </span>
                </div>
                
                <div class="form_signin__item">
                    <div class="form_signin__item-input">
                        <input name="Re_password" id = "myElement" class="input_item re-password" type="password" style="padding-right: 25px" placeholder="Xác nhận lại mật khẩu của bạn">
                        <span class="toggle-password eye_re-pass">
                            <i class="fa-solid fa-eye"></i>
                        </span>
                    </div>
                    <span class="error"><?php 
                        if(isset($_GET['errorRe_password'])&&$_GET['errorRe_password']=='emptyPass'){
                            echo 'Bạn chưa nhập mật khẩu.';
                        }else if(isset($_GET['errorRe_password'])&&$_GET['errorRe_password']=='empty'){
                            echo 'Không được để thông tin trống.';
                        }else if(isset($_GET['errorRe_password'])&&$_GET['errorRe_password']=='wrong'){
                            echo 'Mật khẩu không trùng khớp.';
                        }?> 
                    </span>
                </div>
                <div class="btn__update-wrap">
                    <input type="submit" value="Đăng ký" class="btn_log_sign">
                </div>
                <div class="signin-transition">
                <p class="question-account">Bạn đã có tài khoản chưa ?</p>
                <a class="form-signin" href="./log_sign.php?pages=log_in">Đăng nhập</a>
                </div>
            </form>
        </div>

        <?php

if(isset($_GET['Name'])){
    $name = $_GET['Name'];
    echo "<script>form_signin.Name.value ='$name';</script>";
}
    if(isset($_GET['Email'])){
        $email = $_GET['Email'];
        echo "<script>form_signin.Email.value ='$email';</script>";
    }

    if(isset($_GET['Name_account'])){
        $name_account = $_GET['Name_account'];
        echo "<script>form_signin.Name_account.value ='$name_account';</script>";
    }

    if(isset($_GET['Password'])){
        $password = $_GET['Password'];
        echo "<script>form_signin.Password.value ='$password';</script>";
    }

    ?>