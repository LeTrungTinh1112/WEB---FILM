<?php
$list = actorList();
echo '<div id="actor_wrap" style="padding: 20px;">';

// Thêm phần tìm kiếm và nút "Thêm diễn viên"
echo '<div style="margin-bottom: 15px; display: flex; justify-content: space-between; align-items: center;">';
// Phần tìm kiếm
echo '<div style="display: flex; align-items: center;">';
echo '<input type="text" id="searchInput" placeholder="Tìm kiếm diễn viên..." style="padding: 8px; border: 1px solid #ddd; border-radius: 4px; margin-right: 5px;">';
echo '<button onclick="searchActors()" style="padding: 8px 15px; background-color: #2196F3; color: white; border: none; border-radius: 4px; cursor: pointer;">';
echo '<i class="fa-solid fa-search fa-fw"></i> Tìm kiếm';
echo '</button>';
echo '</div>';

// Nút thêm diễn viên
echo '<button onclick="openAddModal()" style="padding: 8px 15px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;">';
echo '<i class="fa-solid fa-plus fa-fw"></i> Thêm diễn viên';
echo '</button>';
echo '</div>';

echo '<table border="1" cellpadding="10" cellspacing="0" style="width:100%; border-collapse:collapse;">';
echo '<thead>';
echo '<tr>';
echo '<th>Hình ảnh</th>';
echo '<th>Mã diễn viên</th>';
echo '<th>Tên diễn viên</th>';
echo '<th>Tác vụ</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody id="actorTableBody">';

foreach ($list as $item) {
    echo '<tr>';
    echo '<td><img src="./img/' . $item['NAMEANH'] . '" style="max-width:100px; max-height:100px;"></td>';
    echo '<td>' . $item['MADV'] . '</td>';
    echo '<td>' . $item['TENDV'] . '</td>';
    echo '<td style="white-space: nowrap;">';
    echo '<button onclick="openEditModal(\'' . $item['MADV'] . '\')" style="padding: 5px 10px; margin-right: 5px; background-color: #2196F3; color: white; border: none; border-radius: 4px; cursor: pointer;">';
    echo '<i class="fa-solid fa-pen-to-square fa-fw"></i> Sửa';
    echo '</button>';
    echo '<button onclick="confirmDelete(\'' . $item['MADV'] . '\', \'' . $item['TENDV'] . '\')" style="padding: 5px 10px; background-color: #f44336; color: white; border: none; border-radius: 4px; cursor: pointer;">';
    echo '<i class="fa-solid fa-trash-can fa-fw"></i> Xóa';
    echo '</button>';
    echo '</td>';
    echo '</tr>';
}

echo '</tbody>';
echo '</table>';
echo '</div>';

// Modal thêm/sửa diễn viên
echo '
<div id="actorModal" style="display:none; position:fixed; z-index:100; left:0; top:0; width:100%; height:100%; background-color:rgba(0,0,0,0.4);">
    <div style="background-color:#fefefe; margin:5% auto; padding:20px; border:1px solid #888; width:50%;">
        <span onclick="closeModal()" style="float:right; cursor:pointer; font-size:28px; font-weight:bold;">&times;</span>
        <h2 id="modalTitle">Thêm diễn viên mới</h2>
        <form id="actorForm">
            <input type="hidden" id="madv">
            <div style="margin-bottom:15px;">
                <label style="display:block; margin-bottom:5px;">Tên diễn viên:</label>
                <input type="text" id="tendv" style="width:100%; padding:8px;">
            </div>
            <div style="margin-bottom:15px;">
                <label style="display:block; margin-bottom:5px;">Hình ảnh:</label>
                <input type="file" id="image" accept="image/*">
            </div>
            <button type="button" onclick="saveActor()" style="padding:10px 15px; background-color:#4CAF50; color:white; border:none; border-radius:4px; cursor:pointer;">Lưu</button>
        </form>
    </div>
</div>
';

// JavaScript xử lý các hành động
echo '
<script>
// Hàm tìm kiếm diễn viên
function searchActors() {
    const searchTerm = document.getElementById("searchInput").value.toLowerCase();
    const rows = document.querySelectorAll("#actorTableBody tr");
    
    rows.forEach(row => {
        const actorName = row.cells[2].textContent.toLowerCase(); // Cột tên diễn viên
        const actorCode = row.cells[1].textContent.toLowerCase(); // Cột mã diễn viên
        
        if (actorName.includes(searchTerm) || actorCode.includes(searchTerm)) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
}

// Cho phép tìm kiếm khi nhấn Enter
document.getElementById("searchInput").addEventListener("keyup", function(event) {
    if (event.key === "Enter") {
        searchActors();
    }
});

function openAddModal() {
    document.getElementById("modalTitle").innerText = "Thêm diễn viên mới";
    document.getElementById("madv").value = "";
    document.getElementById("tendv").value = "";
    document.getElementById("image").value = "";
    document.getElementById("actorModal").style.display = "block";
}

function openEditModal(madv) {
    document.getElementById("modalTitle").innerText = "Sửa diễn viên";
    document.getElementById("actorModal").style.display = "block";
    // Chức năng lấy dữ liệu chi tiết sẽ được phát triển sau
}

function closeModal() {
    document.getElementById("actorModal").style.display = "none";
}

function saveActor() {
    alert("Chức năng lưu đang được phát triển");
}

function confirmDelete(madv, tendv) {
    if (confirm(`Bạn có chắc chắn muốn xóa diễn viên "${tendv}" (${madv}) không?`)) {
        alert("Chức năng xóa đang được phát triển");
    }
}
</script>
';

function actorList()
{
    $list = array();
    require_once('./database/connectDatabase.php');
    $conn = new connectDatabase();

    $query = "SELECT * FROM dienvien";
    $result = $conn->executeQuery($query);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $list[] = $row;
        }
    } else {
        echo 'Thất bại';
        return null;
    }
    return $list;
}