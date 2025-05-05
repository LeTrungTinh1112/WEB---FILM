// Xử lý Pop up video trailer
let iconClosePopUp = document.querySelector('#icon-close-popup');
let containerPopUp = document.querySelector('.container-popup');

iconClosePopUp.addEventListener(
    "click",
    (e) => {
        containerPopUp.style.display = 'none';
    },
    false
)

let playIcon = document.querySelector('#play-icon');

playIcon.addEventListener(
    'click',
    (e) => {
        containerPopUp.style.display = 'block';
    },
    false
)

// Xử lý lịch chiếu phim 
const listDays = document.querySelector('.list-days');
const days = document.getElementsByClassName('day');
const btnLeft = document.querySelector('#btn-left');
const btnRight = document.querySelector('#btn-right');
const length = days.length;
let current = 0;

btnLeft.addEventListener(
    'click',
    (e) => {
        if (current == 0) {
            current = length - 1;
            let width = days[0].offsetWidth;
            listDays.style.transform = `translateX(${-width * current}px)`;
        } else {
            current--;
            let width = days[0].offsetWidth;
            listDays.style.transform = `translateX(${-width * current}px)`; 
        }
    }
)

btnRight.addEventListener(
    'click',
    (e) => {
        if(current == length - 1) {
            current = 0;
            let width = days[0].offsetWidth;
            listDays.style.transform = `translateX(0px)`;
        } else {
            current++;
            let width = days[0].offsetWidth;
            listDays.style.transform = `translateX(${width * -1 * current}px)`; 
        }
    }
)

// Xử lý sự kiện click vào ngày chiếu hiển thị giờ chiếu tương ứng
const day = document.querySelectorAll('.day');
const hours = document.querySelectorAll('.hour');
let temp = document.querySelector('.temp');

for(let i = 0; i < day.length; i++) {
    day[i].addEventListener(
        'click',
        (e) => {
            temp.style.display = 'none';
            for(let j = 0; j < hours.length; j++) {
                if(day[i].getAttribute('ngaychieu') == hours[j].getAttribute('ngaychieu')) {
                    hours[j].style.display = 'flex';
                } else {
                    hours[j].style.display = 'none';
                }
            }
        }, 
        false
    );
}

// Xử lý sự kiện đóng menu-chon-ghe
const iconCloseMenuChonGhe = document.querySelector('#icon-close-menu-chon-ghe');
const containerPopupMenuChonGhe = document.querySelector('.container-popup-menu-chon-ghe');

iconCloseMenuChonGhe.addEventListener(
    "click",
    (e) => {
        containerPopupMenuChonGhe.style.display = "none";
    },
    false
)

// Xử lý sự kiện đóng menu-chon-nuoc
const iconCloseMenuChonNuoc = document.querySelector('#icon-close-menu-chon-nuoc');
const containerPopupMenuChonNuoc = document.querySelector('.container-pop-up-menu-chon-nuoc');

iconCloseMenuChonNuoc.addEventListener(
    "click",
    (e) => {
        containerPopupMenuChonNuoc.style.display = "none";
        for( let i = 0; i < soLuongs.length; i++) {
                let soLuongStr = soLuongs[i].textContent.trim();
                let soLuong = isNaN(soLuongStr) ? 0 : parseInt(soLuongStr); 
                soLuong = 0; 

                let tongCongStr = tongCongs.textContent.trim();
                let tongCong = isNaN(tongCongStr) ? 0 : parseInt(tongCongStr);
                tongCong = 0; 
            
                soLuongs[i].textContent = soLuong.toString();
                tongCongs.textContent = tongCong.toString();
        }
        
        containerPopupMenuChonGhe.style.display = "flex";
    },
    false
)

// Xử lý sự kiện mở menu-chon-nuoc
const btnMuaVe = document.querySelector("#btn-mua-ve");

