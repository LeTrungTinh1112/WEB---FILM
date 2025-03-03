-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 29, 2024 lúc 05:36 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `cinema`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietphim_dienvien`
--

CREATE TABLE `chitietphim_dienvien` (
  `MAPM` varchar(10) NOT NULL,
  `MADV` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietphim_dienvien`
--

INSERT INTO `chitietphim_dienvien` (`MAPM`, `MADV`) VALUES
('PM001', 'PM001DV1'),
('PM001', 'PM001DV2'),
('PM002', 'PM002DV1'),
('PM002', 'PM002DV2'),
('PM002', 'PM002DV3'),
('PM003', 'PM003DV1'),
('PM003', 'PM003DV2'),
('PM004', 'PM004DV1'),
('PM004', 'PM004DV2'),
('PM004', 'PM004DV3'),
('PM004', 'PM004DV4'),
('PM005', 'PM005DV1'),
('PM005', 'PM005DV2'),
('PM006', 'PM006DV1'),
('PM006', 'PM006DV2'),
('PM006', 'PM006DV3'),
('PM007', 'PM007DV1'),
('PM007', 'PM007DV2'),
('PM007', 'PM007DV3'),
('PM008', 'PM008DV1'),
('PM009', 'PM009DV1'),
('PM009', 'PM009DV2'),
('PM010', 'PM010DV1'),
('PM010', 'PM010DV2'),
('PM011', 'PM011DV1'),
('PM011', 'PM011DV2'),
('PM012', 'PM012DV1'),
('PM012', 'PM012DV2'),
('PM013', 'PM013DV1'),
('PM013', 'PM013DV2'),
('PM014', 'PM014DV1'),
('PM014', 'PM014DV2'),
('PM015', 'PM015DV1'),
('PM015', 'PM015DV2'),
('PM016', 'PM016DV1'),
('PM016', 'PM016DV2'),
('PM017', 'PM017DV1'),
('PM017', 'PM017DV2'),
('PM018', 'PM018DV1'),
('PM018', 'PM018DV2'),
('PM018', 'PM018DV3');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietphim_theloai`
--

CREATE TABLE `chitietphim_theloai` (
  `MAPM` varchar(10) NOT NULL,
  `MATHELOAI` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietphim_theloai`
--

INSERT INTO `chitietphim_theloai` (`MAPM`, `MATHELOAI`) VALUES
('PM001', 'TL9'),
('PM002', 'TL5'),
('PM003', 'TL1'),
('PM003', 'TL7'),
('PM003', 'TL8'),
('PM004', 'TL2'),
('PM004', 'TL4'),
('PM004', 'TL7'),
('PM005', 'TL1'),
('PM005', 'TL2'),
('PM005', 'TL7'),
('PM006', 'TL6'),
('PM007', 'TL3'),
('PM007', 'TL5'),
('PM008', 'TL1'),
('PM008', 'TL6'),
('PM009', 'TL8'),
('PM009', 'TL9'),
('PM010', 'TL1'),
('PM010', 'TL2'),
('PM010', 'TL7'),
('PM011', 'TL1'),
('PM011', 'TL6'),
('PM011', 'TL7'),
('PM012', 'TL4'),
('PM012', 'TL9'),
('PM013', 'TL4'),
('PM013', 'TL5'),
('PM014', 'TL4'),
('PM014', 'TL7'),
('PM015', 'TL1'),
('PM015', 'TL7'),
('PM016', 'TL1'),
('PM016', 'TL4'),
('PM016', 'TL6'),
('PM017', 'TL4'),
('PM017', 'TL8'),
('PM018', 'TL6'),
('PM018', 'TL9');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietquyen_chucnang`
--

CREATE TABLE `chitietquyen_chucnang` (
  `MAQUYEN` varchar(10) NOT NULL,
  `MACHUCNANG` varchar(10) NOT NULL,
  `HANHDONG` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietquyen_chucnang`
--

INSERT INTO `chitietquyen_chucnang` (`MAQUYEN`, `MACHUCNANG`, `HANHDONG`) VALUES
('QAD', 'TK', 'Sửa'),
('QAD', 'TK', 'Thêm'),
('QAD', 'TK', 'Xem'),
('QAD', 'TK', 'Xóa'),
('QKH', 'DV', 'Xem'),
('QKH', 'LCP', 'Xem'),
('QKH', 'PC', 'Xem'),
('QKH', 'PM', 'Xem'),
('QKH', 'TK', 'Xem'),
('QKH', 'UUDAI', 'Xem'),
('QQL', 'DV', 'Sửa'),
('QQL', 'DV', 'Xem'),
('QQL', 'DV', 'Xóa'),
('QQL', 'LCP', 'Sửa'),
('QQL', 'LCP', 'Thêm'),
('QQL', 'LCP', 'Xem'),
('QQL', 'LCP', 'Xóa'),
('QQL', 'PC', 'Sửa'),
('QQL', 'PC', 'Xem'),
('QQL', 'PM', 'Sửa'),
('QQL', 'PM', 'Thêm'),
('QQL', 'PM', 'Xem'),
('QQL', 'PM', 'Xóa'),
('QQL', 'PQ', 'Sửa'),
('QQL', 'PQ', 'Thêm'),
('QQL', 'PQ', 'Xem'),
('QQL', 'PQ', 'Xóa'),
('QQL', 'TK', 'Sửa'),
('QQL', 'TK', 'Xem'),
('QQL', 'TK', 'Xóa'),
('QQL', 'UUDAI', 'Thêm'),
('QQL', 'UUDAI', 'Xem'),
('QQL', 'UUDAI', 'Xóa');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietthongke`
--

CREATE TABLE `chitietthongke` (
  `NGAY` date NOT NULL,
  `MAPM` varchar(10) NOT NULL,
  `TONGDOANHTHU` int(11) DEFAULT NULL,
  `TONGVE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietthongke`
--

INSERT INTO `chitietthongke` (`NGAY`, `MAPM`, `TONGDOANHTHU`, `TONGVE`) VALUES
('2024-04-13', 'PM001', 100000, 1),
('2024-04-13', 'PM002', 1200000, 12),
('2024-04-13', 'PM004', 1900000, 19),
('2024-04-13', 'PM011', 3000000, 30),
('2024-04-13', 'PM013', 2000000, 20),
('2024-04-14', 'PM001', 400000, 4),
('2024-04-14', 'PM003', 1900000, 19),
('2024-04-14', 'PM006', 1400000, 14),
('2024-04-14', 'PM009', 2500000, 25),
('2024-04-14', 'PM011', 600000, 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietve_dichvu`
--

