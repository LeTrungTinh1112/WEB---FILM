<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khuyến mãi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/discount.css">
</head>
<body>
    
     <!-- menu  reponsive-->
    <!-- <div class="menu" id="menu">
        <ul class="menu__list">
            <li><a href="#">Review phim</a></li>
            <li><a href="#">Top phim</a></li>
            <li><a href="#">Blog phim</a></li>
            <li><a href="#">Khuyến mãi</a></li>
        </ul>
    </div> -->
    <!-- end menu  -->

    <!-- img-main  -->
    <div class="img-main">
        <div class="img-main__bg">
            <img src="./img/bgmain.jpg" alt="">
        </div>
    </div>
    <!--end img-main  -->
    <?php 
        include_once("./database/connectDatabase.php");
        $conn = new connectDatabase();
        $sql = "SELECT CODE FROM uudai WHERE TRANGTHAI = 1";
        $result = $conn->executeQuery($sql);
        $code = array();
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $code[] = $row['CODE'];
            }
        }
    ?>

    <!-- new friend -->
    <div class="new-friend">
        <div class="container">
            <div class="new-friend__title">
                Nhập MEME9K/MEMEAL9K - Bạn mới MEME nhận vé xem phim chỉ 9K!
            </div>
            <div class="new-friend__contentbg">
                Ưu đãi cực sốc cho khách hàng mới khi lần đầu đăng ký dùng MEME: Thẻ quà xem phim chỉ 9K áp
                dụng tại rạp MEME. Nhanh tay đăng kí, rinh quà xịn, xem phim thả ga!
            </div>
            <div class="new-friend__wrap">
                <div class="new-friend__img">
                    <img src="./img/bgmain.jpg" alt="">
                </div>
                <div class="new-friend__box">
                    <div class="new-friend__item" onclick="openTab(event,'tab1')">
                        <div class="new-friend__icon">
                            <img src="./img/nhapma.svg" alt="">
                        </div>
                        <span>Nhập mã</span>
                        <div class="new-friend__cpy copy-text">
                            <span class="textToCopy" ><?php echo $code[0] ?></span>
                            <i class="fa-regular fa-copy copyIcon" ></i>
                        </div>
                    </div>
                    <div class="new-friend__text">
                        <div class="tab-content new-friend__mr" id="tab1">
                            <br>
                        </div>
                    </div>
                    <div class="new-friend__item" onclick="openTab(event,'tab2')">
                        <div class="new-friend__icon">
                            <img src="./img/nhapma.svg" alt="">
                        </div>
                        <span>Hoặc mã</span>
                        <div class="new-friend__cpy copy-text">
                            <span class="textToCopy"><?php echo $code[1] ?></span>
                            <i class="fa-regular fa-copy copyIcon" ></i>
                        </div>
                    </div>
                    <div class="new-friend__text">
                        <div class="tab-content new-friend__mr" id="tab2">
                            <br>
                        </div>
                    </div>
                    <div class="new-friend__item" onclick="openTab(event,'tab3')">
                        <div class="new-friend__icon">
                            <img src="./img/lienket.svg" alt="code">
                        </div>
                        <span>Liên kết Ngân hàng</span>
                    </div>
                    <div class="new-friend__text">
                        <div class="tab-content new-friend__mr" id="tab3">
                            <div class="new-friend__content">
                                LIÊN KẾT NGAY tài khoản ngân hàng với MoMo
                            </div>
                        </div>
                    </div>
                    <div class="new-friend__item" onclick="openTab(event,'tab4')">
                        <div class="new-friend__icon">
                            <img src="./img/naptien.svg" alt="">
                        </div>
                        <span>Nạp tiền vào MoMo</span>
                    </div>
                    <div class="new-friend__text">
                        <div class="tab-content" id="tab4">
                            <div class="new-friend__content">
                                NẠP TIỀN TỪ 10.000đ
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end new friend -->

    <!-- gift-card -->
    <div class="gift-card">
        <div class="conatiner">
            <div class="gift-card__head">
                <div class="gift-card__title">
                    Thẻ quà vé xem phim
                </div>
            </div>
            <div class="gift-card__wrap">
                <div class="gift-card__box" onclick="openModal()">
                    <div class="gift-card__img">
                        <img src="./img/9000đ.jpg" alt="">
                        <div class="gift-card__bg">
                            <div class="gift-card__seen">
                                Xem chi tiết
                            </div>
                        </div>
                    </div>
                    <div class="gift-card__name">
                        Vé MEME đồng giá 9.000đ
                    </div>
                    <div class="gift-card__btn">
                        <div class="button">
                            Trị giá <span>9.000đ</span>
                        </div>
                    </div>
                </div>
                <div class="gift-card__box" onclick="openModal()">
                    <div class="gift-card__img">
                        <img src="./img/9000đ.jpg" alt="">
                        <div class="gift-card__bg">
                            <div class="gift-card__seen">
                                Xem chi tiết
                            </div>
                        </div>
                    </div>
                    <div class="gift-card__name">
                        Vé MEME đồng giá 9.000đ
                    </div>
                    <div class="gift-card__btn">
                        <div class="button">
                            Trị giá <span>9.000đ</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end gift-card -->

    <!-- modal  -->
    <div class="modal" id="modal">
        <div class="container">
            <div class="modal__box">
                <div class="modal__head">
                    <div class="modal__title">
                        Thông tin chi tiết thẻ quà
                    </div>
                    <div class="modal__icon closeModal" onclick="closeModal()">
                        <i class="fa-solid fa-xmark"></i>
                    </div>
                </div>
                <div class="modal__content">
                    <div class="modal__text-1">
                        <div class="modal__content-title">
                            Vé MEME đồng giá 9.000đ
                        </div>
                        <p class="modal__price">Trị giá: 9.000đ</p>
                        <p class="modal__use">Nơi sử dụng:</p>
                        <p>Mua vé xem phim trực tiếp trên MEME tại các cụm rạp MEME.</p>
                    </div>
                    <ul class="modal__text">
                        <li>Hướng dẫn sử dụng:</li>
                        <li>1. Nhấn nút sử dụng thẻ quà;</li>
                        <li>2. Mở ứng dụng “Mua vé xem phim” trên MEME;</li>
                        <li>3. Chọn rạp MEME>> Chọn suất chiếu;</li>
                        <li>4. Kiểm tra thông tin;</li>
                        <li>5. Chọn thẻ quà tặng >> Ưu đãi được áp dụng;</li>
                        <li>6. Xác nhận thanh toán.</li>
                    </ul>
                    <ul class="modal__text">
                        <li>Điều kiện sử dụng:</li>
                        <li>- Mỗi khách hàng nhận được 1 thẻ quà vé xem phim đồng giá 9.000đ khi mua Vé xem phim trên
                            MEME, áp dụng với các cụm rạp MEME</li>
                        <li>- Thẻ quà giảm giá được sử dụng 1 lần (1 lần/1 số MEME/1 SĐT/1 CMND).</li>
                        <li>- Mỗi thẻ quà chỉ được sử dụng cho 1 lần thanh toán và không hoàn lại giá trị không sử dụng
                            nếu giá trị sử dụng của khách hàng nhỏ hơn mệnh giá thẻ quà.</li>
                        <li>- Không được sử dụng cùng lúc với các loại thẻ quà khác khi thanh toán trên MEME.</li>
                        <li>- Chỉ áp dụng cho vé 2D (Standard, VIP), không áp dụng ghế Sweetbox và các suất chiếu 2D
                            trong phòng chiếu đặc biệt.</li>
                        <li>- Chỉ áp dụng cho giá vé không áp dụng các combo hoặc dịch vụ khác đi kèm.</li>
                        <li>- Không áp dụng Lễ, Tết, suất chiếu sớm, suất chiếu đặc biệt và không áp dụng đồng thời với
                            các chương trình khuyến mãi khác của MEME.</li>
                        <li>- Thẻ quà có hạn sử dụng 30 ngày.</li>
                        <li>- Trong trường hợp xảy ra tranh chấp, quyết định của MEME là quyết định cuối cùng.</li>
                        <li>- Thẻ quà không áp dụng cho ngày Thứ Tư Vui Vẻ của MEME.</li>
                        <li class="italic">(*)Vui lòng xem chi tiết Điều kiện sử dụng tại từng thẻ quà.</li>
                    </ul>
                </div>
                <div class="modal__footer">
                    <div class="modal__btn button button--size closeModal" onclick="closeModal()">
                        ĐÓNG
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end modal  -->

    <!-- rules  -->
    <div class="rules">
        <div class="container">
            <div class="rules__wrap">
                <div class="rules__head">
                    <div class="rules__title">
                        Thể lệ chương trình
                    </div>
                </div>
                <div class="rules__tab">
                    <div class="tab-button rules__name" onclick="openTab(event, 'tab5')">
                        Đối tượng áp dụng
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="rules__box tab-content" id="tab5">
                        <ul class="rules__list">
                            <li>Khách hàng có ứng dụng MoMo trên điện thoại thuộc hệ điều hành Android hoặc iOS.</li>
                            <li>Khách hàng thêm nguồn tiền bằng cách liên kết tài khoản MoMo với ngân hàng có áp dụng
                                chương trình trả thưởng. Xem chi tiết danh sách ngân hàng dưới đây:</li>
                        </ul>
                        <table class="rules__table">
                            <tbody>
                                <tr>
                                    <td>Ngân hàng liên kết có trả thưởng quà từ CTKM</td>
                                    <td>
                                        <ul class="rules__table-list">
                                            <li>Ngân hàng áp dụng trả thưởng khi liên kết qua hình thức trực tiếp với
                                                MoMo: Agribank, ABBank, Bắc Á Bank, BaoViet Bank, Eximbank, Indovina
                                                Bank, MBBank, Nam Á Bank, OCB, OceanBank, Saigon Bank, SCB, SHB,
                                                Shinhan, Techcombank, VIB, VPB, VRB, ngân hàng số Timo, tài khoản thẻ
                                                MSB, tài khoản thẻ Vietcombank.</li>
                                            <li>Đối với khách hàng liên kết MoMo với tài khoản Sacombank, MBB, ABB, ngân
                                                hàng số Timo, OCB, Techcombank (thẻ ghi nợ nội địa & thẻ ghi nợ quốc
                                                tế), Shinhan, VPB, VIB, khách hàng cần thực hiện thêm bước định danh tài
                                                khoản và xác thực khuôn mặt.</li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Ngân hàng liên kết không áp dụng trả thưởng quà từ CTKM</td>
                                    <td>
                                        <ul class="rules__table-list">
                                            <li>Ưu đãi không áp dụng liên kết ngân hàng TPB, Vietinbank, ACB, PVCOM,
                                                VCCB, SeABank, Kienlongbank, tài khoản thanh toán MSB, VCCB, tài khoản
                                                eKYC BIDV (tài khoản đăng ký tạo Online), tài khoản eKYC HDBank (tài
                                                khoản tạo online), tài khoản eKYC Vietcombank (tài khoản tạo online),
                                                tài khoản Internet Banking của Vietcombank.</li>
                                            <li>Ưu đãi không áp dụng khi khách hàng liên kết MoMo qua hình thức liên kết
                                                ngân hàng quốc tế Visa/Master/JCB & thẻ ATM qua cổng Napas, hoặc mở tài
                                                khoản TPBank trên ứng dụng MoMo.</li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-button rules__name" onclick="openTab(event, 'tab6')">
                        Điều kiện tham gia
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="rules__box tab-content" id="tab6">
                        <ul class="rules__list">
                            <li>Tài khoản MoMo phải chưa từng liên kết với tài khoản Ngân hàng nào trước đó.</li>
                            <li>Tài khoản Ngân hàng được liên kết cũng chưa từng liên kết với tài khoản MoMo nào trước
                                đó.</li>
                            <li>Khách hàng chưa từng nạp tiền vào MoMo từ Ngân hàng liên kết, hoặc từ Điểm giao dịch,
                                hoặc từ Thẻ quốc tế (VISA/MASTER/JCB), hoặc từ thẻ ATM qua cổng Napas.</li>
                            <li>Khách hàng chưa từng giao dịch bằng MoMo (ngoại trừ giao dịch nhận tiền từ tài khoản
                                MoMo khác).</li>
                            <li>Khách hàng chưa từng rút tiền từ MoMo.</li>
                            <li>Mỗi khách hàng chỉ được nhận thưởng tối đa 1 lần (1 lần/1 số MoMo/1 CMND/1 tài khoản
                                Ngân hàng/1 thiết bị).</li>
                            <li>Khách hàng chưa từng nhận thưởng từ bất cứ chương trình khuyến mãi nào trước đó của
                                MoMo.</li>
                        </ul>
                    </div>
                    <div class="tab-button rules__name" onclick="openTab(event, 'tab7')">
                        Các bước thực hiện
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="rules__box tab-content" id="tab7">
                        <p>Bạn phải thực hiện đầy đủ theo trình tự 5 bước sau đây để nhận được ưu đãi:</p>
                        <ul class="rules__list">
                            <li>Bước 1: Tải và đăng ký tài khoản MoMo.</li>
                            <li>Bước 2: Nhập mã ‘MOMO9K’ trong ô nhập mã tại mục Ưu đãi.</li>
                            <li>Bước 3: Liên kết tài khoản ngân hàng với MoMo.</li>
                            <li>MoMo có quyền thu hồi các thẻ quà đối với các trường hợp có dấu hiệu gian lận hoặc lợi
                                dụng chương trình khuyến mại để trục lợi.</li>
                            <li>Ngân sách thẻ quà khuyến mại có giới hạn. Thẻ quà ưu đãi có thể sẽ kết thúc sớm hơn khi
                                hết ngân sách sử dụng hoặc đến khi kết thúc chương trình, tùy điều kiện nào đến trước.
                            </li>
                            <li>Bước 4: Nạp tiền vào tài khoản MoMo từ ngân hàng vừa liên kết để xác nhận tài khoản (tối
                                thiểu 10.000đ, riêng ngân hàng Agribank cần nạp tối thiểu 50.000đ).</li>
                            <li>Bước 5: Xác thực tài khoản và xác thực gương mặt theo hướng dẫn.</li>
                        </ul>
                        <p>* Khách hàng cần thực hiện định danh tài khoản, xác thực khuôn mặt & kết quả trùng khớp với
                            các ngân hàng quy định tại phần Đối tượng áp dụng.</p>
                    </div>
                    <div class="tab-button rules__name" onclick="openTab(event, 'tab8')">
                        Quy định về thẻ quà tặng
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="rules__box tab-content" id="tab8">
                        <ul class="rules__list">
                            <li>Các thẻ quà KHÔNG được phép cộng gộp để sử dụng trong một lần thanh toán.</li>
                            <li>Tất cả thẻ quà tặng không được quy đổi thành tiền mặt hoặc Cho/Tặng người khác.</li>
                            <li>Thẻ quà tặng chỉ được sử dụng 1 lần. Trường hợp giá trị thanh toán không sử dụng hết
                                giá
                                trị thẻ quà, MoMo sẽ không hoàn lại tiền chênh lệch.</li>
                            <li>MoMo có quyền thu hồi các thẻ quà đối với các trường hợp có dấu hiệu gian lận hoặc
                                lợi
                                dụng chương trình khuyến mại để trục lợi.</li>
                            <li>Ngân sách thẻ quà khuyến mại có giới hạn. Thẻ quà ưu đãi có thể sẽ kết thúc sớm hơn
                                khi
                                hết ngân sách sử dụng hoặc đến khi kết thúc chương trình, tùy điều kiện nào đến
                                trước.
                            </li>
                            <li>Thẻ quà tặng chỉ áp dụng cho vé xem phim từ 85.000đ</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end rules  -->

  
    <script src="./js/discount.js"></script>
</body>
</html>