btnMuaVe.addEventListener(
    "click",
    (e) => {
            // Kiểm tra xem ghế có được chọn
            let kiemTra = false;
            let kiemTraGheDons = document.querySelectorAll('.ghe-don div');
            let kiemTraGheDois = document.querySelectorAll('.ghe-doi div');

            kiemTraGheDons.forEach((ghe) => {
                if(ghe.classList.contains('daChon')) {
                    kiemTra = true; 
                    return;
                }
            });

            kiemTraGheDois.forEach((ghe) => {
                if(ghe.classList.contains('daChon')) 
                    kiemTra = true;
                    return;
            });
            if(!kiemTra) {
                alert('Mời bạn chọn phòng và ghế');
            } else {
                containerPopupMenuChonNuoc.style.display = "flex";

                containerPopupMenuChonGhe.style.display = "none";
            }
    },
    false
)

// Xử lý sự kiện mở menu-thanh-toan
const btnTiepTuc = document.querySelector("#tong-tien-bap-nuoc h4");
const containerPopupMenuThanhToan = document.querySelector('.container-pop-up-menu-thanh-toan');

btnTiepTuc.addEventListener(
    "click",
    (e) => {
        containerPopupMenuThanhToan.style.display = "flex";

        containerPopupMenuChonNuoc.style.display = "none";
    },
    false
)

// Xử lý sự kiện đóng menu-thanh-toan
const iconCloseMenuThanhToan = document.querySelector('#icon-close-menu-thanh-toan');

iconCloseMenuThanhToan.addEventListener(
    "click",
    (e) => {
        containerPopupMenuThanhToan.style.display = "none";

        containerPopupMenuChonNuoc.style.display = "flex";
    },
    false
)

// || Xử lý sự kiện lấy dữ liệu cho vé đã mua
let phongChieuThanhToan;
let soGheDaChonThanhToan;
let thoiGianChieuThanhToan;
let ngayChieuThanhToan;
let thucPhamDaChon = [];
let tongCongThucPhamThanhToan;
let bapNuocThanhToan_ThucPham = document.querySelector('#bap-nuoc-thanh-toan_thucpham');

// || Xử lý sự kiện ngày chiếu, thời gian chiếu, phòng chiếu, ghế đã chọn, thực phẩm đã chọn, vé 
// Xử lý sự kiện hiển thị ghế theo mã phòng chiếu bằng async
function showGhe(MAPM, MAPHONGCHIEU, MALICHCHIEU) {
    return new Promise((resolve, reject) => {
        if (MAPHONGCHIEU === "") {
            document.getElementById("row-ghe").innerHTML = "";
            reject("MAPHONGCHIEU is empty");
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    document.getElementById("row-ghe").innerHTML = this.responseText;
                    resolve("Data loaded successfully");
                }
            };
            xmlhttp.open("GET", "./pages/xu-ly-chon-phong.php?MAPM=" + MAPM + "&&MAPHONGCHIEU=" + MAPHONGCHIEU + "&&MALICHCHIEU=" + MALICHCHIEU, true);
            xmlhttp.send();
        }
    });
}   

function kiemTraGheDaBan() {
    return new Promise((resolve) => {
        let gheDon = document.querySelectorAll('.ghe-don div');
        let gheDoi = document.querySelectorAll('.ghe-doi div');
        
    });
}

