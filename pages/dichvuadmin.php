<?php
$dichvu = getListDichvu();
echo '<div id="dichvu_wrap">';
echo '<table class="dichvu_table">';
echo '<thead>';
echo '<tr>';
echo '<th>Image</th>';
echo '<th>Code</th>';
echo '<th>Name</th>';
echo '<th>Description</th>';
echo '<th>Price</th>';
echo '<th>Action</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
foreach ($dichvu as $row) {
    echo '<tr>';
    echo '<td><img src="./img/' . $row['NAMEANH'] . '" alt="' . $row['TENDICHVU'] . '"></td>';
    echo '<td class="dichvu_code">' . $row['MADICHVU'] . '</td>';
    echo '<td class="dichvu_name">' . $row['TENDICHVU'] . '</td>';
    echo '<td class="dichvu_desc">' . $row['MOTA'] . '</td>';
    echo '<td class="dichvu_price">' . $row['PRICE'] . '</td>';
    echo '<td><i class="fa-solid fa-pen-to-square fa-fw edit_dichvu" title="Edit" data-code="' . $row['MADICHVU'] . '" data-name="' . $row['TENDICHVU'] . '" data-desc="' . $row['MOTA'] . '" data-price="' . $row['PRICE'] . '" data-image="' . $row['NAMEANH'] . '"></i></td>';
    echo '</tr>';
}
echo '</tbody>';
echo '</table>';
echo '</div>';

echo '<div id="edit_dichvu_modal" class="modal_new">';
echo '<div class="modal_input_wrap">';
echo '<h3 class="change_usser_title">Edit Service</h3>';
echo '<i class="fa-solid fa-times btn_exit" id="btn_exit_edit_dichvu"></i>';
echo '<div class="form_modal_input">';
echo '<label class="model_iput_name">Code: <input type="text" id="edit_code" readonly></label>';
echo '<label class="model_iput_name">Name: <input type="text" id="edit_name"></label>';
echo '<label class="model_iput_name">Description: <input type="text" id="edit_desc"></label>';
echo '<label class="model_iput_name">Price: <input type="number" id="edit_price"></label>';
echo '<label class="model_iput_name">Image: <input type="text" id="edit_image"></label>';
echo '</div>';
echo '</div>';
echo '</div>';

echo '<script>';
echo 'document.querySelectorAll(".edit_dichvu").forEach(button => {';
echo 'button.addEventListener("click", function() {';
echo 'document.getElementById("edit_dichvu_modal").style.display = "block";';
echo 'document.getElementById("edit_code").value = this.getAttribute("data-code");';
echo 'document.getElementById("edit_name").value = this.getAttribute("data-name");';
echo 'document.getElementById("edit_desc").value = this.getAttribute("data-desc");';
echo 'document.getElementById("edit_price").value = this.getAttribute("data-price");';
echo 'document.getElementById("edit_image").value = this.getAttribute("data-image");';
echo '});';
echo '});';
echo 'document.getElementById("btn_exit_edit_dichvu").addEventListener("click", function() {';
echo 'document.getElementById("edit_dichvu_modal").style.display = "none";';
echo '});';
echo '</script>';

function getListDichvu()
{
    $dichvu = array();
    require_once('./database/connectDatabase.php');
    $connection = new connectDatabase();
    $query = "SELECT * FROM dichvu";
    $result = $connection->executeQuery($query);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $dichvu[] = $row;
        }
    } else {
        echo 'Thất bại';
        return null;
    }
    return $dichvu;
}