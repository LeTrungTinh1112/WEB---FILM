<?php 
    require_once('./database/connectDatabase.php');
    $conn = new connectDatabase();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lọc Suất Chiếu</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        .box1 button {
            float: right;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="my-4">Lọc Suất Chiếu Theo Ngày</h2>
        <div class="form-group">
            <label for="ngay">Chọn Ngày:</label>
            <input type="date" class="form-control" id="ngay" name="ngay">
            <button class="btn btn-primary" onclick="filterByDate()">Lọc</button>
        </div>
        <div id="suatchieu-container">
            <div class="box1">
                <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Thêm</button>
            </div>
            <table class="table table-hover table-bordered table-striped">
                <thead>
                    <th>Mã Suất Chiếu</th>
                    <th>Ngày</th>
                    <th>Thời Gian Bắt Đầu</th>
                    <th>Cập Nhật</th>
                    <th>Xóa</th>
                </thead>
                <tbody>
                    <?php 
                        $query = "SELECT * FROM suatchieu";
                        $result = $conn->executeQuery($query);
                        if(!$result) {
                            echo 'failed';
                        } else {
                            while($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row['MASC']; ?></td>
                        <td><?php echo $row['NGAY']; ?></td>
                        <td><?php echo $row['THOIGIANBATDAU']; ?></td>
                        <td><button class="btn btn-success" onclick="openEditNgayLeForm('<?php echo $row['MASC'] ?>', '<?php echo $row['NGAY']; ?>', '<?php echo $row['THOIGIANBATDAU']; ?>')">Cập Nhật</button></td>
                        <td><a href="./pages/deleteNgayLe.php?sid=<?php echo $row['MASC']; ?>" class="btn btn-danger">Xóa</a></td>
                    </tr>
                    <?php
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- form them suat chieu -->
    <form action="./pages/insertSuatChieu.php" method="post" id="themSuatChieu">
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Thêm Suất Chiếu</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="ngay">Ngày</label>
                                <input type="date" name="ngay" id="ngay" class="form-control" required>
                                <span id="ngayError" style="color: red;"></span>
                            </div>
                            <div class="form-group">
                                <label for="gioBatDau">Giờ Bắt Đầu</label>
                                <select name="gioBatDau" id="gioBatDau" class="form-control">
                                    <?php for($i = 1; $i <= 23; $i++): ?>
                                        <option value="<?= $i ?>"><?= str_pad($i, 2, '0', STR_PAD_LEFT) ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="phutBatDau">Phút Bắt Đầu</label>
                                <select name="phutBatDau" id="phutBatDau" class="form-control">
                                    <?php for($i = 0; $i <= 59; $i++): ?>
                                        <option value="<?= $i ?>"><?= str_pad($i, 2, '0', STR_PAD_LEFT) ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <input type="submit" class="btn btn-success" name="them_suatchieu" value="Lưu">
                        </div>
                    </div>
                </div>
            </div>
        </form>

    <!-- form sua suat chieu -->
    <form action="./pages/updateSuatChieu.php" method="post">
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Sửa Suất Chiếu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_maSuatChieu">Mã Suất Chiếu</label>
                            <input type="text" name="edit_maSuatChieu" id="edit_maSuatChieu" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="edit_ngay">Ngày</label>
                            <input type="date" name="edit_ngay" id="edit_ngay" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="gioBatDau">Giờ Bắt Đầu</label>
                            <select name="gioBatDau" id="gioBatDau" class="form-control">
                                <?php for($i = 1; $i <= 23; $i++): ?>
                                    <option value="<?= $i ?>"><?= str_pad($i, 2, '0', STR_PAD_LEFT) ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="phutBatDau">Phút Bắt Đầu</label>
                            <select name="phutBatDau" id="phutBatDau" class="form-control">
                                <?php for($i = 0; $i <= 59; $i++): ?>
                                    <option value="<?= $i ?>"><?= str_pad($i, 2, '0', STR_PAD_LEFT) ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <input type="submit" class="btn btn-success" name="sua_suatchieu" value="Cập Nhật">
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>

    function openEditNgayLeForm(maSuatChieu, ngay, thoiGianBatDau) {
        $('#edit_ngay').val(ngay);
        $('#edit_thoiGianBatDau').val(thoiGianBatDau);
        $('#edit_maSuatChieu').val(maSuatChieu);
        $('#editModal').modal('show');
        }
    function filterByDate() {
        var selectedDate = document.getElementById('ngay').value;
        $.ajax({
            url: './pages/filterByDate.php',
            method: 'POST',
            data: { selectedDate: selectedDate },
        success: function(response) {
            $('#suatchieu-container').html(response);
        }
    });
}

    </script>
</body>
</html>
