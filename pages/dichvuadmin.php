<?php
$dichvu = getListDichvu();
echo '<div id="dichvu_wrap">';

// Thêm phần tìm kiếm và nút "Thêm dịch vụ"
echo '<div style="margin-bottom: 15px; display: flex; justify-content: space-between; align-items: center;">';
// Phần tìm kiếm
echo '<div style="display: flex; align-items: center;">';
echo '<input type="text" id="searchInput" placeholder="Tìm kiếm dịch vụ..." style="padding: 8px; border: 1px solid #ddd; border-radius: 4px; margin-right: 5px;">';
echo '<button onclick="searchServices()" style="padding: 8px 15px; background-color: #2196F3; color: white; border: none; border-radius: 4px; cursor: pointer;">';
echo '<i class="fa-solid fa-search fa-fw"></i> Tìm kiếm';
echo '</button>';
echo '</div>';

// Nút thêm dịch vụ
echo '<button onclick="openAddModal()" style="padding: 8px 15px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;">';
echo '<i class="fa-solid fa-plus fa-fw"></i> Thêm dịch vụ';
echo '</button>';
echo '</div>';

echo '<table border="1" cellpadding="10" cellspacing="0" style="width:100%; border-collapse:collapse;">';
echo '<thead>';
echo '<tr>';
echo '<th>Hình ảnh</th>';
echo '<th>Mã dịch vụ</th>';
echo '<th>Tên dịch vụ</th>';
echo '<th>Mô tả</th>';
echo '<th>Giá</th>';
echo '<th>Tác vụ</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody id="serviceTableBody">'; // Thêm ID cho tbody để cập nhật kết quả tìm kiếm

foreach ($dichvu as $row) {
    echo '<tr>';
    echo '<td><img src="./img/' . $row['NAMEANH'] . '" style="max-width:100px; max-height:100px;"></td>';
    echo '<td>' . $row['MADICHVU'] . '</td>';
    echo '<td>' . $row['TENDICHVU'] . '</td>';
    echo '<td>' . $row['MOTA'] . '</td>';
    echo '<td>' . number_format($row['PRICE'], 0, ',', '.') . ' <i class="fa-solid fa-dong-sign fa-fw"></i></td>';
    echo '<td style="white-space: nowrap;">';
    echo '<button onclick="openEditModal(\'' . $row['MADICHVU'] . '\')" style="padding: 5px 10px; margin-right: 5px; background-color: #2196F3; color: white; border: none; border-radius: 4px; cursor: pointer;">';
    echo '<i class="fa-solid fa-pen-to-square fa-fw"></i> Sửa';
    echo '</button>';
    echo '<button onclick="confirmDelete(\'' . $row['MADICHVU'] . '\', \'' . $row['TENDICHVU'] . '\')" style="padding: 5px 10px; background-color: #f44336; color: white; border: none; border-radius: 4px; cursor: pointer;">';
    echo '<i class="fa-solid fa-trash-can fa-fw"></i> Xóa';
    echo '</button>';
    echo '</td>';
    echo '</tr>';
}

echo '</tbody>';
echo '</table>';
echo '</div>';

// Modal thêm/sửa (giữ nguyên như trước)
echo '
<div id="serviceModal" style="display:none; position:fixed; z-index:100; left:0; top:0; width:100%; height:100%; background-color:rgba(0,0,0,0.4);">
    <div style="background-color:#fefefe; margin:5% auto; padding:20px; border:1px solid #888; width:50%;">
        <span onclick="closeModal()" style="float:right; cursor:pointer; font-size:28px; font-weight:bold;">&times;</span>
        <h2 id="modalTitle">Thêm dịch vụ mới</h2>
        <form id="serviceForm">
            <input type="hidden" id="madichvu">
            <div style="margin-bottom:15px;">
                <label style="display:block; margin-bottom:5px;">Tên dịch vụ:</label>
                <input type="text" id="tendichvu" style="width:100%; padding:8px;">
            </div>
            <div style="margin-bottom:15px;">
                <label style="display:block; margin-bottom:5px;">Mô tả:</label>
                <textarea id="mota" style="width:100%; padding:8px; height:100px;"></textarea>
            </div>
            <div style="margin-bottom:15px;">
                <label style="display:block; margin-bottom:5px;">Giá:</label>
                <input type="number" id="price" style="width:100%; padding:8px;">
            </div>
            <div style="margin-bottom:15px;">
                <label style="display:block; margin-bottom:5px;">Hình ảnh:</label>
                <input type="file" id="image" accept="image/*">
            </div>
            <button type="button" onclick="saveService()" style="padding:10px 15px; background-color:#4CAF50; color:white; border:none; border-radius:4px; cursor:pointer;">Lưu</button>
        </form>
    </div>
</div>
';

// JavaScript xử lý các hành động (bổ sung hàm tìm kiếm)
echo '
<script>
// Hàm tìm kiếm dịch vụ
function searchServices() {
    const searchTerm = document.getElementById("searchInput").value.toLowerCase();
    const rows = document.querySelectorAll("#serviceTableBody tr");
    
    rows.forEach(row => {
        const serviceName = row.cells[2].textContent.toLowerCase(); // Cột tên dịch vụ
        const serviceCode = row.cells[1].textContent.toLowerCase(); // Cột mã dịch vụ
        const serviceDesc = row.cells[3].textContent.toLowerCase(); // Cột mô tả
        
        if (serviceName.includes(searchTerm) || 
            serviceCode.includes(searchTerm) || 
            serviceDesc.includes(searchTerm)) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
}

// Cho phép tìm kiếm khi nhấn Enter
document.getElementById("searchInput").addEventListener("keyup", function(event) {
    if (event.key === "Enter") {
        searchServices();
    }
});

// Các hàm khác giữ nguyên như trước
function openAddModal() {
    document.getElementById("modalTitle").innerText = "Thêm dịch vụ mới";
    document.getElementById("madichvu").value = "";
    document.getElementById("tendichvu").value = "";
    document.getElementById("mota").value = "";
    document.getElementById("price").value = "";
    document.getElementById("image").value = "";
    document.getElementById("serviceModal").style.display = "block";
}

function openEditModal(madichvu) {
    document.getElementById("modalTitle").innerText = "Sửa dịch vụ";
    document.getElementById("serviceModal").style.display = "block";
}

function closeModal() {
    document.getElementById("serviceModal").style.display = "none";
}

function saveService() {
    alert("Chức năng lưu đang được phát triển");
}

function confirmDelete(madichvu, tendichvu) {
    if (confirm(`Bạn có chắc chắn muốn xóa dịch vụ "${tendichvu}" (${madichvu}) không?`)) {
        alert("Chức năng xóa đang được phát triển");
    }
}
</script>
';

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
        echo 'thất bại';
        return null;
    }
    return $dichvu;
}