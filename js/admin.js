
$('#lichchieuphim_wrap').ready(function(){
    const divWrap_btnNgay = document.querySelector("#lichchieuphim_daytime ul");
    let btnPrevNgay = document.getElementById("btn_left_Ngay");
    let btnNextNgay = document.getElementById("btn_right_Ngay");
    let index = 0; // Mỗi lần cuộn qua một ô
    
    if(btnNextNgay!=null){
        btnNextNgay.addEventListener("click", () => {
            let ngay = divWrap_btnNgay.querySelectorAll('li');
            btnPrevNgay.style.display='flex';
            
            if(15+index<ngay.length){
                index++;
                divWrap_btnNgay.style.left='calc( -74px * '+index+')';
                if(15+index>=ngay.length) btnNextNgay.style.display='none';
            }
        });
    }
    
    if(btnPrevNgay!=null){
        btnPrevNgay.addEventListener("click", () => {
        
            index--;
            btnNextNgay.style.display='flex';
            divWrap_btnNgay.style.left='calc( -74px * '+index+')';
            if(index == 0) btnPrevNgay.style.display='none';
            
        });
    }
    
});



//add lich chieu phim
function showAddFormLichchieuphim(){

        let n = btn_add_lichchieuphim.getAttribute('name');
        $('#unclick_behind_this_screen').css('display' , 'block');
        $.ajax({
            url: "./pages/addLichchieuphim.php", 
            type: "POST",
            data: {ngay: n},
            success: function(response) {
                $("#lichchieuphim_wrap").append(response); 
                $("#form_addLichchieuphim #btn_exit").on('click',function(){
                    
                     $('#unclick_behind_this_screen').css('display' , 'none');
                   $('#form_addLichchieuphim').remove();
                
               });
               
                
            }
        });
        
   
 
}
    


//end add lichhcieu phim


// user 

$('#users_wrap').ready(function () {
    $('.user > i.fa-pen-to-square').each(function () {
        $(this).on('click', function () {
            let keywork = $(this).attr('name');
            $.ajax({
                url: './pages/usersadmin.php',
                type: 'GET',
                data: { USERNAME: keywork },
                success: function (result) {
                    $("#content").html(result);
                    $('#unclick_behind_this_screen').css('display', 'block');
                    $('#users_wrap_change').css('display', 'grid');

                    $('#users_wrap_change #btn_exit').on('click', function () {
                        $('#unclick_behind_this_screen').css('display', 'none');
                        $('#users_wrap_change').css({ 'display': 'none' });
                    }),
                        $.ajax({
                            url: './js/admin.js',
                            success: function (result) {

                            },
                            error: function (xhr, status, error) {
                                // Xử lý lỗi nếu có
                            }
                        });
                    $('#btnDelAll').on('click',function(){
                        $('input[name="hoten"]').val('');
                        $('input[name="email"]').val('');
                    })

                },
                error: function (xhr, status, error) {
                    console.error("error:", status, error);
                }
            });
        });
    });
    $('.user i.fa-trash').each(function(){
        $(this).on('click', function(){
            let keywork = $(this).attr('name');
            $.ajax({
                url:'./pages/usersadmin.php',
                type: 'GET',
                data: {userdel: keywork},
                success: function(result){
                    $('#unclick_behind_this_screen').css('display', 'none');
                    $('#users_wrap_change').css({ 'display': 'none' });
                    $("#content").html(result);
                    $.ajax({
                        url: './js/admin.js',
                        success: function (result) {
                        },
                        error: function (xhr, status, error) {
                            // Xử lý lỗi nếu có
                        }
                    });
                }
            })
        })
    })
});


$(document).ready(function () {
    function checkErrorParam() {
        var urlParams = new URLSearchParams(window.location.search);
        return urlParams.has('error');
    }

    if (checkErrorParam()) {
        $("#account__box").css('display', 'block');
        $('#unclick_behind_this_screen').css('display', 'block');
    }

    $("#acount__add").on('click', function () {
        $("#account__box").css('display', 'block');
        $('#unclick_behind_this_screen').css('display', 'block');
    });

    $("#account__icon").on('click', function () {
        $("#account__box").css('display', 'none');
        $('#unclick_behind_this_screen').css('display', 'none');
    });
});