function clickChonGhe() {
    return new Promise((resolve, reject) => {
        // Xu ly su kien ghe don
        let gheDons = document.querySelectorAll('.ghe-don div');
        let lengthGheDons = gheDons.length;
        let choNgoi = document.getElementById('so-ghe-da-chon');
        let tamTinhs = document.getElementById('tam-tinh');

        gheDons.forEach((ghe) => {
            ghe.addEventListener(
                'click', 
                (e) => {
                    if (!e.target.classList.contains('daMua')) {
                        e.target.classList.toggle('daChon');
                        if (e.target.classList.contains('daChon')) {
                            choNgoi.textContent += e.target.textContent + " ";

                            let giaGheStr = ghe.getAttribute('price').trim();
                            let giaGhe = isNaN(giaGheStr) ? 0 : parseInt(giaGheStr);
                            
                            let tamTinhStr = tamTinhs.textContent.trim();
                            let tamTinh = isNaN(tamTinhStr) ? 0 : parseInt(tamTinhStr);
                            tamTinh += giaGhe; 
                            
                            tamTinhs.textContent = tamTinh.toString();
                        } else {
                            choNgoi.textContent = choNgoi.textContent.replace(e.target.textContent, '');

                            let giaGheStr = ghe.getAttribute('price').trim();
                            let giaGhe = isNaN(giaGheStr) ? 0 : parseInt(giaGheStr);
                            
                            let tamTinhStr = tamTinhs.textContent.trim();
                            let tamTinh = isNaN(tamTinhStr) ? 0 : parseInt(tamTinhStr);
                            tamTinh -= giaGhe; 
                            
                            tamTinhs.textContent = tamTinh.toString();
                        }
                    }
                });
        });

        // Xu ly su kien ghe doi
        let gheDois = document.querySelectorAll('.ghe-doi div');
        let lengthGheDois = gheDois.length;

        gheDois.forEach((ghe) => {
            ghe.addEventListener(
                'click', 
                (e) => {
                    if (!e.target.classList.contains('daMua')) {
                        e.target.classList.toggle('daChon');
                        if (e.target.classList.contains('daChon')) {
                            choNgoi.textContent += e.target.textContent;

                            let giaGheStr = ghe.getAttribute('price').trim();
                            let giaGhe = isNaN(giaGheStr) ? 0 : parseInt(giaGheStr);
                            
                            let tamTinhStr = tamTinhs.textContent.trim();
                            let tamTinh = isNaN(tamTinhStr) ? 0 : parseInt(tamTinhStr);
                            tamTinh += giaGhe; 
                            
                            tamTinhs.textContent = tamTinh.toString();
                        } else {
                            choNgoi.textContent = choNgoi.textContent.replace(e.target.textContent, '');

                            let giaGheStr = ghe.getAttribute('price').trim();
                            let giaGhe = isNaN(giaGheStr) ? 0 : parseInt(giaGheStr);
                            
                            let tamTinhStr = tamTinhs.textContent.trim();
                            let tamTinh = isNaN(tamTinhStr) ? 0 : parseInt(tamTinhStr);
                            tamTinh -= giaGhe; 
                            
                            tamTinhs.textContent = tamTinh.toString();
                        }
                    }
                });
        });
    });
}

const xuLySuKienHienThiGhe = async (MAPM, MAPHONGCHIEU, MALICHCHIEU) => {
    try {
        const showGhePromise = showGhe(MAPM, MAPHONGCHIEU, MALICHCHIEU);
        console.log("showGhe: ", await showGhePromise);
        const clickChonGhePromise = clickChonGhe();
        console.log("clickChonGhe: ", await clickChonGhePromise);
    } catch (error) {
        console.log(error);
    }
}

// Xử lý sự kiện mở menu-chon-ghe
function guiThongTinDenXuLyHienThiPhongChieu(maphim, masuatchieu) {
    return new Promise((resolve, reject) => {
        if (masuatchieu === "") {
            reject("MASUATCHIEU is empty");
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    document.getElementById("chon-phong").innerHTML = this.responseText;
                    console.log(this.responseText);
                    resolve("guiThongTinDenXuLyHienThiPhongChieu successfully");
                }
            };
            xmlhttp.open("GET", "./pages/xu-ly-hien-thi-phong-chieu.php?MAPM=" + maphim + "&&MASC=" + masuatchieu, true);
            xmlhttp.send();
        }
    });
}   

function hienThiMenuChonGhe() {
    return new Promise((resolve, reject) => {
        // Hiển thị giao diện menu chọn ghế
        containerPopupMenuChonGhe.style.display = "flex";
        // Xử lý sự kiện click vào phòng chiếu hiển thị ghế
        const chonPhong = document.querySelectorAll('.phong');
        for(let i = 0; i < chonPhong.length; i++) {
            let MAPM = chonPhong[i].getAttribute('maphim');
            let MAPHONGCHIEU = chonPhong[i].getAttribute('maphongchieu');
            let MALICHCHIEU = chonPhong[i].getAttribute('malichchieu');
           
            chonPhong[i].addEventListener(
                'click',
                () => { 
                    xuLySuKienHienThiGhe(MAPM, MAPHONGCHIEU, MALICHCHIEU);
                    // phongChieuThanhToan = chonPhong[i].getAttribute('tenphong');
                    document.querySelector('#so-ghe-da-chon').textContent = "";
                    document.querySelector('#tam-tinh').textContent = 0;
                    document.querySelector('#hide-ma-lich-chieu').setAttribute(
                        'malichchieu', 
                        chonPhong[i].getAttribute('malichchieu'));
                },
                false
            );
        }
        resolve("Menu displayed successfully");
    });
}   