CREATE TABLE `chitietve_dichvu` (
  `MAVE` varchar(10) NOT NULL,
  `MADICHVU` varchar(10) NOT NULL,
  `SoLuong` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietve_dichvu`
--

INSERT INTO `chitietve_dichvu` (`MAVE`, `MADICHVU`, `SoLuong`) VALUES
('MV0008', 'MDV001', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietve_ghe`
--

CREATE TABLE `chitietve_ghe` (
  `MAVE` varchar(10) NOT NULL,
  `MAGHE` varchar(10) NOT NULL,
  `PRICE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietve_ghe`
--

INSERT INTO `chitietve_ghe` (`MAVE`, `MAGHE`, `PRICE`) VALUES
('MV0001', 'PC1A1', 100000),
('MV0002', 'PC1D5', 100000),
('MV0003', 'PC2C4', 100000),
('MV0004', 'PC2B2', 100000),
('MV0005', 'PC3A6', 100000),
('MV0006', 'PC3A8', 100000),
('MV0007', 'PC4E2', 100000),
('MV0008', 'PC3A1', 100000),
('MV0008', 'PC3A2', 100000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chucnang`
--

CREATE TABLE `chucnang` (
  `MACHUCNANG` varchar(10) NOT NULL,
  `TENCHUCNANG` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chucnang`
--

INSERT INTO `chucnang` (`MACHUCNANG`, `TENCHUCNANG`) VALUES
('DV', 'Dịch vụ'),
('LCP', 'Lịch chiếu phim'),
('PC', 'Phòng chiếu'),
('PM', 'Phim'),
('PQ', 'Phân quyền'),
('TK', 'Tài khoản'),
('UUDAI', 'Ưu đãi'),
('DIENVIEN','Diễn viên'),
('GHE','Ghế'),
('LG','Loại ghế'),
('NGAYLE','Ngày lễ'),
('SUATCHIEU','Suất chiếu'),
('THELOAI','Thể loại');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dichvu`
--

CREATE TABLE `dichvu` (
  `MADICHVU` varchar(10) NOT NULL,
  `TENDICHVU` varchar(255) DEFAULT NULL,
  `NAMEANH` varchar(255) DEFAULT NULL,
  `MOTA` varchar(255) DEFAULT NULL,
  `PRICE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `dichvu`
--

INSERT INTO `dichvu` (`MADICHVU`, `TENDICHVU`, `NAMEANH`, `MOTA`, `PRICE`) VALUES
('MDV001', 'Nước CoCa', 'cocacola.jpg', '1 lon nước có gas', 20000),
('MDV002', 'Nước Fanta Cam', 'fantacam.jpg', '1 lon nước có gas', 20000),
('MDV003', 'Nước Pepsi', 'pepsi.jpg', '1 lon nước có gas', 20000),
('MDV004', 'Nước Suối', 'nuocsuoi.jpg', '1 chai nước tinh khiết', 15000),
('MDV005', 'Bắp Phô Mai', 'bapphomai.jpg', '1 bắp phô mai', 35000),
('MDV006', 'Bắp Nguyên Bản', 'bapnguyenban.jpg', '1 bắp nguyên bản', 35000),
('MDV007', 'Combo 2 nước + 1 bắp', 'combo2nuoc1bap.jpg', 'TIẾT KIỆM 15K!!! Gồm: 2 nước có gas + 1 bắp', 60000),
('MDV008', 'Combo 2 bắp 1 nước', 'combo2bap1nuoc.jpg', 'TIẾT KIỆM 15K!!! Gồm: 2 bắp + 1 nước có gas', 70000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dienvien`
--

CREATE TABLE `dienvien` (
  `MADV` varchar(10) NOT NULL,
  `TENDV` varchar(255) DEFAULT NULL,
  `NAMEANH` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `dienvien`
--

INSERT INTO `dienvien` (`MADV`, `TENDV`, `NAMEANH`) VALUES
('PM001DV1', 'Greg Hsu', 'greghsu.jpg'),
('PM001DV2', 'Kaya Kiyohara', 'kayakiyohara.jpg'),
('PM002DV1', 'Nell Tiger Free', 'nell.jpg'),
('PM002DV2', 'Tawfeek Barhom', 'tawfeek.jpg'),
('PM002DV3', 'Sônia Braga', 'sonia.jpg'),
('PM003DV1', 'Kirsten Dunst', 'kirsten.jpg'),
('PM003DV2', 'Wagner Moura', 'wagner.jpg'),
('PM004DV1', 'Paul Rudd', 'paul.jpg'),
('PM004DV2', 'Carrie Coon', 'carrie.jpg'),
('PM004DV3', 'Finn Wolfhard', 'finn.jpg'),
('PM004DV4', 'Mckenna Grace', 'mckenna.jpg'),
('PM005DV1', 'Rebecca Hall', 'rebecca.jpg'),
('PM005DV2', 'Brian Tyree Henry', 'brian.jpg'),
('PM006DV1', 'Park Ji-yeon', 'parkjiyeon.jpg'),
('PM006DV2', 'Song Ji-eun', 'songjieun.jpg'),
('PM006DV3', 'Kim Nu-ri', 'kimnuri.jpg'),
('PM007DV1', 'DeWanda Wise', 'dewanda.jpg'),
('PM007DV2', 'Taegen Burns', 'taegen.jpg'),
('PM007DV3', 'Pyper Braun', 'pyper.jpg'),
('PM008DV1', 'Dev Patel', 'dev.jpg'),
('PM009DV1', 'Benoît Magimel', 'benoit.jpg'),
('PM009DV2', 'Juliette Binoche', 'juliette.jpg'),
('PM010DV1', 'Timothée Chalamet', 'timo.jpg'),
('PM010DV2', 'Zendaya', 'zendaya.jpg'),
('PM011DV1', 'Anya Taylor-Joy', 'anya.jpg'),
('PM011DV2', 'Chris Hemsworth', 'chris.jpg'),
('PM012DV1', 'Thanh Hiền', 'thanhhiien.jpg'),
('PM012DV2', 'Đinh Y Nhung', 'dinhynhung.jpg'),
('PM013DV1', 'Phiravich Attachitsataporn', 'phiravich.jpg'),
('PM013DV2', 'Witthawat Rattanaboonbaramee', 'witthawat.jpg'),
('PM014DV1', 'Chris Pratt', 'pratt.jpg'),
('PM014DV2', 'Samuel L. Jackson', 'samuel.jpg'),
('PM015DV1', 'Owen Teague', 'owen.jpg'),
('PM015DV2', 'Freya Allan', 'freya.jpg'),
('PM016DV1', 'Ryan Gosling', 'ryan.jpg'),
('PM016DV2', 'Emily Blunt', 'emily.jpg'),
('PM017DV1', 'Amy Poehler', 'amy.jpg'),
('PM017DV2', 'Phyllis Smith', 'phyllis.jpg'),
('PM018DV1', 'Thái Hòa', 'thaihoa.jpg'),
('PM018DV2', 'Xuân Lan', 'xuanlan.jpg'),
('PM018DV3', 'Uyển Ân', 'uyenan.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ghe`
--

CREATE TABLE `ghe` (
  `MAPHONGCHIEU` varchar(10) DEFAULT NULL,
  `MALOAIGHE` varchar(10) DEFAULT NULL,
  `STT` int(11) DEFAULT NULL,
  `HANGGHE` char(1) DEFAULT NULL,
  `TRANGTHAI` tinyint(4) DEFAULT NULL,
  `MAGHE` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `ghe`
--

INSERT INTO `ghe` (`MAPHONGCHIEU`, `MALOAIGHE`, `STT`, `HANGGHE`, `TRANGTHAI`, `MAGHE`) VALUES
('PC1', 'STD', 1, 'A', 1, 'PC1A1'),
('PC1', 'STD', 10, 'A', 1, 'PC1A10'),
('PC1', 'STD', 2, 'A', 1, 'PC1A2'),
('PC1', 'STD', 3, 'A', 1, 'PC1A3'),
('PC1', 'STD', 4, 'A', 1, 'PC1A4'),
('PC1', 'STD', 5, 'A', 1, 'PC1A5'),
('PC1', 'STD', 6, 'A', 1, 'PC1A6'),
('PC1', 'STD', 7, 'A', 1, 'PC1A7'),
('PC1', 'STD', 8, 'A', 1, 'PC1A8'),
('PC1', 'STD', 9, 'A', 1, 'PC1A9'),
('PC1', 'STD', 11, 'B', 1, 'PC1B1'),
('PC1', 'STD', 20, 'B', 1, 'PC1B10'),
('PC1', 'STD', 12, 'B', 1, 'PC1B2'),
('PC1', 'STD', 13, 'B', 1, 'PC1B3'),
('PC1', 'STD', 14, 'B', 1, 'PC1B4'),
('PC1', 'STD', 15, 'B', 1, 'PC1B5'),
('PC1', 'STD', 16, 'B', 1, 'PC1B6'),
('PC1', 'STD', 17, 'B', 1, 'PC1B7'),
('PC1', 'STD', 18, 'B', 1, 'PC1B8'),
('PC1', 'STD', 19, 'B', 1, 'PC1B9'),
('PC1', 'STD', 21, 'C', 1, 'PC1C1'),
('PC1', 'STD', 30, 'C', 1, 'PC1C10'),
('PC1', 'STD', 22, 'C', 1, 'PC1C2'),
('PC1', 'STD', 23, 'C', 1, 'PC1C3'),
('PC1', 'STD', 24, 'C', 1, 'PC1C4'),
('PC1', 'STD', 25, 'C', 1, 'PC1C5'),
('PC1', 'STD', 26, 'C', 1, 'PC1C6'),
('PC1', 'STD', 27, 'C', 1, 'PC1C7'),
('PC1', 'STD', 28, 'C', 1, 'PC1C8'),
('PC1', 'STD', 29, 'C', 1, 'PC1C9'),
('PC1', 'BIZ', 31, 'D', 1, 'PC1D1'),
('PC1', 'BIZ', 40, 'D', 1, 'PC1D10'),
('PC1', 'BIZ', 32, 'D', 1, 'PC1D2'),
('PC1', 'BIZ', 33, 'D', 1, 'PC1D3'),
('PC1', 'BIZ', 34, 'D', 1, 'PC1D4'),
('PC1', 'BIZ', 35, 'D', 1, 'PC1D5'),
('PC1', 'BIZ', 36, 'D', 1, 'PC1D6'),
('PC1', 'BIZ', 37, 'D', 1, 'PC1D7'),
('PC1', 'BIZ', 38, 'D', 1, 'PC1D8'),
('PC1', 'BIZ', 39, 'D', 1, 'PC1D9'),
('PC1', 'BIZ', 41, 'E', 1, 'PC1E1'),
('PC1', 'BIZ', 50, 'E', 1, 'PC1E10'),
('PC1', 'BIZ', 42, 'E', 1, 'PC1E2'),
('PC1', 'BIZ', 43, 'E', 1, 'PC1E3'),
('PC1', 'BIZ', 44, 'E', 1, 'PC1E4'),
('PC1', 'BIZ', 45, 'E', 1, 'PC1E5'),
('PC1', 'BIZ', 46, 'E', 1, 'PC1E6'),
('PC1', 'BIZ', 47, 'E', 1, 'PC1E7'),
('PC1', 'BIZ', 48, 'E', 1, 'PC1E8'),
('PC1', 'BIZ', 49, 'E', 1, 'PC1E9'),
('PC1', 'BIZ', 51, 'F', 1, 'PC1F1'),
('PC1', 'BIZ', 60, 'F', 1, 'PC1F10'),
('PC1', 'BIZ', 52, 'F', 1, 'PC1F2'),
('PC1', 'BIZ', 53, 'F', 1, 'PC1F3'),
('PC1', 'BIZ', 54, 'F', 1, 'PC1F4'),
('PC1', 'BIZ', 55, 'F', 1, 'PC1F5'),
('PC1', 'BIZ', 56, 'F', 1, 'PC1F6'),
('PC1', 'BIZ', 57, 'F', 1, 'PC1F7'),
('PC1', 'BIZ', 58, 'F', 1, 'PC1F8'),
('PC1', 'BIZ', 59, 'F', 1, 'PC1F9'),
('PC1', 'DOI', 61, 'G', 1, 'PC1G1'),
('PC1', 'DOI', 62, 'G', 1, 'PC1G2'),
('PC1', 'DOI', 63, 'G', 1, 'PC1G3'),
('PC1', 'DOI', 64, 'G', 1, 'PC1G4'),
('PC1', 'DOI', 65, 'G', 1, 'PC1G5'),
('PC2', 'STD', 66, 'A', 1, 'PC2A1'),
('PC2', 'STD', 75, 'A', 1, 'PC2A10'),
('PC2', 'STD', 67, 'A', 1, 'PC2A2'),
('PC2', 'STD', 68, 'A', 1, 'PC2A3'),
('PC2', 'STD', 69, 'A', 1, 'PC2A4'),
('PC2', 'STD', 70, 'A', 1, 'PC2A5'),
('PC2', 'STD', 71, 'A', 1, 'PC2A6'),
('PC2', 'STD', 72, 'A', 1, 'PC2A7'),
('PC2', 'STD', 73, 'A', 1, 'PC2A8'),
('PC2', 'STD', 74, 'A', 1, 'PC2A9'),
('PC2', 'STD', 76, 'B', 1, 'PC2B1'),
('PC2', 'STD', 85, 'B', 1, 'PC2B10'),
('PC2', 'STD', 77, 'B', 1, 'PC2B2'),
('PC2', 'STD', 78, 'B', 1, 'PC2B3'),
('PC2', 'STD', 79, 'B', 1, 'PC2B4'),
('PC2', 'STD', 80, 'B', 1, 'PC2B5'),
('PC2', 'STD', 81, 'B', 1, 'PC2B6'),
('PC2', 'STD', 82, 'B', 1, 'PC2B7'),
('PC2', 'STD', 83, 'B', 1, 'PC2B8'),
('PC2', 'STD', 84, 'B', 1, 'PC2B9'),
('PC2', 'STD', 86, 'C', 1, 'PC2C1'),
('PC2', 'STD', 95, 'C', 1, 'PC2C10'),
('PC2', 'STD', 87, 'C', 1, 'PC2C2'),
('PC2', 'STD', 88, 'C', 1, 'PC2C3'),
('PC2', 'STD', 89, 'C', 1, 'PC2C4'),
('PC2', 'STD', 90, 'C', 1, 'PC2C5'),
('PC2', 'STD', 91, 'C', 1, 'PC2C6'),
('PC2', 'STD', 92, 'C', 1, 'PC2C7'),
('PC2', 'STD', 93, 'C', 1, 'PC2C8'),
('PC2', 'STD', 94, 'C', 1, 'PC2C9'),
('PC2', 'BIZ', 96, 'D', 1, 'PC2D1'),
('PC2', 'BIZ', 105, 'D', 1, 'PC2D10'),
('PC2', 'BIZ', 97, 'D', 1, 'PC2D2'),
('PC2', 'BIZ', 98, 'D', 1, 'PC2D3'),
('PC2', 'BIZ', 99, 'D', 1, 'PC2D4'),
('PC2', 'BIZ', 100, 'D', 1, 'PC2D5'),
('PC2', 'BIZ', 101, 'D', 1, 'PC2D6'),
('PC2', 'BIZ', 102, 'D', 1, 'PC2D7'),
('PC2', 'BIZ', 103, 'D', 1, 'PC2D8'),
('PC2', 'BIZ', 104, 'D', 1, 'PC2D9'),
('PC2', 'BIZ', 106, 'E', 1, 'PC2E1'),
('PC2', 'BIZ', 115, 'E', 1, 'PC2E10'),
('PC2', 'BIZ', 107, 'E', 1, 'PC2E2'),
('PC2', 'BIZ', 108, 'E', 1, 'PC2E3'),
('PC2', 'BIZ', 109, 'E', 1, 'PC2E4'),
('PC2', 'BIZ', 110, 'E', 1, 'PC2E5'),
('PC2', 'BIZ', 111, 'E', 1, 'PC2E6'),
('PC2', 'BIZ', 112, 'E', 1, 'PC2E7'),
('PC2', 'BIZ', 113, 'E', 1, 'PC2E8'),
('PC2', 'BIZ', 114, 'E', 1, 'PC2E9'),
('PC2', 'BIZ', 116, 'F', 1, 'PC2F1'),
('PC2', 'BIZ', 125, 'F', 1, 'PC2F10'),
('PC2', 'BIZ', 117, 'F', 1, 'PC2F2'),
('PC2', 'BIZ', 118, 'F', 1, 'PC2F3'),
('PC2', 'BIZ', 119, 'F', 1, 'PC2F4'),
('PC2', 'BIZ', 120, 'F', 1, 'PC2F5'),
('PC2', 'BIZ', 121, 'F', 1, 'PC2F6'),
('PC2', 'BIZ', 122, 'F', 1, 'PC2F7'),
('PC2', 'BIZ', 123, 'F', 1, 'PC2F8'),
('PC2', 'BIZ', 124, 'F', 1, 'PC2F9'),
('PC2', 'DOI', 126, 'G', 1, 'PC2G1'),
('PC2', 'DOI', 127, 'G', 1, 'PC2G2'),
('PC2', 'DOI', 128, 'G', 1, 'PC2G3'),
('PC2', 'DOI', 129, 'G', 1, 'PC2G4'),
('PC2', 'DOI', 130, 'G', 1, 'PC2G5'),
('PC3', 'STD', 131, 'A', 1, 'PC3A1'),
('PC3', 'STD', 140, 'A', 1, 'PC3A10'),
('PC3', 'STD', 132, 'A', 1, 'PC3A2'),
('PC3', 'STD', 133, 'A', 1, 'PC3A3'),
('PC3', 'STD', 134, 'A', 1, 'PC3A4'),
('PC3', 'STD', 135, 'A', 1, 'PC3A5'),
('PC3', 'STD', 136, 'A', 1, 'PC3A6'),
('PC3', 'STD', 137, 'A', 1, 'PC3A7'),
('PC3', 'STD', 138, 'A', 1, 'PC3A8'),
('PC3', 'STD', 139, 'A', 1, 'PC3A9'),
('PC3', 'STD', 141, 'B', 1, 'PC3B1'),
('PC3', 'STD', 150, 'B', 1, 'PC3B10'),
('PC3', 'STD', 142, 'B', 1, 'PC3B2'),
('PC3', 'STD', 143, 'B', 1, 'PC3B3'),
('PC3', 'STD', 144, 'B', 1, 'PC3B4'),
('PC3', 'STD', 145, 'B', 1, 'PC3B5'),
('PC3', 'STD', 146, 'B', 1, 'PC3B6'),
('PC3', 'STD', 147, 'B', 1, 'PC3B7'),
('PC3', 'STD', 148, 'B', 1, 'PC3B8'),
('PC3', 'STD', 149, 'B', 1, 'PC3B9'),
('PC3', 'STD', 151, 'C', 1, 'PC3C1'),
('PC3', 'STD', 160, 'C', 1, 'PC3C10'),
('PC3', 'STD', 152, 'C', 1, 'PC3C2'),
('PC3', 'STD', 153, 'C', 1, 'PC3C3'),
('PC3', 'STD', 154, 'C', 1, 'PC3C4'),
('PC3', 'STD', 155, 'C', 1, 'PC3C5'),
('PC3', 'STD', 156, 'C', 1, 'PC3C6'),
('PC3', 'STD', 157, 'C', 1, 'PC3C7'),
('PC3', 'STD', 158, 'C', 1, 'PC3C8'),
('PC3', 'STD', 159, 'C', 1, 'PC3C9'),
('PC3', 'BIZ', 161, 'D', 1, 'PC3D1'),
('PC3', 'BIZ', 170, 'D', 1, 'PC3D10'),
('PC3', 'BIZ', 162, 'D', 1, 'PC3D2'),
('PC3', 'BIZ', 163, 'D', 1, 'PC3D3'),
('PC3', 'BIZ', 164, 'D', 1, 'PC3D4'),
('PC3', 'BIZ', 165, 'D', 1, 'PC3D5'),
('PC3', 'BIZ', 166, 'D', 1, 'PC3D6'),
('PC3', 'BIZ', 167, 'D', 1, 'PC3D7'),
('PC3', 'BIZ', 168, 'D', 1, 'PC3D8'),
('PC3', 'BIZ', 169, 'D', 1, 'PC3D9'),
('PC3', 'BIZ', 171, 'E', 1, 'PC3E1'),
('PC3', 'BIZ', 180, 'E', 1, 'PC3E10'),
('PC3', 'BIZ', 172, 'E', 1, 'PC3E2'),
('PC3', 'BIZ', 173, 'E', 1, 'PC3E3'),
('PC3', 'BIZ', 174, 'E', 1, 'PC3E4'),
('PC3', 'BIZ', 175, 'E', 1, 'PC3E5'),
('PC3', 'BIZ', 176, 'E', 1, 'PC3E6'),
('PC3', 'BIZ', 177, 'E', 1, 'PC3E7'),
('PC3', 'BIZ', 178, 'E', 1, 'PC3E8'),
('PC3', 'BIZ', 179, 'E', 1, 'PC3E9'),
('PC3', 'BIZ', 181, 'F', 1, 'PC3F1'),
('PC3', 'BIZ', 190, 'F', 1, 'PC3F10'),
('PC3', 'BIZ', 182, 'F', 1, 'PC3F2'),
('PC3', 'BIZ', 183, 'F', 1, 'PC3F3'),
('PC3', 'BIZ', 184, 'F', 1, 'PC3F4'),
('PC3', 'BIZ', 185, 'F', 1, 'PC3F5'),
('PC3', 'BIZ', 186, 'F', 1, 'PC3F6'),
('PC3', 'BIZ', 187, 'F', 1, 'PC3F7'),
('PC3', 'BIZ', 188, 'F', 1, 'PC3F8'),
('PC3', 'BIZ', 189, 'F', 1, 'PC3F9'),
('PC3', 'DOI', 191, 'G', 1, 'PC3G1'),
('PC3', 'DOI', 192, 'G', 1, 'PC3G2'),
('PC3', 'DOI', 193, 'G', 1, 'PC3G3'),
('PC3', 'DOI', 194, 'G', 1, 'PC3G4'),
('PC3', 'DOI', 195, 'G', 1, 'PC3G5'),
('PC4', 'STD', 196, 'A', 1, 'PC4A1'),
('PC4', 'STD', 205, 'A', 1, 'PC4A10'),
('PC4', 'STD', 197, 'A', 1, 'PC4A2'),
('PC4', 'STD', 198, 'A', 1, 'PC4A3'),
('PC4', 'STD', 199, 'A', 1, 'PC4A4'),
('PC4', 'STD', 200, 'A', 1, 'PC4A5'),
('PC4', 'STD', 201, 'A', 1, 'PC4A6'),
('PC4', 'STD', 202, 'A', 1, 'PC4A7'),
('PC4', 'STD', 203, 'A', 1, 'PC4A8'),
('PC4', 'STD', 204, 'A', 1, 'PC4A9'),
('PC4', 'STD', 206, 'B', 1, 'PC4B1'),
('PC4', 'STD', 215, 'B', 1, 'PC4B10'),
('PC4', 'STD', 207, 'B', 1, 'PC4B2'),
('PC4', 'STD', 208, 'B', 1, 'PC4B3'),
('PC4', 'STD', 209, 'B', 1, 'PC4B4'),
('PC4', 'STD', 210, 'B', 1, 'PC4B5'),
('PC4', 'STD', 211, 'B', 1, 'PC4B6'),
('PC4', 'STD', 212, 'B', 1, 'PC4B7'),
('PC4', 'STD', 213, 'B', 1, 'PC4B8'),
('PC4', 'STD', 214, 'B', 1, 'PC4B9'),
('PC4', 'STD', 216, 'C', 1, 'PC4C1'),
('PC4', 'STD', 225, 'C', 1, 'PC4C10'),
('PC4', 'STD', 217, 'C', 1, 'PC4C2'),
('PC4', 'STD', 218, 'C', 1, 'PC4C3'),
('PC4', 'STD', 219, 'C', 1, 'PC4C4'),
('PC4', 'STD', 220, 'C', 1, 'PC4C5'),
('PC4', 'STD', 221, 'C', 1, 'PC4C6'),
('PC4', 'STD', 222, 'C', 1, 'PC4C7'),
('PC4', 'STD', 223, 'C', 1, 'PC4C8'),
('PC4', 'STD', 224, 'C', 1, 'PC4C9'),
('PC4', 'BIZ', 226, 'D', 1, 'PC4D1'),
('PC4', 'BIZ', 235, 'D', 1, 'PC4D10'),
('PC4', 'BIZ', 227, 'D', 1, 'PC4D2'),
('PC4', 'BIZ', 228, 'D', 1, 'PC4D3'),
('PC4', 'BIZ', 229, 'D', 1, 'PC4D4'),
('PC4', 'BIZ', 230, 'D', 1, 'PC4D5'),
('PC4', 'BIZ', 231, 'D', 1, 'PC4D6'),
('PC4', 'BIZ', 232, 'D', 1, 'PC4D7'),
('PC4', 'BIZ', 233, 'D', 1, 'PC4D8'),
('PC4', 'BIZ', 234, 'D', 1, 'PC4D9'),
('PC4', 'BIZ', 236, 'E', 1, 'PC4E1'),
('PC4', 'BIZ', 245, 'E', 1, 'PC4E10'),
('PC4', 'BIZ', 237, 'E', 1, 'PC4E2'),
('PC4', 'BIZ', 238, 'E', 1, 'PC4E3'),
('PC4', 'BIZ', 239, 'E', 1, 'PC4E4'),
('PC4', 'BIZ', 240, 'E', 1, 'PC4E5'),
('PC4', 'BIZ', 241, 'E', 1, 'PC4E6'),
('PC4', 'BIZ', 242, 'E', 1, 'PC4E7'),
('PC4', 'BIZ', 243, 'E', 1, 'PC4E8'),
('PC4', 'BIZ', 244, 'E', 1, 'PC4E9'),
('PC4', 'BIZ', 246, 'F', 1, 'PC4F1'),
('PC4', 'BIZ', 255, 'F', 1, 'PC4F10'),
('PC4', 'BIZ', 247, 'F', 1, 'PC4F2'),
('PC4', 'BIZ', 248, 'F', 1, 'PC4F3'),
('PC4', 'BIZ', 249, 'F', 1, 'PC4F4'),
('PC4', 'BIZ', 250, 'F', 1, 'PC4F5'),
('PC4', 'BIZ', 251, 'F', 1, 'PC4F6'),
('PC4', 'BIZ', 252, 'F', 1, 'PC4F7'),
('PC4', 'BIZ', 253, 'F', 1, 'PC4F8'),
('PC4', 'BIZ', 254, 'F', 1, 'PC4F9'),
('PC4', 'DOI', 256, 'G', 1, 'PC4G1'),
('PC4', 'DOI', 257, 'G', 1, 'PC4G2'),
('PC4', 'DOI', 258, 'G', 1, 'PC4G3'),
('PC4', 'DOI', 259, 'G', 1, 'PC4G4'),
('PC4', 'DOI', 260, 'G', 1, 'PC4G5'),
('PC5', 'STD', 261, 'A', 1, 'PC5A1'),
('PC5', 'STD', 270, 'A', 1, 'PC5A10'),
('PC5', 'STD', 262, 'A', 1, 'PC5A2'),
('PC5', 'STD', 263, 'A', 1, 'PC5A3'),
('PC5', 'STD', 264, 'A', 1, 'PC5A4'),
('PC5', 'STD', 265, 'A', 1, 'PC5A5'),
('PC5', 'STD', 266, 'A', 1, 'PC5A6'),
('PC5', 'STD', 267, 'A', 1, 'PC5A7'),
('PC5', 'STD', 268, 'A', 1, 'PC5A8'),
('PC5', 'STD', 269, 'A', 1, 'PC5A9'),
('PC5', 'STD', 271, 'B', 1, 'PC5B1'),
('PC5', 'STD', 280, 'B', 1, 'PC5B10'),
('PC5', 'STD', 272, 'B', 1, 'PC5B2'),
('PC5', 'STD', 273, 'B', 1, 'PC5B3'),
('PC5', 'STD', 274, 'B', 1, 'PC5B4'),
('PC5', 'STD', 275, 'B', 1, 'PC5B5'),
('PC5', 'STD', 276, 'B', 1, 'PC5B6'),
('PC5', 'STD', 277, 'B', 1, 'PC5B7'),
('PC5', 'STD', 278, 'B', 1, 'PC5B8'),
('PC5', 'STD', 279, 'B', 1, 'PC5B9'),
('PC5', 'STD', 281, 'C', 1, 'PC5C1'),
('PC5', 'STD', 290, 'C', 1, 'PC5C10'),
('PC5', 'STD', 282, 'C', 1, 'PC5C2'),
('PC5', 'STD', 283, 'C', 1, 'PC5C3'),
('PC5', 'STD', 284, 'C', 1, 'PC5C4'),
('PC5', 'STD', 285, 'C', 1, 'PC5C5'),
('PC5', 'STD', 286, 'C', 1, 'PC5C6'),
('PC5', 'STD', 287, 'C', 1, 'PC5C7'),
('PC5', 'STD', 288, 'C', 1, 'PC5C8'),
('PC5', 'STD', 289, 'C', 1, 'PC5C9'),
('PC5', 'BIZ', 291, 'D', 1, 'PC5D1'),
('PC5', 'BIZ', 300, 'D', 1, 'PC5D10'),
('PC5', 'BIZ', 292, 'D', 1, 'PC5D2'),
('PC5', 'BIZ', 293, 'D', 1, 'PC5D3'),
('PC5', 'BIZ', 294, 'D', 1, 'PC5D4'),
('PC5', 'BIZ', 295, 'D', 1, 'PC5D5'),
('PC5', 'BIZ', 296, 'D', 1, 'PC5D6'),
('PC5', 'BIZ', 297, 'D', 1, 'PC5D7'),
('PC5', 'BIZ', 298, 'D', 1, 'PC5D8'),
('PC5', 'BIZ', 299, 'D', 1, 'PC5D9'),
('PC5', 'BIZ', 301, 'E', 1, 'PC5E1'),
('PC5', 'BIZ', 310, 'E', 1, 'PC5E10'),
('PC5', 'BIZ', 302, 'E', 1, 'PC5E2'),
('PC5', 'BIZ', 303, 'E', 1, 'PC5E3'),
('PC5', 'BIZ', 304, 'E', 1, 'PC5E4'),
('PC5', 'BIZ', 305, 'E', 1, 'PC5E5'),
('PC5', 'BIZ', 306, 'E', 1, 'PC5E6'),
('PC5', 'BIZ', 307, 'E', 1, 'PC5E7'),
('PC5', 'BIZ', 308, 'E', 1, 'PC5E8'),
('PC5', 'BIZ', 309, 'E', 1, 'PC5E9'),
('PC5', 'BIZ', 311, 'F', 1, 'PC5F1'),
('PC5', 'BIZ', 320, 'F', 1, 'PC5F10'),
('PC5', 'BIZ', 312, 'F', 1, 'PC5F2'),
('PC5', 'BIZ', 313, 'F', 1, 'PC5F3'),
('PC5', 'BIZ', 314, 'F', 1, 'PC5F4'),
('PC5', 'BIZ', 315, 'F', 1, 'PC5F5'),
('PC5', 'BIZ', 316, 'F', 1, 'PC5F6'),
('PC5', 'BIZ', 317, 'F', 1, 'PC5F7'),
('PC5', 'BIZ', 318, 'F', 1, 'PC5F8'),
('PC5', 'BIZ', 319, 'F', 1, 'PC5F9'),
('PC5', 'DOI', 321, 'G', 1, 'PC5G1'),
('PC5', 'DOI', 322, 'G', 1, 'PC5G2'),
('PC5', 'DOI', 323, 'G', 1, 'PC5G3'),
('PC5', 'DOI', 324, 'G', 1, 'PC5G4'),
('PC5', 'DOI', 325, 'G', 1, 'PC5G5');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lichchieuphim`
--

CREATE TABLE `lichchieuphim` (
  `MAPM` varchar(10) DEFAULT NULL,
  `MASC` varchar(10) DEFAULT NULL,
  `MAPHONGCHIEU` varchar(10) DEFAULT NULL,
  `MALICHCHIEU` varchar(10) NOT NULL,
  `THOIGIANKETTHUC` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `lichchieuphim`
--

INSERT INTO `lichchieuphim` (`MAPM`, `MASC`, `MAPHONGCHIEU`, `MALICHCHIEU`, `THOIGIANKETTHUC`) VALUES
('PM001', 'SC00010', 'PC1', 'LC000010', '11:33'),
('PM001', 'SC00010', 'PC2', 'LC000011', '11:33'),
('PM001', 'SC00011', 'PC1', 'LC000012', '12:33'),
('PM001', 'SC00011', 'PC2', 'LC000013', '12:33'),
('PM001', 'SC00012', 'PC4', 'LC000014', '13:33'),
('PM002', 'SC00011', 'PC3', 'LC000015', '12:33'),
('PM003', 'SC00012', 'PC1', 'LC000016', '14:33'),
('PM001', 'SC0001', 'PC1', 'LC0001', '9:33'),
('PM002', 'SC0001', 'PC2', 'LC0002', '9:33'),
('PM003', 'SC0002', 'PC3', 'LC0003', '11:09'),
('PM004', 'SC0002', 'PC4', 'LC0004', '11:19'),
('PM005', 'SC0003', 'PC5', 'LC0005', '13:35'),
('PM006', 'SC0003', 'PC1', 'LC0006', '13:22'),
('PM007', 'SC0004', 'PC2', 'LC0007', '15:24'),
('PM008', 'SC0004', 'PC3', 'LC0008', '15:23'),
('PM009', 'SC0005', 'PC4', 'LC0009', '17:45'),
('PM010', 'SC0005', 'PC5', 'LC0010', '18:16'),
('PM011', 'SC0006', 'PC1', 'LC0011', '19:10'),
('PM012', 'SC0006', 'PC2', 'LC0012', '19:37'),
('PM013', 'SC0007', 'PC3', 'LC0013', '21:22'),
('PM014', 'SC0007', 'PC4', 'LC0014', '21:10'),
('PM015', 'SC0008', 'PC5', 'LC0015', '23:33'),
('PM016', 'SC0008', 'PC1', 'LC0016', '23:24'),
('PM017', 'SC0009', 'PC2', 'LC0017', '1:33'),
('PM018', 'SC0009', 'PC3', 'LC0018', '1:25');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaighe`
--

CREATE TABLE `loaighe` (
  `MALOAIGHE` varchar(10) NOT NULL,
  `TENLOAIGHE` varchar(255) DEFAULT NULL,
  `PRICE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `loaighe`
--

INSERT INTO `loaighe` (`MALOAIGHE`, `TENLOAIGHE`, `PRICE`) VALUES
('BIZ', 'vip', 100000),
('DOI', 'đôi', 150000),
('STD', 'thường', 80000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ngayle`
--

CREATE TABLE `ngayle` (
  `NGAY` date NOT NULL,
  `PHANTRAMGIATANG` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `ngayle`
--

INSERT INTO `ngayle` (`NGAY`, `PHANTRAMGIATANG`) VALUES
('2024-02-14', 25),
('2024-03-08', 25),
('2024-04-14', 25),
('2024-04-18', 20),
('2024-06-01', 25),
('2024-09-02', 20),
('2024-10-20', 20),
('2024-11-19', 20);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phim`
--

CREATE TABLE `phim` (
  `MAPM` varchar(10) NOT NULL,
  `PATHTRAILER` varchar(255) DEFAULT NULL,
  `MOTA` text DEFAULT NULL,
  `THOILUONG` varchar(255) DEFAULT NULL,
  `NGAYCHIEU` date DEFAULT NULL,
  `QUOCGIA` varchar(255) DEFAULT NULL,
  `DANHGIA` float DEFAULT NULL,
  `DOTUOI` tinyint(4) DEFAULT NULL,
  `LUOTXEM` int(11) DEFAULT NULL,
  `TRANGTHAI` tinyint(4) DEFAULT NULL,
  `TENPHIM` varchar(255) DEFAULT NULL,
  `NAMEANH` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `phim`
--

INSERT INTO `phim` (`MAPM`, `PATHTRAILER`, `MOTA`, `THOILUONG`, `NGAYCHIEU`, `QUOCGIA`, `DANHGIA`, `DOTUOI`, `LUOTXEM`, `TRANGTHAI`, `TENPHIM`, `NAMEANH`) VALUES
('PM001', 'https://www.youtube.com/watch?v=8Pq08VsVUFk', 'Ký ức tình đầu ùa về khi Jimmy nhận được tấm bưu thiếp từ Ami. Cậu quyết định một mình bước lên chuyến tàu đến Nhật Bản gặp lại người con gái cậu đã bỏ lỡ 18 năm trước. Mối tình day dứt thời thanh xuân, liệu sẽ có một kết cục nào tốt đẹp khi đoàn tụ?', '123 phút', '2024-04-08', 'Trung Quốc', 8.4, 13, 1000, 0, 'Thanh Xuân 18x2: Lữ Trình Hướng Về Em', 'thanhxuan18x2.jpg'),
('PM002', 'https://www.youtube.com/watch?v=AVAnQaJ49l8', 'When a young American woman is sent to Rome to bengin a life of service to the church, she encounters a darkness that causes her to question her own faith and uncovers a terrifying conspiracy that hopes to bring about the birth of evil incarnate.', '123 phút', '2024-04-05', 'Mỹ', 5.7, 18, 700, 0, 'Điềm Báo Của Quỷ', 'diembaocuaquy.jpg'),
('PM003', 'https://www.youtube.com/watch?v=QGlgPf9jGMA', 'Trong một tương lai gần, một nhóm các phóng viên chiến trường quả cảm phải đấu tranh với thời gian và bom đạn nguy hiểm để đến kịp Nhà Trắng giữa bối cảnh nội chiến Hoa Kỳ đang tiến đến cao trào.', '109 phút', '2024-04-12', 'Hoa Kỳ', 7.8, 16, 1200, 0, 'Ngày Tàn Của Đế Quốc', 'ngaytancuadequoc.jpg'),
('PM004', 'https://www.youtube.com/watch?v=Y4Fbcvq-9RU', 'Sau các sự kiện của Ghostbusters: Afterlife, gia đình Spengler đang tìm kiếm cuộc sống mới ở Thành phố New York. Nhóm săn ma bao gồm Ray, Winston và Podcast sử dụng công nghệ mới để chống lại các mối đe dọa chết người cổ xưa đang ẩn náu trong các vật dụng hàng ngày. Thế nhưng, họ sẽ phải đối đầu với một thế lực đen tối hùng mạnh mới.', '119 phút', '2024-04-12', 'Mỹ', 5, 13, 2000, 0, 'Biệt Đội Săn Ma: Kỷ Nguyên Băng Giá', 'bietdoisanma.jpg'),
('PM005', 'https://www.youtube.com/watch?v=B2Jlyq_Tf3Y', 'Sau cuộc đối đầu nổ lực, Godzilla và Kong phải hợp tác chống lại một mối đe dọa khổng lồ chưa được khám phá ẩn sâu trong thế giới của chúng ta, thách thức sự tồn tại của chính chúng – và của chúng ta.', '125 phút', '2024-03-29', 'Mỹ', 9.3, 0, 2400, 0, 'Godzilla x Kong: Đế Chế Mới', 'Kong.jpg'),
('PM006', 'https://www.youtube.com/watch?v=N_ieracfsts', 'Chuyện phim xoay quanh Lee Soo-yeon (Park Ji-yeon) - một nữ minh tinh màn bạc đang ở đỉnh cao sự nghiệp nhưng bất chợt tuột dốc không phanh vì tai nạn chết người do chính cô gây ra trong lúc say rượu. Sau thời gian dài “ở ẩn” để trả giá cho sai lầm, Lee Soo-yeon bắt đầu nuôi mộng trở lại với khán giả nhưng bê bối từ quá khứ của cô luôn bị người đời đay nghiến, châm chọc. Lòng đố kỵ và khát khao danh vọng trỗi dậy trong Soo-yeon khi hằng ngày chứng kiến sự thành công của “ngôi sao mới lên” Song Ga-young (Kim Nu-ri) - hậu bối cùng công ty quản lý được sắp xếp sống chung với Soo-yeon trong căn hộ sang trọng. Sau một cuộc tranh cãi gay gắt với Ga-young, Soo-yeon đã tìm đến rượu để “an thần”, nhưng khi thức dậy cô đã phát hiện Ga-young chết trong căn hộ đầy bí ẩn. Liệu án mạng này sẽ ảnh hưởng như thế nào đến con đường lấy lại hào quang của Soo-yeon khi chính cô là nghi phạm duy nhất?', '112 phút', '2024-04-12', 'Hàn Quốc', 10, 18, 3000, 0, 'Hào Quang Đẫm Máu', 'haoquangdammau.jpg'),
('PM007', 'https://www.youtube.com/watch?v=DqRVx0wfOBQ', 'Toy Story phiên bản kinh dị sắp làm khán giả ngất luôn tại rạp! Chú gấu nhồi bông trông thì bình thường dễ thương nhưng lại sai khiến cô bạn nhỏ chơi một trò chơi đen tối với những thử thách kỳ lạ!', '114 phút', '2024-04-12', 'Mỹ', 9, 13, 2100, 0, 'Người “Bạn” Trong Tưởng Tượng', 'nguoibantrongtuongtuong.jpg'),
('PM008', 'https://www.youtube.com/watch?v=zEOXpArv940', 'Kid, một thanh niên vô danh sống trong một câu lạc bộ chiến đấu ngầm, nơi mà đêm này qua đêm khác anh đeo mặt nạ khỉ đột để chiến đấu trong lồng sắt kiếm tiền. Sau nhiều năm kìm nén cơn thịnh nộ trong bản thân mình, Kid tìm ra cách thâm nhập vào khu vực của giới thượng lưu độc ác thành phố. Khi những kí ức đau thương thời thơ ấu của anh trở về, đôi bàn tay đầy sẹo bí ẩn của anh sẽ đặt dấu chấm hết cho những kẻ đã cướp đi cuộc sống này.', '113 phút', '2024-04-05', 'Hoa Kỳ', 8.2, 18, 1700, 0, 'Monkey Man Báo Thù', 'monkeymanbaothu.jpg'),
('PM009', 'https://www.youtube.com/watch?v=5APPENpUdu0', 'Trong bối cảnh năm 1885 tại Pháp, đầu bếp tài ba Eugenie đã làm việc cho nhà quý tộc sành ăn Dodin Bouffant suốt 20 năm qua. Công việc nấu nướng và lòng ngưỡng mộ mà cả hai dành cho nhau dần dẫn tới một mối quan hệ lãng mạn. Họ cùng nhau tạo ra những tuyệt tác ẩm thực, khiến ngay cả những đầu bếp lừng lẫy nhất thế giới cũng phải thán phục. Nhưng Eugenie yêu thích sự tự do của mình và chưa bao giờ muốn kết hôn với Dodin. Khi Dodin nhận ra tình cảm sâu sắc của mình dành cho người phụ nữ đã luôn kề bên những năm tháng qua, cũng là lúc ông phát hiện Eugenie lâm bệnh nặng. Liệu mối tình lãng mạn này có thể kết thúc với hạnh phúc trọn vẹn?', '135 phút', '2024-03-22', 'Pháp', 8.5, 13, 1100, 0, 'Muôn Vị Nhân Gian', 'muonvinhangian.jpg'),
('PM010', 'https://www.youtube.com/watch?v=Svt6DK9T130', 'Hãy theo dõi hành trình thần thoại của Paul Atreides khi anh đoàn kết với Chani và Fremen trong khi trên con đường trả thù những kẻ âm mưu phá hoại gia đình anh. Đứng trước sự lựa chọn giữa tình yêu của đời mình và số phận của vũ trụ đã biết, Paul cố gắng ngăn chặn một tương lai khủng khiếp mà chỉ có anh mới có thể nhìn thấy.', '166 phút', '2024-03-01', 'Mỹ', 9.4, 16, 4000, 0, 'Dune: Hành Tinh Cát – Phần Hai', 'dune.jpg'),
('PM011', 'https://www.youtube.com/watch?v=vPwSfR_O9Jo', 'Câu chuyện bắt đầu từ lúc Thế giới sụp đổ, Furiosa phải tự cứu lấy mình để trở về nhà. Một cuộc phiêu lưu hành động độc lập khốc liệt, tiền truyện về quái nữ đồng hành với Max Rockatansky.', '100 phút', '2024-05-17', 'Mỹ', 9, 16, 0, 1, 'Furiosa: Câu Chuyện Từ Max Điên', 'furiosa.jpg'),
('PM012', 'https://www.youtube.com/watch?v=d1ZHdosjNX8', 'Trách nhiệm thuộc về ai?', '127 phút', '2024-04-26', 'Việt Nam', 9.6, 0, 0, 1, 'Lật Mặt 7: Một Điều Ước', 'latmat7.jpg'),
('PM013', 'https://www.youtube.com/watch?v=JToYSVWY4N8', 'Hồn ma Nak với sức mạnh khủng khiếp nhất, đáng sợ nhất mà bộ đôi mỏ hỗn Balloon & First phải đối mặt để giải cứu cho trai đẹp Min Joon. Liệu hội bạn này sẽ giải được nghiệp mình tạo ra hay sẽ tan rã từ đây?', '112 phút', '2024-05-31', 'Thái Lan', 9.5, 16, 0, 1, 'Ngôi Đền Kỳ Quái 4', 'ngoidenkyquai.jpg'),
('PM014', 'https://www.youtube.com/watch?v=hlBA_G5_PGk', 'Trong bộ phim hoạt hình này, chú mèo mê đồ ăn Garfield bị cuốn vào một vụ trộm để giúp cha mình - một tên trộm đường phố, khỏi một chú mèo biểu diễn khác đang muốn trả thù ông. Bắt đầu như một mối quan hệ hợp tác miễn cưỡng và kết thúc bằng việc Garfield và Vic nhận ra rằng cha con họ không hề khác biệt như vẻ ngoài của mình.', '100 phút', '2024-05-31', 'Mỹ', 9.1, 0, 0, 1, 'Garfield – Mèo Béo Siêu Quậy', 'garfield.jpg'),
('PM015', 'https://www.youtube.com/watch?v=m30S4Ax9BOM', 'Một vài thế hệ trong tương lai sau thời đại của Caesar, loài khỉ trở thành loài thống trị và sống hòa bình trong khi loài người bị suy yếu và sống trong bóng tối. Khi một nhà lãnh đạo khỉ độc tài mới xây dựng đế chế của mình, một chú khỉ trẻ bắt đầu một cuộc hành trình đầy gian nan, khiến anh ta phải nghi ngờ tất cả những gì anh ta biết về quá khứ và phải đưa ra những lựa chọn sẽ định hình tương lai cho cả loài khỉ và loài người.', '123 phút', '2024-05-24', 'Mỹ', 8.8, 16, 0, 1, 'Hành Tinh Khỉ: Vương Quốc Mới', 'hanhtinhkhi.jpg'),
('PM016', 'https://www.youtube.com/watch?v=bo2Y9Soatsg', 'Colt Seavers là một diễn viên đóng thế “lão làng. Bất ngờ, anh được mời làm “bản sao” cho một nhân vật nổi tiếng trong phim do người yêu cũ – Jody (Emily Blunt) đạo diễn. Mọi chuyện dần chệch hướng khi ngôi sao của bộ phim bỗng mất tích, không ai có thể liên lạc được. Để cứu lấy công việc và giành lại tình yêu của đời mình, Colt vướng vào âm mưu khó lường khi cố gắng đi tìm diễn viên đó.', '114 phút', '2024-05-03', 'Mỹ', 7.5, 13, 0, 1, 'Kẻ Thế Thân', 'kethethan.jpg'),
('PM017', 'https://www.youtube.com/watch?v=dFnSgtLNgtQ', 'Một cuộc phiêu lưu hoàn toàn mới bên trong đầu của Riley với một bộ của xúc mới', '123 phút', '2024-06-14', 'Mỹ', 9.9, 0, 0, 1, 'Những Mảnh Ghép Cảm Xúc 2', 'nhungmanhghepcamxuc.jpg'),
('PM018', 'https://www.youtube.com/watch?v=U46X1pXfolk', 'Bà Dương và ông Thoại luôn cố gắng để xây dựng một hình ảnh gia đình tài giỏi và danh giá trong mắt mọi người. Tuy nhiên dưới lớp vỏ bọc hào nhoáng ấy là những biến cố và lục dục gia đình đầy sóng gió. Nhìn kĩ hơn một chút bức tranh gia đình hạnh phúc ấy, rất nhiều “khuyết điểm” sẽ lộ ra gây bất ngờ', '115 phút', '2024-04-18', 'Việt Nam', 8.7, 0, 0, 1, 'Cái Giá Của Hạnh Phúc', 'caigiacuahanhphuc.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phongchieu`
--

CREATE TABLE `phongchieu` (
  `MAPHONGCHIEU` varchar(10) NOT NULL,
  `TENPHONGCHIEU` varchar(255) DEFAULT NULL,
  `TRANGTHAI` tinyint(4) DEFAULT NULL,
  `SOGHE` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `phongchieu`
--

INSERT INTO `phongchieu` (`MAPHONGCHIEU`, `TENPHONGCHIEU`, `TRANGTHAI`, `SOGHE`) VALUES
('PC1', 'Phong chieu so 1', 1, 80),
('PC2', 'Phong chieu so 2', 1, 80),
('PC3', 'Phong chieu so 3', 1, 80),
('PC4', 'Phong chieu so 4', 1, 80),
('PC5', 'Phong chieu so 5', 1, 80);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quyen`
--

CREATE TABLE `quyen` (
  `MAQUYEN` varchar(10) NOT NULL,
  `TENQUYEN` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `quyen`
--

INSERT INTO `quyen` (`MAQUYEN`, `TENQUYEN`) VALUES
('QAD', 'Quyền Admin'),
('QKH', 'Quyền khách hàng'),
('QQL', 'Quyền quản lí');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `suatchieu`
--

CREATE TABLE `suatchieu` (
  `MASC` varchar(10) NOT NULL,
  `NGAY` date DEFAULT NULL,
  `THOIGIANBATDAU` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `suatchieu`
--

INSERT INTO `suatchieu` (`MASC`, `NGAY`, `THOIGIANBATDAU`) VALUES
('SC0001', '2024-04-11', '7:30'),
('SC00010', '2024-04-26', '9:30'),
('SC00011', '2024-04-26', '10:30'),
('SC00012', '2024-04-26', '11:30'),
('SC0002', '2024-04-11', '9:30'),
('SC0003', '2024-04-11', '11:30'),
('SC0004', '2024-04-11', '13:30'),
('SC0005', '2024-04-11', '15:30'),
('SC0006', '2024-04-11', '17:30'),
('SC0007', '2024-04-11', '19:30'),
('SC0008', '2024-04-11', '21:30'),
('SC0009', '2024-04-11', '23:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `USERNAME` varchar(10) NOT NULL,
  `PASSWORD` varchar(255) DEFAULT NULL,
  `NGAYTAOTK` date DEFAULT NULL,
  `TRANGTHAI` smallint(6) DEFAULT NULL,
  `EMAIL` varchar(255) DEFAULT NULL,
  `HOTEN` varchar(255) DEFAULT NULL,
  `NAMEANH` varchar(255) DEFAULT NULL,
  `MAQUYEN` varchar(10) DEFAULT NULL,
  `THOIGIANTAOTK` varchar(10) DEFAULT NULL,
  `SODIENTHOAI` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`USERNAME`, `PASSWORD`, `NGAYTAOTK`, `TRANGTHAI`, `EMAIL`, `HOTEN`, `NAMEANH`, `MAQUYEN`, `THOIGIANTAOTK`, `SODIENTHOAI`) VALUES
('Oanhle2222', 'Hoichima33', '2023-09-21', 1, '3122hehehe@gmail.com', 'Oanh le', 'Loi-ich-hien-mau.jpg', 'QKH', '20:30:00', ''),
('Quynhquynh', 'meomeo122', '2023-10-02', 1, 'quynh@gmail.com', 'Quynh12', 'Quynhquynh.png', 'QQL', '8:30:00', NULL),
('Trung442', 'trung3312', '2023-08-02', 1, 'trung22@gmail.com', 'Trunggg', 'Trung442.png', 'QAD', '10:30:00', NULL),
('tuan123', '12345678', '2024-04-20', 1, 'anhtu123@gmail.com', 'teo', 'userImg.jpg', 'QKH', '04:22:07', '0123456789');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `theloai`
--

CREATE TABLE `theloai` (
  `MATHELOAI` varchar(10) NOT NULL,
  `TENTHELOAI` varchar(255) DEFAULT NULL,
  `MOTA` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `theloai`
--

INSERT INTO `theloai` (`MATHELOAI`, `TENTHELOAI`, `MOTA`) VALUES
('TL1', 'Hành Động', 'Thường bao gồm sự đối đầu giữa “cái thiện” và “cái ác” với nhiều cuộc chiến ác liệt bằng tay không hoặc vũ khí, tiết tấu nhanh và kĩ xảo điện ảnh cao'),
('TL2', 'Phiêu Lưu', 'Bao gồm các chuyến du hành mạo hiểm chứa đựng nhiều hiểm nguy hoặc may mắn, đôi khi có yếu tố thần thoại'),
('TL3', 'Bí Ẩn', 'Thường là quá trình điều tra về một bí ẩn chưa được khám phá'),
('TL4', 'Hài Kịch', 'Chứa đựng nhiều chi tiết hài hước để gây cười cho người xem'),
('TL5', 'Kinh Dị', 'Chứa những hình ảnh rùng rợn, ánh sáng mờ ảo, âm thanh rùng rợn, do đó thể loại phim này có thể đi đôi với các thể loại giả tưởng, viễn tưởng'),
('TL6', 'Giật Gân', 'Là một thể loại rộng lớn của văn chương có sử dụng yếu tố hồi hộp, căng thẳng như là yếu tố chính của phim'),
('TL7', 'Kỳ Ảo', 'Bối cảnh thường không có thật, thường liên quan đến hiện tượng siêu nhiên, magic'),
('TL8', 'Chính Kịch', 'Thường tập trung nói về cuộc đời hoặc một giai đoạn trong cuộc đời nhân vật chính'),
('TL9', 'Lãng Mạn', 'Tập trung khai thác tình yêu lãnh mạn giữa các nhân vật chính');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongke`
--

CREATE TABLE `thongke` (
  `NGAY` date NOT NULL,
  `TONGDOANHTHU` int(11) NOT NULL,
  `TONGVE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `thongke`
--

INSERT INTO `thongke` (`NGAY`, `TONGDOANHTHU`, `TONGVE`) VALUES
('2024-04-13', 8200000, 82),
('2024-04-14', 6800000, 68);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `uudai`
--

CREATE TABLE `uudai` (
  `CODE` varchar(10) NOT NULL,
  `TENUUDAI` varchar(255) DEFAULT NULL,
  `PHANTRAMUUDAI` int(11) NOT NULL,
  `DIEUKIEN` int(11) NOT NULL,
  `TRANGTHAI` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `uudai`
--

INSERT INTO `uudai` (`CODE`, `TENUUDAI`, `PHANTRAMUUDAI`, `DIEUKIEN`, `TRANGTHAI`) VALUES
('MUD001', 'Hoá Đơn trên 150.000đ giảm 5%', 5, 150000, 1),
('MUD002', 'Hoá Đơn trên 250.000đ giảm 10%', 10, 250000, 0),
('MUD003', 'Hoá Đơn trên 350.000đ giảm 15%', 15, 350000, 0),
('MUD004', 'Hoá Đơn trên 450.000đ giảm 20%', 20, 450000, 1),
('MUD005', 'Hoá Đơn trên 500.000đ giảm 25%', 25, 500000, 1),
('MUD006', 'Hoá Đơn trên 1.000.000đ giảm 40%', 30, 1000000, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ve`
--

CREATE TABLE `ve` (
  `MAVE` varchar(10) NOT NULL,
  `USERNAME` varchar(255) DEFAULT NULL,
  `MALICHCHIEU` varchar(10) DEFAULT NULL,
  `TONGTIEN` int(11) DEFAULT NULL,
  `NGAY` date NOT NULL,
  `THOIGIAN` time NOT NULL,
  `PHUONGTHUCTHANHTOAN` varchar(255) DEFAULT NULL,
  `MAUUDAI` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `ve`
--

INSERT INTO `ve` (`MAVE`, `USERNAME`, `MALICHCHIEU`, `TONGTIEN`, `NGAY`, `THOIGIAN`, `PHUONGTHUCTHANHTOAN`, `MAUUDAI`) VALUES
('MV0001', 'tuan123', 'LC0001', 100000, '2024-03-01', '10:40:32', 'Ngân hàng', ''),
('MV0002', 'Quynhquynh', 'LC0001', 100000, '2024-01-01', '14:41:22', 'Momo', ''),
('MV0003', 'Oanhle2222', 'LC0002', 100000, '2024-04-23', '12:11:12', 'Ngân hàng', ''),
('MV0004', 'Quynhquynh', 'LC0002', 100000, '2024-02-21', '15:10:52', 'Momo', ''),
('MV0005', 'tuan123', 'LC0003', 100000, '2024-01-11', '12:16:12', 'Momo', ''),
('MV0006', 'Trung442', 'LC0003', 100000, '2024-04-11', '11:17:42', 'Momo', ''),
('MV0007', 'Oanhle2222', 'LC0004', 100000, '2024-03-12', '17:37:46', 'ZaloPay', ''),
('MV0008', 'tuan123', 'LC0008', 220000, '2024-04-24', '14:15:00', 'Ngân hàng', 'MUD001');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitietphim_dienvien`
--
ALTER TABLE `chitietphim_dienvien`
  ADD PRIMARY KEY (`MAPM`,`MADV`);

--
-- Chỉ mục cho bảng `chitietphim_theloai`
--
ALTER TABLE `chitietphim_theloai`
  ADD PRIMARY KEY (`MAPM`,`MATHELOAI`);

--
-- Chỉ mục cho bảng `chitietquyen_chucnang`
--
ALTER TABLE `chitietquyen_chucnang`
  ADD PRIMARY KEY (`MAQUYEN`,`MACHUCNANG`,`HANHDONG`);

--
-- Chỉ mục cho bảng `chitietthongke`
--
ALTER TABLE `chitietthongke`
  ADD PRIMARY KEY (`NGAY`,`MAPM`);

--
-- Chỉ mục cho bảng `chitietve_dichvu`
--
ALTER TABLE `chitietve_dichvu`
  ADD PRIMARY KEY (`MAVE`,`MADICHVU`);

--
-- Chỉ mục cho bảng `chitietve_ghe`
--
ALTER TABLE `chitietve_ghe`
  ADD PRIMARY KEY (`MAVE`,`MAGHE`);

--
-- Chỉ mục cho bảng `chucnang`
--
ALTER TABLE `chucnang`
  ADD PRIMARY KEY (`MACHUCNANG`);

--
-- Chỉ mục cho bảng `dichvu`
--
ALTER TABLE `dichvu`
  ADD PRIMARY KEY (`MADICHVU`);

--
-- Chỉ mục cho bảng `dienvien`
--
ALTER TABLE `dienvien`
  ADD PRIMARY KEY (`MADV`);

--
-- Chỉ mục cho bảng `ghe`
--
ALTER TABLE `ghe`
  ADD PRIMARY KEY (`MAGHE`);

--
-- Chỉ mục cho bảng `lichchieuphim`
--
ALTER TABLE `lichchieuphim`
  ADD PRIMARY KEY (`MALICHCHIEU`);

--
-- Chỉ mục cho bảng `loaighe`
--
ALTER TABLE `loaighe`
  ADD PRIMARY KEY (`MALOAIGHE`);

--
-- Chỉ mục cho bảng `ngayle`
--
ALTER TABLE `ngayle`
  ADD PRIMARY KEY (`NGAY`);

--
-- Chỉ mục cho bảng `phim`
--
ALTER TABLE `phim`
  ADD PRIMARY KEY (`MAPM`);

--
-- Chỉ mục cho bảng `phongchieu`
--
ALTER TABLE `phongchieu`
  ADD PRIMARY KEY (`MAPHONGCHIEU`);

--
-- Chỉ mục cho bảng `quyen`
--
ALTER TABLE `quyen`
  ADD PRIMARY KEY (`MAQUYEN`);

--
-- Chỉ mục cho bảng `suatchieu`
--
ALTER TABLE `suatchieu`
  ADD PRIMARY KEY (`MASC`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`USERNAME`);

--
-- Chỉ mục cho bảng `theloai`
--
ALTER TABLE `theloai`
  ADD PRIMARY KEY (`MATHELOAI`);

--
-- Chỉ mục cho bảng `thongke`
--
ALTER TABLE `thongke`
  ADD PRIMARY KEY (`NGAY`);

--
-- Chỉ mục cho bảng `uudai`
--
ALTER TABLE `uudai`
  ADD PRIMARY KEY (`CODE`);

--
-- Chỉ mục cho bảng `ve`
--
ALTER TABLE `ve`
  ADD PRIMARY KEY (`MAVE`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