//end user


$(".chucnangcon_wrap").find(".chucnangcon_Phim").ready(function () {
    $(".chucnangcon_Phim").on('click', function () {
        let luachon = $(this).attr("name");
        let url_link = '';
        switch ($(".chucnang_wrap").attr('name')) {
            case "chucnangPhim":
                url_link = './pages/chucnangPhim.php';
                break;
            case "chucnangLichchieuphim":
                url_link = './pages/chucnangLichchieuphim.php';
                break;
        }
        $.ajax({

            url: url_link,
            type: "GET",
            data: { pagecon: luachon },
            success: function (response) {
                $("#content").html(response); // Thay đổi nội dung của #content
                $.ajax({
                    url: "./js/admin.js",
                    success: function (response) {
                        // Xử lý dữ liệu từ yêu cầu AJAX thứ hai
                    },
                    error: function (xhr, status, error) {
                        // Xử lý lỗi nếu có
                    }
                });
            }
        });
    });
});


//movie
$('#movies').find('.movie').ready(function(){
    $('.movie').on('mouseenter',function(){
        $(this).find('.click_change_infor_movie').css({
            'display':'flex',
        });
    });
    $('.movie').on('mouseleave',function(){
        $(this).find('.click_change_infor_movie').css('display','none');
    });
    $('.movie').on('click',function(){
            let maphim = $(this).attr('name');
            let page = (document.querySelector("#list_page ul ")).getAttribute('name');
            $.ajax({
                url: "./pages/moviesadmin.php",
                type: "GET",
                data: {MAPM: maphim,index: page},
                success: function(response) {
                    $("#content").html(response); // Thay đổi nội dung của #content
                    $('#unclick_behind_this_screen').css('display' , 'block');
                    $.ajax({
                        url: "./js/admin.js",
                        success: function(response) {
                            // Xử lý dữ liệu từ yêu cầu AJAX thứ hai
                        },
                        error: function(xhr, status, error) {
                            // Xử lý lỗi nếu có
                        }
                    });
                }
            });
        });
            $('#movie_change_infor').ready(function(){
           
            // $('#movie_change_infor').css('display','flex');
            $('#movie_change_infor').find('#btn_exit').on('click',function(){
                $('#unclick_behind_this_screen').css('display' , 'none');
                $('#movie_change_infor').css('display','none');
                
            });
        });
    
    
    $('#movie_change_infor').find('#click_show_infor_movie_new').ready(function(){
        $('#movie_change_infor').find('#click_show_infor_movie_new').on('click',function(){
            let status=$('#movie_change_infor').find('#click_show_infor_movie_new').attr('name');
        switch(status){
            case "show":

                $('#movie_change_infor').find('#click_show_infor_movie_new').html('<i class="fa-solid fa-arrow-left" style="margin-right:10px;"></i>Quay lại');
                $('#movie_change_infor').find('#show_infor_movie_new').css('display','block');
                $('#movie_change_infor').find('#click_show_infor_movie_new').attr('name','hide');

                //hiện xóa btn
                $('.click_show_change_movie').find('.fa-trash').css('display','none');
                
                break;
            case "hide":

                $('#movie_change_infor').find('#click_show_infor_movie_new').html('Chỉnh sửa phim<i class="fa-solid fa-arrow-right" style="padding-left:10px;"></i>');
                $('#movie_change_infor').find('#show_infor_movie_new').css('display','none');
                $('#movie_change_infor').find('#click_show_infor_movie_new').attr('name','show');

                //ẩn xóa btn
                $('.click_show_change_movie').find('.fa-trash').css('display','block');
                break;
        }
        });
    });
});
$('#show_infor_movie_new').find('#click_show_theloai').ready(function () {
    $('#show_infor_movie_new').find('#click_show_theloai').on('click', function () {
        let status = $('#show_infor_movie_new').find('#click_show_theloai').attr('name');
        switch (status) {
            case "show":
                $('#click_show_theloai').html('Click để ẩn thể loại');
                $('#show_list_theloai').css('display', 'block');
                $('#click_show_theloai').attr('name', 'hide');
                break;
            case "hide":
                $('#click_show_theloai').html('Click để chọn thể loại');
                $('#show_list_theloai').css('display', 'none');
                $('#click_show_theloai').attr('name', 'show');
                break;
        }
    });
});

