<?php
include('connectDatabase.php'); // Đảm bảo đúng đường dẫn tới file chứa class connectDatabase

$database = new connectDatabase();

if ($database->conn) {
    echo "Kết nối MySQL thành công!";
} else {
    echo "Kết nối MySQL thất bại!!!!";
}
?>

<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);
?>
