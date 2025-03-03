const slider1 = document.getElementById("slide_phimdangchieu");
const boxWidth = document.querySelector(".grid__column-2-4").offsetWidth; //Lấy chiều rộng của box
var btnPrev1 = document.getElementById("btn_prev_phimdangchieu");
var btnNext1 = document.getElementById("btn_next_phimdangchieu");




let boxView1 = Math.round(slider1.clientWidth / boxWidth); //888888888888

btnPrev1.style.display = "none";

btnPrev1.addEventListener("click", () => {
    const scrollLeft = slider1.scrollLeft; //Lấy giá trị của scroll của phần tử hiện tại
    const target = scrollLeft - boxWidth * boxView1;
    slider1.scrollTo({
        top: 0,
        left: target,
        behavior: "smooth"
    });
});

btnNext1.addEventListener("click", () => {
  
    const scrollLeft = slider1.scrollLeft;
    const target = scrollLeft + boxWidth * boxView1;
    slider1.scrollTo({
        top: 0,
        left: target,
        behavior: "smooth"
    });
});

slider1.addEventListener("scroll", () => {
    const scrollLeft = slider1.scrollLeft;
    const maxScroll = slider1.scrollWidth - slider1.clientWidth;

    if (scrollLeft <= 0) {
        btnPrev1.style.display = "none";
    } else {
        btnPrev1.style.display = "flex";
    }

    if (scrollLeft >= maxScroll) {
        btnNext1.style.display = "none";
    } else {
        btnNext1.style.display = "flex";
    }
});

// ----------------------------------------

const slider2 = document.getElementById("slide_phimsapchieu");
var btnPrev2 = document.getElementById("btn_prev_phimsapchieu");
var btnNext2 = document.getElementById("btn_next_phimsapchieu");




let boxView2 = Math.round(slider2.clientWidth / boxWidth); //888888888888

btnPrev2.style.display = "none";

btnPrev2.addEventListener("click", () => {
    const scrollLeft = slider2.scrollLeft; //Lấy giá trị của scroll của phần tử hiện tại
    const target = scrollLeft - boxWidth * boxView2;
    slider2.scrollTo({
        top: 0,
        left: target,
        behavior: "smooth"
    });
});

btnNext2.addEventListener("click", () => {
  
    const scrollLeft = slider2.scrollLeft;
    const target = scrollLeft + boxWidth * boxView2;
    slider2.scrollTo({
        top: 0,
        left: target,
        behavior: "smooth"
    });
});

slider2.addEventListener("scroll", () => {
    const scrollLeft = slider2.scrollLeft;
    const maxScroll = slider2.scrollWidth - slider2.clientWidth;

    if (scrollLeft <= 0) {
        btnPrev2.style.display = "none";
    } else {
        btnPrev2.style.display = "flex";
    }

    if (scrollLeft >= maxScroll) {
        btnNext2.style.display = "none";
    } else {
        btnNext2.style.display = "flex";
    }
});

        // function searchFilm() {
        //     let input = document.getElementById('searchFilmMenu').value;
        //     let value_theLoai = document.getElementById('cbb_category').value;
        //     let value_quocGia = document.getElementById('cbb_country').value;
        //     let value_Nam = document.getElementById('cbb_years').value;
        //     let xhr = new XMLHttpRequest();
        //     xhr.open('GET', './pages/searchMenuPhim.php?query=' + input +'&theLoai='+ value_theLoai +'&quocGia='+ value_quocGia+'&nam='+value_Nam, true);

        //     xhr.onload = function () {
        //         if (xhr.readyState == 4 && xhr.status == 200) {
        //             document.getElementById('conchimnon').innerHTML = xhr.responseText;
        //         }
        //     };
        //     xhr.send();
        // }

        // function searchFilm(page = 1) {
        //     let input = document.getElementById('searchFilmMenu').value;
        //     let value_theLoai = document.getElementById('cbb_category').value;
        //     let value_quocGia = document.getElementById('cbb_country').value;
        //     let value_Nam = document.getElementById('cbb_years').value;
        //     let xhr = new XMLHttpRequest();
        //     xhr.open('GET', './pages/searchMenuPhim.php?query=' + input + '&theLoai=' + value_theLoai + '&quocGia=' + value_quocGia + '&nam=' + value_Nam + '&page=' + page, true);
        
        //     xhr.onload = function () {
        //         if (xhr.readyState == 4 && xhr.status == 200) {
        //             document.getElementById('conchimnon').innerHTML = xhr.responseText;
        //         }
        //     };
        //     xhr.send();
        // }

        function searchFilm(page = 1) {
            let input = document.getElementById('searchFilmMenu').value;
            let value_theLoai = document.getElementById('cbb_category').value;
            let value_quocGia = document.getElementById('cbb_country').value;
            let value_Nam = document.getElementById('cbb_years').value;
            let xhr = new XMLHttpRequest();
            xhr.open('GET', './pages/searchMenuPhim.php?query=' + input + '&theLoai=' + value_theLoai + '&quocGia=' + value_quocGia + '&nam=' + value_Nam + '&page=' + page, true);
        
            xhr.onload = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById('conchimnon').innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }

        document.getElementById('searchFilmMenu').addEventListener('keyup',()=>{
            searchFilm();
        });
        document.getElementById('cbb_category').addEventListener('change',()=>{
            searchFilm();
        });
        document.getElementById('cbb_country').addEventListener('change',()=>{
            searchFilm();
        });
        document.getElementById('cbb_years').addEventListener('change',()=>{
            searchFilm();
        });
document.addEventListener("DOMContentLoaded", function() {
    searchFilm();
});