$('#show_infor_movie_new').find('#click_show_dienvien').ready(function(){
    $('#show_infor_movie_new').find('#click_show_dienvien').on('click',function(){
        let status= $('#show_infor_movie_new').find('#click_show_dienvien').attr('name');
        switch(status){
            case "show":
                $('#click_show_dienvien').html('Click để ẩn diễn viên');
                $('#show_list_dienvien').css('display','block');
                $('#click_show_dienvien').attr('name','hide');
               break;
            case "hide":
                $('#click_show_dienvien').html('Click để chọn diễn viên');
                $('#show_list_dienvien').css('display','none');
                $('#click_show_dienvien').attr('name','show');
                break;
        }
    });
}); 

//add phim
$("#btn_add_phim").ready(function(){
    $("#btn_add_phim").on('click',function(){
        $('#unclick_behind_this_screen').css('display' , 'block');
        $.ajax({
            url: "./pages/addMovieadmin.php",
            success: function(response) {
                $("#content").append(response); 
                $("#form_addMovie #btn_exit").on('click',function(){
                    
                   $('#unclick_behind_this_screen').css('display' , 'none');
                   $('#form_addMovie').remove();
                  
               });
               
                
            }
        });
        
   
    });
});
function clickToSelectTheloaiPhim(div){
        let select = div.querySelector('#click_show_theloai');
        let status= select.getAttribute('name');
        switch(status){
            case "show":
                select.innerHTML='Click để ẩn thể loại';
                div.querySelector('#show_list_theloai').style='display: block;';
            select.setAttribute('name','hide');
           break;
        case "hide":
            select.innerHTML='Click để chọn thể loại';
            div.querySelector('#show_list_theloai').style='display: none;';
            select.setAttribute('name','show');
            break;
        }
    
}

function clickToSelectDienvienPhim(div){
    let select = div.querySelector('#click_show_dienvien');
    let status= select.getAttribute('name');
    switch(status){
        case "show":
            select.innerHTML='Click để ẩn diễn viên';
            div.querySelector('#show_list_dienvien').style='display: block;';
        select.setAttribute('name','hide');
       break;
    case "hide":
        select.innerHTML='Click để chọn diễn viên';
        div.querySelector('#show_list_dienvien').style='display: none;';
        select.setAttribute('name','show');
        break;
    }

}
function addMovieadmin(){
    
        event.preventDefault(); // Ngăn chặn hành động mặc định của form
    
        let inputs = document.getElementsByName("THELOAI[]");
        let inputValues = [];
    
        for (let i = 0; i < inputs.length; i++) {
            if(inputs[i].checked)
                inputValues.push(inputs[i].value);
        }
    
        // Xử lý dữ liệu ở đây
        let errorTL = document.getElementById('errorTL');
        if(inputValues.length==0){
            errorTL.innerHTML="Chọn thể loại";
        }else
        errorTL.innerHTML="";

        
    
        // Tiếp tục gửi form đến action bằng cách sử dụng JavaScript

        let form = document.getElementById("form_addMovie");
let formData = new FormData(form);
let xhr = new XMLHttpRequest();

xhr.open("POST", form.action, true);
xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        // Xử lý phản hồi từ server nếu cần
        form.innerHTML = xhr.responseText;
    }
};
formData.append('thaotac', 'add');
xhr.send(formData);
    
}

