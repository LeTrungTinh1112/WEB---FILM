<?php 
    require_once('./database/connectDatabase.php');
    $conn = new connectDatabase();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Document</title>
    <style>
        .box1 button{
            float: right;
        }
        #btnPhongChieu, #btnLoaiGhe, #btnGhe{
        border: 2px solid black;
        }
        .h6 {
            text-align: center;
            color: red;
        }
        .box2 button {
            float:left;
            padding: 0.5%;
            margin: 1%;
        }
        .content {
            display: none;
        }
        .active-content {
            display: block;
        }
        .btn-primary {
            margin-top: 2%;
        }
        #btnLoaiGhe.active {
            background-color: #79B791;
        }
        .themLoaiGhe {
            margin-top: 12%;
        }
        #content {
            margin: 0;
        }
        #seatMapContainer {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
        }
        .seat {
            width: 2em;
            height: 2em;
            margin: 0.5em;
            background-color: lightgray;
            border: 1px solid black;
            display: inline-block;
            text-align: center;
            line-height: 2em;
            cursor: pointer;
        }
        .seat.slected {
            background-color: green;
        }
        .seat.unavailabel {
            background-color: red;
        }
        .modal-dialog {
            max-height: 100%;
            max-width: 40%;
        }

        .modal-content {
            overflow-y: auto;
        }
        .modal-content {
    font-size: 16px; /* Kích thước font chữ lớn hơn */
    width: 100%; /* Độ rộng lớn hơn */
    height: 1000px; /* Chiều cao lớn hơn */
    /* Các thuộc tính khác */
}
        .maPhongChieu, .maLoaiGhe, .stt, .hangGhe {
            float: left;
        }
        .maPhongChieu {
            width: 17%;
        }
        .maLoaiGhe {
            width: 14%;
        }
        .stt {
            width: 12%;
        }
        .hangGhe {
            width: 12%;
        }

    </style>
