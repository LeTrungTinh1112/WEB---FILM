<?php 

echo '
<div class="chucnang_wrap" name="chucnangLichchieuphim">
        <ul class="chucnangcon_wrap">
            ';
        if(isset($_GET['pagecon'])){
            switch($_GET['pagecon']){
                case "lichchieuphimadmin.php":
                    echo'
            <li class="chucnangcon_Phim" id="chucnangconPhim_selected" name="lichchieuphimadmin.php">Lich chiếu phim</li>
            <li class="chucnangcon_Phim" name="suatchieuadmin.php">Suất chiếu</li>
            <li class="chucnangcon_Phim"  name="ngayleadmin.php">Ngày lễ</li>';
                    break;
                case "suatchieuadmin.php":
                    echo'
            <li class="chucnangcon_Phim"  name="lichchieuphimadmin.php">Lich chiếu phim</li>
            <li class="chucnangcon_Phim" id="chucnangconPhim_selected" name="suatchieuadmin.php">Suất chiếu</li>
            <li class="chucnangcon_Phim"  name="ngayleadmin.php">Ngày lễ</li>';
                    break;
                case "ngayleadmin.php":
                    echo'
            <li class="chucnangcon_Phim"  name="lichchieuphimadmin.php">Lich chiếu phim</li>        
            <li class="chucnangcon_Phim" name="suatchieuadmin.php">Suất chiếu</li>
            <li class="chucnangcon_Phim"  id="chucnangconPhim_selected"  name="ngayleadmin.php">Ngày lễ</li>';
                    break;
            }
        }
        else{
            echo'
            <li class="chucnangcon_Phim" id="chucnangconPhim_selected" name="lichchieuphimadmin.php">Lich chiếu phim</li>
            <li class="chucnangcon_Phim" name="suatchieuadmin.php">Suất chiếu</li>
            <li class="chucnangcon_Phim"  name="ngayleadmin.php">Ngày lễ</li>'; 
        }
echo' </ul>
    <div class="content_chucnangcon_wrap">';
    if(isset($_GET['pagecon']))
        require($_GET["pagecon"]);
    else 
        require("./pages/lichchieuphimadmin.php");
    echo'</div>
</div>';
echo '
    <script>
        $(".chucnangcon_wrap>.chucnangcon_Phim").click(function(){
            let luachon = $(this).attr("name");
            $.ajax({
                url: "./pages/chucnangLichchieuphim.php", 
                type: "GET",
                data: {pagecon: luachon},
                success: function(response) {
                    $("#content").html(response); // Thay đổi nội dung của #content
                }
            });
        });
    </script>
    ';

?>