if(document.getElementById("form_updatePhim")!=null){
    let form_updatePhim = document.getElementById("form_updatePhim");
    form_updatePhim.addEventListener('submit',function(event){
        event.preventDefault();
        let formData = new FormData(form_updatePhim);
    let xhr = new XMLHttpRequest();
    
    xhr.open(form_updatePhim.method, form_updatePhim.action, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Xử lý phản hồi từ server nếu cần
        
            document.getElementById('movie_change_infor').innerHTML = xhr.responseText;
        }
    };
    formData.append('thaotac', 'update');
    formData.append('MAPM', form_updatePhim.getAttribute('name'));
    xhr.send(formData);
        
    });
}

if(document.querySelector(".click_show_change_movie .fa-trash") != null){
    let trash_deletePhim=document.querySelector(".click_show_change_movie .fa-trash");
    trash_deletePhim.addEventListener('click',function(div){
        let MAPM = trash_deletePhim.getAttribute('name');
        let xhr = new XMLHttpRequest();
        var formData = new FormData();
        
    xhr.open("POST","./pages/addMovieadmin.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Xử lý phản hồi từ server nếu cần
            document.getElementById('movie_change_infor').innerHTML = xhr.responseText;
        }
    };
    formData.append('thaotac', 'delete');
    formData.append('MAPM', MAPM);
    xhr.send(formData);
    });
}


//end add phim



    // $('.lichchieuphim_phim').find('.edit_suatchieu').on('click', function () {
    //     $('#change_lichchieuphim_phim').ready(function () {
    //         $('#unclick_behind_this_screen').css('display', 'block');
    //         $('#change_lichchieuphim_phim').css('display', 'flex');
    //         $('.lichchieuphim_lichchieu').on('click', function () {
    //             $('#hide_choose_new_suatchieu').css('display', 'none');
    //             $('#div_choose_new_suatchieu').ready(function () {
    //                 $('#div_choose_new_suatchieu').css('display', 'grid');
    //             });
    //         });
    //         $('#exit_edit_suatchieu').on('click', function () {
    //             $('#hide_choose_new_suatchieu').css('display', 'block');
    //             $('#div_choose_new_suatchieu').css('display', 'none');
    //             $('#unclick_behind_this_screen').css('display', 'none');
    //             $('#change_lichchieuphim_phim').css('display', 'none');
    //         });
    //     });
    // });


// ticket-history
$('#history_ticket_wrap').ready(function () {
    $('.icon-show').on('click', function () {
        let keywork = $(this).attr('name');
        // alert(keywork);
        $.ajax({
            url: './pages/lsdatveadmin.php',
            type: 'GET',
            data: { MAVE: keywork },
            success: function (result) {
                $('#content').html(result);
                $('#unclick_behind_this_screen').css('display', 'block');
                $('#ticket-history').css('display', 'block');
                $('#icon-close').on('click', function () {
                    $('#unclick_behind_this_screen').css('display', 'none');
                    $('#ticket-history').css('display', 'none');
                });
                $.ajax({
                    url: "./js/admin.js",
                    success: function (result) {

                    },
                    error: function (xhr, status, error) {
                    }
                });
            }
        });
    });
});


// end ticket-history



    $(".btn_changeDayLichchieuphim").on('click',function(){
        
        let day = $(this).attr('name');
        $('#lichchieuphim_selected').attr('id','');
        $(this).attr('id','lichchieuphim_selected');
        $.ajax({
            url: "./pages/lichchieuphimadmin.php", 
                type: "GET",
                data: {day: day},
                success: function(response) {
                    document.getElementById('lichchieuphim_content').outerHTML=response;
                    // $("#lichchieuphim_content").html(response); // Thay đổi nội dung của #content
                    // $('#unclick_behind_this_screen').css('display' , 'block');
                    
                }
            });
         
    });

