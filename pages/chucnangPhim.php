<?php 

echo '
<div class="chucnang_wrap" name="chucnangPhim">
        <ul class="chucnangcon_wrap">
            ';
            
        if(isset($_GET['pagecon'])){
            foreach($chucnang as $tenchucnang){
                switch($tenchucnang){
                    case "Lịch chiếu phim":
                        echo'<li class="chucnangcon_Phim" '.((isset($_GET['pagecon']) && $_GET['pagecon']=="moviesadmin.php")?'id="chucnangconPhim_selected"':'').' name="moviesadmin.php">Phim</li>';
                        break;
                    case "Thể loại":
                        echo '<li class="chucnangcon_Phim" '.((isset($_GET['pagecon']) && $_GET['pagecon']=="theloaiadmin.php")?'id="chucnangconPhim_selected"':'').' name="theloaiadmin.php">Thể loại</li>';
                        break;
                    case "Diễn viên":
                        echo ' <li class="chucnangcon_Phim" '.((isset($_GET['pagecon']) && $_GET['pagecon']=="dienvienadmin.php")?'id="chucnangconPhim_selected"':'').' name="dienvienadmin.php">Diễn viên</li>';
                        break;
                    default:
                        break;
                }
            }
        }
        else{
            foreach($chucnang as $tenchucnang){
                switch($tenchucnang){
                    case "Lịch chiếu phim":
                        echo'<li class="chucnangcon_Phim" id="chucnangconPhim_selected" name="moviesadmin.php">Phim</li>';
                        break;
                    case "Thể loại":
                        echo '<li class="chucnangcon_Phim" name="theloaiadmin.php">Thể loại</li>';
                        break;
                    case "Diễn viên":
                        echo ' <li class="chucnangcon_Phim" name="dienvienadmin.php">Diễn viên</li>';
                        break;
                    default:
                        break;
                }
            }
        }
echo' </ul>
    <div class="content_chucnangcon_wrap">';
    if(isset($_GET['pagecon']))
        require($_GET["pagecon"]);
    else {
        if(isset($_GET['MAPM']))
            require("./moviesadmin.php");
        else
            require("./pages/moviesadmin.php");
    }
        
    echo'</div>
</div>';
// echo '
//     <script>
//         $(".chucnangcon_wrap>.chucnangcon_Phim").click(function(){
//             let luachon = $(this).attr("name");
//             $.ajax({
//                 url: "./pages/chucnangPhim.php", 
//                 type: "GET",
//                 data: {pagecon: luachon},
//                 success: function(response) {
//                     $("#content").html(response); // Thay đổi nội dung của #content
//                 }
//             });
//         });
//     </script>
//     ';

?>