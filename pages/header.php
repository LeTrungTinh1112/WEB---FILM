<?php
session_start();
?>

<div class="header">
        <div class="container">
            <div class="header__wrap">
                <div class="header__logo">
                    <a href="index.php" class="header__img-logo">
                        <img src="././img/Logo1.png" alt="logo">
                    </a>
                    <a href="index.php" class="header__title">
                        <div class="header__text">
                            <span>Đặt vé  xem phim</span>
                        </div>
                    </a>
                </div>
                <ul class="header__menu">
                    <li><a href="index.php?pages=discount.php">Khuyến mãi</a></li>
                    <li class="header__search">
                        <div id="modalSearch">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                        <ul class="search" id="search">
                            <div class="search_input">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                <input type="text" placeholder="Nhập tên phim" id="searchFilm">
                            </div>
                            <div class="scrollable-content">
                                <h4>Phim đang chiếu</h4>
                                <div class="scrollable-list" id="scrollable_list">                                    
                                </div>
                            </div>
                        </ul>
                    </li>
                    <li>
                        
                        <?php include "TrangThaiDangNhap.php" ?>
                    </li>
                </ul>
                <div class="header__sm">
                    <div class="header__search">
                        <a href="#" id="modalSearchSM">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </a>
                        <ul class="search" id="searchSM">
                            <div class="search_input">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                <input type="text" placeholder="Nhập tên phim">
                            </div>
                            <div class="scrollable-content">
                                <h4>Phim đang chiếu</h4>
                                <!-- ooo -->
                                
                                <div class="scrollable-list">
                                    <!-- <li>
                                        <a href="">
                                            <div class="scrollable-list__img">
                                                <img src="./img/logo.jpg" alt="">
                                            </div>
                                            <div class="scrollable-list__content">
                                                <div class="scrollable-list__name">
                                                    Điềm Báo của Quỷ
                                                </div>
                                                <div class="scrollable-list__type">
                                                    Kinh Dị
                                                </div>
                                                <div class="scrollable-list__icon">
                                                    <div class="scrollable-list__star">
                                                        <i class="fa-solid fa-star"></i>
                                                        <span>5.9</span>
                                                    </div>
                                                    <div class="scrollable-list__signal">
                                                        <img src="./img/signal-streams.svg" alt="">
                                                        <span>Đang chiếu</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li> -->
                                    
                                </div>
                            </div>
                        </ul>
                    </div>
                    <div class="header__bars" id="bars" onclick="openMenu()">
                        <i class="fa-solid fa-bars"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="menu" id="menu">
        <ul class="menu__list">
            <li><a href="#">Review phim</a></li>
            <li><a href="#">Top phim</a></li>
            <li><a href="#">Blog phim</a></li>
            <li><a href="#">Khuyến mãi</a></li>
        </ul>
    </div>