<?php

function getUserAll(){
    if(isset($_GET['USERNAME']) || isset($_GET['userdel']))
        require_once("../database/connectDatabase.php");
    else
        require_once("./database/connectDatabase.php");
    $userList = array();
    $conn = new connectDatabase();
    $query = "SELECT * FROM taikhoan WHERE TRANGTHAI <> 2";
    $result = $conn->executeQuery($query);
    if($result){
        while($row = $result->fetch_assoc()) {
            $userList[] = $row;
        }
    } else {
        echo 'error';
        return null;
    }
    return $userList;
}

function userChoose(){
    $userUp = array();
    if(isset($_GET['USERNAME'])) {
        $username = $_GET['USERNAME'];
        $list = getUserAll();
        foreach($list as $row){
            if($row['USERNAME'] == $username){
                $userUp = $row;
                break; 
            }
        }
    } else {
        echo 'error';
        return null;
    }
    return $userUp;
}


function del(){
    if(isset($_GET['userdel'])){
        require_once("../database/connectDatabase.php");
    }else{
        require_once("./database/connectDatabase.php");
    }
    $conn = new connectDatabase();
    $username = $_GET['userdel'];
    $sql = "UPDATE  taikhoan SET TRANGTHAI = 2 WHERE USERNAME='$username'";
    $conn->executeQuery($sql);
}

if(isset($_GET['userdel'])){
    del();
}

echo '<div class="account__position">
<div class="account__add" id="acount__add">
    Thêm tài khoản
</div>
</div>';

echo '<div id="users_wrap">
<div class="user userheader">
    <span class="user_date">THỜI GIAN TẠO TK</span>
    <span class="user_username">USERNAME</span>
    <span class="user_email">EMAIL</span>
    <span class="user_name">HỌ TÊN</span>
    <span class="user_maquyen">MÃ QUYỀN</span>
    <span class="user_status">TRẠNG THÁI</span>
</div>
<div id="usercontent">';
$list = getUserAll();
foreach ($list as $row) {
    echo '<div class="user">
        <span class="user_date">'.$row['NGAYTAOTK'].' '.$row['THOIGIANTAOTK'].'</span>
        <span class="user_username">'.$row['USERNAME'].'</span>
        <span class="user_email">'.$row['EMAIL'].'</span>
        <span class="user_name">'.$row['HOTEN'].'</span>
        <span class="user_maquyen">'.$row['MAQUYEN'].'</span>
        <span class="user_status">'.(($row['TRANGTHAI'] == 1) ? 'Hoạt động' : 'Bị khóa').'</span>
        <i class="fa-solid fa-pen-to-square fa-fw" name="'.$row['USERNAME'].'"></i>
        <i class="fa-solid fa-trash" name="'.$row['USERNAME'].'"></i>
    </div>';
}
echo '</div>
</div>'; 

echo '<div id="users_wrap_change">';
echo '<div id="old_user" >';
echo '<h4 class="change_usser_title">Thông tin hiện tại</h4>';
echo '<div class="showInfor">';
echo '<div class="mota_Infor">';
echo '<div>Username:</div>';
echo '<div>Họ tên:</div>';
echo '<div>Email:</div>';
echo '<div>Mã quyền:</div>';
echo '<div>Tình trạng:</div>';
echo '</div>';
echo '<div class="mota_Infor" id="value_Infor_Old">';
if(isset($_GET['USERNAME'])){
    $userUp = userChoose();
    echo '<div>'.$userUp['USERNAME'].'</div>';
    echo '<div>'.$userUp['HOTEN'].'</div>';
    echo '<div>'.$userUp['EMAIL'].'</div>';
    echo '<div>'.$userUp['MAQUYEN'].'</div>';
    echo '<div>'.(($userUp['TRANGTHAI'])== 1 ? 'Hoạt động' : 'Khóa').'</div>';
}
echo '</div>';
echo '</div>';
echo '</div>';
echo '<div id="new_user" >';
echo '<h4 class="change_usser_title">Thông tin mới</h4>';
echo '<form style="width:100%;" method="get" action="./pages/xulyUpdateTK.php">';
echo '<div  class="showInfor">';
echo '<div class="mota_Infor">';
echo '<div>Username:</div>';
echo '<div>Họ tên:</div>';
echo '<div>Email:</div>';
echo '<div>Mã quyền:</div>';
echo '<div>Tình trạng:</div>';
echo '</div>';
echo '<div class="mota_Infor" id="value_Infor">';
if(isset($_GET['USERNAME'])){
    $row = userChoose();
    echo '<input name="username" value="'.$row['USERNAME'].'"  type="text" readonly>';
    echo '<input name="hoten" type="text" placeholder="Nhập giá trị mới">';
    echo '<input name="email" type="text" placeholder="Nhập giá trị mới">';
    $query = "SELECT * FROM quyen";
    $conn = new connectDatabase();
    $result = $conn->executeQuery($query);
    echo '<select name="quyen" id="quyen">';
    while($quyen = mysqli_fetch_array($result)){
        $selected = ($row['MAQUYEN'] == $quyen['MAQUYEN']) ? 'selected' : '';
        echo '<option value="'.$quyen['MAQUYEN'].'" '.$selected.'>'.$quyen['TENQUYEN'].'</option>';
    }
    echo '</select>';
    echo '<select name="trangthai" id="trangthai">';
    echo '<option value="1" '.(($row['TRANGTHAI']) == 1 ? 'selected' : '').'>Hoạt động</option>';
    echo '<option value="0" '.(($row['TRANGTHAI']) == 0 ? 'selected' : '').'>Khóa</option>';
    echo '</select>';
}
echo '</div>';
echo '</div>';
echo '<div id="btn_wrap_change_user">';
echo '<button id="btnDelAll" type="reset">Xóa tất cả</button>';
echo '<button id="btnUp" type="submit">Xác nhận</button>';
echo '</div>';
echo '</form>';
echo '</div>';
echo '<span id="btn_exit"><i class="fa-solid fa-x"></i></span>';
echo '</div>';

