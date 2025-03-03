<style>
        .container__endow {
            padding: 30px 15px;
        }
        .endow {
            width: 100%;
            border-collapse: collapse;
            box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
        }

        .endow__add {
            text-align: right;
            margin-bottom: 20px;
        }
        .endow__add button{
            border: none;
            padding: 10px 20px;
            background: #79B791;
            border-radius: 5px;
            color: #fff;
            font-size: 15px;
            cursor: pointer;
            font-weight: 500;
        }

        .endow thead tr th {
            background: #79B791;
            color: #fff;
            font-size: 15px;
            font-weight: 600;
        }

        .endow thead tr th,
        .endow tbody tr td {
            border-bottom: 1px solid #ddd;
            text-align: center;
            padding: 12px 0;
            
        }

        .endow tbody tr td {
            background: #fff;
        }

        .endow ul {
            margin: 0;
            padding: 0;
            display: flex;
            list-style: none;
            align-items: center;
            justify-content: center;
        }

        .endow ul li {
            margin-left: 10px;
            border-radius: 6px;
            cursor: pointer;
        }

        .endow ul li a {
            text-decoration: none;
            color: #ffff;
        }

        .endow ul li:first-child {
            background: #2C73BA;
            padding: 6px 10px;
        }

        .endow ul li:last-child {
            background: #C82333;
            padding: 6px 10px;
        }

        .endow td span {
            background: #21BF06;
            padding: 6px 10px;
            color: #fff;
            border-radius: 6px;
        }

        .endow td .red {
            background: #C82333;
        }

        .model__detail {
            display: none;
        }

        .model__container {
            margin: 0 auto;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
            max-width: 1200px;
            position: relative;
            background: #fff;
        }

        .model__container::after {
            content: "";
            height: 100%;
            width: 1px;
            background: #ddd;
            position: absolute;
            top: 0px;
            left: 52.5%;
        }

        .model__tbl {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
        }

        .model__tbl th {
            padding: 10px;
            background: #79B791;
            color: #fff;
        }

        .model__tbl td {
            padding: 5px 10px;
            font-size: 16px;
            background: #fff;
        }

        .model__btn {
            padding: 10px;
            text-align: right;
            margin-right: 15%;
        }

        .model__btn button {
            padding: 6px 10px;
            background: #79B791;
            border: none;
            border-radius: 6px;
            color: #fff;
            cursor: pointer;
            margin-left: 10px;
        }

        .model__tbl td input {
            padding: 6px;
            border: 1px solid #ddd;
            outline: none;
        }

        .model__icon {
            position: absolute;
            top: 3%;
            right: 2%;
            font-size: 18px;
            color: #fff;
            cursor: pointer;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: none;
        }

        .model__detail.show {
            display: block;
            position: fixed;
             top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000; 
        }

        .model__addCode {
            display: none;
        }

        .model__item {
            margin: 0 auto;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
            max-width: 400px;
            position: relative;
            background: #fff;
        }

        .model__add {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
        }

        .model__addCode.show {
            display: block;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
        }

        .model__add tr th {
            padding: 10px 0;
            background: #79B791;
            color: #fff;
            font-size: 18px;
        }

        .model__add tr td {
            padding: 5px 15px;
        }

        .model__add tr td input {
            padding: 5px;
            outline: none;
            border: 1px solid #ddd;
        }

        .model__add tr td:last-child {
            text-align: center;
        }

        .model__add tr td:last-child button{
            color: #fff;
            background: #79B791;
            border: none;
            cursor: pointer;
            padding: 6px 10px;
            border-radius: 6px;
        }

        .model__close {
            position: absolute;
            top: 5px;
            right: 10px;
            color: #fff;
            font-size: 18px;
            cursor: pointer;
        }
</style>