</head>
<body>
<div class="container">
        
        <div class="box2">
            <button class="btn" id="btnPhongChieu" style="background-color: #79B791;">Phòng Chiếu</button>
            <button class="btn" id="btnLoaiGhe">Loại Ghế</button>
            <button class="btn" id="btnGhe">Ghế</button>
        </div>
        <div id="contentLoaiGhe" class="content">
            <div class="box1">
                <button class="btn btn-primary themLoaiGhe" data-toggle="modal" data-target="#addLoaiGheModal">Thêm</button>
            </div>
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Mã Loại Ghế</th>
                            <th>Tên Loại Ghế</th>
                            <th>Giá</th>
                            <th>Cập Nhật</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $query = "SELECT * FROM loaighe";
                            $result = $conn->executeQuery($query);
                            if(!$result) {
                                echo 'failed';
                            } else {
                                while($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['MALOAIGHE']; ?></td>
                                        <td><?php echo $row['TENLOAIGHE']; ?></td>
                                        <td><?php echo $row['PRICE']; ?></td>
                                        <td><button class="btn btn-success" onclick="openEditLoaiGheForm('<?php echo $row['MALOAIGHE']; ?>', '<?php echo $row['TENLOAIGHE']; ?>', '<?php echo $row['PRICE']; ?>')">Cập Nhật</button></td>
                                        <td><a href="./pages/deletePhongChieu.php?sid=<?php echo $row['MALOAIGHE']; ?>" class="btn btn-danger">Xóa</a></td>
                                    </tr>
                                    <?php
                                }
                            }
                        ?>
                    </tbody>
                </table>

                <!-- Form thêm loại ghế -->
                <form action="./pages/insertPhongChieu.php" method="post" id="themLoaiGhe">
                    <div class="modal fade" id="addLoaiGheModal" tabindex="-1" role="dialog" aria-labelledby="addLoaiGheModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Thêm Loại Ghế</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            
                                <div class="form-group">
                                    <label for="maloaighe">Mã Loại Ghế</label>
                                    <input type="text" id="maloaighe" name="maloaighe" class="form-control">
                                    <span id="maLoaiGheError" style="color: red;"></span>
                                </div>
                                <div class="form-group">
                                    <label for="tenloaighe">Tên Loại Ghế</label>
                                    <input type="text" id="tenloaighe" name="tenloaighe" class="form-control">
                                    <span id="tenLoaiGheError" style="color: red;"></span>
                                </div>
                                <div class="form-group">
                                    <label for="price">Giá</label>
                                    <input type="number" id="price" name="price" class="form-control">
                                    <span id="priceError" style="color: red;"></span>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <input type="submit" class="btn btn-success" name="them_loaighe" value="Lưu">
                        </div>
                        </div>
                    </div>
                    </div>
                        </div>
                </form>

                <!-- Form sửa loại ghế -->
                <form action="./pages/updatePhongChieu.php" method="post" id="suaLoaiGhe">
                    <div class="modal fade" id="editLoaiGheModal" tabindex="-1" role="dialog" aria-labelledby="editLoaiGheModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Sửa Loại Ghế</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="edit_maloaighe">Mã Loại Ghế</label>
                                        <input type="text" id="edit_maloaighe" name="edit_maloaighe" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit_tenloaighe">Tên Loại Ghế</label>
                                        <input type="text" id="edit_tenloaighe" name="edit_tenloaighe" class="form-control">
                                        <span id="edit_tenLoaiGheError" style="color: red;"></span>
                                       
                                    </div>
                                    <div class="form-group">
                                        <label for="edit_price">Giá</label>
                                        <input type="text" id="edit_price" name="edit_price" class="form-control">
                                        <span id="edit_priceError" style="color: red;"></span>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                    <input type="submit" class="btn btn-success" name="sua_phongchieu" value="Cập Nhật">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
    <div class="container">
        <div id="contentPhongChieu" class="content active-content">
        <div class ="box1">
            <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Thêm</button>
        </div>
            <table class="table table-hover table-bordered table-striped">
                <thread>
                    <tr>
                        <th>Mã Phòng Chiếu</th>
                        <th>Tên Phòng Chiếu</th>
                        <th>Số Ghế</th>
                        <th>Trạng Thái</th>
                        <th>Xem Ghế</th>
                        <th>Cập Nhật</th>
                        <th>Xóa</th>
                    </tr>
                </thread>
                <tbody>
                <?php 
                    $query = "SELECT * FROM phongchieu";
                    $result = $conn->executeQuery($query);
                    if(!$result) {
                        echo 'failed';
                    } else {
                        while($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td><?php echo $row['MAPHONGCHIEU']; ?></td>
                                <td><?php echo $row['TENPHONGCHIEU']; ?></td>
                                <td><?php echo $row['SOGHE']; ?></td>
                                <td><?php echo $row['TRANGTHAI']; ?></td>
                                <td><button class="btn btn-info" onclick="openSeatMap('<?php echo $row['MAPHONGCHIEU']; ?>')">Xem Ghế</button></td>
                                <td><button class="btn btn-success" onclick="openEditForm('<?php echo $row['MAPHONGCHIEU']; ?>', '<?php echo $row['TENPHONGCHIEU']; ?>', '<?php echo $row['SOGHE']; ?>', '<?php echo $row['TRANGTHAI']; ?>')">Cập Nhật</button></td>
                                <td><a href="./pages/deletePhongChieu.php?id=<?php echo $row['MAPHONGCHIEU']; ?>" class="btn btn-danger">Xóa</a></td>
                            </tr>
                            <?php
                        }
                    }
                ?>
                </tbody>
            </table>
        <?php 
            if(isset($_GET['message'])) {
                echo "<h6>".$_GET['message']."</h6>";
            }
        ?>

        
        <form action="./pages/insertPhongChieu.php" method="post" id="themPhongChieu">
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm Phòng Chiếu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                        <div class="form-group">
                            <label for="maphongchieu">Mã Phòng Chiếu</label>
                            <input type="text" name="maphongchieu" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="tenphongchieu">Tên Phòng Chiếu</label>
                            <input type="text" name="tenphongchieu" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="soghe">Số Ghế</label>
                            <input type="text" name="soghe" class="form-control">
                        </div>
                        <div class="form-group">
                                <label for="">Trạng Thái</label><br>
                                <label for="active">Đang Hoạt Động</label>
                                <input type="radio" name="trangThai" value="1" id="active" class="form-control" checked>
                                <label for="inactive">Tạm Dừng Hoạt Động</label>
                                <input type="radio" name="trangThai" value="0" id="inactive" class="form-control">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <input type="submit" class="btn btn-success" name="them_phongchieu" value="Lưu">
                </div>
                </div>
            </div>
            </div>
        </div>
        </form>

        <!-- form sua phong chieu-->
        
        <form action="./pages/updatePhongChieu.php" method="post" id="suaPhongChieu">
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Sửa Phòng Chiếu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_maphongchieu">Mã Phòng Chiếu</label>
                            <input type="text" id="edit_maphongchieu" name="edit_maphongchieu" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="edit_tenphongchieu">Tên Phòng Chiếu</label>
                            <input type="text" id="edit_tenphongchieu" name="edit_tenphongchieu" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="edit_soghe">Số Ghế</label>
                            <input type="text" id="edit_soghe" name="edit_soghe" class="form-control">
                        </div>
                        <div class="form-group">
                                <label for="">Trạng Thái</label><br>
                                <label for="active">Đang Hoạt Động</label>
                                <input type="radio" name="edit_trangThai" value="1" id="active" class="form-control" checked>
                                <label for="inactive">Tạm Dừng Hoạt Động</label>
                                <input type="radio" name="edit_trangThai" value="0" id="inactive" class="form-control">        
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <input type="submit" class="btn btn-success" name="sua_phongchieu" value="Lưu">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
    



    