function hienThiTieuDePhimTrongMenuChonGhe(tenphim, maphim, masuatchieu) {
    return new Promise((resolve, reject) => {
        if (masuatchieu === "") {
            reject("MASUATCHIEU is empty");
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    document.getElementById("tieu-de-phim").innerHTML = this.responseText;
                    resolve("Hien Thi Tieu De Phim successfully");
                }
            };
            xmlhttp.open("GET", "./pages/xu-ly-hien-thi-phong-chieu.php?TENPHIM=" + tenphim + "&&MASC=" + masuatchieu, true);
            xmlhttp.send();
        }
    });
}

const xuLySuKienHienThiMenuChonGhe = async (tenphim, maphim, masuatchieu) => {
    try {
        const guiThongTinDenXuLyHienThiPhongChieuPromise = guiThongTinDenXuLyHienThiPhongChieu(maphim, masuatchieu);
        console.log(await guiThongTinDenXuLyHienThiPhongChieuPromise);

        const hienThiTieuDePhimTrongMenuChonGhePromise = hienThiTieuDePhimTrongMenuChonGhe(tenphim, maphim, masuatchieu);
        console.log(await hienThiTieuDePhimTrongMenuChonGhePromise);

        const hienThiMenuChonGhePromise = hienThiMenuChonGhe();
        console.log(await hienThiMenuChonGhePromise);
    } catch (error) {
        console.log(error);
    }
}

function kiemTraDangNhap(tenphim, maphim, masuatchieu) {
    let xhttp = new XMLHttpRequest();

    // Xác định hàm xử lý sự kiện khi nhận được phản hồi từ máy chủ
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Phản hồi từ máy chủ đã được nhận và xử lý
            var response = JSON.parse(this.responseText);
            thongTinThanhToan.username = response.username;
            if (response.loggedIn) {
                // Nếu session tồn tại, thực hiện các hành động khi đã đăng nhập
                xuLySuKienHienThiMenuChonGhe(tenphim, maphim, masuatchieu);
                console.log('Người dùng đã đăng nhập.');
            } else {
                // Nếu session không tồn tại, thực hiện các hành động khi chưa đăng nhập
                alert('Vui lòng đăng nhập tài khoản!');
                console.log('Người dùng chưa đăng nhập.');
            }
        }
    };

    // Mở một yêu cầu GET đến endpoint kiểm tra session trên máy chủ
    xhttp.open("GET", "./pages/kiem-tra-session.php", true);

    // Bắt đầu gửi yêu cầu
    xhttp.send();
}   
// Xử lý sự kiện click vào thời gian chiếu 
const hour = document.querySelectorAll(".hour");
for(let i = 0; i < hour.length; i++) {
    hour[i].addEventListener(
        "click",
        (e) => {
            kiemTraDangNhap(
                hour[i].getAttribute('tenphim'), 
                hour[i].getAttribute('maphim'), 
                hour[i].getAttribute('masuatchieu'));
            document.querySelector('#row-ghe').innerHTML = '';
        },
        false
    )
}

// || BẮP-NƯỚC
const btnTrus = document.querySelectorAll('.btn-tru');
const btnCongs = document.querySelectorAll('.btn-cong');
let soLuongs = document.querySelectorAll('.so-luong-label');
const giaDichVus = document.querySelectorAll('.gia-dich-vu');
const tongCongs = document.querySelector('#tong-cong');

const tangSoLuong = (event) => {
    for(let i = 0; i < soLuongs.length; i++) {
        if(event.getAttribute('madichvu') == soLuongs[i].getAttribute('madichvu')) {

            let soLuongStr = soLuongs[i].textContent.trim();
            let soLuong = isNaN(soLuongStr) ? 0 : parseInt(soLuongStr); 
            ++soLuong; 
            
            let giaDichVuStr = giaDichVus[i].textContent.trim();
            let giaDichVu = isNaN(giaDichVuStr) ? 0 : parseInt(giaDichVuStr);
            
            let tongCongStr = tongCongs.textContent.trim();
            let tongCong = isNaN(tongCongStr) ? 0 : parseInt(tongCongStr);
            tongCong += giaDichVu; 
            
            soLuongs[i].textContent = soLuong.toString();
            tongCongs.textContent = tongCong.toString();
        }
    }
}

