-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2025 at 08:59 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carserv`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `BookingID` int(11) NOT NULL,
  `BookingCode` varchar(20) NOT NULL,
  `CustomerName` varchar(100) NOT NULL,
  `CustomerPhoneNumber` varchar(20) NOT NULL,
  `CustomerEmail` varchar(100) DEFAULT NULL,
  `CarID` int(11) DEFAULT NULL,
  `BookingDate` date NOT NULL,
  `Time` time DEFAULT NULL,
  `Notes` text DEFAULT NULL,
  `EstimatedCompletionTime` datetime DEFAULT NULL,
  `ActualCompletionTime` datetime DEFAULT NULL,
  `TotalPrice` int(11) DEFAULT NULL,
  `StaffID` int(11) DEFAULT NULL,
  `CancellationReason` text DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `StatusID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`BookingID`, `BookingCode`, `CustomerName`, `CustomerPhoneNumber`, `CustomerEmail`, `CarID`, `BookingDate`, `Time`, `Notes`, `EstimatedCompletionTime`, `ActualCompletionTime`, `TotalPrice`, `StaffID`, `CancellationReason`, `CreatedAt`, `UpdatedAt`, `StatusID`) VALUES
(1, 'BK240001', 'Trần Văn An', '0911223344', 'an.tv@example.com', 1, '2024-05-15', NULL, 'Kiểm tra định kỳ, thay nhớt.', '2025-05-15 10:30:00', NULL, NULL, 2, NULL, '2025-05-08 10:47:22', '2025-05-08 14:49:48', 1),
(2, 'BK240002', 'Lê Thị Bình', '0922334455', 'binh.lt@example.com', 2, '2024-05-15', NULL, 'Xe có tiếng kêu lạ ở gầm trước.', '2025-05-15 16:30:00', NULL, NULL, 3, NULL, '2025-05-08 10:47:22', '2025-05-08 14:49:52', 2),
(3, 'BK240003', 'Phạm Văn Chiến', '0933445566', 'chien.pv@example.com', 3, '2024-05-16', NULL, 'Sơn lại cản sau bị trầy.', '2025-05-17 17:00:00', NULL, NULL, 4, NULL, '2025-05-08 10:47:22', '2025-05-08 14:49:55', 2),
(4, 'BK240004', 'Hoàng Thị Dung', '0944556677', 'dung.ht@example.com', 4, '2024-05-16', NULL, 'Vệ sinh nội thất, rửa xe.', '2025-05-16 15:30:00', '2025-05-16 15:15:00', 250000, 6, NULL, '2025-05-08 10:47:22', '2025-05-08 14:50:03', 4),
(5, 'BK240005', 'Ngô Văn Giang', '0955667788', 'giang.nv@example.com', 5, '2024-05-17', NULL, 'Thay 2 lốp trước.', '2025-05-17 11:30:00', '2025-05-17 11:10:00', 2400000, 7, NULL, '2025-05-08 10:47:22', '2025-05-08 14:50:17', 9),
(6, 'BK240006', 'Vũ Thị Hà', '0966778899', 'ha.vt@example.com', 6, '2024-05-17', NULL, 'Kiểm tra hệ thống điện, đèn pha không sáng.', NULL, NULL, NULL, 8, NULL, '2025-05-08 10:47:22', '2025-05-08 10:47:22', 7),
(7, 'BK240007', 'Đỗ Văn Hùng', '0977889900', 'hung.dv@example.com', 7, '2024-05-18', NULL, NULL, '2024-05-18 10:00:00', NULL, NULL, 9, NULL, '2025-05-08 10:47:22', '2025-05-08 10:47:22', 8),
(8, 'BK240008', 'Bùi Thị Lan', '0988990011', 'lan.bt@example.com', 8, '2024-05-18', NULL, 'Bảo dưỡng nhanh.', '2024-05-18 15:30:00', NULL, NULL, 10, 'Khách báo bận đột xuất.', '2025-05-08 10:47:22', '2025-05-08 10:47:22', 5),
(9, 'BK240009', 'Lý Văn Minh', '0900112233', 'minh.lv@example.com', 9, '2024-05-19', NULL, 'Kiểm tra điều hòa không mát.', NULL, NULL, NULL, 2, NULL, '2025-05-08 10:47:22', '2025-05-08 10:47:22', 3),
(10, 'BK240010', 'Trần Ngọc Nga', '0911002211', 'nga.tn@example.com', 10, '2024-05-19', NULL, 'Đánh bóng xe.', '2025-05-20 12:00:00', NULL, NULL, 3, 'Không đủ nhân lực.', '2025-05-08 10:47:22', '2025-05-08 14:50:21', 6),
(11, 'BK20250511043219', '1', '0932105214', 'khacduy584@gmail.com', 11, '2025-05-15', '00:00:02', 'Ghi chú thêm (Tùy chọn)', NULL, NULL, 1550000, NULL, NULL, '2025-05-11 02:32:19', '2025-05-11 02:32:19', 1),
(12, 'BK20250511043944', 'Nguyễn Khắc Duy', '0932105214', 'khacduy584@gmail.com', 11, '2025-05-15', '11:00:00', 'Ghi chú thêm (Tùy chọn)', NULL, NULL, 1100000, NULL, NULL, '2025-05-11 02:39:44', '2025-05-12 08:20:58', 5),
(13, 'BK20250511045934', 'Lê Hoàng Yến', '0932105214', 'khacduy584@gmail.com', 11, '2025-05-15', '08:00:00', 'Ghi chú thêm (Tùy chọn)', NULL, NULL, 2120000, NULL, NULL, '2025-05-11 02:59:34', '2025-05-11 02:59:34', 1),
(14, 'BK20250511050215', 'Lê Hoàng Yến', '0932105214', 'khacduy584@gmail.com', 11, '2025-05-15', '08:00:00', 'Ghi chú thêm (Tùy chọn)', NULL, NULL, 2120000, NULL, NULL, '2025-05-11 03:02:15', '2025-05-11 03:02:15', 1),
(15, 'BK20250511050832', 'Nguyễn Khắc Duy', '0932105214', 'khacduy584@gmail.com', 11, '2025-05-15', '10:00:00', 'Ghi chú thêm (Tùy chọn)', NULL, NULL, 3620000, NULL, NULL, '2025-05-11 03:08:32', '2025-05-12 08:25:04', 5),
(16, 'BK20250511053104', 'Nguyễn Khắc Duy', '0932105214', 'khacduy584@gmail.com', 11, '2025-05-15', '13:00:00', 'Ghi chú thêm (Tùy chọn)', NULL, NULL, 2270000, NULL, NULL, '2025-05-11 03:31:04', '2025-05-12 08:27:18', 5),
(17, 'BK20250511053312', 'Nguyễn Khắc Duy', '0932105214', 'khacduy584@gmail.com', 11, '2025-05-15', '10:00:00', 'Ghi chú thêm (Tùy chọn)', NULL, NULL, 900000, NULL, NULL, '2025-05-11 03:33:12', '2025-05-12 08:29:28', 5),
(18, 'BK20250511054247', 'Nguyễn Khắc Duy', '0932105214', 'khacduy584@gmail.com', 11, '2025-05-15', '13:00:00', 'Ghi chú thêm (Tùy chọn)', NULL, NULL, 1850000, NULL, NULL, '2025-05-11 03:42:47', '2025-05-12 08:29:34', 5),
(19, 'BK20250511055742', 'Nguyễn Khắc Duy', '0932105214', 'khacduy584@gmail.com', 11, '2025-05-15', '15:00:00', 'Ghi chú thêm (Tùy chọn)', NULL, NULL, 1550000, NULL, NULL, '2025-05-11 03:57:42', '2025-05-12 08:29:36', 5),
(20, 'BK20250511060224', 'Nguyễn Khắc Duy', '0932105214', 'khacduy584@gmail.com', 11, '2025-05-15', '15:00:00', 'Ghi chú thêm (Tùy chọn)', NULL, NULL, 2800000, NULL, NULL, '2025-05-11 04:02:24', '2025-05-12 08:29:39', 5),
(21, 'BK20250511061347', 'Nguyễn Khắc Duy', '0932105214', 'khacduy584@gmail.com', 11, '2025-05-15', '16:00:00', 'Ghi chú thêm (Tùy chọn)', NULL, NULL, 3620000, NULL, NULL, '2025-05-11 04:13:47', '2025-05-12 08:32:43', 5),
(22, 'BK20250511062855', 'Nguyễn Khắc Duy', '0932105214', 'khacduy584@gmail.com', 11, '2025-05-15', '16:00:00', 'Ghi chú thêm (Tùy chọn)', NULL, NULL, 4250000, NULL, NULL, '2025-05-11 04:28:55', '2025-05-12 08:34:02', 5),
(23, 'BK202505121042557810', 'Nguyễn Khắc Duy', '0932105214', 'khacduy584@gmail.com', 13, '2025-05-15', '13:00:00', 'Ghi chú thêm (Tùy chọn)', NULL, NULL, 1350000, NULL, NULL, '2025-05-12 08:42:55', '2025-05-12 08:44:56', 5),
(24, 'BK202505121057034637', 'Nguyễn Khắc Duy', '0932105214', 'khacduy584@gmail.com', 13, '2025-05-15', '13:00:00', 'Ghi chú thêm (Tùy chọn)', NULL, NULL, 1400000, NULL, NULL, '2025-05-12 08:57:03', '2025-05-12 08:57:03', 1),
(25, 'BK20250516084913597', 'Nguyễn Khắc Duy', '0932105214', 'khacduy584@gmail.com', 14, '2025-05-15', '13:00:00', 'Ghi chú thêm (Tùy chọn)', NULL, NULL, 2000000, NULL, NULL, '2025-05-16 06:49:13', '2025-05-16 06:50:07', 5);