function hide_formAddLCP(ID){
    document.getElementById('unclick_behind_this_screen').style="display:none;";
    switch(ID){
        case 1:
            document.getElementById('form_addLichchieuphim').outerHTML='';
            break;
        case 2:
          
            let day = document.getElementById("btn_exit_formAddLCP").getAttribute('name');
            
            $.ajax({
                url: "./pages/lichchieuphimadmin.php", 
                    type: "GET",
                    data: {day: day},
                    success: function(response) {
              $('#form_deleteLichchieuphim').remove();
                        document.getElementById('lichchieuphim_content').outerHTML=response;
                        // $("#lichchieuphim_content").html(response); // Thay đổi nội dung của #content
                        // $('#unclick_behind_this_screen').css('display' , 'block');
                        
                    }
                });
            break;
    }
  
}

function showUpdateFormLichchieuphim(div){
    let MAPM = div.getAttribute('name');
      
    $('#unclick_behind_this_screen').css('display', 'block');
    let ngay = document.getElementById('btn_add_lichchieuphim').getAttribute('name');
    $.ajax({
        url: "./pages/updateLichchieuphimadmin.php",
        type: "POST",
        data: { ngay: ngay,MAPM: MAPM },
        success: function (response) {
            $("#lichchieuphim_wrap").append(response);
            $('#change_lichchieuphim_phim .lichchieuphim_lichchieu').on('click', function () {
                $('#selectChangeSC').attr('id','');
                $(this).attr('id','selectChangeSC');
                let masc=$(this).attr('name');
                let malichchieu= $(this).find('input').attr('value');
                $.ajax({
                    url: "./pages/updateLichchieuphimadmin.php",
                    type: "POST",
                    data: { ngay: ngay,MAPM: MAPM ,selectSC: masc,malichchieu: malichchieu},
                    success: function (response) {
                        $("#change_lichchieuphim_phim #hide_choose_new_suatchieu").html(response);
                        
                    }
                });            
                            
                });

        },
        error: function (xhr, status, error) {
            alert(error);
        }
    });
}


       


$('#change_lichchieuphim_phim .lichchieuphim_lichchieu').on('click', function () {
    $('#selectChangeSC').attr('id','');
    $(this).attr('id','selectChangeSC');
    let masc=$(this).attr('name');
    let malichchieu= $(this).find('input').attr('value');
    $.ajax({
        url: "./pages/updateLichchieuphimadmin.php",
        type: "POST",
        data: { ngay: ngay,MAPM: MAPM ,selectSC: masc,malichchieu: malichchieu},
        success: function (response) {
            $("#change_lichchieuphim_phim #hide_choose_new_suatchieu").html(response);

            
        }
    });            
                
    });