const giamSoLuong = (event) => {
    for(let i = 0; i < soLuongs.length; i++) {
        if(event.getAttribute('madichvu') == soLuongs[i].getAttribute('madichvu')) {
            let soLuongStr = soLuongs[i].textContent.trim(); // Lấy giá trị và loại bỏ khoảng trắng thừa
            let soLuong = isNaN(soLuongStr) ? 0 : parseInt(soLuongStr); // Chuyển đổi thành số, nếu không thành công sẽ trả về 0
            if(soLuong > 0) {
                --soLuong;
            }
            soLuongs[i].textContent = soLuong.toString();

            let giaDichVuStr = giaDichVus[i].textContent.trim();
            let giaDichVu = isNaN(giaDichVuStr) ? 0 : parseInt(giaDichVuStr);
            
            let tongCongStr = tongCongs.textContent.trim();
            let tongCong = isNaN(tongCongStr) ? 0 : parseInt(tongCongStr);

            if(soLuong >= 0 && tongCong > 0) {
                tongCong -= giaDichVu;
            }

            soLuongs[i].textContent = soLuong.toString();
            tongCongs.textContent = tongCong.toString();
        }
    }
}

for(let i = 0; i < btnCongs.length ; i++) {
    btnCongs[i].addEventListener(
        'click',
        () =>  {
            tangSoLuong(btnCongs[i]);
        },
        false
    );

    btnTrus[i].addEventListener(
        'click',
        () => {
            giamSoLuong(btnCongs[i]);
        },
        false
    );
}

// || Thanh Toan

// Dữ liệu JSON bạn muốn gửi
let soLuongDichVuThanhToans = document.querySelectorAll('.so-luong-label');
let jsonData = {};
function showThongTinVeDaMua() {
    return new Promise((resolve, reject) => {
        document.querySelector('#thoi-gian-chieu-thanh-toan_tg').textContent = document.querySelector('#tieu-de-phim time').textContent;
        document.querySelector('#ngay-chieu-thanh-toan_nc').textContent = document.querySelector('#tieu-de-phim date').textContent;
        document.querySelector('#phong-chieu-thanh-toan_pc').textContent = phongChieuThanhToan;
        document.querySelector('#ghe-thanh-toan_ghe').textContent = document.querySelector('#so-ghe-da-chon').textContent;
        document.querySelector('#so-tien-thanh-toan_sotien').textContent = document.querySelector('#tam-tinh').textContent + "đ";

        // Lấy dữ liệu cho dichVuThanhToan
        for(let i = 0; i < soLuongDichVuThanhToans.length; i++) {
            let tendichvu = soLuongDichVuThanhToans[i].getAttribute('tendichvu');
            let price = soLuongDichVuThanhToans[i].getAttribute('price');
            let madichvu = soLuongDichVuThanhToans[i].getAttribute('madichvu');
            let soLuong = soLuongDichVuThanhToans[i].textContent;
        
            // Tạo một cặp khóa / giá trị trong đối tượng jsonData cho mỗi phần tử
            jsonData[tendichvu] = {
                madichvu: madichvu,
                price: price,
                soluong: soLuong
            };
        }
        console.log(jsonData);
    });
}

