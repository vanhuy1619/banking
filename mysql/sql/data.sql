-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: mysql-server
-- Thời gian đã tạo: Th5 31, 2022 lúc 04:41 PM
-- Phiên bản máy phục vụ: 8.0.27
-- Phiên bản PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `bank`
--
CREATE DATABASE IF NOT EXISTS `data` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `data`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `buycard`
--

CREATE TABLE IF NOT EXISTS `buycard` (
  `username` varchar(10) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `nhamang` varchar(10) NOT NULL,
  `moneycard` varchar(6) NOT NULL,
  `soluong` int NOT NULL,
  `idcard` varchar(255) NOT NULL,
  `phigiaodich` varchar(10) NOT NULL,
  `datebuycard` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `buycard`
--

INSERT INTO `buycard` (`username`, `phone`, `nhamang`, `moneycard`, `soluong`, `idcard`, `phigiaodich`, `datebuycard`) VALUES
('8607238642', '0978423478', 'viettel', '20000', 3, '1111145451-1111198303-1111102719--', '0', '2022-05-24 10:17:21'),
('8607238642', '0978423478', 'vinaphone', '50000', 4, '3333397201-3333338350-3333321403-3333324499-', '0', '2022-05-24 10:34:50'),
('4242445040', '0478142222', 'vinaphone', '20000', 2, '3333330355-3333391124---', '0', '2022-05-24 15:17:25'),
('4242445040', '0478142222', 'viettel', '50000', 1, '1111181367----', '0', '2022-05-24 15:18:14'),
('4242445040', '0478142222', 'viettel', '100000', 5, '1111152751-1111141008-1111108712-1111194266-1111115809', '0', '2022-05-24 16:12:32'),
('8249878109', '0929099012', 'viettel', '20000', 1, '1111154996----', '0', '2022-05-25 05:39:38'),
('1628204604', '0929099064', 'viettel', '100000', 1, '1111147577----', '0', '2022-05-26 11:31:59'),
('1628204604', '0929099064', 'viettel', '50000', 1, '1111108666----', '0', '2022-05-26 12:42:19'),
('1628204604', '0929099064', 'viettel', '10000', 1, '1111104609----', '0', '2022-05-26 12:44:54'),
('1628204604', '0929099064', 'viettel', '10000', 1, '1111167093----', '0', '2022-05-26 12:47:19'),
('1628204604', '0929099064', 'viettel', '50000', 3, '1111138397-1111181008-1111181450--', '0', '2022-05-26 12:51:20'),
('1628204604', '0929099064', 'vinaphone', '50000', 3, '3333352917-3333334822-3333374110--', '0', '2022-05-26 12:51:47'),
('1628204604', '0929099064', 'viettel', '10000', 1, '1111179919----', '0', '2022-05-26 14:51:30'),
('1628204604', '0929099064', 'viettel', '10000', 1, '1111141846----', '0', '2022-05-26 14:59:19'),
('1628204604', '0929099064', 'viettel', '20000', 4, '1111144448-1111194256-1111135824-1111147552-', '0', '2022-05-26 14:59:31'),
('1628204604', '0929099064', 'viettel', '50000', 3, '1111128520-1111137147-1111190178--', '0', '2022-05-26 14:59:58'),
('1628204604', '0929099064', 'viettel', '20000', 4, '1111119364-1111136038-1111134737-1111142802-', '0', '2022-05-26 15:01:24'),
('1628204604', '0929099064', 'viettel', '10000', 1, '1111140151----', '0', '2022-05-26 15:26:20'),
('1628204604', '0929099064', 'viettel', '20000', 1, '1111127719----', '0', '2022-05-26 18:44:50'),
('1628204604', '0929099064', 'viettel', '100000', 2, '1111112687-1111121007---', '0', '2022-05-26 18:45:11'),
('1628204604', '0929099064', 'viettel', '20000', 1, '1111122642----', '0', '2022-05-26 18:47:06'),
('1628204604', '0929099064', 'viettel', '10000', 1, '1111161145----', '0', '2022-05-26 18:50:15'),
('1628204604', '0929099064', 'vinaphone', '50000', 3, '3333372983-3333300706-3333396937--', '0', '2022-05-26 19:43:24'),
('1628204604', '0929099064', 'mobifone', '10000', 1, '2222295917----', '0', '2022-05-26 19:53:53'),
('1628204604', '0929099064', 'viettel', '10000', 1, '1111156367----', '0', '2022-05-26 20:42:05'),
('1628204604', '0929099064', 'viettel', '20000', 1, '1111177014----', '0', '2022-05-26 20:43:24'),
('1628204604', '0929099064', 'viettel', '50000', 1, '1111157471----', '0', '2022-05-26 20:43:36'),
('1628204604', '0929099064', 'viettel', '10000', 1, '1111166523----', '0', '2022-05-26 20:43:58'),
('1628204604', '0929099064', 'viettel', '20000', 2, '1111143568-1111107795---', '0', '2022-05-27 06:25:20'),
('4330934118', '0123456789', 'viettel', '20000', 1, '1111182272----', '0', '2022-05-27 06:26:04'),
('8607238642', '0978423478', 'viettel', '100000', 1, '1111123600----', '0', '2022-05-27 18:37:03'),
('8607238642', '0978423478', 'viettel', '10000', 1, '1111188870----', '0', '2022-05-27 19:38:28'),
('8607238642', '0978423478', 'vinaphone', '100000', 1, '3333383854----', '0', '2022-05-27 20:38:03'),
('8607238642', '0978423478', 'mobifone', '10000', 1, '2222296707----', '0', '2022-05-27 20:46:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `card`
--

CREATE TABLE IF NOT EXISTS `card` (
  `idcard` varchar(6) NOT NULL,
  `cvv` varchar(3) NOT NULL,
  `datecard` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `card`
--

INSERT INTO `card` (`idcard`, `cvv`, `datecard`) VALUES
('111111', '411', '2022-10-10'),
('222222', '443', '2022-11-11'),
('333333', '577', '2022-12-12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chuyentien`
--

CREATE TABLE IF NOT EXISTS `chuyentien` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL,
  `phonesend` varchar(10) NOT NULL,
  `phonereceive` varchar(10) NOT NULL,
  `namereceive` varchar(50) NOT NULL,
  `money` varchar(50) NOT NULL,
  `fee` varchar(20) NOT NULL,
  `note` varchar(50) NOT NULL,
  `trangthaichuyen` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `datechuyen` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `chuyentien`
--

INSERT INTO `chuyentien` (`id`, `username`, `phonesend`, `phonereceive`, `namereceive`, `money`, `fee`, `note`, `trangthaichuyen`, `datechuyen`) VALUES
(1, '', '0978423478', '0929099064', 'Mai Văn Mạnh', '3000000', 'Người gửi', 'd', 'Thành công', '2022-05-24 01:41:28'),
(2, '8607238642', '0978423478', '0929099063', 'Nguyễn Văn Huy', '100000', 'Người gửi', 'd', 'Thành công', '2022-05-24 01:46:08'),
(3, '1628204604', '0929099064', '0929099063', 'Nguyễn Văn Huy', '1000000', 'Người gửi', 'd', 'Thành công', '2022-05-24 02:29:58'),
(4, '8607238642', '0978423478', '0929099064', 'Mai Văn Mạnh', '1000000', 'Người gửi', 'ok', 'Thành công', '2022-05-24 04:48:23'),
(5, '4242445040', '0478142222', '0978423478', 'Trần Hoàng Thy Anh', '100000', 'Người gửi', 'Lisa', 'Thành công', '2022-05-24 05:24:53'),
(6, '8607238642', '0978423478', '0478142222', 'Bích Nụ', '4000000', 'Người gửi', 'we', 'Thành công', '2022-05-24 23:16:39'),
(7, '8249878109', '0929099012', '0978423478', 'Trần Hoàng Thy Anh', '100000', 'Người gửi', 'jôi', 'Thành công', '2022-05-25 14:50:44'),
(8, '8249878109', '0929099012', '0929099064', 'Mai Văn Mạnh', '100000', 'Người gửi', 'zalo', 'Thành công', '2022-05-25 20:01:22'),
(9, '1628204604', '0929099064', '0978423478', 'Trần Hoàng Thy Anh', '1000000', 'Người gửi', 'web', 'Thành công', '2022-05-26 18:28:02'),
(10, '', '0123456789', '0978423478', 'Trần Hoàng Thy Anh', '100000', 'Người nhận', 'Chúc mừng sinh nhật', 'Thành công', '2022-05-27 13:17:33'),
(11, 'usernamese', '0123456789', '0929099064', 'Mai Văn Mạnh', '100000', 'Người nhận', 'Đi chợ', 'Thành công', '2022-05-27 13:20:35'),
(12, '4330934118', '0123456789', '0929099012', 'Phạm Băng Băng', '100000', 'Người nhận', 'Học phí', 'Thành công', '2022-05-27 13:23:41'),
(13, '8607238642', '0978423478', '0929099064', 'Mai Văn Mạnh', '100000', 'Người gửi', 'Trả', 'Thành công', '2022-05-28 03:36:56'),
(14, '4330934118', '0123456789', '0823273016', 'Minh Bi', '6000000', 'Người gửi', 'Tessttt', 'Chờ duyệt', '2022-05-31 15:50:52');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `naptien`
--

CREATE TABLE IF NOT EXISTS `naptien` (
  `username` varchar(10) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `idcard` varchar(6) NOT NULL,
  `money` varchar(50) NOT NULL,
  `datenap` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `naptien`
--

INSERT INTO `naptien` (`username`, `phone`, `idcard`, `money`, `datenap`) VALUES
('8607238642', '0978423478', '111111', '10000000', '2022-05-23 18:49:11'),
('8607238642', '0978423478', '111111', '10000000', '2022-05-23 21:31:59'),
('1628204604', '0929099064', '111111', '10000000', '2022-05-23 21:54:43'),
('4242445040', '0478142222', '111111', '10000000', '2022-05-23 22:15:30'),
('4242445040', '0478142222', '222222', '100000', '2022-05-23 22:20:19'),
('8249878109', '0929099012', '111111', '5000000', '2022-05-25 05:38:31'),
('4330934118', '0123456789', '111111', '10000000', '2022-05-27 06:10:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhantien`
--

CREATE TABLE IF NOT EXISTS `nhantien` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `usernamereceive` varchar(10) NOT NULL,
  `namesend` varchar(50) NOT NULL,
  `phonesend` varchar(10) NOT NULL,
  `note` varchar(50) NOT NULL,
  `money` varchar(50) NOT NULL,
  `datenhan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `nhantien`
--

INSERT INTO `nhantien` (`id`, `usernamereceive`, `namesend`, `phonesend`, `note`, `money`, `datenhan`) VALUES
(1, '', 'Trần Hoàng Thy Anh', '0978423478', 'd', '3000000', '2022-05-23 18:41:28'),
(2, '', 'Trần Hoàng Thy Anh', '0978423478', 'd', '100000', '2022-05-23 18:46:08'),
(3, '', 'Mai Văn Mạnh', '0929099064', 'd', '1000000', '2022-05-23 19:29:58'),
(4, '1628204604', 'Trần Hoàng Thy Anh', '0978423478', 'ok', '1000000', '2022-05-23 21:48:23'),
(5, '8607238642', 'Bích Nụ', '0478142222', 'Lisa', '100000', '2022-05-23 22:24:53'),
(6, '4242445040', 'Trần Hoàng Thy Anh', '0978423478', 'we', '4000000', '2022-05-24 16:16:39'),
(7, '8607238642', 'Phạm Băng Băng', '0929099012', 'jôi', '100000', '2022-05-25 07:50:44'),
(8, '1628204604', 'Phạm Băng Băng', '0929099012', 'zalo', '100000', '2022-05-25 13:01:22'),
(9, '8607238642', 'Mai Văn Mạnh', '0929099064', 'web', '1000000', '2022-05-26 11:28:02'),
(10, '8607238642', 'Nguyễn Thị Hương Giang', '0123456789', 'Chúc mừng sinh nhật', '100000', '2022-05-27 06:17:33'),
(11, '1628204604', 'Nguyễn Thị Hương Giang', '0123456789', 'Đi chợ', '100000', '2022-05-27 06:20:35'),
(12, '8249878109', 'Nguyễn Thị Hương Giang', '0123456789', 'Học phí', '100000', '2022-05-27 06:23:41'),
(13, '1628204604', 'Trần Hoàng Thy Anh', '0978423478', 'Trả', '100000', '2022-05-27 20:36:56'),
(17, '', '', '0123456789', '', '6000000', '2022-05-31 16:30:51'),
(18, '', '', '0123456789', '', '6000000', '2022-05-31 16:37:06'),
(19, '', '', '0123456789', '', '6000000', '2022-05-31 16:38:50'),
(20, '', '', '0123456789', '', '6000000', '2022-05-31 16:40:43');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `otp`
--

CREATE TABLE IF NOT EXISTS `otp` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `otp` varchar(6) NOT NULL,
  `dateotp` bigint NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `otp`
--

INSERT INTO `otp` (`id`, `username`, `phone`, `email`, `otp`, `dateotp`) VALUES
(1, '8607238642', '0978423478', 'vipbigbang5xxx@gmail.com', '232583', 1653331267),
(2, '8607238642', '0978423478', 'vipbigbang5xxx@gmail.com', '394216', 1653331539),
(3, '8607238642', '0978423478', 'vipbigbang5xxx@gmail.com', '042090', 1653331794),
(4, '1628204604', '0929099064', 'vanhuy1619@gmail.com', '323478', 1653334167),
(5, '8607238642', '0978423478', 'vipbigbang5xxx@gmail.com', '721025', 1653342491),
(6, '4242445040', '0478142222', 'bichnukpop@gmail.com', '390166', 1653344659),
(7, '8607238642', '0978423478', 'vipbigbang5xxx@gmail.com', '277754', 1653344832),
(8, '8607238642', '0978423478', 'vipbigbang5xxx@gmail.com', '067156', 1653408921),
(9, '8607238642', '0978423478', 'vipbigbang5xxx@gmail.com', '353847', 1653408982),
(10, '8249878109', '0929099012', 'goicombo2018@gmail.com', '903280', 1653465021),
(11, '8249878109', '0929099012', 'goicombo2018@gmail.com', '045974', 1653483635),
(12, '1628204604', '0929099064', 'vanhuy1619@gmail.com', '059801', 1653495981),
(13, '1628204604', '0929099064', 'vanhuy1619@gmail.com', '515642', 1653563417),
(14, '1628204604', '0929099064', 'vanhuy1619@gmail.com', '181907', 1653564453),
(15, '8607238642', '0978423478', 'vipbigbang5xxx@gmail.com', '359192', 1653596547),
(16, '4330934118', '0123456789', 'giangnguyen.011210@gmail.com', '881366', 1653632215),
(17, '4330934118', '0123456789', 'giangnguyen.011210@gmail.com', '324101', 1653632414),
(18, '4330934118', '0123456789', 'giangnguyen.011210@gmail.com', '768367', 1653632603),
(19, '1628204604', '0929099064', 'vanhuy1619@gmail.com', '432775', 1653659841),
(20, '1628204604', '0929099064', 'vanhuy1619@gmail.com', '283072', 1653659975),
(21, '1544219720', '0929099063', 'kwonjiyong2702@gmail.com', '934601', 1653663046),
(22, '1544219720', '0929099063', 'kwonjiyong2702@gmail.com', '853723', 1653663113),
(23, '1544219720', '0929099063', 'kwonjiyong2702@gmail.com', '194447', 1653663166),
(24, '1544219720', '0929099063', 'kwonjiyong2702@gmail.com', '005040', 1653663244),
(25, '1544219720', '0929099063', 'kwonjiyong2702@gmail.com', '854117', 1653663395),
(26, '8607238642', '0978423478', 'vipbigbang5xxx@gmail.com', '722178', 1653681073),
(27, '8607238642', '0978423478', 'vipbigbang5xxx@gmail.com', '495507', 1653683213),
(28, '8607238642', '0978423478', 'vipbigbang5xxx@gmail.com', '245215', 1653683361),
(29, '8607238642', '0978423478', 'vipbigbang5xxx@gmail.com', '470609', 1653683795),
(30, '4330934118', '0123456789', 'giangnguyen.011210@gmail.com', '363018', 1654011589),
(31, '4330934118', '0123456789', 'giangnguyen.011210@gmail.com', '784699', 1654011923);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ruttien`
--

CREATE TABLE IF NOT EXISTS `ruttien` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `idcard` varchar(6) NOT NULL,
  `cvv` varchar(3) NOT NULL,
  `money` varchar(100) NOT NULL,
  `daterut` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `note` varchar(255) NOT NULL,
  `trangthairut` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `ruttien`
--

INSERT INTO `ruttien` (`id`, `username`, `phone`, `idcard`, `cvv`, `money`, `daterut`, `note`, `trangthairut`) VALUES
(1, '4242445040', '0478142222', '111111', '411', '1000000', '2022-05-23 22:16:38', 'Rút', 'Thành công'),
(2, '8607238642', '0978423478', '111111', '411', '10000000', '2022-05-23 23:22:41', '', 'Đang chờ'),
(3, '8607238642', '0978423478', '111111', '411', '1000000', '2022-05-23 23:24:56', 'du lịch', 'Thành công'),
(4, '1628204604', '0929099064', '111111', '411', '2000000', '2022-05-26 10:40:14', '', 'Thành công'),
(5, '4330934118', '0123456789', '111111', '411', '6000000', '2022-05-27 06:36:33', 'Du lịch', 'Đang chờ'),
(6, '4330934118', '0123456789', '111111', '411', '1000000', '2022-05-27 06:38:17', 'Mua đồ', 'Thành công'),
(7, '4330934118', '0123456789', '111111', '411', '7050000', '2022-05-31 13:01:29', '', 'Thành công');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `phone` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `cmndT` varchar(255) NOT NULL,
  `cmndS` varchar(255) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `datecreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `money` float NOT NULL DEFAULT '0',
  `flagrut` int NOT NULL DEFAULT '0',
  `status` varchar(20) NOT NULL,
  `loginfirst` varchar(5) NOT NULL,
  `countfail` int NOT NULL DEFAULT '0',
  `statuslogin` varchar(255) DEFAULT 'NULL',
  `timeblock` bigint NOT NULL DEFAULT '0',
  `block` varchar(255) DEFAULT 'NULL',
  PRIMARY KEY (`phone`,`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`phone`, `email`, `name`, `address`, `cmndT`, `cmndS`, `username`, `password`, `datecreate`, `money`, `flagrut`, `status`, `loginfirst`, `countfail`, `statuslogin`, `timeblock`, `block`) VALUES
('0123456789', 'giangnguyen.011210@gmail.com', 'Nguyễn Thị Hương Giang', 'Nghệ An', '272739028_271240471797914_2433519848008511513_n.jpg', '272774296_1331334490673626_2768273183932690149_n.jpg', '4330934118', '0000000', '2022-05-27 05:56:48', 8700000, 1, 'Đã duyệt', 'false', 0, 'NULL', 0, 'NULL'),
('0471541214', 'khoanguyen30lb@gmail.com', 'Nguyễn Thiên', 'Đức Lợi-Mộ Đức-Quãng Ngãi', 'Screenshot (2).png', 'Screenshot (8).png', '2858573938', '1111111', '2022-05-11 07:44:50', 100000, 0, 'Đã duyệt', 'false', 0, 'NULL', 0, 'NULL'),
('0478142222', 'bichnukpop@gmail.com', 'Bích Nụ', 'Mỹ', '51bedad86dc541011f21ad0b8100c13b.jpg', 'lisa-manoban-mac-global-ambassador.jpg', '4242445040', '0000000', '2022-05-23 22:12:50', 12355000, 1, 'Đã duyệt', 'false', 0, 'NULL', 0, 'NULL'),
('0823273016', '244887438n@gmail.com', 'Minh Bi', '32/7, DT743, Bình Phú, Bình Chuẩn', 'avatar.jpg', 'avatar.jpg', '9504897196', 'rLDmwK', '2022-05-31 14:31:19', 0, 0, 'Chờ xác minh', 'true', 0, 'NULL', 0, 'NULL'),
('0929099012', 'goicombo2018@gmail.com', 'Phạm Băng Băng', 'Đồng Nai', 'Screenshot (15).png', 'Screenshot (18).png', '8249878109', '0000000', '2022-05-25 05:32:55', 4865000, 0, 'Đã duyệt', 'false', 0, 'NULL', 0, 'NULL'),
('0929099063', 'kwonjiyong2702@gmail.com', 'Nguyễn Văn Huy', 'Bình Dương', '275672436_666409987901352_5811510392181224482_n.jpg', '278619898_690478238827860_2118919295754625959_n.jpg', '1544219720', '0000000', '2022-05-01 03:42:57', 11100000, 0, 'Chờ cập nhật', 'false', 7, 'Đăng nhập bất thường', 1653285224, 'Tài khoản bị khóa'),
('0929099064', 'vanhuy1619@gmail.com', 'Mai Văn Mạnh', 'TPHCM', '278619898_690478238827860_2118919295754625959_n.jpg', '275672436_666409987901352_5811510392181224482_n.jpg', '1628204604', '1111111', '2022-05-01 11:59:29', 16640000, 1, 'Chờ cập nhật', 'false', 0, 'NULL', 0, 'NULL'),
('0978423478', 'vipbigbang5xxx@gmail.com', 'Trần Hoàng Thy Anh', 'Bình Dương', 'HU-COVER-ADELE30.png', '175449368_484626846214115_1321062436399150936_n.jpg', '8607238642', '0000000', '2022-05-03 05:27:10', 26195000, 1, 'Đã duyệt', 'false', 0, 'NULL', 0, 'NULL'),
('admin', 'minhbi.18050203@gmail.com', 'Lê Minh Bi', 'Bình Dương', '272739028_271240471797914_2433519848008511513_n.jpg', '272774296_1331334490673626_2768273183932690149_n.jpg', '1234686868', 'admin', '2022-05-29 19:15:45', 10000000, 0, 'Đã duyệt', 'false', 0, 'NULL', 0, 'NULL');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