<div class="container">
    <div id="contentGhe" class="content">
        <div class="box1">
            <button class="btn btn-primary themGhe" data-toggle="modal" data-target="#addGheModal">Thêm</button>
        </div>
        <div class="maPhongChieu">
            <label for="maPhongChieu">Mã Phòng Chiếu</label>
            <?php 
                $query = "SELECT MAPHONGCHIEU, TENPHONGCHIEU FROM phongchieu";
                $result = $conn->executeQuery($query);
                if(!$result) {
                    echo 'Failed';
                } else {
                    echo '<select class="form-control" name="maPhongChieu" id="maPhongChieu">';
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row['MAPHONGCHIEU'] . '">' . $row['TENPHONGCHIEU'] . '</option>';
                    }
                    echo '</select>';
                }
            ?>
        </div>

        <div class="maLoaiGhe">
            <label for="maLoaiGhe">Mã Loại Ghế</label>
            <?php 
                $query = "SELECT MALOAIGHE, TENLOAIGHE FROM loaighe";
                $result = $conn->executeQuery($query);
                if(!$result) {
                    echo 'Failed';
                } else {
                    echo '<select class="form-control" name="maLoaiGhe" id="maLoaiGhe">';
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row['MALOAIGHE'] . '">' . $row['TENLOAIGHE'] . '</option>';
                    }
                    echo '</select>';
                }
            ?>
        </div>

        <div class="stt">
            <label for="stt">Số Thứ Tự</label>
            <?php 
                $query = "SELECT DISTINCT STT FROM ghe ORDER BY STT";
                $result = $conn->executeQuery($query);
                if(!$result) {
                    echo 'Failed';
                } else {
                    echo '<select class="form-control" name="stt" id="stt">';
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row['STT'] . '">' . $row['STT'] . '</option>';
                    }
                    echo '</select>';
                }
            ?>
        </div>

        <div class="hangGhe">
            <label for="hangGhe">Hàng Ghế</label>
            <?php 
                $query = "SELECT DISTINCT HANGGHE FROM ghe ORDER BY HANGGHE";
                $result = $conn->executeQuery($query);
                if(!$result) {
                    echo 'Failed';
                } else {
                    echo '<select class="form-control" name="hangGhe" id="hangGhe">';
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row['HANGGHE'] . '">' . $row['HANGGHE'] . '</option>';
                    }
                    echo '</select>';
                }
            ?>
        </div>


        <!-- Nút Lọc -->
        <div class="filterButton">
            <button id="filterButton" class="btn btn-primary">Lọc</button>
            <button id="showAllButton" class="btn btn-primary">Hiển thị tất cả</button>
        </div>
        
        <!-- Bảng kết quả -->
        <div id="resultTable">
            <table class="table table-hover table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Mã Phòng Chiếu</th>
                        <th>Mã Loại Ghế</th>
                        <th>Số Thứ Tự</th>
                        <th>Hàng Ghế</th>
                        <th>Trạng Thái</th>
                        <th>Mã Ghế</th>
                        <th>Cập Nhật</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $query = "SELECT * FROM ghe ORDER BY STT, MAPHONGCHIEU, HANGGHE, MAGHE";
                        $result = $conn->executeQuery($query);
                        if(!$result) {
                            echo 'failed';
                        } else {
                            while($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>
                                    <td><?php echo $row['MAPHONGCHIEU']; ?></td>
                                    <td><?php echo $row['MALOAIGHE']; ?></td>
                                    <td><?php echo $row['STT']; ?></td>
                                    <td><?php echo $row['HANGGHE']; ?></td>
                                    <td><?php echo $row['TRANGTHAI']; ?></td>
                                    <td><?php echo $row['MAGHE'] ?></td>
                                    <td><button class="btn btn-success" onclick="openEditGheForm('<?php echo $row['MAPHONGCHIEU']; ?>', '<?php echo $row['MALOAIGHE']; ?>', '<?php echo $row['STT']; ?>', '<?php echo $row['HANGGHE']; ?>', '<?php echo $row['TRANGTHAI']; ?>', '<?php echo $row['MAGHE']; ?>')">Cập Nhật</button></td>
                                    <td><a href="./pages/deleteGhe.php?id=<?php echo $row['MAGHE']; ?>" class="btn btn-danger">Xóa</a></td>
                                </tr>
                                <?php
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
        

        <!-- Form thêm ghế -->
        <form id="themGhe" action="./pages/insertGhe.php"  method="post">
            <div class="modal fade" id="addGheModal" tabindex="-1" role="dialog" aria-labelledby="addLoaiGheModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Thêm Ghế</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="maGhe">Mã Ghế</label>
                                    <input type="text" name="maGhe" class="form-control" readonly>
                                </div>
                                <label for="maPhongChieu">Mã Phòng Chiếu</label>
                                <?php 
                                    $query = "SELECT MAPHONGCHIEU, TENPHONGCHIEU FROM phongchieu";
                                    $result = $conn->executeQuery($query);
                                    if(!$result) {
                                        echo 'Failed';
                                    } else {
                                        echo '<select class="form-control" name="maPhongChieu" id="maPhongChieu">';
                                        while($row = mysqli_fetch_assoc($result)) {
                                            echo '<option value="' . $row['MAPHONGCHIEU'] . '">' . $row['TENPHONGCHIEU'] . '</option>';
                                        }
                                        echo '</select>';
                                    }
                                ?>
                            </div>
                            <div class="form-group">
                                <label for="maLoaiGhe">Mã Loại Ghế</label>
                                <?php 
                                    $query = "SELECT MALOAIGHE, TENLOAIGHE FROM loaighe";
                                    $result = $conn->executeQuery($query);
                                    if(!$result) {
                                        echo 'Failed';
                                    } else {
                                        echo '<select class="form-control" name="maLoaiGhe" id="maLoaiGhe">';
                                        while($row = mysqli_fetch_assoc($result)) {
                                            echo '<option value="' . $row['MALOAIGHE'] . '">' . $row['TENLOAIGHE'] . '</option>';
                                        }
                                        echo '</select>';
                                    }
                                ?>
                            </div>
                            <div class="form-group">
                                <label for="hangGhe">Hàng Ghế</label>
                                <select name="hangGhe" class="form-control">
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                    <option value="F">F</option>
                                    <option value="G">G</option>
                                    <option value="H">H</option>
                                    <option value="I">I</option>
                                    <option value="J">J</option>
                                    <option value="K">K</option>
                                    <option value="L">L</option>
                                    <option value="M">M</option>
                                    <option value="N">N</option>
                                    <option value="O">O</option>
                                    <option value="P">P</option>
                                    <option value="Q">Q</option>
                                    <option value="R">R</option>
                                    <option value="S">S</option>
                                    <option value="T">T</option>
                                    <option value="U">U</option>
                                    <option value="V">V</option>
                                    <option value="W">W</option>
                                    <option value="X">X</option>
                                    <option value="Y">Y</option>
                                    <option value="Z">Z</option>
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="stt">Số Thứ Tự</label>
                                <input type="number" name="stt" class="form-control">
                                <span id="sttError" style="color: red;"></span>
                            </div>
                            <div class="form-group">
                                <label for="">Trạng Thái</label><br>
                                <label for="active">Đang Hoạt Động</label>
                                <input type="radio" name="trangThai" value="1" id="active" class="form-control" checked>
                                <label for="inactive">Tạm Dừng Hoạt Động</label>
                                <input type="radio" name="trangThai" value="0" id="inactive" class="form-control">
                                
                            </div>

                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <input type="submit" class="btn btn-success" name="them_ghe" value="Lưu">
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Form sửa ghế -->
        <form action="./pages/updateGhe.php" method="post" id="suaGhe">
            <div class="modal fade" id="editGheModal" tabindex="-1" role="dialog" aria-labelledby="editLoaiGheModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Sửa Ghế</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                    <label for="edit_maGhe">Mã Ghế</label>
                                    <input type="text" name="edit_maGhe" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="edit_maPhongChieu">Mã Phòng Chiếu</label>
                                <?php 
                                    $query = "SELECT MAPHONGCHIEU, TENPHONGCHIEU FROM phongchieu";
                                    $result = $conn->executeQuery($query);
                                    if(!$result) {
                                        echo 'Failed';
                                    } else {
                                        echo '<select class="form-control" name="edit_maPhongChieu" id="edit_maPhongChieu">';
                                        while($row = mysqli_fetch_assoc($result)) {
                                            echo '<option value="' . $row['MAPHONGCHIEU'] . '">' . $row['TENPHONGCHIEU'] . '</option>';
                                        }
                                        echo '</select>';
                                    }
                                ?>
                            </div>
                            <div class="form-group">
                                <label for="edit_maLoaiGhe">Mã Loại Ghế</label>
                                <?php 
                                    $query = "SELECT MALOAIGHE, TENLOAIGHE FROM loaighe";
                                    $result = $conn->executeQuery($query);
                                    if(!$result) {
                                        echo 'Failed';
                                    } else {
                                        echo '<select class="form-control" name="edit_maLoaiGhe" id="edit_maLoaiGhe">';
                                        while($row = mysqli_fetch_assoc($result)) {
                                            echo '<option value="' . $row['MALOAIGHE'] . '">' . $row['TENLOAIGHE'] . '</option>';
                                        }
                                        echo '</select>';
                                    }
                                ?>
                            <div class="form-group">
                                <label for="edit_stt">Số Thứ Tự</label>
                                <input type="text" id="edit_stt" name="edit_stt" class="form-control">
                                <span id="sttSuaError" style="color: red;"></span>
                            </div>
                            <div class="form-group">
                                <label for="edit_hangGhe">Hàng Ghế</label>
                                <select name="edit_hangGhe" class="form-control">
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                    <option value="F">F</option>
                                    <option value="G">G</option>
                                    <option value="H">H</option>
                                    <option value="I">I</option>
                                    <option value="J">J</option>
                                    <option value="K">K</option>
                                    <option value="L">L</option>
                                    <option value="M">M</option>
                                    <option value="N">N</option>
                                    <option value="O">O</option>
                                    <option value="P">P</option>
                                    <option value="Q">Q</option>
                                    <option value="R">R</option>
                                    <option value="S">S</option>
                                    <option value="T">T</option>
                                    <option value="U">U</option>
                                    <option value="V">V</option>
                                    <option value="W">W</option>
                                    <option value="X">X</option>
                                    <option value="Y">Y</option>
                                    <option value="Z">Z</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit_trangThai">Trạng Thái</label><br>
                                <label for="active">Đang Hoạt Động</label>
                                <input type="radio" id="active" name="trangThai" value="1" class="form-control" checked> 
                                <label for="inactive">Tạm Dừng Hoạt Động</label>
                                <input type="radio" id="inactive" name="trangThai" value="0" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <input type="submit" class="btn btn-success" name="sua_phongchieu" value="Cập Nhật">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


    <!-- form hien ghe -->
<div class="modal fade" id="seatMapModal" tabindex="-1" role="dialog" aria-labelledby="seatMapModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="seatMapModalLabel">Phòng Chiếu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="seatMapContainer">
                    <!-- Dữ liệu ghế sẽ được hiển thị ở đây -->
                    
                </div>
            </div>
        </div>
    </div>
</div>




<script>
    function openEditForm(id, tenPhongChieu, soGhe, trangThai) {
        document.getElementById("edit_maphongchieu").value = id;
        document.getElementById("edit_tenphongchieu").value = tenPhongChieu;
        document.getElementById("edit_soghe").value = soGhe;
        document.getElementById("active").checked = trangThai;
        document.getElementById("inactive").checked = trangThai;
        if (trangThai === "active") {
            document.getElementById("active").checked = true;
        } else {
            document.getElementById("inactive").checked = true;
        }
        $('#editModal').modal('show');
    }

    function openEditLoaiGheForm(id, tenLoaiGhe, price) {
        document.getElementById("edit_maloaighe").value = id;
        document.getElementById("edit_tenloaighe").value = tenLoaiGhe;
        document.getElementById("edit_price").value = price;
        $('#editLoaiGheModal').modal('show');
    }
    
    function openEditGheForm(maPhongChieu, maLoaiGhe, stt, hangGhe, trangThai, maGhe) {
        document.getElementsByName("edit_maPhongChieu")[0].value = maPhongChieu;
        document.getElementById("edit_maLoaiGhe").value = maLoaiGhe;
        document.getElementById("edit_stt").value = stt;
        document.getElementsByName("edit_hangGhe")[0].value = hangGhe;
        document.getElementsByName("edit_maGhe")[0].value = maGhe;
        document.getElementById("active").checked = trangThai;
        document.getElementById("inactive").checked = trangThai;

        if (trangThai === "active") {
            document.getElementById("active").checked = true;
        } else {
            document.getElementById("inactive").checked = true;
        }

        $('#editGheModal').modal('show');
    }
    //validate them ghe
    function validateFormGhe() {
        var stt = document.forms["themGhe"]["stt"].value;
        
        if (stt == "") {
            document.getElementById("sttError").innerHTML = "Vui lòng điền số thứ tự";
            return false;
        }
    }

    document.getElementById("themGhe").onsubmit = function() {
        return validateFormGhe();
    };


    //validate sua ghe
    function validateFormSuaGhe() {
        var stt = document.forms["suaGhe"]["edit_stt"].value;
        
        if (stt == "") {
            document.getElementById("sttSuaError").innerHTML = "Vui lòng điền số thứ tự";
            return false;
        }
    }

    document.getElementById("suaGhe").onsubmit = function() {
        return validateFormSuaGhe();
    };


    //validate loaighe
    function validateFormLoaiGhe() {
        var maLoaiGhe = document.forms["themLoaiGhe"]["maloaighe"].value;
        var tenLoaiGhe = document.forms["themLoaiGhe"]["tenloaighe"].value;
        var priceLoaiGhe = document.forms["themLoaiGhe"]["price"].value;

        if (maLoaiGhe == "" && tenLoaiGhe == "" && priceLoaiGhe == "") {
            document.getElementById("maLoaiGheError").innerHTML = "Vui lòng điền mã loại ghế";
            document.getElementById("tenLoaiGheError").innerHTML = "Vui lòng điền tên loại ghế";
            document.getElementById("priceError").innerHTML = "Vui lòng điền giá loại ghế";
            return false;
        } else if(maLoaiGhe == "") {
            document.getElementById("maLoaiGheError").innerHTML = "Vui lòng điền mã loại ghế";
            return false;
        } else if(tenLoaiGhe == "") {
            document.getElementById("tenLoaiGheError").innerHTML = "Vui lòng điền tên loại ghế";
            return false;
        } else if(priceLoaiGhe == "") {
            document.getElementById("priceError").innerHTML = "Vui lòng điền giá loại ghế";
            return false;

        }
        return true;
    }

    var maLoaiGheInput = document.getElementById("maloaighe");
    var tenLoaiGheInput = document.getElementById("tenloaighe");
    var priceInput = document.getElementById("price");
    var maLoaiGheError = document.getElementById("maLoaiGheError");
    var tenLoaiGheError = document.getElementById("tenLoaiGheError");
    var priceError = document.getElementById("priceError");

    maLoaiGheInput.oninput = function() {
        if (maLoaiGheInput.value !== "") {
            maLoaiGheError.style.display = "none"; 
        } else {
            maLoaiGheError.style.display = "block"; 
        }
    };

    tenLoaiGheInput.oninput = function() {
        if (tenLoaiGheInput.value !== "") {
            tenLoaiGheError.style.display = "none"; 
        } else {
            tenLoaiGheError.style.display = "block"; 
        }
    };

    priceInput.oninput = function() {
        if (priceInput.value !== "") {
            priceError.style.display = "none";
        } else {
            priceError.style.display = "block";
        }
    };

    document.getElementById("themLoaiGhe").onsubmit = function() {
        return validateFormLoaiGhe();
    };


    //validate sualoaighe

    document.getElementById("suaLoaiGhe").onsubmit = function() {
    return validateEditLoaiGheForm();
    };

    var editTenLoaiGheInput = document.getElementById("edit_tenloaighe");
    var editPriceInput = document.getElementById("edit_price");
    var editTenLoaiGheError = document.getElementById("edit_tenLoaiGheError");
    var editPriceError = document.getElementById("edit_priceError");

    editTenLoaiGheInput.oninput = function() {
        if (editTenLoaiGheInput.value !== "") {
            editTenLoaiGheError.innerHTML = "";
        } else {
            editTenLoaiGheError.innerHTML = "Vui lòng điền tên loại ghế";
        }
    };

    editPriceInput.oninput = function() {
        if (editPriceInput.value !== "") {
            editPriceError.innerHTML = "";
        } else {
            editPriceError.innerHTML = "Vui lòng điền giá loại ghế";
        }
    };

    function validateEditLoaiGheForm() {
        if (editTenLoaiGheInput.value.trim() === "") {
            editTenLoaiGheError.innerHTML = "Vui lòng điền tên loại ghế";
            return false;
        }

        if (editPriceInput.value.trim() === "") {
            editPriceError.innerHTML = "Vui lòng điền giá loại ghế";
            return false;
        }

        return true;
    };



    


    // Validate form phongchieu
    function validateThemPhongChieuForm() {
    var maPhongChieuInput = document.getElementsByName("maphongchieu")[0];
    var tenPhongChieuInput = document.getElementsByName("tenphongchieu")[0];
    var soGheInput = document.getElementsByName("soghe")[0];
    var trangThaiInput = document.getElementsByName("trangthai")[0];

    if (!document.getElementById("them_maphongchieuError")) {
        maPhongChieuInput.insertAdjacentHTML('afterend', '<span id="them_maphongchieuError" style="color: red;"></span>');
    }
    if (!document.getElementById("them_tenPhongChieuError")) {
        tenPhongChieuInput.insertAdjacentHTML('afterend', '<span id="them_tenPhongChieuError" style="color: red;"></span>');
    }
    if (!document.getElementById("them_soGheError")) {
        soGheInput.insertAdjacentHTML('afterend', '<span id="them_soGheError" style="color: red;"></span>');
    }

    var maPhongChieuError = document.getElementById("them_maphongchieuError");
    var tenPhongChieuError = document.getElementById("them_tenPhongChieuError");
    var soGheError = document.getElementById("them_soGheError");

    var isValid = true;

    if (maPhongChieuInput.value.trim() === "") {
        maPhongChieuError.innerHTML = "Vui lòng điền mã phòng chiếu";
        isValid = false;
    } else {
        maPhongChieuError.innerHTML = "";
    }

    if (tenPhongChieuInput.value.trim() === "") {
        tenPhongChieuError.innerHTML = "Vui lòng điền tên phòng chiếu";
        isValid = false;
    } else {
        tenPhongChieuError.innerHTML = "";
    }

    if (soGheInput.value.trim() === "") {
        soGheError.innerHTML = "Vui lòng điền số ghế";
        isValid = false;
    } else {
        soGheError.innerHTML = "";
    }

    return isValid;
}

document.getElementById("themPhongChieu").onsubmit = function() {
    return validateThemPhongChieuForm();
};

function validateSuaPhongChieuForm() {
    var tenPhongChieuInput = document.getElementById("edit_tenphongchieu");
    var soGheInput = document.getElementById("edit_soghe");

    if (!document.getElementById("edit_tenPhongChieuError")) {
        tenPhongChieuInput.insertAdjacentHTML('afterend', '<span id="edit_tenPhongChieuError" style="color: red;"></span>');
    }
    if (!document.getElementById("edit_soGheError")) {
        soGheInput.insertAdjacentHTML('afterend', '<span id="edit_soGheError" style="color: red;"></span>');
    }

    var tenPhongChieuError = document.getElementById("edit_tenPhongChieuError");
    var soGheError = document.getElementById("edit_soGheError");

    var isValid = true;

    if (tenPhongChieuInput.value.trim() === "") {
        tenPhongChieuError.innerHTML = "Vui lòng điền tên phòng chiếu";
        isValid = false;
    } else {
        tenPhongChieuError.innerHTML = "";
    }

    if (soGheInput.value.trim() === "") {
        soGheError.innerHTML = "Vui lòng điền số ghế";
        isValid = false;
    } else {
        soGheError.innerHTML = "";
    }

    return isValid;
}

    document.getElementById("suaPhongChieu").onsubmit = function() {
        return validateSuaPhongChieuForm();
    };

    document.getElementsByName("maphongchieu")[0].oninput = function() {
        var maPhongChieuError = document.getElementById("them_maphongchieuError");
        if (this.value.trim() !== "") {
            maPhongChieuError.innerHTML = "";
        }
        else {
            maPhongChieuError.innerHTML = "Vui lòng điền mã phòng chiếu";
        }
    };

    document.getElementsByName("tenphongchieu")[0].oninput = function() {
        var tenPhongChieuError = document.getElementById("them_tenPhongChieuError");
        if (this.value.trim() !== "") {
            tenPhongChieuError.innerHTML = "";
        }
        else {
            tenPhongChieuError.innerHTML = "Vui lòng điền tên phòng chiếu";
        }
    };

    document.getElementsByName("soghe")[0].oninput = function() {
        var soGheError = document.getElementById("them_soGheError");
        if (this.value.trim() !== "") {
            soGheError.innerHTML = "";
        }
        else {
            soGheError.innerHTML = "Vui lòng điền số ghế";
        }
    };


    document.getElementById("edit_tenphongchieu").oninput = function() {
        var tenPhongChieuError = document.getElementById("edit_tenPhongChieuError");
        if (this.value.trim() !== "") {
            tenPhongChieuError.innerHTML = "";
        }
        else {
            tenPhongChieuError.innerHTML = "Vui lòng điền tên phòng chiếu";
        }
    };

    document.getElementById("edit_soghe").oninput = function() {
        var soGheError = document.getElementById("edit_soGheError");
        if (this.value.trim() !== "") {
            soGheError.innerHTML = "";
        }
        else {
            soGheError.innerHTML = "Vui lòng điền số ghế";
        }
    };






    

    $(document).ready(function() {
            $("#btnPhongChieu").click(function() {
                $(this).css("background-color", "#79B791");
                $("#btnLoaiGhe").removeClass("active").css("background-color", "");
                $("#btnGhe").removeClass("active").css("background-color", "");
                $("#contentPhongChieu").addClass("active-content");
                $("#contentLoaiGhe").removeClass("active-content");
                $('#contentGhe').removeClass("active-content");
            });

            $("#btnLoaiGhe").click(function() {
                $(this).addClass("active").css("background-color", "#79B791");
                $("#btnPhongChieu").removeClass("active").css("background-color", "");
                $("#btnGhe").removeClass("active").css("background-color", "");
                $("#contentLoaiGhe").addClass("active-content");
                $("#contentPhongChieu").removeClass("active-content");
                $('#contentGhe').removeClass("active-content");
            });

            $('#btnGhe').click(function() {
                $(this).addClass("active").css("background-color", "#79B791");
                $("#btnPhongChieu").removeClass("active").css("background-color", "");
                $("#btnLoaiGhe").removeClass("active").css("background-color", "");
                $('#contentGhe').addClass("active-content");
                $("#contentPhongChieu").removeClass("active-content");
                $("#contentLoaiGhe").removeClass("active-content");

            })

            $("#contentPhongChieu").addClass("active-content");
        });

        

    function openSeatMap(id) {
        var maPhongChieu = id;

        fetch('./pages/xuLyGhe.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'maPhongChieu=' + maPhongChieu,
        })
        .then(response => response.text())
        .then(data => {
            $('#seatMapContainer').html(data);
            $('#seatMapModal').modal('show');
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    }
    

    function resizeModal() {
        var modalContent = $('.modal-content');
        var windowHeight = $(window).height();
        var modalHeight = modalContent.height();
        var modalMargin = 60;

        if (modalHeight + modalMargin > windowHeight) {
            var newModalHeight = windowHeight - modalMargin;
            modalContent.css('max-height', newModalHeight);
        }
    }

    $('.modal').on('shown.bs.modal', function () {
        resizeModal();
    });

    $(window).on('resize', function(){
        resizeModal();
    });


    // Lọc ghế
    document.getElementById('filterButton').addEventListener('click', function() {
        var maPhongChieu = document.getElementById('maPhongChieu').value;
        var maLoaiGhe = document.getElementById('maLoaiGhe').value;
        var stt = document.getElementById('stt').value;
        var hangGhe = document.getElementById('hangGhe').value;
        // var maGhe = document.getElementById('maGhe').value;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', './pages/filterGhe.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById('resultTable').innerHTML = xhr.responseText;
            }
        };
        xhr.send('maPhongChieu=' + maPhongChieu + '&maLoaiGhe=' + maLoaiGhe + '&stt=' + stt + '&hangGhe=' + hangGhe);
    });

    //hiển thị tất cả ghế
    document.getElementById('showAllButton').addEventListener('click', function() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', './pages/allData.php', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById('resultTable').innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    });


</script>


</body>
</html>