<div class="container__endow" id="container__endow">
        <div class="endow__add">
            <button>+ Thêm mã code</button>
        </div>
        <table class="endow">
            <thead>
                <tr>
                    <th>CODE</th>
                    <th>TÊN ƯU ĐÃI</th>
                    <th> PHẦN TRĂN ƯU ĐÃI</th>
                    <th>TRẠNG THÁI</th>
                    <th>ĐIỀU KIỆN</th>
                    <th>THAO TÁC</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $list = endowList();
                    foreach($list as $item) {
                        echo ' <tr>';
                        echo '<td>'.$item['CODE'].'</td>';
                        echo '<td>'.$item['TENUUDAI'].'</td>';
                        echo '<td>'.$item['PHANTRAMUUDAI']. '</td>';
                        echo '<td><span class="' . (($item['TRANGTHAI'] == 1) ? '' : 'red') . '">' . (($item['TRANGTHAI'] == 1) ? 'Hoạt động' : 'Khóa') . '</span></td>';
                        echo '<td>'.$item['DIEUKIEN'].'</td>';
                        echo '<td>
                                <ul>
                            <li>
                                <a href="" class="endow__edit">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                    Sửa
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class="fa-solid fa-trash-can"></i>
                                    Xóa
                                </a>
                            </li>
                                </ul>
                                </td>';
                        echo '</tr>';
                    }

                ?>
            </tbody>
        </table>
        <div class="overlay" id="overlay"></div>
        <div class="model__detail" id="modelDetail">
            <div class="model__container">
                <table class="model__tbl">
                    <thead>
                        <tr>
                            <th colspan="2">Thông tin hiện tại</th>
                            <th colspan="2">Thông tin mới</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Code:</td>
                            <td>MUD001</td>
                            <td>Code:</td>
                            <td><input type="text" placeholder="Nhập mã code"></td>
                        </tr>
                        <tr>
                            <td>Tên ưu đãi:</td>
                            <td>Hoá Đơn trên 150.000đ giảm 5%</td>
                            <td>Tên ưu đãi:</td>
                            <td><input type="text" placeholder="Nhập tên ưu đãi"></td>
                        </tr>
                        <tr>
                            <td>Phần trăm ưu đãi:</td>
                            <td>5</td>
                            <td>Phần trăm ưu đãi:</td>
                            <td><input type="number" placeholder="Nhập phần trăm ưu đãi"></td>
                        </tr>
                        <tr>
                            <td>Trạng thái:</td>
                            <td>1</td>
                            <td>Trạng thái:</td>
                            <td><input type="number" placeholder="Nhập phần trăm ưu đãi"></td>
                        </tr>
                        <tr>
                            <td>Điều kiện:</td>
                            <td>150000</td>
                            <td>Điều kiện:</td>
                            <td><input type="number" placeholder="Nhập phần trăm ưu đãi"></td>
                        </tr>
                    </tbody>
                </table>
                <div class="model__btn">
                    <button>Xóa tất cả</button>
                    <button>Cập nhật</button>
                </div>
                <div class="model__icon">
                    <i class="fa-solid fa-xmark"></i>
                </div>
            </div>
        </div>
        <div class="model__addCode">
            <div class="model__item">
                <table class="model__add">
                    <thead>
                        <tr>
                            <th colspan="2">Thông tin ưu đãi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Code:</td>
                            <td><input type="text" placeholder=""></td>
                        </tr>
                        <tr>
                            <td>Tên ưu đãi:</td>
                            <td><input type="text" placeholder=""></td>
                        </tr>
                        <tr>
                            <td>Phần trăm ưu đãi:</td>
                            <td><input type="text" placeholder=""></td>
                        </tr>
                        <tr>
                            <td>Trạng thái:</td>
                            <td><input type="text" placeholder=""></td>
                        </tr>
                        <tr>
                            <td>Điều kiện</td>
                            <td><input type="text" placeholder=""></td>
                        </tr>
                        <tr>
                            <td rowspan="2" colspan="2">
                                <button>Xác Nhận</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="model__close">
                    <i class="fa-solid fa-xmark"></i>
                </div>
            </div>
        </div>
 </div>

 <script>
        // $()
        document.addEventListener("DOMContentLoaded", function () {
            var editButtons = document.querySelectorAll(".endow__edit");

            var modelDetail = document.getElementById("modelDetail");

            var overlay = document.getElementById("overlay");

            editButtons.forEach(function (button) {
                button.addEventListener("click", function (event) {
                    event.preventDefault();

                    modelDetail.classList.add("show");
                    overlay.style.display = "block";
                });
            });

            var closeIcon = document.querySelector(".model__icon .fa-solid.fa-xmark");
            closeIcon.addEventListener("click", function () {
                modelDetail.classList.remove("show");
                overlay.style.display = "none";
            });
        });

        document.addEventListener("DOMContentLoaded", function () {
        var addCodeButton = document.querySelector(".endow__add button");
        var modelAddCode = document.querySelector(".model__addCode");
        var overlay = document.getElementById("overlay");

        addCodeButton.addEventListener("click", function (event) {
            event.preventDefault();

            modelAddCode.classList.add("show");
            overlay.style.display = "block";
        });

        var closeIcon = document.querySelector(".model__addCode .model__close .fa-solid.fa-xmark");
        closeIcon.addEventListener("click", function () {
            modelAddCode.classList.remove("show");
            overlay.style.display = "none";
        });
    });
</script>

<?php
    function endowList() {
        $list = array();
        $conn = new connectDatabase();

        $query = "SELECT * FROM uudai";
        $result = $conn->executeQuery($query);
        if($result) {
            while($row = $result->fetch_assoc()) {
                $list[] = $row;
            }
        }else{
            return;
        }
        return $list;
    }
?>