-- --------------------------------------------------------

--
-- Table structure for table `bookingservices`
--

CREATE TABLE `bookingservices` (
  `BookingServiceID` int(11) NOT NULL,
  `BookingID` int(11) NOT NULL,
  `ServiceID` int(11) NOT NULL,
  `PriceAtBooking` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookingservices`
--

INSERT INTO `bookingservices` (`BookingServiceID`, `BookingID`, `ServiceID`, `PriceAtBooking`) VALUES
(1, 1, 1, 750000),
(2, 2, 3, 800000),
(3, 3, 5, 1200000),
(4, 4, 6, 120000),
(5, 4, 1, 130000),
(6, 5, 7, 1200000),
(8, 6, 4, 450000),
(9, 7, 2, 150000),
(10, 9, 4, 650000),
(11, 11, 1, 0),
(12, 11, 3, 0),
(13, 12, 1, 750000),
(14, 12, 2, 150000),
(15, 12, 7, 200000),
(16, 13, 1, 750000),
(17, 13, 3, 800000),
(18, 13, 4, 450000),
(19, 13, 6, 120000),
(20, 14, 1, 750000),
(21, 14, 3, 800000),
(22, 14, 4, 450000),
(23, 14, 6, 120000),
(24, 15, 1, 750000),
(25, 15, 3, 800000),
(26, 15, 4, 450000),
(27, 15, 10, 1500000),
(28, 15, 6, 120000),
(29, 16, 1, 750000),
(30, 16, 2, 150000),
(31, 16, 3, 800000),
(32, 16, 4, 450000),
(33, 16, 6, 120000),
(34, 17, 1, 750000),
(35, 17, 2, 150000),
(36, 18, 1, 750000),
(37, 18, 2, 150000),
(38, 18, 4, 450000),
(39, 18, 9, 500000),
(40, 19, 1, 750000),
(41, 19, 3, 800000),
(42, 20, 1, 750000),
(43, 20, 3, 800000),
(44, 20, 4, 450000),
(45, 20, 5, 600000),
(46, 20, 7, 200000),
(47, 21, 2, 150000),
(48, 21, 3, 800000),
(49, 21, 4, 450000),
(50, 21, 5, 600000),
(51, 21, 10, 1500000),
(52, 21, 6, 120000),
(53, 22, 1, 750000),
(54, 22, 2, 150000),
(55, 22, 3, 800000),
(56, 22, 4, 450000),
(57, 22, 5, 600000),
(58, 22, 10, 1500000),
(59, 23, 1, 750000),
(60, 23, 2, 150000),
(61, 23, 4, 450000),
(62, 24, 3, 800000),
(63, 24, 5, 600000),
(64, 25, 1, 750000),
(65, 25, 3, 800000),
(66, 25, 4, 450000);

-- --------------------------------------------------------

--
-- Table structure for table `bookingstatuses`
--

CREATE TABLE `bookingstatuses` (
  `StatusID` int(11) NOT NULL,
  `StatusCode` varchar(50) NOT NULL,
  `StatusName` varchar(100) NOT NULL,
  `Description` text DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookingstatuses`
--

INSERT INTO `bookingstatuses` (`StatusID`, `StatusCode`, `StatusName`, `Description`, `CreatedAt`, `UpdatedAt`) VALUES
(1, 'PENDING', 'Chờ Xác Nhận', 'Lịch hẹn đã được tạo và đang chờ gara xem xét, xác nhận.', '2025-05-08 10:42:30', '2025-05-08 10:42:30'),
(2, 'CONFIRMED', 'Đã Xác Nhận', 'Gara đã xác nhận lịch hẹn với khách hàng.', '2025-05-08 10:42:30', '2025-05-08 10:42:30'),
(3, 'IN_PROGRESS', 'Đang Tiến Hành', 'Xe của khách đang được thực hiện dịch vụ tại gara.', '2025-05-08 10:42:30', '2025-05-08 10:42:30'),
(4, 'COMPLETED', 'Hoàn Thành', 'Dịch vụ đã được thực hiện xong, xe sẵn sàng để giao.', '2025-05-08 10:42:30', '2025-05-08 10:42:30'),
(5, 'CANCELLED_CUSTOMER', 'Khách Hủy', 'Khách hàng đã hủy lịch hẹn.', '2025-05-08 10:42:30', '2025-05-08 10:42:30'),
(6, 'CANCELLED_GARAGE', 'Gara Hủy', 'Gara đã hủy lịch hẹn (có thể do lý do đột xuất).', '2025-05-08 10:42:30', '2025-05-08 10:42:30'),
(7, 'VEHICLE_RECEIVED', 'Đã Tiếp Nhận Xe', 'Gara đã tiếp nhận xe từ khách hàng để bắt đầu dịch vụ.', '2025-05-08 10:42:30', '2025-05-08 10:42:30'),
(8, 'AWAITING_PARTS', 'Chờ Phụ Tùng', 'Dịch vụ đang tạm dừng do cần chờ phụ tùng về.', '2025-05-08 10:42:30', '2025-05-08 10:42:30'),
(9, 'VEHICLE_COLLECTED', 'Khách Đã Nhận Xe', 'Khách hàng đã nhận lại xe sau khi dịch vụ hoàn thành.', '2025-05-08 10:42:30', '2025-05-08 10:42:30'),
(10, 'NO_SHOW', 'Khách Không Đến', 'Khách hàng không đến theo lịch hẹn đã xác nhận.', '2025-05-08 10:42:30', '2025-05-08 10:42:30');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `CarID` int(11) NOT NULL,
  `LicensePlate` varchar(20) NOT NULL,
  `Brand` varchar(50) DEFAULT NULL,
  `Model` varchar(50) DEFAULT NULL,
  `CarYear` int(11) DEFAULT NULL,
  `VIN` varchar(17) DEFAULT NULL,
  `LastServiceDate` timestamp NULL DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`CarID`, `LicensePlate`, `Brand`, `Model`, `CarYear`, `VIN`, `LastServiceDate`, `CreatedAt`, `UpdatedAt`) VALUES
