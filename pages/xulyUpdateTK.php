<?php
require_once('../database/connectDatabase.php');
$conn = new connectDatabase();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $username = $_GET['username'];
    $hoten = $_GET['hoten'];
    $email = $_GET['email'];
    $quyen = $_GET['quyen'];
    $trangthai = $_GET['trangthai'];

    if (!empty($hoten) || !empty($email) || !empty($quyen) || isset($trangthai)) {
        $sql = "UPDATE taikhoan SET ";

        if (!empty($hoten)) {
            $sql .= "HOTEN = '$hoten', ";
        }

        if (!empty($email)) {
            $sql .= "EMAIL = '$email', ";
        }

        if (!empty($quyen)) {
            $sql .= "MAQUYEN = '$quyen', ";
        }

        if (isset($trangthai)) {
            $sql .= "TRANGTHAI = $trangthai, ";
        }

        $sql = rtrim($sql, ", ");
        $sql .= " WHERE USERNAME = '$username'";

        if ($conn->executeQuery($sql)) {
            header("location: ../admin.php?page=usersadmin");
        } else {
            echo "Có lỗi xảy ra khi cập nhật dữ liệu.";
        }
    }
}

$conn->disconnect();
?>
