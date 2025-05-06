<?php
// TAO QR, LUU THONG TIN THANH TOAN VAO SESSION, NMA CHUA CAP NHAT SQL
session_start();
header('Content-type: text/html; charset=utf-8');
header('Access-Control-Allow-Headers: *');
header("Access-Control-Allow-Origin: *"); // or use your specific domain
header("Access-Control-Allow-Methods: GET, OPTIONS");

$data2 = json_decode(file_get_contents('php://input'), true);
require_once('../database/connectDatabase.php');

// Tạo session mặc định khi trang được truy cập
if (!isset($_SESSION['payment_status'])) {
    $_SESSION['payment_status'] = 'pending'; // Hoặc giá trị mặc định nào khác mà bạn muốn
}
if(!isset($_SESSION['data2'])) {
    $_SESSION['data2'] = $data2; // Hoặc giá trị mặc định nào khác mà bạn muốn
}
// Hàm gửi yêu cầu POST
function execPostRequest($url, $data)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data))
    );
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

$endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
$partnerCode = 'MOMOBKUN20180529';
$accessKey = 'klm05TvNBzhg7h7j';
$secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
$orderInfo = "Thanh toán qua MoMo";

// Lấy giá trị selectedTotal từ session
$selectedTotal = $data2['tongtien']; // Giá trị tổng tiền đã chọn
$amount = $selectedTotal; // Sử dụng selectedTotal làm amount
$orderId = time() . "";
$redirectUrl = "http://localhost/WEB---FILM/index.php?pages=momoPage.php"; // Đường dẫn đến thanhtoan.php
$ipnUrl = "http://yourdomain.com/ipn.php"; // Đường dẫn IPN nếu cần
$extraData = "";

if (empty($_POST)) {
    $requestId = time() . "";
    $requestType = "captureWallet";

    // Tạo chữ ký
    $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
    $signature = hash_hmac("sha256", $rawHash, $secretKey);

    // Dữ liệu để gửi
    $data = array(
        'partnerCode' => $partnerCode,
        'partnerName' => "Test",
        "storeId" => "MomoTestStore",
        'requestId' => $requestId,
        'amount' => $amount,
        'orderId' => $orderId,
        'orderInfo' => $orderInfo,
        'redirectUrl' => $redirectUrl,
        'ipnUrl' => $ipnUrl,
        'lang' => 'vi',
        'extraData' => $extraData,
        'requestType' => $requestType,
        'signature' => $signature
    );

    // Gửi yêu cầu POST
    $result = execPostRequest($endpoint, json_encode($data));
    $jsonResult = json_decode($result, true);  // decode json
    addTicketToSession($data2); // Lưu thông tin vé vào session
    // Kiểm tra nội dung của $jsonResult
    if (isset($jsonResult['payUrl'])) {
        // Chuyển hướng đến URL thanh toán
       
        header('Location: ' . $jsonResult['payUrl']);
        // echo '<script type="text/javascript">window.location.href = "' . $jsonResult['payUrl'] . '";</script>';
      exit(); // Thêm exit để ngăn chặn thực thi mã sau khi chuyển hướng
    } else {
        echo "Lỗi: " . (isset($jsonResult['message']) ? $jsonResult['message'] : 'Không có thông tin chi tiết');
        error_log("Kết quả trả về từ MoMo: " . $result);
    }
}

// Kiểm tra trạng thái thanh toán sau khi người dùng quay lại
if (isset($_GET['resultCode'])) {
    if ($_GET['resultCode'] == '0') {
        $_SESSION['payment_status'] = 'momo_success'; // Lưu trạng thái thanh toán thành công
        echo "Thanh toán thành công!";
        updateDataBase($_SESSION['data2']); // Cập nhật cơ sở dữ liệu
    } else {
        $_SESSION['payment_status'] = 'momo_failed'; // Lưu trạng thái thanh toán thất bại
        echo "Thanh toán thất bại!";
        
    }
}
function addTicketToSession($data2){
     // Truy xuất các phần tử của mảng $data và gán cho các biến tương ứng
     $_SESSION['data2'] = $data2; // Lưu thông tin vé vào session
}
function updateDataBase($data2){
    if ($data2 !== null) {
        $connect = new connectDatabase();
        // Truy xuất các phần tử của mảng $data và gán cho các biến tương ứng
        $username = $data2['username'];
        $malichchieu = $data2['malichchieu'];
        $maghes = $data2['maghes'];
        $tongtien = $data2['tongtien'];
        $ngay = $data2['ngay'];
        $thoigian = $data2['thoigian'];
        $phuongthucthanhtoan = $data2['phuongthucthanhtoan'];
        $bapnuocs = $data2['bapnuocs'];
        // Tạo mã vé tự động
        $veSql = "SELECT COUNT(*) AS total_rows FROM ve";
        $veQuery = $connect->executeQuery($veSql);
        $result = mysqli_fetch_assoc($veQuery);
        $totalRows = intval($result['total_rows']) + 1;

        $remainingLength = 4; // độ dài phần sau tiền tố 'MV'
        $mave =  'MV' . str_pad($totalRows, $remainingLength, '0', STR_PAD_LEFT);

        // UPDATE table chitietve_dichvu
        foreach($bapnuocs as $tendichvu => $thongtin) {
            $madichvu = $thongtin['madichvu'];
            $soluong = $thongtin['soluong'];

            if($soluong > 0) {
                $upDateChiTietVeDichVuSql  = " INSERT INTO chitietve_dichvu(MAVE, MADICHVU, SOLUONG)
                VALUES ('$mave', '$madichvu', '$soluong') ";
                $connect->executeQuery($upDateChiTietVeDichVuSql); // trả về true nếu thành công, ngược lại là false
            }  
        }

        // UPDATE table ve
        $upDateSql  = " INSERT INTO ve(MAVE, USERNAME, MALICHCHIEU, TONGTIEN, NGAY, THOIGIAN, PHUONGTHUCTHANHTOAN,DATHANHTOAN)
                        VALUES ('$mave', '$username', '$malichchieu', '$tongtien', '$ngay', '$thoigian', '$phuongthucthanhtoan','true')
                    ";
        $upDateQuery = $connect->executeQuery($upDateSql); // trả về true nếu thành công, ngược lại là false

        // UPDATE chitietve_ghe 
        foreach($maghes as $maghe => $price) {
            $upDateChiTietVeGheSql  = " INSERT INTO chitietve_ghe(MAVE, MAGHE, PRICE)
                        VALUES ('$mave', '$maghe', '$price') ";
            $connect->executeQuery($upDateChiTietVeGheSql); // trả về true nếu thành công, ngược lại là false
        }

        echo "Cập nhật vé đã mua thành công";
    } else {
        // Xử lý trường hợp không nhận được dữ liệu hoặc dữ liệu không hợp lệ
        echo "Không nhận được dữ liệu hoặc dữ liệu không hợp lệ";
    }
}
?>

