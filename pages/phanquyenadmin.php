<?php
function layMaQuyen($str) {
    $words = explode(' ', $str);
    $result = '';
    foreach ($words as $word) {
        $result .= strtoupper(substr($word, 0, 1));
    }
    return $result;
}

require_once('./database/connectDatabase.php');
$conn = new connectDatabase();
$sqlBTNQuyen = "SELECT* FROM quyen ";
$resultBTN = $conn->executeQuery($sqlBTNQuyen);

if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['model_iput_name'])){
    $tenQuyen = $_POST['model_iput_name'];
    $maQuyen = layMaQuyen($tenQuyen);
    $sql = "INSERT INTO quyen (MAQUYEN, TENQUYEN) 
                        VALUES ('$maQuyen','$tenQuyen')";  
    $conn->executeQuery($sql);
    header("Location: admin.php?page=phanquyenadmin");
}

$conn->disconnect();

?>
<div class="modal_new">
  <form action="admin.php?page=phanquyenadmin" class="form_modal_input" name="form_modal_input" method="POST">
    <div class="modal_input_wrap">
      <div class="modal_input_tenQuyen">
        <span>Tên quyền</span> 
        <input type="text" name="model_iput_name" class="model_iput_name" autocomplete="off">
      </div>
      <div class="modal_btn_wrap">
      <span class="btn_cancel">Cancel </span>
        <input type="submit" value="Submit" name="modal_submit" class="modal_submit">
        
      </div>
    </div>
    <div class="modal_delete_wrap">
      <div class="modal_delete_tenQuyen">
        
      </div>
      <div class="modal_btn_wrap">
      <span class="btn_cancel_delete">Cancel </span>
        <input type="button" value="Submit" name="modal_submit_delete" class="modal_submit_delete">
        
      </div>
    </div>
  </form>
</div>
<div class="phanquyen_wrap" name="QAD">
    <ul class="phanquyen_wrap_quyen" id="phanquyen_wrap_quyen">

        <?php 
            if ($resultBTN->num_rows > 0) {
                $flag = true;
                while($row = $resultBTN->fetch_assoc()) {
                    if($flag){
                        echo "<li class='btn_phanquyen quyen_selected' name=".$row['MAQUYEN'].">".$row['TENQUYEN']."</li>";
                        $flag=false;
                    }else{
                        echo "<li class='btn_phanquyen ' name=".$row['MAQUYEN'].">".$row['TENQUYEN']."</li>";
                    }
                }
            } else {
                echo "Sai truy van";
            }
        ?>
        
        <!-- <li class="btn_phanquyen" name="QQL">Quyền quản lí</li>
        <li class="btn_phanquyen quyen_selected" name="QAD">Quyền Admin</li> -->


        <li class="btn_thaotacphanquyen " name="new_quyen">
            <i class="fa-solid fa-plus"></i>
        </li>
        <li class="btn_thaotacphanquyen" name="edit_quyen">
            <i class="fa-solid fa-pen"></i>
        </li>
        <li class="btn_thaotacphanquyen" name="remove_quyen">
            <i class="fa-solid fa-trash"></i>
        </li>
        <li class="btn_thaotacphanquyen" name="acept_edit" style="display: none;">
            Accept
        </li>
    </ul>
    <div class="phanquyen_wrap_header">
        <div name="cotdetrong"></div>
        <div class="phanquyen_hanhdong">Xem</div>
        <div class="phanquyen_hanhdong">Thêm</div>
        <div class="phanquyen_hanhdong">Sửa</div>
        <div class="phanquyen_hanhdong">Xóa</div>
    </div>
    <div class="phanquyen_wrap" id="phanquyen_wrap">
        
    </div>
    
</div>