//  Xử lý thông tin bắp nước đã chọn
const xuLySuKienBapNuocDaChon = (jsonData) => {
    return new Promise((resolve, reject) => {
        if (Object.keys(jsonData).length === 0) {
            reject("Không có dữ liệu JSON");
        } else {
            // Tạo một đối tượng XMLHttpRequest
            const xhr = new XMLHttpRequest();

            // Thiết lập hàm xử lý sự kiện cho sự kiện onreadystatechange
            xhr.onreadystatechange = function() {
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                    // Nhận dữ liệu từ phản hồi và chèn nó vào phần tử HTML
                    document.getElementById("bap-nuoc-thanh-toan_thucpham").innerHTML = this.responseText;
                }
            };

            // Mở yêu cầu với phương thức GET hoặc POST và URL của tệp PHP
            xhr.open('POST', './pages/xu-ly-bap-nuoc-da-chon.php', true);
            xhr.setRequestHeader('Content-Type', 'application/json'); // Thêm dòng này để thông báo server biết dữ liệu gửi đi là JSON
            // Gửi yêu cầu đến máy chủ
            // console.log(JSON.stringify(jsonData));
            xhr.send(JSON.stringify(jsonData));
            resolve();
        }
    });
}

const xuLySoTienSuKienBapNuocDaChon = (jsonData) => {
    return new Promise((resolve, reject) => {
        if (Object.keys(jsonData).length === 0) {
            reject("Không có dữ liệu JSON");
        } else {
            // Tạo một đối tượng XMLHttpRequest
            const xhr = new XMLHttpRequest();

            // Thiết lập hàm xử lý sự kiện cho sự kiện onreadystatechange
            xhr.onreadystatechange = function() {
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                    // Nhận dữ liệu từ phản hồi và chèn nó vào phần tử HTML
                    document.getElementById("so-tien-thanh-toan_sotien-thucpham").innerHTML = this.responseText;
                }
            };

            // Mở yêu cầu với phương thức GET hoặc POST và URL của tệp PHP
            xhr.open('POST', './pages/xu-ly-so-tien-bap-nuoc-da-chon.php', true);
            xhr.setRequestHeader('Content-Type', 'application/json'); // Thêm dòng này để thông báo server biết dữ liệu gửi đi là JSON
            // Gửi yêu cầu đến máy chủ
            // console.log(JSON.stringify(jsonData));
            xhr.send(JSON.stringify(jsonData));
            resolve();
        }
    });
}

const loadDuLieuUuDai = (tongtien) => {
    let xhttp = new XMLHttpRequest();

    // Xác định hàm xử lý sự kiện khi nhận được phản hồi từ máy chủ
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.querySelector('#uu-dai-thanh-toan div').innerHTML = this.responseText;
        }
    };
    // Mở một yêu cầu GET đến endpoint kiểm tra session trên máy chủ
    xhttp.open("POST", "./pages/load-du-lieu-uu-dai.php", true);
    xhttp.setRequestHeader("Content-type", "application/json"); // Đặt header cho yêu cầu

    // Chuyển đổi dữ liệu tổng tiền thành JSON và gửi đi
    xhttp.send(JSON.stringify({ tongtien: tongtien }));
}

const xuLyTongTienThanhToan = () => {
    let tienGhe = document.querySelector('#tam-tinh').textContent.trim();
    let tienBapNuocs = document.querySelectorAll('#so-tien-thanh-toan_sotien-thucpham div');
    let tongTienDaGiam = 0;
    let tongTienBanDau = 0;

    tienGhe = isNaN(tienGhe) ? 0 : parseInt(tienGhe);
    tongTienBanDau += tienGhe;

    tienBapNuocs.forEach(function(item) {
        let price = parseFloat(item.textContent.trim()); // Extract price as a number
        if (!isNaN(price)) { // Check if the extracted value is a number
            tongTienBanDau += price; // Add the price to the total
        }
    });

    document.querySelector('#tong-tien-thanh-toan_tong-tien').textContent = tongTienBanDau.toString()+"đ";
    loadDuLieuUuDai(tongTienBanDau);

    // Thêm sự kiện thay đổi ưu đãi
    // let selectElement = document.querySelector('#phantramuudai');
    // Thêm sự kiện xử lý vé đã giảm
    setTimeout((e) => {
        var selectedOption = document.getElementById('phantramuudai').getAttribute('phantramuudai');
        selectedOption = parseFloat(selectedOption)/100;
        tongTienDaGiam = tongTienBanDau;
        tongTienDaGiam -= (tongTienBanDau * selectedOption);
        console.log(tongTienDaGiam);
        document.querySelector('#tong-tien-thanh-toan_tong-tien').textContent = tongTienDaGiam.toString()+"đ";
    },1000);
}

