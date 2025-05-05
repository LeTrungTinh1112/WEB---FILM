<?php 
    require_once('./database/connectDatabase.php');
    $conn = new connectDatabase;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <title>Document</title>
    <style>
        .box1 button {
            float: right;
        }
        .container {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="box1">
            <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Thêm</button>
        </div>
        <table class="table table-hover table-bordered table-striped">
            <thead>
                <th>Ngày</th>
                <th>Phần Trăm Gia Tăng</th>                
                <th>Cập Nhật</th>
                <th>Xóa</th>
            </thead>
            <tbody>
            <?php 
                $query = "SELECT * FROM ngayle";
                    $result = $conn->executeQuery($query);
                    if(!$result) {
                        echo 'failed';
                    } else {
                        while($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td><?php echo $row['NGAY']; ?></td>
                                <td><?php echo $row['PHANTRAMGIATANG']; ?></td>
                                <td><button class="btn btn-success" onclick="openEditNgayLeForm('<?php echo $row['NGAY']; ?>', '<?php echo $row['PHANTRAMGIATANG']; ?>')">Cập Nhật</button></td>
                                <td><a href="./pages/deleteNgayLe.php?sid=<?php echo $row['NGAY']; ?>" class="btn btn-danger">Xóa</a></td>
                            </tr>
                        <?php
                                }
                            }
                        ?>
            </tbody>
        </table>
    </div>

<!-- form them ngay le -->
<form action="./pages/insertNgayLe.php" method="post">
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm Ngày Lễ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="ngay">Ngày</label>
                        <input type="date" name="ngay" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="phanTramGiaTang">Phần Trăm Gia Tăng</label>
                        <input type="number" name="phanTramGiaTang" class="form-control" required>
                    </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <input type="submit" class="btn btn-success" name="them_ngayle" value="Lưu">
            </div>
        </div>
    </div>
</div>
</form>

<!-- form sua ngay le -->

<form action="./pages/updateNgayLe.php" method="post">
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cập Nhật Ngày Lễ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_ngay">Ngày</label>
                        <input type="date" id="edit_ngay" name="edit_ngay" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_phanTramGiaTang">Phần Trăm Gia Tăng</label>
                        <input type="number" id="edit_phanTramGiaTang" name="edit_phanTramGiaTang" class="form-control" required>
                    </div>

                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <input type="submit" class="btn btn-success" name="sua_ngayle" value="Lưu">
            </div>
        </div>
    </div>
</div>
</form>


<script>
    function openEditNgayLeForm(ngay, phanTramGiaTang) {
        document.getElementById('edit_ngay').value = ngay;
        document.getElementById('edit_phanTramGiaTang').value = phanTramGiaTang;
        $('#editModal').modal('show');
    }

    
</script>

</body>
</html>