echo '<div class="account__box" id="account__box">';
echo '<div class="account__title">
    Thêm tài khoản
    <div class="account__icon" id="account__icon">
        <i class="fa-solid fa-xmark"></i>
    </div>
</div>';
echo '<form name="user" class="account__tbl" action="./pages/xulyAddTK.php" method="post" id="accountForm">';
echo '<div>';
echo '<label for="username">Username:</label>';
echo '<input type="text" name="USERNAME" value="'.((isset($_GET['username'])) ? $_GET['username'] : '').'">';
echo  '<span class="error">';
        if(isset($_GET['errorUsername'])){
            if($_GET['errorUsername'] == 'empty'){
                echo 'Không được để rỗng';
            }else if($_GET['errorUsername'] == 'exist'){
                echo 'Username đã tồn tại';
            }else if($_GET['errorUsername'] == 'char'){
                echo '6 ký tự tối thiểu';
            }
        }
echo '</span>';
echo '</div>';
echo '<div>';
echo '<label for="hoten">Họ tên:</label>';
echo '<input type="text" name="HOTEN" value="'.((isset($_GET['hoten'])) ? $_GET['hoten'] : '').'">';
echo '<span class="error">';
        if(isset($_GET['errorHoten']) && $_GET['errorHoten'] == 'empty'){
            echo 'Không được để trống';
        }
echo '</span>';
echo '</div>';
echo '<div>';
echo '<label for="password">Password:</label>';
echo '<input type="password" name="PASSWORD" value="'.((isset($_GET['password'])) ? $_GET['password'] : '').'">';
echo '<span class="error">';
         if(isset($_GET['errorPassword'])){
            if($_GET['errorPassword'] == 'empty') {
                echo 'Không được để trống';
            }else if($_GET['errorPassword'] == 'char'){
                echo '8 ký tự tối thiểu';
            }
        }
echo '</span>';
echo '</div>';
echo '<div>';
echo '<label for="email">Email:</label>';
echo '<input type="text" name="EMAIL" value="'.((isset($_GET['email'])) ? $_GET['email'] : '').'">';
echo '<span class="error">';
        if(isset($_GET['errorEmail'])){
            if($_GET['errorEmail'] == 'empty'){
                echo 'Không được để trống';
            }else if($_GET['errorEmail'] == 'exist'){
                echo 'Email đã tồn tại';
            }else if($_GET['errorEmail'] == 'char'){
                echo 'Email không hợp lệ';
            }
        }
echo '</span>';
echo '</div>';
echo '<div>';
echo '<label for="sdt">Số điện thoại:</label>';
echo '<input type="text" name="SODIENTHOAI" value="'.((isset($_GET['sdt'])) ? $_GET['sdt'] : '').'">';
echo '<span class="error">';
        if(isset($_GET['errorSDT'])){
            if($_GET['errorSDT'] == 'empty'){
                echo 'Không được để trống';
            }else if($_GET['errorSDT'] == 'char'){
                echo 'Không hợp lệ';
            }
        }
echo '</span>';
echo '</div>';
echo '<div>';
$maquyen = isset($_GET['quyen']) ? $_GET['quyen'] : '';
echo '<label for="quyen">Quyền:</label>';
echo '<select name="MAQUYEN" id="quyen">';
echo '<option value="QKH" '.($maquyen == "QKH" ? "selected" : "").'>Quyền khách hàng</option>';
echo '<option value="QQL" '.($maquyen == "QQL" ? "selected" : "").'>Quyền quản lý</option>';
echo '<option value="QAD" '.($maquyen == "QAD" ? "selected" : "").'>Quyền Admin</option>';
echo '</select>';
echo '</div>';
echo '<div class="account__btn">';
echo '<input type="submit" value="Thêm">';
echo '</div>';
echo '</form>';
echo '</div>';


?>
