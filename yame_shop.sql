-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2021 at 02:21 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yame_shop`
--
CREATE DATABASE IF NOT EXISTS `yame_shop` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `yame_shop`;

-- --------------------------------------------------------

--
-- Table structure for table `chitietdathang`
--

DROP TABLE IF EXISTS `chitietdathang`;
CREATE TABLE `chitietdathang` (
  `SoDonDH` int(11) NOT NULL,
  `MSHH` varchar(11) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `GiaDatHang` int(11) NOT NULL,
  `GiamGia` int(11) NOT NULL,
  `MaDC` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chitietdathang`
--

INSERT INTO `chitietdathang` (`SoDonDH`, `MSHH`, `SoLuong`, `GiaDatHang`, `GiamGia`, `MaDC`) VALUES
(52, 'P2c9500f85', 1, 425000, 0, 36),
(52, 'P2c9db7353', 2, 850000, 0, 36);

-- --------------------------------------------------------

--
-- Table structure for table `dathang`
--

DROP TABLE IF EXISTS `dathang`;
CREATE TABLE `dathang` (
  `SoDonDH` int(11) NOT NULL,
  `MSKH` varchar(10) NOT NULL,
  `MSNV` varchar(10) DEFAULT NULL,
  `NgayDH` timestamp NOT NULL DEFAULT current_timestamp(),
  `TrangThaiDH` tinyint(4) NOT NULL,
  `TongTien` int(11) NOT NULL,
  `MaDC` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dathang`
--

INSERT INTO `dathang` (`SoDonDH`, `MSKH`, `MSNV`, `NgayDH`, `TrangThaiDH`, `TongTien`, `MaDC`) VALUES
(28, 'KHf7ded7a', NULL, '2021-10-27 17:05:42', 0, 0, NULL),
(29, 'KHf7ded7a', NULL, '2021-10-27 17:05:42', 0, 0, NULL),
(30, 'KH875ccd1', NULL, '2021-10-27 17:07:40', 0, 0, NULL),
(32, 'KHf7ded7a', NULL, '2021-10-27 17:09:19', 0, 0, NULL),
(34, 'KHf7ded7a', NULL, '2021-10-27 17:09:35', 0, 0, NULL),
(35, 'KHf7ded7a', NULL, '2021-10-27 17:09:35', 0, 0, NULL),
(36, 'KHf7ded7a', NULL, '2021-10-27 17:11:03', 0, 0, NULL),
(37, 'KHf7ded7a', NULL, '2021-10-27 17:11:03', 0, 0, NULL),
(38, 'KHf7ded7a', NULL, '2021-10-27 17:11:17', 0, 0, NULL),
(40, 'KHf7ded7a', NULL, '2021-10-28 07:45:38', 0, 0, NULL),
(42, 'KHf7ded7a', NULL, '2021-10-30 17:08:33', 0, 0, NULL),
(52, 'KHc3a8384', NULL, '2021-11-28 01:15:43', 0, 1275000, 36);

-- --------------------------------------------------------

--
-- Table structure for table `diachikh`
--

DROP TABLE IF EXISTS `diachikh`;
CREATE TABLE `diachikh` (
  `MaDC` int(11) NOT NULL,
  `DiaChi` varchar(255) NOT NULL,
  `MSKH` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `diachikh`
--

INSERT INTO `diachikh` (`MaDC`, `DiaChi`, `MSKH`) VALUES
(11, '123 Trần Văn Hoài, Ninh Kiều', 'KH7d2c986'),
(12, '123 Trần Văn Hoài, Ninh Kiều', 'KH7dfa672'),
(13, 'Nhơn mỹ', 'KH7f3a400'),
(14, 'Nhơn mỹ', 'KH7f84848'),
(15, '123 Trần Văn Hoài, Ninh Kiều', 'KH80ee2a5'),
(16, 'Nhơn mỹ', 'KH816eb38'),
(17, '', 'KHf1b10cc'),
(18, '12 Trần Văn Hoài, Ninh Kiều', 'KHf7ded7a'),
(19, '', 'KHf8282f4'),
(20, '12 Trần Văn Hoài, Ninh Kiều', 'KH5d5501b'),
(21, '12 Trần Văn Hoài, Ninh Kiều', 'KH5d58179'),
(22, '12 Trần Văn Hoài, Ninh Kiều', 'KH5d76a0b'),
(23, '12 Trần Văn Hoài, Ninh Kiều', 'KH5d9daa9'),
(24, '134, nhơn lộc, nhơn mỹ , chợ mới , an giang', 'KHf7ded7a'),
(25, '134, nhơn lộc, nhơn mỹ , chợ mới , an giang', 'KH857d627'),
(26, '134, nhơn lộc, nhơn mỹ , chợ mới , an giang', 'KHf7ded7a'),
(27, '123 tịnh biên', 'KHf7ded7a'),
(28, 'ninh kiều ,cần thơ', 'KHf7ded7a'),
(29, 'Nhơn mỹ', 'KH875ccd1'),
(30, 'Nhơn mỹ', 'KH878f9d4'),
(31, 'long an', 'KHf7ded7a'),
(32, 'Nhơn mỹ', 'KHc80bb55'),
(33, 'Nhơn mỹ', 'KH1281776'),
(34, 'Nhơn mỹ', 'KH16c0e32'),
(35, '123 Trần Văn Hoài, Ninh Kiều', 'KH16c0e32'),
(36, 'Ninh kiều, Cần Thơ', 'KHc3a8384');

-- --------------------------------------------------------

--
-- Table structure for table `hanghoa`
--

DROP TABLE IF EXISTS `hanghoa`;
CREATE TABLE `hanghoa` (
  `MSHH` varchar(10) NOT NULL,
  `TenHH` varchar(255) NOT NULL,
  `MoTa` text NOT NULL,
  `Gia` int(11) NOT NULL,
  `SoLuongHang` int(11) NOT NULL,
  `MaLoaiHang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hanghoa`
--

INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `MoTa`, `Gia`, `SoLuongHang`, `MaLoaiHang`) VALUES
('P2c9500f85', 'Quần Dài Loose Pants Linh Vật Olygre ', 'Quần Dài Loose Pants Linh Vật Olygre ', 425000, 1000, 2),
('P2c9db7353', 'Quần Dài Jean Slimfit Đơn Giản 12VAHDT Vạn Xuân Kiến Quốc', 'Quần Dài Jean Slimfit Đơn Giản 12VAHDT Vạn Xuân Kiến Quốc', 425000, 120, 2),
('P2ca71ada0', 'Sơ Mi Tay Dài Đơn Giản', 'Sơ Mi Tay Dài Đơn Giản', 285000, 200, 5),
('P2cac3ea61', 'Quần Dài Tây Đơn Giản', 'Quần Dài Tây Đơn Giản', 425000, 200, 7),
('P2cbe4502d', 'Quần Dài Tây Đơn Giản B2HG03', 'Quần Dài Tây Đơn Giản B2HG03', 425000, 200, 7),
('P2ccaaa587', 'Sơ Mi Tay Dài Đơn Giản M20', 'Sơ Mi Tay Dài Đơn Giản M20', 185000, 100, 5),
('P6df64d2fb', 'Áo Thun Cổ Tròn Đơn Giản M18 ', 'Chất liệu: Cotton 2 chiều\r\nThành phần: 100% Cotton\r\n- Thân thiện\r\n- Thấm hút thoát ẩm\r\n- Mềm mại\r\n- Kiểm soát mùi\r\n- Điều hòa nhiệt\r\n+ Họa tiết thêu kỹ thuật số\r\n- HDSD:\r\n+ Nên giặt chung với sản phẩm cùng màu\r\n+ Không dùng thuốc tẩy hoặc xà phòng có tính tẩy mạnh\r\n+ Nên phơi trong bóng râm để giữ sp bền màu', 185000, 100, 1),
('Pa53893565', 'Áo Thun Cổ Tròn Đơn Giản M14', 'Chất liệu: Cotton 4 Chiều\r\nThành phần: 95% cotton 5% spandex\r\n- Thoáng mát\r\n- Hút ẩm tốt\r\n- Co dãn tốt\r\n+ Họa tiết in bóng', 155000, 100, 1),
('Pa53d9601d', 'Áo Thun Cổ Tròn Đơn Giản M11', 'Chất liệu: Cotton 2 chiều\r\nThành phần: 100% Cotton\r\n- Co dãn 2 chiều\r\n- Thấm hút mồ hôi tốt mang lại cảm giác thoáng mát\r\nIn dẻo + Thêu đắp vải phản quang', 145000, 120, 1),
('Pa5412c711', 'Áo Thun Cổ Tròn Đơn Giản M01', 'Chất liệu: Cotton 100% (2C)\r\nVới thành phần 100% từ sợi thiên nhiên, áo thun mang lại cảm giác thoáng mát, thấm hút mồ hôi tốt.\r\n\r\nThiết kế:\r\n- Kiểu dáng Raglan thời trang\r\n- Có túi áo tiện lợi\r\n- Tay và túi phối dây xương cá cotton 1.5cm\r\n- In dẻo thông điệp túi áo\r\n- Form áo cải tiến với 3 size M - L - XL\r\n(Thông số chi tiết ở cuối trang)\r\n- Màu sắc: 8 màu', 185000, 180, 1),
('Pa546528f3', 'Áo Khoác Classic Đơn Giản Thần Cổ Đại Anubis M1', 'Chất liệu: Vải Dù\r\nThành phần: 100% poly\r\n- Chống tia UV\r\n- Cản gió\r\n- Chống bụi\r\n- Ít nhăn\r\n- Nhanh khô\r\n- Bền màu tốt\r\n- Chống thấm nước lên nhiều giờ liền\r\n- Bảo vệ chống tác động môi trường\r\n+ Logo Anubis in cao\r\n+ Dây luồng nón phối màu cam nổi bật\r\n+ Túi trong tiện dụng\r\n+ Nón áo có mũi che không bị bắt nắng\r\n+ Cổ tay áo có nút bấm cố định phù hợp với tay người dùng\r\n+ Reverse Coil Zipper\r\n(Những chiếc khoá túi này có bề mặt ngoài dẹp, phẳng trong khi răng khoá thì ở trong)', 320000, 1200, 8);

-- --------------------------------------------------------

--
-- Table structure for table `hinhhanghoa`
--

DROP TABLE IF EXISTS `hinhhanghoa`;
CREATE TABLE `hinhhanghoa` (
  `MaHinh` int(11) NOT NULL,
  `TenHinh` varchar(255) NOT NULL,
  `MSHH` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hinhhanghoa`
--

INSERT INTO `hinhhanghoa` (`MaHinh`, `TenHinh`, `MSHH`) VALUES
(9, 'image6176df64d34c7.jpg', 'P6df64d2fb'),
(30, 'image617a538935cfc.jpg', 'Pa53893565'),
(31, 'image617a53d960873.jpg', 'Pa53d9601d'),
(32, 'image617a5412c78bc.jpg', 'Pa5412c711'),
(33, 'image617a54652991c.jpg', 'Pa546528f3'),
(34, 'image61a2c95012bb6.jpg', 'P2c9500f85'),
(35, 'image61a2c9db74de8.jpg', 'P2c9db7353'),
(36, 'image61a2ca71b015e.jpg', 'P2ca71ada0'),
(37, 'image61a2cac4021f6.jpg', 'P2cac3ea61'),
(38, 'image61a2cbe451a31.jpg', 'P2cbe4502d'),
(39, 'image61a2ccaaa7f81.jpg', 'P2ccaaa587');

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

DROP TABLE IF EXISTS `khachhang`;
CREATE TABLE `khachhang` (
  `MSKH` varchar(10) NOT NULL,
  `HoTenKH` varchar(255) NOT NULL,
  `SoDienThoai` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`MSKH`, `HoTenKH`, `SoDienThoai`, `Email`, `username`, `password`) VALUES
('', 'Lê Duy Thanh', '0333618825', 'Thanh123@gmail.com', '', NULL),
('KH1281776', 'Thanh', '0333618825', 'Thanh123@gmail.com', 'leduythanh123', '827ccb0eea8a706c4c34a16891f84e7b'),
('KH16c0e32', 'Thanh', '0333618825', 'Thanh123@gmail.com', 'ldthanh', '827ccb0eea8a706c4c34a16891f84e7b'),
('KH5d5501b', 'Trần Thị Mỹ Tiên', '0333618825', 'mytien@gmail.com', NULL, NULL),
('KH5d58179', 'Trần Thị Mỹ Tiên', '0333618825', 'mytien@gmail.com', NULL, NULL),
('KH5d76a0b', 'Trần Thị Mỹ Tiên', '0333618825', 'mytien@gmail.com', NULL, NULL),
('KH5d9daa9', 'Trần Thị Mỹ Tiên', '0333618825', 'mytien@gmail.com', NULL, NULL),
('KH7d2c986', 'Lê Duy Thanh', '0333618825', 'Thanh123@gmail.com', 'ldthanh2', '827ccb0eea8a706c4c34a16891f84e7b'),
('KH7dfa672', 'Tiên', '0333618825', 'Thanh123@gmail.com', NULL, NULL),
('KH7f3a400', 'Thanh', '0333618825', 'Thanh123@gmail.com', NULL, NULL),
('KH7f84848', 'Than', '1234567', 'Thanh123@gmail.com', NULL, NULL),
('KH80ee2a5', 'Lê Duy Thanh', '0333618825', 'Thanh123@gmail.com', NULL, NULL),
('KH816eb38', 'Thanh', '0333618825', 'Thanh123@gmail.com', NULL, NULL),
('KH857d627', 'Trần Thị Mỹ Tiên', '0333618825', 'mytien@gmail.com', NULL, NULL),
('KH875ccd1', 'Thanh', '0333618825', 'Thanh123@gmail.com', NULL, NULL),
('KH878f9d4', 'Thanh', '0333618825', 'Thanh123@gmail.com', NULL, NULL),
('KHc3a8384', 'Lê Duy Thanh', '0333618825', 'ldthanh0301@gmail.com', 'ldthanh0301', '827ccb0eea8a706c4c34a16891f84e7b'),
('KHc80bb55', 'Thanh', '0333618825', 'Thanh123@gmail.com', 'leduythanh', '827ccb0eea8a706c4c34a16891f84e7b'),
('KHf1b10cc', '', '', '', NULL, NULL),
('KHf7ded7a', 'Trần Thị Mỹ Tiên', '0333618825', 'mytien@gmail.com', 'mytien', '827ccb0eea8a706c4c34a16891f84e7b'),
('KHf8282f4', '', '', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `loaihanghoa`
--

DROP TABLE IF EXISTS `loaihanghoa`;
CREATE TABLE `loaihanghoa` (
  `MaLoaiHang` int(11) NOT NULL,
  `TenLoaiHang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loaihanghoa`
--

INSERT INTO `loaihanghoa` (`MaLoaiHang`, `TenLoaiHang`) VALUES
(1, 'Áo thun'),
(2, 'Quần Jean'),
(5, 'Áo sơ mi'),
(7, 'Quần tây'),
(8, 'Áo khoác');

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

DROP TABLE IF EXISTS `nhanvien`;
CREATE TABLE `nhanvien` (
  `HoTenNV` varchar(255) NOT NULL,
  `ChucVu` varchar(255) NOT NULL,
  `DiaChi` varchar(500) NOT NULL,
  `SoDienThoai` varchar(255) NOT NULL,
  `MSNV` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nhanvien`
--

INSERT INTO `nhanvien` (`HoTenNV`, `ChucVu`, `DiaChi`, `SoDienThoai`, `MSNV`, `username`, `password`) VALUES
('Lê Duy Thanh', '3', '123 Trần Văn Hoài, Ninh Kiều', '0333618825', 'staff2705f', 'ldthanh', '827ccb0eea8a706c4c34a16891f84e7b'),
('Yến Linh', '1', 'Nhơn mỹ', '0333618825', 'staff3e9eb', 'ylinh', '827ccb0eea8a706c4c34a16891f84e7b'),
('Phan Hữu Phúc', '0', 'Nhơn mỹ', '0333618825', 'staff590bc', 'phphuc', '827ccb0eea8a706c4c34a16891f84e7b'),
('Trương Thiện Tín', '0', 'An Châu', '0333618825', 'staff79e6b', 'tttin', '827ccb0eea8a706c4c34a16891f84e7b'),
('Trần Thị Mỹ Tiên', '2', 'Nhơn mỹ', '0333618825', 'staffb8cb2', 'ttmtien', '827ccb0eea8a706c4c34a16891f84e7b');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chitietdathang`
--
ALTER TABLE `chitietdathang`
  ADD KEY `SoDonDH` (`SoDonDH`),
  ADD KEY `MSHH_Chitietdathang` (`MSHH`),
  ADD KEY `MaDC_chitietdathang` (`MaDC`);

--
-- Indexes for table `dathang`
--
ALTER TABLE `dathang`
  ADD PRIMARY KEY (`SoDonDH`),
  ADD KEY `MSNV_DatHang` (`MSNV`),
  ADD KEY `MSKH_DatHang` (`MSKH`),
  ADD KEY `MaDC_DatHang` (`MaDC`);

--
-- Indexes for table `diachikh`
--
ALTER TABLE `diachikh`
  ADD PRIMARY KEY (`MaDC`),
  ADD KEY `MSKH_DiachiKH` (`MSKH`);

--
-- Indexes for table `hanghoa`
--
ALTER TABLE `hanghoa`
  ADD PRIMARY KEY (`MSHH`),
  ADD KEY `MaLoaiHang_hanghoa` (`MaLoaiHang`);

--
-- Indexes for table `hinhhanghoa`
--
ALTER TABLE `hinhhanghoa`
  ADD PRIMARY KEY (`MaHinh`),
  ADD KEY `MSHH_HinhHangHoa` (`MSHH`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`MSKH`),
  ADD UNIQUE KEY `unique_username_khachhang` (`username`);

--
-- Indexes for table `loaihanghoa`
--
ALTER TABLE `loaihanghoa`
  ADD PRIMARY KEY (`MaLoaiHang`);

--
-- Indexes for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD UNIQUE KEY `unique_nhanvien` (`MSNV`),
  ADD UNIQUE KEY `unique_username_nhanvien` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dathang`
--
ALTER TABLE `dathang`
  MODIFY `SoDonDH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `diachikh`
--
ALTER TABLE `diachikh`
  MODIFY `MaDC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `hinhhanghoa`
--
ALTER TABLE `hinhhanghoa`
  MODIFY `MaHinh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `loaihanghoa`
--
ALTER TABLE `loaihanghoa`
  MODIFY `MaLoaiHang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chitietdathang`
--
ALTER TABLE `chitietdathang`
  ADD CONSTRAINT `MSHH_Chitietdathang` FOREIGN KEY (`MSHH`) REFERENCES `hanghoa` (`MSHH`) ON UPDATE CASCADE,
  ADD CONSTRAINT `MaDC_chitietdathang` FOREIGN KEY (`MaDC`) REFERENCES `diachikh` (`MaDC`),
  ADD CONSTRAINT `SoDonDH` FOREIGN KEY (`SoDonDH`) REFERENCES `dathang` (`SoDonDH`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dathang`
--
ALTER TABLE `dathang`
  ADD CONSTRAINT `MSKH_DatHang` FOREIGN KEY (`MSKH`) REFERENCES `khachhang` (`MSKH`) ON UPDATE CASCADE,
  ADD CONSTRAINT `MSNV_DatHang` FOREIGN KEY (`MSNV`) REFERENCES `nhanvien` (`MSNV`) ON UPDATE CASCADE,
  ADD CONSTRAINT `MaDC_DatHang` FOREIGN KEY (`MaDC`) REFERENCES `diachikh` (`MaDC`) ON UPDATE CASCADE;

--
-- Constraints for table `diachikh`
--
ALTER TABLE `diachikh`
  ADD CONSTRAINT `MSKH_DiachiKH` FOREIGN KEY (`MSKH`) REFERENCES `khachhang` (`MSKH`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hanghoa`
--
ALTER TABLE `hanghoa`
  ADD CONSTRAINT `MaLoaiHang_hanghoa` FOREIGN KEY (`MaLoaiHang`) REFERENCES `loaihanghoa` (`MaLoaiHang`);

--
-- Constraints for table `hinhhanghoa`
--
ALTER TABLE `hinhhanghoa`
  ADD CONSTRAINT `MSHH_HinhHangHoa` FOREIGN KEY (`MSHH`) REFERENCES `hanghoa` (`MSHH`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