const xuLySuKienThongTinVeDaMuaAsyn = async () => {
    try {
        showThongTinVeDaMua();
        await xuLySuKienBapNuocDaChon(jsonData);
        await xuLySoTienSuKienBapNuocDaChon(jsonData);
        console.log("xuLySuKienBapNuocDaChon successfully" + jsonData);
        setTimeout(xuLyTongTienThanhToan, 1000);
    } catch (error) {
        console.log(error);
    }
}

let btnTiepTucThanhToan = document.querySelector('#tong-tien-bap-nuoc h4');
btnTiepTucThanhToan.addEventListener(
    'click',
    (e) => {
        xuLySuKienThongTinVeDaMuaAsyn();
    },
    false
)

// || Xử lý thanh toán vé 

let thongTinThanhToan = {
    username:'Trung',
    malichchieu: '',
    maghes: {},
    bapnuocs: jsonData,
    tongtien: 0,
    ngay: '',
    thoigian: '',
    phuongthucthanhtoan: ''
} 

const xuLyLoadDuLieuThanhToanVe = () => {
    let maLichChieu = document.querySelector('#hide-ma-lich-chieu').getAttribute('malichchieu');
    let phuongThucThanhToan = document.querySelector('#phuong-thuc-thanh-toan select').value;
    let tongTienThanhToan = document.querySelector('#tong-tien-thanh-toan_tong-tien').textContent.slice(0, -1);
    tongTienThanhToan = parseFloat(tongTienThanhToan);
    let kiemTraGheDons = document.querySelectorAll('.ghe-don div');
    let kiemTraGheDois = document.querySelectorAll('.ghe-doi div');

    // Lấy ngày và giờ hiện tại
    let timeCurrent = new Date();
    let ngay = `${timeCurrent.getFullYear()}-${timeCurrent.getMonth()}-${timeCurrent.getDay()}`;
    let gio = `${timeCurrent.getHours()}:${timeCurrent.getMinutes()}:${timeCurrent.getSeconds()}`;

    // Truyền dữ liệu vào object thongTinThanhToan
    thongTinThanhToan.malichchieu = maLichChieu;
    thongTinThanhToan.tongtien = tongTienThanhToan;
    thongTinThanhToan.ngay = ngay;
    thongTinThanhToan.thoigian = gio;
    thongTinThanhToan.phuongthucthanhtoan = phuongThucThanhToan;

    kiemTraGheDons.forEach((ghe) => {
        if(ghe.classList.contains('daChon')) {
            thongTinThanhToan.maghes[ghe.getAttribute('maghe')] = ghe.getAttribute('price');
        }
    });

    kiemTraGheDois.forEach((ghe) => {
        if(ghe.classList.contains('daChon')) 
            thongTinThanhToan.maghes[ghe.getAttribute('maghe')] = ghe.getAttribute('price');
    });

}

const xuLyCapNhatVeDaMua = () => {
    return new Promise((resolve, reject) => {
        if (thongTinThanhToan === null || thongTinThanhToan === undefined) {
            // Đối tượng không tồn tại
            reject("Thông tin thanh toán không tồn tại");
        } else {
            // Đối tượng tồn tại
            const xml = new XMLHttpRequest();
            xml.onreadystatechange = () => {
                if(xml.readyState === XMLHttpRequest.DONE && xml.status === 200) {
                    console.log(JSON.stringify(thongTinThanhToan));
                    console.log(xml.responseText);
                    resolve("Thanh toán thành công");
                }
            };
            xml.open("POST", "./pages/xu-ly-cap-nhat-ve-da-mua.php", true);
            xml.setRequestHeader('Content-Type', 'application/json');
            xml.send(JSON.stringify(thongTinThanhToan));
        }
    });
}

const thucHienThanhToanVe = async () => {
    xuLyLoadDuLieuThanhToanVe();
    console.log(await xuLyCapNhatVeDaMua());
    alert("Thanh toán thành công!");
    location.reload();
}

let btnThanhToan = document.querySelector('#thanh-toan h4');
btnThanhToan.addEventListener(
    'click',
    (e) => {
        setTimeout(thucHienThanhToanVe, 1000);
    },
    false
)