function deleteLCP(div){
    let mapm = div.getAttribute('id');
    let parent=div.parentElement;
    let list_divLCP=parent.querySelectorAll(".lichchieuphim_lichchieu");
    let n = btn_add_lichchieuphim.getAttribute('name');
    let arrayselectMLC = [];

    // for(let i=0;i<list_divLCP.length;i++){
    //     arrayselectMLC.push(list_divLCP[i].getAttribute('name'));
    // }
    document.getElementById('unclick_behind_this_screen').style="display:block;";
    let formData = new FormData();
    let xhr = new XMLHttpRequest();

    xhr.open("POST", "../pages/deleteLichchieuphim.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Xử lý phản hồi từ server nếu cần
$('#lichchieuphim_wrap').append(xhr.responseText);
      
     
            // div.innerHTML = `<option value="">Chọn suất chiếu</option>` + xhr.responseText;
        }
    };
    formData.append('MAPM',mapm);
    formData.append('ngay',n);
    formData.append('listLCP', JSON.stringify(arrayselectMLC));
    xhr.send(formData);
}
function updateLCP(){
    event.preventDefault(); // Ngăn chặn hành động mặc định của form

    let form = document.getElementById("div_choose_new_suatchieu");
    let formData = new FormData(form);
    let xhr = new XMLHttpRequest();

    xhr.open(form.method, form.action, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Xử lý phản hồi từ server nếu cần
            form.innerHTML = xhr.responseText;
        }
    };
    xhr.send(formData);


}
function hide_formUpdateLCP(){
    document.getElementById('unclick_behind_this_screen').style="display:none;";
    let day = document.getElementById("exit_edit_suatchieu").getAttribute('name');
            
            $.ajax({
                url: "./pages/lichchieuphimadmin.php", 
                    type: "GET",
                    data: {day: day},
                    success: function(response) {
              $('#change_lichchieuphim_phim').remove();
                        document.getElementById('lichchieuphim_content').outerHTML=response;
                        // $("#lichchieuphim_content").html(response); // Thay đổi nội dung của #content
                        // $('#unclick_behind_this_screen').css('display' , 'block');
                        
                    }
                });
            
}
function showListSCcothechonUpdate(div){
    
    // Thiết lập thuộc tính "selected" cho phần tử đã chọn
    let ngay = document.getElementById('btn_add_lichchieuphim').getAttribute('name');
    let parent = div.parentElement;

    let options=div.querySelectorAll('option');
    for(let i=0;i<options.length;i++){

            options[i].removeAttribute('selected');
            
         
    }
     
   
    let defaultOption = div.querySelector("option[value="+div.value+"]");

    // Thiết lập thuộc tính "selected" cho phần tử đã chọn
    defaultOption.setAttribute("selected", "selected");
                let maphim = document.getElementById("change_lichchieuphim_phim").getAttribute('name');

               
                let formData = new FormData();
                let xhr = new XMLHttpRequest();

                xhr.open("POST", "../pages/updateLichchieuphimadmin.php", true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                        // Xử lý phản hồi từ server nếu cần
                     
                            document.getElementById('showPhongchieu').innerHTML = xhr.responseText;
                       
                       
                        // div.innerHTML = `<option value="">Chọn suất chiếu</option>` + xhr.responseText;
                    }
                };
                formData.append('ngay', ngay);
                formData.append('PC', '');
               formData.append('selectSC', '');
                formData.append('MASC', div.value);
                formData.append('mapihm', maphim);
                xhr.send(formData);

}




//user
$('#users_wrap').ready(function () {
    $('.user > i').on('click', function () {
        $('#unclick_behind_this_screen').css('display', 'block');
        $('#users_wrap_change').css({
            'display': 'grid',
            //'color' : 'red'

        });
    });
    $('#users_wrap_change #btn_exit').on('click', function () {
        $('#unclick_behind_this_screen').css('display', 'none');
        $('#users_wrap_change').css({
            'display': 'none',
            //'color' : 'red'

        });
    });
});

$(".chucnangcon_wrap").find(".chucnangcon_Phim").ready(function () {
    $(".chucnangcon_Phim").on('click', function () {
        let luachon = $(this).attr("name");
        let url_link = '';
        switch ($(".chucnang_wrap").attr('name')) {
            case "chucnangPhim":
                url_link = './pages/chucnangPhim.php';
                break;
            case "chucnangLichchieuphim":
                url_link = './pages/chucnangLichchieuphim.php';
                break;
        }
        $.ajax({

            url: url_link,
            type: "GET",
            data: { pagecon: luachon },
            success: function (response) {
                $("#content").html(response); // Thay đổi nội dung của #content
                $.ajax({
                    url: "./js/admin.js",
                    success: function (response) {
                        // Xử lý dữ liệu từ yêu cầu AJAX thứ hai
                    },
                    error: function (xhr, status, error) {
                        // Xử lý lỗi nếu có
                    }
                });
            }
        });
    });
});


if( document.getElementById("form_updatePhim") != null){
    let form_updatePhim = document.getElementById("form_updatePhim");
    form_updatePhim.addEventListener('submit', function (event) {
        event.preventDefault();
        let formData = new FormData(form_updatePhim);
        let xhr = new XMLHttpRequest();
    
        xhr.open(form_updatePhim.method, form_updatePhim.action, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                // Xử lý phản hồi từ server nếu cần
    
                document.getElementById('movie_change_infor').innerHTML = xhr.responseText;
            }
        };
        formData.append('thaotac', 'update');
        formData.append('MAPM', form_updatePhim.getAttribute('name'));
        xhr.send(formData);
    
    });
}