(1, '51K-111.22', 'Toyota', 'Vios G', 2022, 'VIN001TOYOTAVIOS', '2023-12-15 03:00:00', '2025-05-08 10:42:30', '2025-05-08 10:42:30'),
(2, '29A-222.33', 'Honda', 'CRV L', 2021, 'VIN002HONDACRVL', '2024-01-10 07:30:00', '2025-05-08 10:42:30', '2025-05-08 10:42:30'),
(3, '30H-333.44', 'Ford', 'Ranger XLS', 2020, 'VIN003FORDRANGR', NULL, '2025-05-08 10:42:30', '2025-05-08 10:42:30'),
(4, '92B-444.55', 'Kia', 'Seltos Premium', 2023, 'VIN004KIASELTOS', '2024-02-20 02:15:00', '2025-05-08 10:42:30', '2025-05-08 10:42:30'),
(5, '60C-555.66', 'Hyundai', 'Accent AT', 2022, 'VIN005HYUNDAIACT', NULL, '2025-05-08 10:42:30', '2025-05-08 10:42:30'),
(6, '72A-666.77', 'Mazda', 'CX-5 Deluxe', 2021, 'VIN006MAZDACX5D', '2023-11-05 09:00:00', '2025-05-08 10:42:30', '2025-05-08 10:42:30'),
(7, '43X-777.88', 'VinFast', 'Fadil Plus', 2020, 'VIN007VFFADILPL', '2024-03-01 01:30:00', '2025-05-08 10:42:30', '2025-05-08 10:42:30'),
(8, '14P-888.99', 'Mitsubishi', 'Xpander Cross', 2023, 'VIN008MITXPCROS', NULL, '2025-05-08 10:42:30', '2025-05-08 10:42:30'),
(9, '86M-999.00', 'Suzuki', 'Ertiga Hybrid', 2022, 'VIN009SUZERTIGA', '2023-10-25 04:45:00', '2025-05-08 10:42:30', '2025-05-08 10:42:30'),
(10, '37N-000.11', 'BMW', '320i SportLine', 2019, 'VIN010BMW320ISL', '2024-02-28 06:00:00', '2025-05-08 10:42:30', '2025-05-08 10:42:30'),
(11, '43G1-423.11', 'Toyota', 'Vig G', 2022, '12346848610', NULL, '2025-05-11 02:11:34', '2025-05-11 02:11:34'),
(13, '92C1 423 91', 'Toyota', 'Vig G', 2023, 'VIN1234684825', NULL, '2025-05-12 08:42:55', '2025-05-12 08:42:55'),
(14, '43G1 423 11', 'Toyota', 'VIP', 2023, 'VIN12346848611244', NULL, '2025-05-16 06:49:13', '2025-05-16 06:49:13');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `NotificationID` int(11) NOT NULL,
  `RecipientEmail` varchar(100) DEFAULT NULL,
  `RecipientPhoneNumber` varchar(20) DEFAULT NULL,
  `BookingID` int(11) DEFAULT NULL,
  `Subject` varchar(255) DEFAULT NULL,
  `Message` text NOT NULL,
  `Type` enum('Email','SMS','System') NOT NULL,
  `Status` enum('Sent','Failed','Pending') DEFAULT 'Pending',
  `SentAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`NotificationID`, `RecipientEmail`, `RecipientPhoneNumber`, `BookingID`, `Subject`, `Message`, `Type`, `Status`, `SentAt`, `CreatedAt`) VALUES
(1, 'an.tv@example.com', '0911223344', 1, 'Xác nhận yêu cầu đặt lịch BK240001', 'GaraXeVN đã nhận được yêu cầu đặt lịch của bạn. Chúng tôi sẽ liên hệ xác nhận sớm.', 'Email', 'Sent', '2024-05-14 03:00:00', '2025-05-08 10:52:56'),
(2, NULL, '0922334455', 2, NULL, 'Lich hen BK240002 cua ban tai GaraXeVN vao 14:00 15/05/2024 da DUOC XAC NHAN. Vui long den dung gio.', 'SMS', 'Sent', '2024-05-14 04:30:00', '2025-05-08 10:52:56'),
(3, 'chien.pv@example.com', NULL, 3, '[GaraXeVN] Lịch hẹn BK240003 đã được xác nhận', 'Cảm ơn bạn đã đặt lịch. Lịch hẹn BK240003 của bạn đã được xác nhận.', 'Email', 'Pending', '2025-05-08 10:52:56', '2025-05-08 10:52:56'),
(4, NULL, '0944556677', 4, NULL, 'Xe cua ban (BK240004) da hoan thanh dich vu. Tong chi phi: 250.000 VND. Moi ban den nhan xe.', 'SMS', 'Sent', '2024-05-16 08:20:00', '2025-05-08 10:52:56'),
(5, 'giang.nv@example.com', '0955667788', 5, 'Hoàn thành dịch vụ BK240005', 'Dịch vụ thay lốp cho xe của bạn đã hoàn thành. Chi phí: 2.400.000 VND.', 'Email', 'Sent', '2024-05-17 04:15:00', '2025-05-08 10:52:56'),
(6, NULL, '0966778899', 6, NULL, 'GaraXeVN da tiep nhan xe cua ban (BK240006) de kiem tra he thong dien.', 'SMS', 'Sent', '2025-05-08 10:52:56', '2025-05-08 10:52:56'),
(7, 'hung.dv@example.com', NULL, 7, '[Thông báo] Lịch hẹn BK240007 - Chờ phụ tùng', 'Dịch vụ cho xe của bạn (BK240007) đang cần chờ phụ tùng. Chúng tôi sẽ thông báo khi có cập nhật.', 'Email', 'Failed', '2025-05-08 10:52:56', '2025-05-08 10:52:56'),
(8, NULL, '0988990011', 8, NULL, 'Rat tiec, lich hen BK240008 cua ban da bi HUY theo yeu cau. Neu co nhu cau dat lai, vui long lien he GaraXeVN.', 'SMS', 'Sent', '2025-05-08 10:52:56', '2025-05-08 10:52:56'),
(9, 'minh.lv@example.com', NULL, 9, '[GaraXeVN] Cập nhật trạng thái lịch hẹn BK240009', 'Xe của bạn (BK240009) đang được kỹ thuật viên kiểm tra hệ thống điều hòa.', 'Email', 'Sent', '2025-05-08 10:52:56', '2025-05-08 10:52:56'),
(10, NULL, '0911002211', 10, NULL, 'Xin loi quy khach, lich hen BK240010 buoc phai HUY do gara qua tai. Mong quy khach thong cam va dat lai vao ngay khac.', 'SMS', 'Sent', '2025-05-08 10:52:56', '2025-05-08 10:52:56'),
(11, 'khacduy584@gmail.com', '0932105214', 22, 'Thông báo dịch vụ Carserv', '<div style=\"font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;\">\n                            <div style=\"max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; padding: 20px;\">\n                                <h2 style=\"color: #fd4f0d; text-align: center;\">Lịch hẹn của bạn đã được ghi nhận</h2>\n                                <p>Xin chào <strong>Nguyễn Khắc Duy</strong>,</p><p>Cảm ơn bạn đã gửi yêu cầu. Chúng tôi xin thông báo rằng lịch hẹn của bạn đã được ghi nhận. Vui lòng xem chi tiết bên dưới:</p><div style=\"display: flex; flex-direction: row; \">\n                                <div style=\"flex: 0 0 auto; width: 50%;\">\n                                    <p><strong>Mã booking:</strong> BK20250511062855</p></div>\n                                <div style=\"flex: 0 0 auto; width: 50%;\">\n                                    <p><strong>Ngày giờ hẹn:</strong> 16:00:00 - 17:00:00, 2025-05-15 </p>\n                                </div>\n                            </div><div style=\"display: flex; flex-direction: row; \"><div style=\"flex: 0 0 auto; width: 50%;\"><p><strong>Thông tin người đăng ký:</strong></p><p style=\"font-size: 14px; color: #555;\"><strong>Tên:</strong> Nguyễn Khắc Duy</p><p style=\"font-size: 14px; color: #555;\"><strong>Số điện thoại:</strong> 0932105214</p><p style=\"font-size: 14px; color: #555;\"><strong>Email:</strong> khacduy584@gmail.com</p></div><div style=\"flex: 0 0 auto; width: 50%; margin-left: auto !important;\"><p><strong>Thông tin xe:</strong></p><p style=\"font-size: 14px; color: #555;\"><strong>Hãng xe:</strong> Toyota</p><p style=\"font-size: 14px; color: #555;\"><strong>Dòng xe:</strong> Vig G</p><p style=\"font-size: 14px; color: #555;\"><strong>Năm sản xuất:</strong> 2022</p><p style=\"font-size: 14px; color: #555;\"><strong>Biển số xe:</strong> 43G1-423.11</p></div></div><p><strong>Thông tin dịch vụ:</strong></p><p>- Thay Nhớt Máy và Lọc Nhớt (750.000 VNĐ) <br>- Kiểm Tra và Bổ Sung Nước Làm Mát (150.000 VNĐ) <br>- Sửa Chữa Hệ Thống Treo (800.000 VNĐ) <br>- Sửa Chữa Hệ Thống Khởi Động (450.000 VNĐ) <br>- Sơn Dặm Vết Xước (600.000 VNĐ) <br>- Đánh Bóng Toàn Thân Xe (1.500.000 VNĐ) <br></p><p><strong>Tổng giá:</strong> 4.250.000 VNĐ</p><p>Chúng tôi luôn sẵn sàng hỗ trợ bạn!</p><div style=\"margin-top: 20px;\"><p style=\"font-size: 14px; color: #555;\">Trân trọng,<br><strong>Đội ngũ Carserv</strong></p><p style=\"font-size: 14px; color: #888;\">Địa chỉ: 84 Nguyễn Hữu Dật, Hải Châu, Đà Nẵng, Việt Nam<br>Email: info@carserv.com<br>Điện thoại: 0932105214</p></div><hr style=\"border: 0; border-top: 1px solid #eee; margin: 20px 0;\"><p style=\"text-align: center; font-size: 12px; color: #aaa;\">© 2024 Carserv. Tất cả các quyền được bảo lưu.</p></div></div>', 'Email', 'Sent', '2025-05-11 04:29:26', '2025-05-10 23:28:57'),
(12, 'khacduy584@gmail.com', '0932105214', 23, 'Thông báo dịch vụ Carserv', '<div style=\"font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;\">\r\n                            <div style=\"max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; padding: 20px;\">\r\n                                <h2 style=\"color: #fd4f0d; text-align: center;\">Lịch hẹn của bạn đã được ghi nhận</h2>\r\n                                <p>Xin chào <strong>Nguyễn Khắc Duy</strong>,</p><p>Cảm ơn bạn đã gửi yêu cầu. Chúng tôi xin thông báo rằng lịch hẹn của bạn đã được ghi nhận. Vui lòng xem chi tiết bên dưới:</p><div style=\"display: flex; flex-direction: row; \">\r\n                                <div style=\"flex: 0 0 auto; width: 50%;\">\r\n                                    <p><strong>Mã booking:</strong> BK202505121042557810</p></div>\r\n                                <div style=\"flex: 0 0 auto; width: 50%;\">\r\n                                    <p><strong>Ngày giờ hẹn:</strong> 13:00:00 - 14:00:00, 2025-05-15 </p>\r\n                                </div>\r\n                            </div><div style=\"display: flex; flex-direction: row; \"><div style=\"flex: 0 0 auto; width: 50%;\"><p><strong>Thông tin người đăng ký:</strong></p><p style=\"font-size: 14px; color: #555;\"><strong>Tên:</strong> Nguyễn Khắc Duy</p><p style=\"font-size: 14px; color: #555;\"><strong>Số điện thoại:</strong> 0932105214</p><p style=\"font-size: 14px; color: #555;\"><strong>Email:</strong> khacduy584@gmail.com</p></div><div style=\"flex: 0 0 auto; width: 50%; margin-left: auto !important;\"><p><strong>Thông tin xe:</strong></p><p style=\"font-size: 14px; color: #555;\"><strong>Hãng xe:</strong> Toyota</p><p style=\"font-size: 14px; color: #555;\"><strong>Dòng xe:</strong> Vig G</p><p style=\"font-size: 14px; color: #555;\"><strong>Năm sản xuất:</strong> 2023</p><p style=\"font-size: 14px; color: #555;\"><strong>Biển số xe:</strong> 92C1 423 91</p></div></div><p><strong>Thông tin dịch vụ:</strong></p><p>- Thay Nhớt Máy và Lọc Nhớt (750.000 VNĐ) <br>- Kiểm Tra và Bổ Sung Nước Làm Mát (150.000 VNĐ) <br>- Sửa Chữa Hệ Thống Khởi Động (450.000 VNĐ) <br></p><p><strong>Tổng giá:</strong> 1.350.000 VNĐ</p><p>Chúng tôi luôn sẵn sàng hỗ trợ bạn!</p><div style=\"margin-top: 20px;\"><p style=\"font-size: 14px; color: #555;\">Trân trọng,<br><strong>Đội ngũ Carserv</strong></p><p style=\"font-size: 14px; color: #888;\">Địa chỉ: 84 Nguyễn Hữu Dật, Hải Châu, Đà Nẵng, Việt Nam<br>Email: info@carserv.com<br>Điện thoại: 0932105214</p></div><hr style=\"border: 0; border-top: 1px solid #eee; margin: 20px 0;\"><p style=\"text-align: center; font-size: 12px; color: #aaa;\">© 2024 Carserv. Tất cả các quyền được bảo lưu.</p></div></div>', 'Email', 'Sent', '2025-05-12 03:42:59', '2025-05-12 03:42:59'),
(13, 'khacduy584@gmail.com', '0932105214', 24, 'Thông báo dịch vụ Carserv', '<div style=\"font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;\">\r\n                            <div style=\"max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; padding: 20px;\">\r\n                                <h2 style=\"color: #fd4f0d; text-align: center;\">Lịch hẹn của bạn đã được ghi nhận</h2>\r\n                                <p>Xin chào <strong>Nguyễn Khắc Duy</strong>,</p><p>Cảm ơn bạn đã gửi yêu cầu. Chúng tôi xin thông báo rằng lịch hẹn của bạn đã được ghi nhận. Vui lòng xem chi tiết bên dưới:</p><div style=\"display: flex; flex-direction: row; \">\r\n                                <div style=\"flex: 0 0 auto; width: 50%;\">\r\n                                    <p><strong>Mã booking:</strong> BK202505121057034637</p></div>\r\n                                <div style=\"flex: 0 0 auto; width: 50%;\">\r\n                                    <p><strong>Ngày giờ hẹn:</strong> 13:00:00 - 14:00:00, 2025-05-15 </p>\r\n                                </div>\r\n                            </div><div style=\"display: flex; flex-direction: row; \"><div style=\"flex: 0 0 auto; width: 50%;\"><p><strong>Thông tin người đăng ký:</strong></p><p style=\"font-size: 14px; color: #555;\"><strong>Tên:</strong> Nguyễn Khắc Duy</p><p style=\"font-size: 14px; color: #555;\"><strong>Số điện thoại:</strong> 0932105214</p><p style=\"font-size: 14px; color: #555;\"><strong>Email:</strong> khacduy584@gmail.com</p></div><div style=\"flex: 0 0 auto; width: 50%; margin-left: auto !important;\"><p><strong>Thông tin xe:</strong></p><p style=\"font-size: 14px; color: #555;\"><strong>Hãng xe:</strong> Toyota</p><p style=\"font-size: 14px; color: #555;\"><strong>Dòng xe:</strong> Vig G</p><p style=\"font-size: 14px; color: #555;\"><strong>Năm sản xuất:</strong> 2023</p><p style=\"font-size: 14px; color: #555;\"><strong>Biển số xe:</strong> 92C1 423 91</p></div></div><p><strong>Thông tin dịch vụ:</strong></p><p>- Sửa Chữa Hệ Thống Treo (800.000 VNĐ) <br>- Sơn Dặm Vết Xước (600.000 VNĐ) <br></p><p><strong>Tổng giá:</strong> 1.400.000 VNĐ</p><p>Chúng tôi luôn sẵn sàng hỗ trợ bạn!</p><div style=\"margin-top: 20px;\"><p style=\"font-size: 14px; color: #555;\">Trân trọng,<br><strong>Đội ngũ Carserv</strong></p><p style=\"font-size: 14px; color: #888;\">Địa chỉ: 84 Nguyễn Hữu Dật, Hải Châu, Đà Nẵng, Việt Nam<br>Email: info@carserv.com<br>Điện thoại: 0932105214</p></div><hr style=\"border: 0; border-top: 1px solid #eee; margin: 20px 0;\"><p style=\"text-align: center; font-size: 12px; color: #aaa;\">© 2024 Carserv. Tất cả các quyền được bảo lưu.</p></div></div>', 'Email', 'Sent', '2025-05-12 03:57:06', '2025-05-12 03:57:06'),
(14, 'khacduy584@gmail.com', '0932105214', 25, 'Thông báo dịch vụ Carserv', '<div style=\"font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;\">\r\n                            <div style=\"max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; padding: 20px;\">\r\n                                <h2 style=\"color: #fd4f0d; text-align: center;\">Lịch hẹn của bạn đã được ghi nhận</h2>\r\n                                <p>Xin chào <strong>Nguyễn Khắc Duy</strong>,</p><p>Cảm ơn bạn đã gửi yêu cầu. Chúng tôi xin thông báo rằng lịch hẹn của bạn đã được ghi nhận. Vui lòng xem chi tiết bên dưới:</p><div style=\"display: flex; flex-direction: row; \">\r\n                                <div style=\"flex: 0 0 auto; width: 50%;\">\r\n                                    <p><strong>Mã booking:</strong> BK20250516084913597</p></div>\r\n                                <div style=\"flex: 0 0 auto; width: 50%;\">\r\n                                    <p><strong>Ngày giờ hẹn:</strong> 13:00:00 - 14:00:00, 2025-05-15 </p>\r\n                                </div>\r\n                            </div><div style=\"display: flex; flex-direction: row; \"><div style=\"flex: 0 0 auto; width: 50%;\"><p><strong>Thông tin người đăng ký:</strong></p><p style=\"font-size: 14px; color: #555;\"><strong>Tên:</strong> Nguyễn Khắc Duy</p><p style=\"font-size: 14px; color: #555;\"><strong>Số điện thoại:</strong> 0932105214</p><p style=\"font-size: 14px; color: #555;\"><strong>Email:</strong> khacduy584@gmail.com</p></div><div style=\"flex: 0 0 auto; width: 50%; margin-left: auto !important;\"><p><strong>Thông tin xe:</strong></p><p style=\"font-size: 14px; color: #555;\"><strong>Hãng xe:</strong> Toyota</p><p style=\"font-size: 14px; color: #555;\"><strong>Dòng xe:</strong> VIP</p><p style=\"font-size: 14px; color: #555;\"><strong>Năm sản xuất:</strong> 2023</p><p style=\"font-size: 14px; color: #555;\"><strong>Biển số xe:</strong> 43G1 423 11</p></div></div><p><strong>Thông tin dịch vụ:</strong></p><p>- Thay Nhớt Máy và Lọc Nhớt (750.000 VNĐ) <br>- Sửa Chữa Hệ Thống Treo (800.000 VNĐ) <br>- Sửa Chữa Hệ Thống Khởi Động (450.000 VNĐ) <br></p><p><strong>Tổng giá:</strong> 2.000.000 VNĐ</p><p>Chúng tôi luôn sẵn sàng hỗ trợ bạn!</p><div style=\"margin-top: 20px;\"><p style=\"font-size: 14px; color: #555;\">Trân trọng,<br><strong>Đội ngũ Carserv</strong></p><p style=\"font-size: 14px; color: #888;\">Địa chỉ: 84 Nguyễn Hữu Dật, Hải Châu, Đà Nẵng, Việt Nam<br>Email: info@carserv.com<br>Điện thoại: 0932105214</p></div><hr style=\"border: 0; border-top: 1px solid #eee; margin: 20px 0;\"><p style=\"text-align: center; font-size: 12px; color: #aaa;\">© 2024 Carserv. Tất cả các quyền được bảo lưu.</p></div></div>', 'Email', 'Sent', '2025-05-16 01:49:17', '2025-05-16 01:49:17');

-- --------------------------------------------------------

--
-- Table structure for table `servicecategories`
--

CREATE TABLE `servicecategories` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(100) NOT NULL,
  `Description` text DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `DeletedAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `servicecategories`
