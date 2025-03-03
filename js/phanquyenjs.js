var buttonsPhanQuyen = document.querySelectorAll('.btn_phanquyen');
// Duyệt qua từng nút và gắn sự kiện click cho chúng
buttonsPhanQuyen.forEach(function(button) {
    button.addEventListener('click', function() {
        // Thêm class "quyen_selected" cho nút được click
        this.classList.add('quyen_selected');
        document.getElementsByName('edit_quyen')[0].classList.remove('quyen_selected');
        document.getElementsByName('acept_edit')[0].style.display = "none";
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "./pages/phanquyenchucnang.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("phanquyen_wrap").innerHTML = this.responseText;
        }
        };
        xhr.send("action="+this.getAttribute("name"));
        // Duyệt qua từng nút và xóa class "quyen_selected" khỏi các nút khác
        buttonsPhanQuyen.forEach(function(btn) {
            if (btn !== button) {
                btn.classList.remove('quyen_selected');
            }
        });
    });
    
});

document.getElementsByClassName('btn_phanquyen')[0].click();

btnEdit = document.getElementsByName('edit_quyen')[0];

btnEdit.addEventListener('click',()=>{
    let parentElement = document.getElementById('phanquyen_wrap');
    let inputElements = parentElement.querySelectorAll('input');

    if (btnEdit.classList.contains("quyen_selected")) {
        btnEdit.classList.remove('quyen_selected');
        document.getElementsByName('acept_edit')[0].style.display = "none";
        inputElements.forEach(function(input) {
            input.disabled = true; 
        });
    } else {
        btnEdit.classList.add('quyen_selected');
        document.getElementsByName('acept_edit')[0].style.display = "flex";
        inputElements.forEach(function(input) {
            input.disabled = false; 
        });
    }
});

document.getElementsByName('acept_edit')[0].addEventListener('click',()=>{
    document.getElementsByName('acept_edit')[0].style.display = "none";
    btnEdit.classList.remove('quyen_selected');

    let mangChiTietCN = [];
    let parentElement = document.getElementById('phanquyen_wrap');
    let functionDivs = parentElement.getElementsByClassName('phanquyen_wrap_function');

    let elements = document.getElementsByClassName("btn_phanquyen");
    let maQuyen = null;

    for (var i = 0; i < elements.length; i++) {
        if (elements[i].classList.contains("quyen_selected")) {
            maQuyen = elements[i].getAttribute('name');
            break;
        }
    }

    for (var i = 0; i < functionDivs.length; i++) {
        var divContent = functionDivs[i].getElementsByClassName('phanquyen_wrap_content')[0];
            var inputs = divContent.querySelectorAll('input');
            // Duyệt qua từng input checkbox
            inputs.forEach(function(input) {
                input.disabled = true;
                if(input.checked){
                   let maCN =  divContent.querySelector('.phanquyen_name').getAttribute('name');
                   mangChiTietCN.push([maQuyen ,maCN, input.getAttribute('name')]);
                }
            });
    }
    // console.log(mangChiTietCN);
    var jsonData = JSON.stringify(mangChiTietCN);
var xhr = new XMLHttpRequest();
xhr.open("POST", "./pages/phanquyenchucnang.php", true);
xhr.setRequestHeader("Content-Type", "application/json");
xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
        // Xử lý kết quả trả về từ process.php (nếu cần)
        console.log(xhr.responseText);
    }
};

xhr.send(jsonData);
});


document.getElementsByName('new_quyen')[0].addEventListener('click',()=>{
    document.querySelector('.modal_new').style.display = "block";
    document.querySelector('.modal_input_wrap').style.display = "flex";
});

document.getElementsByName('remove_quyen')[0].addEventListener('click',()=>{
    document.querySelector('.modal_new').style.display = "block";
    document.querySelector('.modal_delete_wrap').style.display = "flex";

    let elements = document.getElementsByClassName("btn_phanquyen");
    let tenQuyen =null;

    for (var i = 0; i < elements.length; i++) {
        if (elements[i].classList.contains("quyen_selected")) {
            tenQuyen = elements[i].innerHTML;
            break;
        }
    }
    document.querySelector('.modal_delete_tenQuyen').innerText ="Bạn có muốn xóa: "+ tenQuyen +" chứ ?";
});



document.querySelector('.btn_cancel').addEventListener('click',()=>{
    document.querySelector('.modal_new').style.display = "none";
    document.querySelector('.modal_input_wrap').style.display = "none";
});
document.querySelector('.btn_cancel_delete').addEventListener('click',()=>{
    document.querySelector('.modal_new').style.display = "none";
    document.querySelector('.modal_delete_wrap').style.display = "none";
});

document.querySelector('.modal_submit_delete').addEventListener('click',()=>{
    document.querySelector('.modal_new').style.display = "none";
    document.querySelector('.modal_delete_wrap').style.display = "none";

    let elements = document.getElementsByClassName("btn_phanquyen");
    let maQuyen = null;


    for (var i = 0; i < elements.length; i++) {
        if (elements[i].classList.contains("quyen_selected")) {
            maQuyen = elements[i].getAttribute('name');
            break;
        }
    }
    var xhr = new XMLHttpRequest();
    xhr.open('GET', './pages/XoaMaQuyen.php?MaQuyen=' + maQuyen, true);
    xhr.send();
    window.location.href = "admin.php?page=phanquyenadmin";
    // console.log(maQuyen);
});



