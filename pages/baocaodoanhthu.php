<script>
$(document).ready(function(){
    var chart;

    showDefaultGraph();

    function showDefaultGraph() {
        $.ajax({
            url: "pages/xulydoanhthu.php?choose=doanhthu&style=tongtheotheloai",
            type: "GET",
            dataType: "json",
            success: function(data) {
                updateChart(data[0],data[1]);
            }
        });
    }

    function showGraph() {
        let thongke = $("#thongke").val();
        let from_date = $("#from_date").val();
        let to_date = $("#to_date").val();

        let url = "pages/xulydoanhthu.php?choose=" + encodeURIComponent(thongke);
        if(thongke == "doanhthu"){
            let chung = $("#chung").val();
            url += "&style=" + encodeURIComponent(chung);
        }else if(thongke == "theloai"){
            let tenloai = $("#tenloai").val();
            let thutu = $("#thutu").val();
            url += "&style=" + encodeURIComponent(tenloai) + "&thutu=" + encodeURIComponent(thutu);
        }

        if (from_date && to_date) {
            url += "&from_date=" + encodeURIComponent(from_date) + "&to_date=" + encodeURIComponent(to_date);
        }

        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function(data) {
                updateChart(data[0],data[1]);
            }
        });
    }


    function updateChart(data1, data2) {
        if (chart) {
            chart.destroy(); 
        }
        chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: ""
            },
            dataPointWidth: 25,
            dataSpacing: 5,
            axisY: {
                includeZero: true,
                title: ""
            },
            legend: null,
            creditText: "", 
            data: [{
                type: "column",
                name:"Doanh thu",
                yValueFormatString: "#0.##đ",
                showInLegend: true,
                dataPoints: data1,
            },{
                type: "column",
                name:  "Số vé",
                yValueFormatString: "#0. vé",
                showInLegend: true,
                dataPoints: data2,
            }]
        });
        chart.render();

        function toggleDataSeries(e) {
            chart.render();
        }
    }

    $("#dateForm").submit(function() {
        showGraph();
        return false;
    });

    $("#thongke").change(function() {
        if ($(this).val() === "theloai") {
            $("#chung").hide();
            $("#type").show();
        } else {
            $("#chung").show();
            $("#type").hide();
        }
    }).change(); 
});

</script>


<div class="thongke__container">
    <form id="dateForm">
        <select name="thongke" id="thongke">
            <option value="doanhthu">Tổng doanh thu</option>
            <option value="theloai">Thể loại</option>
        </select>
        <select id="chung" name="chung">
            <option value="tongtheotheloai">Tổng theo thể loại</option>
            <option value="tongtheongay">Tổng theo ngày</option>
            <option value="tongtheophim">Tổng theo phim</option>
        </select>
        <div class="type" id="type" style="display: none;">
            <select name="tenloai" id="tenloai">
                <?php
                    require_once("./database/connectDatabase.php");
                    $conn = new connectDatabase();
                    $sql = "SELECT * FROM theloai";
                    $result = $conn->executeQuery($sql);
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            echo '<option value="'.$row['MATHELOAI'].'">'.$row['TENTHELOAI'].'</option>';
                        }
                    }
                ?>
            </select>
            <select name="thutu" id="thutu">
                <option value="0">Chọn top vé bán chạy</option>
                <option value="1">Top 1</option>
                <option value="2">Top 2</option>
                <option value="3">Top 3</option>
                <option value="4">Top 4</option>
                <option value="5">Top 5</option>
                <option value="6">Top 6</option>
                <option value="7">Top 7</option>
                <option value="8">Top 8</option>
                <option value="9">Top 9</option>
                <option value="10">Top 10</option>
            </select>
        </div>
        Từ ngày: <input type="date" id="from_date" name="from_date">
        Đến ngày: <input type="date" id="to_date" name="to_date">
        <button type="submit">Xem biểu đồ</button>
    </form>
    <div id="scroll-stype" style="height:60vh; width: 100%; overflow-x:auto; margin:0px; padding:0px;">
        <div id="chartContainer" ></div>
    </div>
</div>