--

INSERT INTO `servicecategories` (`CategoryID`, `CategoryName`, `Description`, `parent_id`, `CreatedAt`, `UpdatedAt`, `DeletedAt`) VALUES
(1, 'Bảo Dưỡng Định Kỳ', 'Các dịch vụ bảo dưỡng theo khuyến cáo của nhà sản xuất.', NULL, '2025-05-08 10:42:30', '2025-05-08 10:42:30', NULL),
(2, 'Sửa Chữa Máy - Gầm', 'Khắc phục các sự cố liên quan đến động cơ và hệ thống gầm xe.', NULL, '2025-05-08 10:42:30', '2025-05-08 10:42:30', NULL),
(3, 'Sửa Chữa Điện - Điện Tử', 'Kiểm tra và sửa chữa hệ thống điện, cảm biến, ECU.', NULL, '2025-05-08 10:42:30', '2025-05-08 10:42:30', NULL),
(4, 'Đồng Sơn Ô Tô', 'Dịch vụ làm đồng, sơn lại xe, phục hồi xe sau va chạm.', NULL, '2025-05-08 10:42:30', '2025-05-08 10:42:30', NULL),
(5, 'Chăm Sóc Xe Chuyên Nghiệp', 'Các dịch vụ làm đẹp, vệ sinh, bảo vệ xe.', NULL, '2025-05-08 10:42:30', '2025-05-08 10:42:30', NULL),
(6, 'Lốp Xe (Vỏ Xe)', 'Kiểm tra, vá, thay thế lốp xe.', NULL, '2025-05-08 10:42:30', '2025-05-08 10:42:30', NULL),
(7, 'Phụ Tùng & Phụ Kiện', 'Cung cấp và lắp đặt phụ tùng, phụ kiện chính hãng và OEM.', NULL, '2025-05-08 10:42:30', '2025-05-08 10:42:30', NULL),
(8, 'Bảo Dưỡng Nhanh', 'Các dịch vụ bảo dưỡng cơ bản, thời gian thực hiện nhanh.', 1, '2025-05-08 10:42:30', '2025-05-08 10:42:30', NULL),
(9, 'Kiểm Tra Tổng Quát', 'Dịch vụ kiểm tra toàn diện tình trạng xe.', NULL, '2025-05-08 10:42:30', '2025-05-08 10:42:30', NULL),
(10, 'Dịch Vụ Cứu Hộ', 'Hỗ trợ cứu hộ xe gặp sự cố trên đường.', NULL, '2025-05-08 10:42:30', '2025-05-08 10:42:30', '2023-12-31 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `ServiceID` int(11) NOT NULL,
  `CategoryID` int(11) DEFAULT NULL,
  `ServiceName` varchar(200) NOT NULL,
  `Description` text DEFAULT NULL,
  `EstimatedDuration` int(11) DEFAULT NULL,
  `BasePrice` int(11) DEFAULT NULL,
  `ImageURL` varchar(255) DEFAULT NULL,
  `IsActive` tinyint(1) DEFAULT 1,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`ServiceID`, `CategoryID`, `ServiceName`, `Description`, `EstimatedDuration`, `BasePrice`, `ImageURL`, `IsActive`, `CreatedAt`, `UpdatedAt`) VALUES