if(document.querySelector(".click_show_change_movie .fa-trash") != null){
    let trash_deletePhim = document.querySelector(".click_show_change_movie .fa-trash");
    trash_deletePhim.addEventListener('click', function (div) {
        let MAPM = trash_deletePhim.getAttribute('name');
        let xhr = new XMLHttpRequest();
        var formData = new FormData();
    
        xhr.open("POST", "./pages/addMovieadmin.php", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                // Xử lý phản hồi từ server nếu cần
                document.getElementById('movie_change_infor').innerHTML = xhr.responseText;
            }
        };
        formData.append('thaotac', 'delete');
        formData.append('MAPM', MAPM);
        xhr.send(formData);
    });
}


//end add phim

//an vao chon phim trong them lich chieu phim
function show_SuatchieuvaPhongchieu_LCP() {
    let maphim = document.getElementById("selectFilm");
    let wrapAll = document.getElementById("wrapAll_selectSuatchieuandPhC");
    let ngay=document.getElementsByClassName('btn_add')[0].getAttribute('name');
    let formData = new FormData();
   let xhr = new XMLHttpRequest();

   xhr.open("POST", "../pages/addLichchieuphim.php", true);
   xhr.onreadystatechange = function () {
       if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
           // Xử lý phản hồi từ server nếu cần
           wrapAll.innerHTML = xhr.responseText;
           // div.innerHTML = `<option value="">Chọn suất chiếu</option>` + xhr.responseText;
       }
   };
   formData.append('newSCvaPC', '');
   let arrayselectSC = [];
   let arrayselectPC = [];
   formData.append('ngay', ngay);
    formData.append('mapihm', maphim.value);
    formData.append('selectSC', JSON.stringify(arrayselectSC));
    formData.append('selectPC', JSON.stringify(arrayselectPC));
   xhr.send(formData);
}
//ấn vào nút thêm ở trang thêm lịch chiếu phim

function add_SuatchieuvaPhongchieu_LCP(div) {
    let maphim = document.getElementById("selectFilm");
    let ngay=document.getElementsByClassName('btn_add')[0].getAttribute('name');
    let wrapAll = document.getElementById("wrapAll_selectSuatchieuandPhC");
    let listselectSC = document.getElementsByName('selectSC[]');
                let arrayselectSC = [];
                for (let i = 0; i < listselectSC.length; i++) {
                    if (listselectSC[i].value != "")
                        arrayselectSC.push(listselectSC[i].value);
                }
                

                let listselectPC = document.getElementsByName('selectPC[]');
                let arrayselectPC = [];
                for (let i = 0; i < listselectPC.length; i++) {
                    if (listselectPC[i].value != "")
                        arrayselectPC.push(listselectPC[i].value);
                }
   let formData = new FormData();
   let xhr = new XMLHttpRequest();

   xhr.open("POST", "../pages/addLichchieuphim.php", true);
   xhr.onreadystatechange = function () {
       if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
           // Xử lý phản hồi từ server nếu cần
           wrapAll.innerHTML += xhr.responseText;
           // div.innerHTML = `<option value="">Chọn suất chiếu</option>` + xhr.responseText;
       }
   };
   formData.append('newSCvaPC', '');
   formData.append('ngay', ngay);
    formData.append('mapihm', maphim.value);
    formData.append('selectSC', JSON.stringify(arrayselectSC));
    formData.append('selectPC', JSON.stringify(arrayselectPC));
    console.log("mang masc");
    console.log(arrayselectSC);
    console.log("mang mapc");
    console.log(arrayselectPC);
   xhr.send(formData);
}

//an vao chon suat chieu o trang them lich chieu phim

