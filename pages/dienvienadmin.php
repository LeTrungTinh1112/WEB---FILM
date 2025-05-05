<style>
    .actor__wrap {
        justify-content: space-evenly;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            background: #fff;
        }

        .actor__item {
            width: 19%;
            margin: 20px;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
            border-radius: 6px;
            cursor: pointer;
            padding: 15px;
            position: relative;
        }

        .actor_img {
            width: 100%;
            height:280px;
        }

        .actor_img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .actor__name {
            text-align: center;
            font-size: 18px;
            font-weight: 600;
            padding-top: 5px;
        }

        .actor__item:hover .actor__name {
            color: #79B791;
        }

        .actor__icon {
            content: "";
            position: absolute;
            top: 5px;
            right: 8px;
            background: #fff;
            padding: 5px;
            border-radius: 6px;
            border: 1px solid #79B791;
        }

        .actor__icon i {
            color:#79B791;
            font-size: 18px;
        }

        .detail-actor__container {
            margin: 20px auto;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            background: #fff;
            padding: 20px;
            position: relative;
        }

        .detail-actor__table {
            width: 100%;
            border-collapse: collapse;
        }

        .detail-actor__table th {
            background-color: #79B791;
            color: #fff;
            padding: 12px 0;
        }

        .detail-actor__table td {
            padding: 12px 0;
        }

        .detail-actor__table td img {
            max-width: 100%;
            height: 160px;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .detail-actor__table input[type="text"] {
            width: calc(100% - 24px);
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .detail-actor__table th,
        .detail-actor__table td:first-child {
            width: 30%;
        }

        .detail-actor__btn {
            text-align: center;
        }

        .detail-actor__btn button {
            padding: 6px 10px;
            border: none;
            background-color: #79B791;
            color: #fff;
            border-radius: 6px;
            cursor: pointer;
        }

        .detail-actor__icon {
            position: absolute;
            top: 7%;
            right: 10%;
            font-size: 24px;
            color: #fff;
            cursor: pointer;
        }

        .detail-actor.show {
            display: block;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
        }

        .detail-actor {
            display: none;
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
</style>

<div class="actor__wrap">
    <?php
        $list = actorList();
        foreach($list as $item) {
            echo '<div class="actor__item" id="'.$item['MADV'].'">';
            echo '<div class="actor_img">';
            echo '<img src="./img/'.$item['NAMEANH'].'" alt="">';
            echo '</div>';
            echo '<div class="actor__icon"><i class="fa-regular fa-pen-to-square"></i></div>';
            echo '<div class="actor__name">'.$item['TENDV'].'</div>';
            echo '</div>';
        }
    ?>
     <div class="detail-actor">
            <div class="detail-actor__container">
                <div class="detail-actor__icon" id="closeIcon">
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <table class="detail-actor__table">
                    <thead>
                        <tr>
                            <th colspan="2">Thông tin diễn viên</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Mã diễn viên:</td>
                            <td>MDV91</td>
                        </tr>
                        <tr>
                            <td>Tên diễn viên:</td>
                            <td><input type="text" value="Minhta"></td>
                        </tr>
                        <tr>
                            <td>Hình ảnh</td>
                            <td><img src="./img/Oanhle2222.png" alt=""></td>
                        </tr>
                    </tbody>
                </table>
                <div class="detail-actor__btn" >
                    <button>Cập nhật</button>
                </div>
            </div>
        </div>
        <div class="overlay" id="overlay"></div>
    </div>
</div>


<?php
    function actorList(){
        $list = array();
        require_once('./database/connectDatabase.php');
        $conn = new connectDatabase();

        $query = "SELECT * FROM dienvien";
        $result = $conn->executeQuery($query);
        if($result){
            while($row = $result->fetch_assoc()){
                $list[] = $row;
            }
        } else{
            return;
        }
        return $list;
    }
?>