(1, 1, 'Thay Nhớt Máy và Lọc Nhớt', 'Sử dụng nhớt chính hãng, thay lọc nhớt.', 45, 750000, 'images/thay_nhot.jpg', 1, '2025-05-08 10:42:30', '2025-05-08 10:42:30'),
(2, 1, 'Kiểm Tra và Bổ Sung Nước Làm Mát', 'Kiểm tra mức nước làm mát, bổ sung nếu cần.', 30, 150000, 'images/nuoc_lam_mat.jpg', 1, '2025-05-08 10:42:30', '2025-05-08 10:42:30'),
(3, 2, 'Sửa Chữa Hệ Thống Treo', 'Kiểm tra giảm xóc, rotuyn, cao su càng A.', 120, 800000, 'images/he_thong_treo.jpg', 1, '2025-05-08 10:42:30', '2025-05-08 10:42:30'),
(4, 3, 'Sửa Chữa Hệ Thống Khởi Động', 'Kiểm tra bình ắc quy, máy đề.', 90, 450000, 'images/he_thong_khoi_dong.jpg', 1, '2025-05-08 10:42:30', '2025-05-08 10:42:30'),
(5, 4, 'Sơn Dặm Vết Xước', 'Xử lý và sơn lại các vết xước nhỏ trên thân xe.', 180, 600000, 'images/son_dam.jpg', 1, '2025-05-08 10:42:30', '2025-05-08 10:42:30'),
(6, 5, 'Rửa Xe Cao Cấp & Hút Bụi Nội Thất', 'Rửa xe bằng dung dịch chuyên dụng, hút bụi kỹ lưỡng.', 60, 120000, 'images/rua_xe_cao_cap.jpg', 1, '2025-05-08 10:42:30', '2025-05-08 10:42:30'),
(7, 6, 'Cân Bằng Động Lốp Xe', 'Cân bằng động cho 4 lốp giúp xe vận hành êm ái.', 45, 200000, 'images/can_bang_dong.jpg', 1, '2025-05-08 10:42:30', '2025-05-08 10:42:30'),
(8, 8, 'Thay Lọc Gió Động Cơ', 'Thay thế lọc gió động cơ giúp không khí vào buồng đốt sạch hơn.', 20, 250000, 'images/thay_loc_gio.jpg', 1, '2025-05-08 10:42:30', '2025-05-08 10:42:30'),
(9, 9, 'Kiểm Tra Tổng Quát Trước Đăng Kiểm', 'Kiểm tra các hạng mục theo tiêu chuẩn đăng kiểm.', 150, 500000, 'images/kiem_tra_dang_kiem.jpg', 1, '2025-05-08 10:42:30', '2025-05-08 10:42:30'),
(10, 4, 'Đánh Bóng Toàn Thân Xe', 'Loại bỏ vết xước dăm, tăng độ bóng cho sơn xe.', 300, 1500000, 'images/danh_bong.jpg', 0, '2025-05-08 10:42:30', '2025-05-08 10:42:30');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `StaffID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `FullName` varchar(100) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `Role` enum('Staff','Admin') NOT NULL,
  `IsActive` tinyint(1) DEFAULT 1,
  `access_token` varchar(100) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`StaffID`, `Username`, `Password`, `FullName`, `Email`, `PhoneNumber`, `Role`, `IsActive`, `access_token`, `CreatedAt`, `UpdatedAt`) VALUES
(1, 'admin', '$2y$10$itbqw4uyDmdt71xV5g1RseYArfHSKB3jQhdWtCdk9A77xJJfgIiBu', 'Nguyễn Khắc Duy', '', '', 'Admin', 1, NULL, '2025-05-08 10:47:22', '2025-05-08 10:48:40'),
(2, 'nv001', '$2y$10$YOUR_HASHED_PASSWORD_NV001', 'Trần Thị An', 'an.tt@garaxe.vn', '0912000002', 'Staff', 1, NULL, '2025-05-08 10:47:22', '2025-05-08 10:47:22'),
(3, 'nv002', '$2y$10$YOUR_HASHED_PASSWORD_NV002', 'Lê Minh Bảo', 'bao.lm@garaxe.vn', '0987000003', 'Staff', 1, NULL, '2025-05-08 10:47:22', '2025-05-08 10:47:22'),
(4, 'nv003', '$2y$10$YOUR_HASHED_PASSWORD_NV003', 'Phạm Thị Cúc', 'cuc.pt@garaxe.vn', '0934000004', 'Staff', 1, NULL, '2025-05-08 10:47:22', '2025-05-08 10:47:22'),
(5, 'nv004', '$2y$10$YOUR_HASHED_PASSWORD_NV004', 'Hoàng Văn Dũng', 'dung.hv@garaxe.vn', '0978000005', 'Staff', 0, NULL, '2025-05-08 10:47:22', '2025-05-08 10:47:22'),
(6, 'nv005', '$2y$10$YOUR_HASHED_PASSWORD_NV005', 'Võ Thị Lan', 'lan.vt@garaxe.vn', '0905000006', 'Staff', 1, NULL, '2025-05-08 10:47:22', '2025-05-08 10:47:22'),
(7, 'nv006', '$2y$10$YOUR_HASHED_PASSWORD_NV006', 'Đỗ Gia Hưng', 'hung.dg@garaxe.vn', '0918000007', 'Staff', 1, NULL, '2025-05-08 10:47:22', '2025-05-08 10:47:22'),
(8, 'nv007', '$2y$10$YOUR_HASHED_PASSWORD_NV007', 'Bùi Ngọc Mai', 'mai.bn@garaxe.vn', '0945000008', 'Staff', 1, NULL, '2025-05-08 10:47:22', '2025-05-08 10:47:22'),
(9, 'nv008', '$2y$10$YOUR_HASHED_PASSWORD_NV008', 'Ngô Thanh Phong', 'phong.nt@garaxe.vn', '0965000009', 'Staff', 1, NULL, '2025-05-08 10:47:22', '2025-05-08 10:47:22'),
(10, 'nv009', '$2y$10$YOUR_HASHED_PASSWORD_NV009', 'Trịnh Kim Yến', 'yen.tk@garaxe.vn', '0909000010', 'Staff', 1, NULL, '2025-05-08 10:47:22', '2025-05-08 10:47:22');

-- --------------------------------------------------------

--
-- Table structure for table `systemsettings`
--

CREATE TABLE `systemsettings` (
  `SettingKey` varchar(100) NOT NULL,
  `SettingValue` text DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `systemsettings`
--

INSERT INTO `systemsettings` (`SettingKey`, `SettingValue`, `Description`, `UpdatedAt`) VALUES
('BOOKING_LEAD_TIME_HOURS', '2', 'Thời gian tối thiểu khách hàng có thể đặt lịch trước (tính bằng giờ).', '2025-05-08 10:52:56'),
('DEFAULT_PENDING_STATUS_ID', '1', 'ID của trạng thái \"Chờ Xác Nhận\" trong bảng bookingstatuses.', '2025-05-08 10:52:56'),
('EMAIL_FROM_ADDRESS', 'no-reply@garaxeviet.pro', 'Địa chỉ email gửi đi các thông báo tự động.', '2025-05-08 10:52:56'),
('GARAGE_ADDRESS', '123 Đường Ba Tháng Hai, Phường 10, Quận 10, TP. Hồ Chí Minh', 'Địa chỉ của gara.', '2025-05-08 10:52:56'),
('GARAGE_EMAIL', 'hotro@garaxeviet.pro', 'Địa chỉ email liên hệ chính thức của gara.', '2025-05-08 10:52:56'),
('GARAGE_HOTLINE', '1900 1234', 'Số điện thoại hotline hỗ trợ khách hàng.', '2025-05-08 10:52:56'),
('GARAGE_NAME', 'Gara Xe Việt Pro', 'Tên chính thức của gara hiển thị trên hệ thống.', '2025-05-08 10:52:56'),
('MAX_BOOKING_PER_SLOT', '3', 'Số lượng lịch hẹn tối đa cho mỗi khung giờ.', '2025-05-08 10:52:56'),
('SMS_SENDER_NAME', 'GaraXeVP', 'Tên hiển thị khi gửi SMS cho khách hàng.', '2025-05-08 10:52:56'),
('WEBSITE_URL', 'https://garaxeviet.pro', 'Địa chỉ website của gara.', '2025-05-08 10:52:56');

-- --------------------------------------------------------

--
-- Table structure for table `timeslots`
--

CREATE TABLE `timeslots` (
  `SlotID` int(11) NOT NULL,
  `SlotDate` date NOT NULL,
  `StartTime` time NOT NULL,
  `EndTime` time NOT NULL,
  `MaxCapacity` int(11) NOT NULL DEFAULT 1,
  `BookedCount` int(11) DEFAULT 0,
  `IsAvailable` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timeslots`