function showListSCcothechon(div) {



    // Thiết lập thuộc tính "selected" cho phần tử đã chọn
    let ngay=document.getElementsByClassName('btn_add')[0].getAttribute('name');
    let parent = div.parentElement;
    let options=div.querySelectorAll('option');
    for(let i=0;i<options.length;i++){

            options[i].removeAttribute('selected');
            
         
    }
     
   
    let defaultOption = div.querySelector("option[value="+div.value+"]");

    // Thiết lập thuộc tính "selected" cho phần tử đã chọn
    defaultOption.setAttribute("selected", "selected");
                let maphim = document.getElementById("selectFilm");

                let listselectSC = document.getElementsByName('selectSC[]');
                let arrayselectSC = [];
                for (let i = 0; i < listselectSC.length; i++) {
                    if (listselectSC[i].value != "")
                        arrayselectSC.push(listselectSC[i].value);
                }
                

                let listselectPC = document.getElementsByName('selectPC[]');
                let arrayselectPC = [];
                for (let i = 0; i < listselectPC.length; i++) {
                    if (listselectPC[i].value != "")
                        arrayselectPC.push(listselectPC[i].value);
                }
                

                let formData = new FormData();
                let xhr = new XMLHttpRequest();

                xhr.open("POST", "../pages/addLichchieuphim.php", true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                        // Xử lý phản hồi từ server nếu cần
                        parent.querySelector("select:last-child").innerHTML = xhr.responseText;
                        // div.innerHTML = `<option value="">Chọn suất chiếu</option>` + xhr.responseText;
                    }
                };
                formData.append('ngay', ngay);
                formData.append('PC', '');
                formData.append('MASC', div.value);
                formData.append('mapihm', maphim.value);
                formData.append('selectSC', JSON.stringify(arrayselectSC));
                formData.append('selectPC', JSON.stringify(arrayselectPC));
                xhr.send(formData);

      
       
   
}




function removeSelectSCvaPC(div){
    let wrapAllchild = document.querySelectorAll("#wrapAll_selectSuatchieuandPhC .wrap_selectSuatchieuandPhC");
    if(wrapAllchild.length == 1) alert('Toi thieu la 1 ');
    else{
        let parent=div.parentElement;
    
        parent.outerHTML='';
    }
    
}

function deletelichchieuphim(div){

    let parent = div.parentElement;
    parent.remove();
    let malichchieu = parent.getAttribute('name');
   
    
    $.ajax({
        url: "../pages/deleteLichchieuphim.php",
        type: "POST",
        data:{MALICHCHIEU : malichchieu},
        success: function (response) {
            let div_scvapc= document.getElementsByClassName('wrap_deleteSuatchieuandPhC');
            if(div_scvapc.length==0){
                window.location.replace("../admin.php?page=lichchieuphimadmin");
            }
         
        }
        

    });

}
function searchAdmin(event){
    event.preventDefault();
    
        let searchadmin = document.getElementById("searchadmin");
       
            
            let formData = new FormData(searchadmin);
            let xhr = new XMLHttpRequest();
        
            xhr.open(searchadmin.method, searchadmin.action, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    // Xử lý phản hồi từ server nếu cần
                    document.getElementById('content').innerHTML = xhr.responseText;
                    // document.getElementById('movie_change_infor').innerHTML = xhr.responseText;
                   
                $.ajax({
                    url: "./js/admin.js",
                    success: function (response) {
                        // Xử lý dữ liệu từ yêu cầu AJAX thứ hai
                    },
                    error: function (xhr, status, error) {
                        // Xử lý lỗi nếu có
                    }
                });
                }
            };
            formData.append('chucnang', searchadmin.getAttribute('name'));
            xhr.send(formData);
        
     
    
}
$('#list_page').ready(function() {
    $('#list_page ul a').click(function(e){
        e.preventDefault();
        let page = $(this).attr('href');
        $.ajax({
            type: 'GET',
            url: page, 
            success: function(data){
                $('#content').html(data);
                $.ajax({
                    url: "./js/admin.js",
                    success: function (response) {
                        // Xử lý dữ liệu từ yêu cầu AJAX thứ hai
                    },
                    error: function (xhr, status, error) {
                        // Xử lý lỗi nếu có
                    }
                });
            }
        });
    });
});