--

INSERT INTO `timeslots` (`SlotID`, `SlotDate`, `StartTime`, `EndTime`, `MaxCapacity`, `BookedCount`, `IsAvailable`) VALUES
(1, '2025-05-15', '08:00:00', '09:00:00', 2, 2, 0),
(2, '2025-05-15', '09:00:00', '10:00:00', 2, 2, 0),
(3, '2025-05-15', '10:00:00', '11:00:00', 2, 2, 0),
(4, '2025-05-15', '11:00:00', '12:00:00', 1, 1, 0),
(5, '2025-05-15', '13:00:00', '14:00:00', 10, 5, 5),
(6, '2025-05-15', '14:00:00', '15:00:00', 2, 2, 0),
(7, '2025-05-15', '15:00:00', '16:00:00', 2, 2, 0),
(8, '2025-05-15', '16:00:00', '17:00:00', 2, 2, 0),
(9, '2025-05-16', '08:00:00', '09:00:00', 2, 1, 1),
(10, '2025-05-16', '13:00:00', '14:00:00', 2, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`BookingID`),
  ADD UNIQUE KEY `BookingCode` (`BookingCode`),
  ADD KEY `idx_bookings_booking_code` (`BookingCode`),
  ADD KEY `idx_bookings_booking_date_time` (`BookingDate`),
  ADD KEY `FK_Booking_Status` (`StatusID`),
  ADD KEY `bookings_ibfk_1` (`CarID`),
  ADD KEY `StaffID` (`StaffID`);

--
-- Indexes for table `bookingservices`
--
ALTER TABLE `bookingservices`
  ADD PRIMARY KEY (`BookingServiceID`),
  ADD UNIQUE KEY `BookingID` (`BookingID`,`ServiceID`),
  ADD KEY `ServiceID` (`ServiceID`);

--
-- Indexes for table `bookingstatuses`
--
ALTER TABLE `bookingstatuses`
  ADD PRIMARY KEY (`StatusID`),
  ADD UNIQUE KEY `StatusCode` (`StatusCode`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`CarID`),
  ADD UNIQUE KEY `LicensePlate` (`LicensePlate`),
  ADD UNIQUE KEY `VIN` (`VIN`),
  ADD KEY `idx_cars_license_plate` (`LicensePlate`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`NotificationID`),
  ADD KEY `BookingID` (`BookingID`);

--
-- Indexes for table `servicecategories`
--
ALTER TABLE `servicecategories`
  ADD PRIMARY KEY (`CategoryID`),
  ADD UNIQUE KEY `CategoryName` (`CategoryName`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`ServiceID`),
  ADD KEY `CategoryID` (`CategoryID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`StaffID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `PhoneNumber` (`PhoneNumber`);

--
-- Indexes for table `systemsettings`
--
ALTER TABLE `systemsettings`
  ADD PRIMARY KEY (`SettingKey`);

--
-- Indexes for table `timeslots`
--
ALTER TABLE `timeslots`
  ADD PRIMARY KEY (`SlotID`),
  ADD UNIQUE KEY `SlotDate` (`SlotDate`,`StartTime`,`EndTime`),
  ADD KEY `idx_timeslots_date_start_end` (`SlotDate`,`StartTime`,`EndTime`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `BookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `bookingservices`
--
ALTER TABLE `bookingservices`
  MODIFY `BookingServiceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `bookingstatuses`
--
ALTER TABLE `bookingstatuses`
  MODIFY `StatusID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `CarID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `NotificationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `servicecategories`
--
ALTER TABLE `servicecategories`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `ServiceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `StaffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `timeslots`
--
ALTER TABLE `timeslots`
  MODIFY `SlotID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `FK_Booking_Status` FOREIGN KEY (`StatusID`) REFERENCES `bookingstatuses` (`StatusID`),
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`CarID`) REFERENCES `cars` (`CarID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`StaffID`) REFERENCES `staff` (`StaffID`);

--
-- Constraints for table `bookingservices`
--
ALTER TABLE `bookingservices`
  ADD CONSTRAINT `bookingservices_ibfk_1` FOREIGN KEY (`BookingID`) REFERENCES `bookings` (`BookingID`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookingservices_ibfk_2` FOREIGN KEY (`ServiceID`) REFERENCES `services` (`ServiceID`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`BookingID`) REFERENCES `bookings` (`BookingID`) ON DELETE SET NULL;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `servicecategories` (`CategoryID`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
