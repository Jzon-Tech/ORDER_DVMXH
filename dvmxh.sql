-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2021 at 07:31 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dvmxh`
--

-- --------------------------------------------------------

--
-- Table structure for table `auto-card`
--

CREATE TABLE `auto-card` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `request_id` text NOT NULL,
  `telco` text NOT NULL,
  `amount_origin` int(11) NOT NULL,
  `amount_recieve` int(11) NOT NULL,
  `pin` text NOT NULL,
  `serial` text NOT NULL,
  `status` text NOT NULL,
  `created_time` text NOT NULL,
  `day` text NOT NULL,
  `month` text NOT NULL,
  `year` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auto-momo`
--

CREATE TABLE `auto-momo` (
  `id` int(11) NOT NULL,
  `mode` text NOT NULL,
  `username` text NOT NULL,
  `tranId` text NOT NULL,
  `partnerId` text NOT NULL,
  `partnerName` text NOT NULL,
  `amount` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_time` text NOT NULL,
  `day` text NOT NULL,
  `month` text NOT NULL,
  `year` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auto-zalo-pay`
--

CREATE TABLE `auto-zalo-pay` (
  `id` int(11) NOT NULL,
  `mode` text NOT NULL,
  `transid` text NOT NULL,
  `owner` text NOT NULL,
  `amount` int(11) NOT NULL,
  `comment` text NOT NULL,
  `username` text NOT NULL,
  `created_time` text NOT NULL,
  `day` text NOT NULL,
  `month` text NOT NULL,
  `year` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bank_auto`
--

CREATE TABLE `bank_auto` (
  `id` int(11) NOT NULL,
  `tid` varchar(64) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `amount` int(11) DEFAULT 0,
  `cusum_balance` int(11) DEFAULT 0,
  `time` datetime DEFAULT NULL,
  `bank_sub_acc_id` varchar(64) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `username` varchar(64) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `like_post`
--

CREATE TABLE `like_post` (
  `username` text NOT NULL,
  `post_key` text NOT NULL,
  `created_time` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `list_bank`
--

CREATE TABLE `list_bank` (
  `id` int(11) NOT NULL,
  `logo_bank` text NOT NULL,
  `owner` text NOT NULL,
  `number_account` text NOT NULL,
  `branch` text NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `list_bank`
--

INSERT INTO `list_bank` (`id`, `logo_bank`, `owner`, `number_account`, `branch`, `note`) VALUES
(1, 'https://hrincjobs-pro.s3.amazonaws.com/media/public/filer_public/66/6b/666b7279-64c1-4d52-b6be-be0b76c7b460/logo-mbbank-cmyk.png', 'NGUYEN VAN A', '0123456789023', 'Hà Nội', 'Vui lòng chuyển đúng nội dung, không hỗ trợ khi nhập sai nội dung');

-- --------------------------------------------------------

--
-- Table structure for table `list_server`
--

CREATE TABLE `list_server` (
  `id` int(11) NOT NULL,
  `key` text NOT NULL,
  `slug` text NOT NULL,
  `note` text NOT NULL,
  `price` int(11) NOT NULL,
  `max_order` int(11) NOT NULL,
  `display` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `list_server`
--

INSERT INTO `list_server` (`id`, `key`, `slug`, `note`, `price`, `max_order`, `display`) VALUES
(1, 'e051d529d3ae835a828da681c18bccff', 'facebook-buff-tang-like-bai-viet', 'ghi chú máy chủ abc', 10, 100, 'show'),
(2, '4e181aa5b8b2951e9a8b067b390209a3', 'facebook-buff-tang-cam-xuc-bai-viet', 'máy chủ abcasdasd', 100, 1000, 'show'),
(3, 'dfb9ede63d4dc8bbc9629dbda50f1fc7', 'facebook-buff-tang-cam-xuc-binh-luan', 'ádasdasda', 1000, 1000, 'show'),
(4, '4ada0959734cd498a9b9c7a76a73d568', 'facebook-buff-tang-luot-binh-luan', 'test123123', 1000, 1000, 'show'),
(5, '7787e5ca3107822fcf8f4a9ba2288c9a', 'facebook-buff-tang-luot-theo-doi', 'jzontechasia', 1000, 1000, 'show');

-- --------------------------------------------------------

--
-- Table structure for table `list_service`
--

CREATE TABLE `list_service` (
  `id` int(11) NOT NULL,
  `key` text NOT NULL,
  `name` text NOT NULL,
  `icon` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `list_service`
--

INSERT INTO `list_service` (`id`, `key`, `name`, `icon`) VALUES
(1, 'f38c2ea16fb4797417c3cf74f4c4195d', 'Facebook Buff', 'fab fa-facebook');

-- --------------------------------------------------------

--
-- Table structure for table `list_service_child`
--

CREATE TABLE `list_service_child` (
  `id` int(11) NOT NULL,
  `father` text NOT NULL,
  `slug` text NOT NULL,
  `icon` text NOT NULL,
  `name` text NOT NULL,
  `reactions` text NOT NULL,
  `comment_field` text NOT NULL,
  `warn_msg` text NOT NULL,
  `autoExtractID` text NOT NULL,
  `amount_minimum` int(11) NOT NULL,
  `amount_maximum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `list_service_child`
--

INSERT INTO `list_service_child` (`id`, `father`, `slug`, `icon`, `name`, `reactions`, `comment_field`, `warn_msg`, `autoExtractID`, `amount_minimum`, `amount_maximum`) VALUES
(1, 'f38c2ea16fb4797417c3cf74f4c4195d', 'facebook-buff-tang-like-bai-viet', 'fas fa-thumbs-up', 'Tăng like bài viết', '[\"like|0\"]', 'false', '<ul style=\"color: rgb(129, 51, 51); font-family: Roboto, sans-serif; font-size: 14px;\"><li>Cách lấy link tăng like -&gt;&nbsp;<a href=\"https://bom.to/laylinkbai2\" style=\"color: rgb(50, 131, 246); text-decoration: none;\">https://bom.to/laylinkbai2</a></li><li>( Lưu ý cách kiểm tra id xem có cài được không ) khi bạn lấy link và hệ thống lấy id . b viết id vào sau www.facebook.com/id ( id là id get ra ) rồi bấm truy cập link rồi xem đúng là bài của bạn đúng thì là id đúng ( dùng níc không phải bạn bè và không có bạn chung để kiểm tra cho chắc nhất ) . ( nếu không vào được thì là bạn lấy link sai và id đó sai liên hệ admin để hỗ trợ ! ( ví dụ id của bạn là 831684720951329 thì bạn vào link www.facebook.com/831684720951329 nếu vào mà ra link đúng và có nút like ok thì cài ok )</li><li>Nhập link www.facebook.com ( không dùng link mbasic hay m.fb )</li><li>Tăng like avatar hoặc bìa cần mở mục công khai cho mọi người like - link ảnh hướng dẫn -&gt; https://prnt.sc/tzlv6p</li><li>Like người việt đang hoạt động</li><li>Buff like không có chế độ bảo hành ( nên buff dư 10 - 20% )</li><li>Cần tăng nhanh có thể cài giá cao hơn giá mặc định 5đ - 10đ</li><li>1 ID chỉ được buff tối đa 10 lần !</li><li>Chúng tôi KHÔNG hoàn tiền nếu bạn cài sai id hoặc KHÔNG đọc hướng dẫn lấy link + id và hướng dẫn sử dụng và điều khoản bên trên !</li></ul>', 'false', 100, 100000),
(2, 'f38c2ea16fb4797417c3cf74f4c4195d', 'facebook-buff-tang-cam-xuc-bai-viet', 'fas fa-heart', 'Tăng cảm xúc bài viết', '[\"like|0\",\"love|40\",\"care|70\",\"haha|70\",\"wow|70\",\"sad|70\",\"angry|100\"]', 'false', '<ul style=\"color: rgb(129, 51, 51); font-family: Roboto, sans-serif; font-size: 14px;\"><li>Cách lấy link tăng like -&gt;&nbsp;<a href=\"https://bom.to/laylinkbai2\" style=\"color: rgb(50, 131, 246); text-decoration: none;\">https://bom.to/laylinkbai2</a></li><li>( Lưu ý cách kiểm tra id xem có cài được không ) khi bạn lấy link và hệ thống lấy id . b viết id vào sau www.facebook.com/id ( id là id get ra ) rồi bấm truy cập link rồi xem đúng là bài của bạn đúng thì là id đúng ( dùng níc không phải bạn bè và không có bạn chung để kiểm tra cho chắc nhất ) . ( nếu không vào được thì là bạn lấy link sai và id đó sai liên hệ admin để hỗ trợ ! ( ví dụ id của bạn là 831684720951329 thì bạn vào link www.facebook.com/831684720951329 nếu vào mà ra link đúng và có nút like ok thì cài ok )</li><li>Nhập link www.facebook.com ( không dùng link mbasic hay m.fb )</li><li>Tăng like avatar hoặc bìa cần mở mục công khai cho mọi người like - link ảnh hướng dẫn -&gt; https://prnt.sc/tzlv6p</li><li>Like người việt đang hoạt động</li><li>Buff like không có chế độ bảo hành ( nên buff dư 10 - 20% )</li><li>Cần tăng nhanh có thể cài giá cao hơn giá mặc định 5đ - 10đ</li><li>1 ID chỉ được buff tối đa 10 lần !</li><li>Chúng tôi KHÔNG hoàn tiền nếu bạn cài sai id hoặc KHÔNG đọc hướng dẫn lấy link + id và hướng dẫn sử dụng và điều khoản bên trên !</li></ul>', 'false', 100, 1000000),
(3, 'f38c2ea16fb4797417c3cf74f4c4195d', 'facebook-buff-tang-cam-xuc-binh-luan', 'fas fa-comments-dollar', 'Tăng cảm xúc bình luận', '[\"like|10\",\"love|\",\"care|10\",\"haha|10\",\"wow|10\",\"sad|10\",\"angry|10\"]', 'false', '<p>MUA MÃ NGUỒN LIÊN HỆ ZALO 0966142061</p>', 'false', 20, 1000),
(4, 'f38c2ea16fb4797417c3cf74f4c4195d', 'facebook-buff-tang-luot-binh-luan', 'fas fa-comment', 'Tăng lượt bình luận', '', 'true', '<p>MUA MÃ NGUỒN LIÊN HỆ ZALO 0966142061</p>', 'false', 10, 100000),
(5, 'f38c2ea16fb4797417c3cf74f4c4195d', 'facebook-buff-tang-luot-theo-doi', 'fas fa-rss', 'Tăng lượt theo dõi', '', '', '<p>MUA MÃ NGUỒN LIÊN HỆ ZALO 0966142061<br></p>', 'true', 100, 100000000);

-- --------------------------------------------------------

--
-- Table structure for table `log_system`
--

CREATE TABLE `log_system` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `content` text NOT NULL,
  `created_time` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `message_suggest`
--

CREATE TABLE `message_suggest` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message_suggest`
--

INSERT INTO `message_suggest` (`id`, `message`) VALUES
(1, 'Anh/Chị cần hỗ trợ gì ạ?'),
(2, 'Đã xử lí xong Anh/Chị nhé ^^'),
(3, 'Chúc Anh/Chị có một ngày mới vui vẻ &lt;3');

-- --------------------------------------------------------

--
-- Table structure for table `newsfeed`
--

CREATE TABLE `newsfeed` (
  `id` int(11) NOT NULL,
  `key` text NOT NULL,
  `poster` text NOT NULL,
  `content` text NOT NULL,
  `created_time` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `newsfeed`
--

INSERT INTO `newsfeed` (`id`, `key`, `poster`, `content`, `created_time`) VALUES
(6, 'd3610926ff37c45d0153f45ca02ad068', 'Quản trị viên', '<h1><span style=\"background-color: rgb(255, 255, 0);\">NỘI DUNG BÀI VIẾT Ở ĐÂY</span></h1>', '1629712727'),
(7, '3b29cc4b600c349e836877b7804e311e', 'Quản trị viên', '<h3><b>ORDER_DVMXH V1</b></h3><h5><span style=\"background-color: rgb(255, 255, 0);\"><b>- Phiên bản hiện tại: V1</b></span></h5><h5><b style=\"background-color: rgb(0, 255, 0);\">Cam kết hỗ trợ khách khi cần qua mọi nền tảng điều khiển từ xa (ÁP DỤNG KHI MUA CODE CHÍNH CHỦ)</b></h5>', '1629712825');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `code` text NOT NULL,
  `buyer` text NOT NULL,
  `fatherKey` text NOT NULL,
  `childSlug` text NOT NULL,
  `object_id` text NOT NULL,
  `list_comment` text DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `reactions` text DEFAULT NULL,
  `server` text NOT NULL,
  `note` text NOT NULL,
  `admin_note` text NOT NULL,
  `status` text NOT NULL,
  `total_cash` int(11) NOT NULL,
  `total_back` int(11) NOT NULL,
  `created_time` text NOT NULL,
  `day` text NOT NULL,
  `month` text NOT NULL,
  `year` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `value` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `name`, `value`) VALUES
(1, 'website_name', 'ORDER_DVMXH'),
(2, 'keyword', 'từ khóa...'),
(3, 'description', 'mô tả...'),
(4, 'og_image', 'https://i.ibb.co/3kB87Zh/jzon-tech-banner.png'),
(5, 'favicon', 'https://i.ibb.co/LkXNxwK/132036217-1495206850673524-1667284798950224339-n-2.jpg'),
(13, 'logo', 'https://i.ibb.co/KW8rPwn/VDr0-G1626661489-removebg-preview-1.png'),
(16, 'discount_member', '0'),
(17, 'discount_ctv', '10'),
(18, 'discount_agency', '30'),
(19, 'nofication', '<h5 style=\"font-family: \" avenir=\"\" next=\"\" w01\",=\"\" lato,=\"\" -apple-system,=\"\" system-ui,=\"\" blinkmacsystemfont,=\"\" \"segoe=\"\" ui\",=\"\" roboto,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(51,=\"\" 65,=\"\" 82);=\"\" text-align:=\"\" center;\"=\"\"><div style=\"text-align: left;\"><font color=\"#ff0000\"><b>đây là thông báo</b></font></div></h5>'),
(20, 'support_caution', '- Hỗ trợ trong giờ hành chính từ Thứ 2 đến Thứ 6.<br>\n- Giờ làm việc từ 9h30 sáng đến 18h30 chiều.<br>\n- Ngoài giờ làm việc sẽ hỗ trợ chậm hơn và phụ thuộc nhân viên hỗ trợ Online.<br>\n- Nếu vấn đề không cần gấp vui lòng chờ đến giờ làm việc để xử lý tốt nhất, nhường cho các bạn cần hỗ trợ gấp ngoài giờ.'),
(21, 'password_admin', 'a228fc7c09184446e54a8c345b7c3c2a395de7f9'),
(23, 'memo_name', 'DUCTHANH '),
(24, 'memo_mode', 'user'),
(25, 'momo_owner', 'PHAM DUC THIEN'),
(26, 'momo_phone', '0966142061'),
(27, 'momo_token', 'token_here'),
(28, 'momo_note', 'Chuyển đúng nội dung sẽ được cộng tiền tự động'),
(29, 'api_card1s', 'partner_id|partner_key'),
(30, 'banking_note', '<h2><font color=\"#0000ff\"><span style=\"background-color: rgb(0, 255, 255);\"><span style=\"font-weight: bolder;\">NẠP NGÂN HÀNG/VÍ ĐIỆN TỬ</span></span></font></h2><ul><li>Tự động cộng tiền khi chuyển khoản qua ví MOMO, Zalo Pay</li><li>Nếu chưa thấy cộng tiền hãy liên hệ ngay cho admin hoặc tạo yêu cầu hỗ trợ</li><li>Nhận 100% mệnh giá nạp (100k bank = 100k web)</li></ul>'),
(31, 'card_note', '<h2><b style=\"background-color: rgb(255, 255, 0);\"><font color=\"#ff0000\">NẠP THẺ CÀO TỰ ĐỘNG</font></b></h2><ul><li>Hệ thống duyệt thẻ hoàn toàn tự động 2 - 5 phút</li><li>Nếu chưa thấy cộng tiền hãy liên hệ ngay cho admin hoặc tạo yêu cầu hỗ trợ</li><li>Khuyến khích nạp qua Ngân hàng/Ví điện tử để không trừ chiết khấu (nhận 100% mệnh giá nạp)</li></ul>'),
(32, 'theme_mode', 'light'),
(33, 'color_navbar', 'color_12'),
(34, 'color_logo', 'color_1'),
(35, 'color_header', 'color_1'),
(36, 'landing_page', 'landing_4'),
(37, 'landing_describe', 'Mô tả sẽ được hiển thị tại đây'),
(38, 'maintenance_mode', 'off'),
(39, 'zalo_owner', 'PHAM DUC THANH'),
(40, 'zalo_phone', '0966142061'),
(41, 'zalo_token', 'token_here'),
(42, 'zalo_note', 'Chuyển đúng nội dung sẽ được cộng tiền tự động'),
(43, 'tele_token', 'tele_token'),
(44, 'tele_chatid', 'tele_chatid'),
(45, 'nofication_new_member', 'yes'),
(46, 'nofication_login_member', 'no'),
(47, 'nofication_like_post', 'no'),
(48, 'nofication_new_order', 'yes'),
(49, 'nofication_success_card', 'no'),
(50, 'nofication_momo', 'no'),
(51, 'nofication_zalopay', 'no'),
(52, 'nofication_new_support', 'yes'),
(53, 'nofication_reply_support', 'yes'),
(54, 'nofication_action_support', 'no'),
(55, 'nofication_changepass_member', 'no'),
(56, 'nofication_detect_bot', 'yes'),
(57, 'plugin_js', ''),
(58, 'vcb_token', 'stk_mk|token'),
(59, 'vcb_owner', '1'),
(60, 'vcb_stk', '1'),
(62, 'vcb_note', '1'),
(63, 'nofication_vcb', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `support_list`
--

CREATE TABLE `support_list` (
  `id` int(11) NOT NULL,
  `code` text NOT NULL,
  `username` text NOT NULL,
  `title` text NOT NULL,
  `problem` text NOT NULL,
  `service` text NOT NULL,
  `describe` text NOT NULL,
  `img_url` text NOT NULL,
  `status` text NOT NULL,
  `created_time` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `support_message`
--

CREATE TABLE `support_message` (
  `id` int(11) NOT NULL,
  `code` text NOT NULL,
  `sender` text NOT NULL,
  `message` text NOT NULL,
  `image` text NOT NULL,
  `isReply` int(11) NOT NULL,
  `created_time` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `support_problem`
--

CREATE TABLE `support_problem` (
  `id` int(11) NOT NULL,
  `key` text NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `support_problem`
--

INSERT INTO `support_problem` (`id`, `key`, `name`) VALUES
(1, '123', 'Nạp tiền'),
(2, '1231', 'Khác');

-- --------------------------------------------------------

--
-- Table structure for table `top-recharge`
--

CREATE TABLE `top-recharge` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `cash` int(11) NOT NULL,
  `month` text NOT NULL,
  `year` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `top-recharge`
--

INSERT INTO `top-recharge` (`id`, `username`, `cash`, `month`, `year`) VALUES
(1, 'iamuser1', 1000, '08', '2021'),
(2, 'iamuser2', 10000, '08', '2021'),
(3, 'iamuser3', 100000, '08', '2021'),
(4, 'iamuser4', 1000000, '08', '2021'),
(5, 'iamuser5', 10000000, '08', '2021');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `cash` int(11) NOT NULL,
  `total_cash` int(11) NOT NULL,
  `used_cash` int(11) NOT NULL,
  `ip` text NOT NULL,
  `level` text NOT NULL DEFAULT 'member',
  `banned` int(11) NOT NULL,
  `created_time` text NOT NULL,
  `day` text NOT NULL,
  `month` text NOT NULL,
  `year` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `cash`, `total_cash`, `used_cash`, `ip`, `level`, `banned`, `created_time`, `day`, `month`, `year`) VALUES
(1, 'admin', '70589360c2cf5477f4f04dee81d0eaac28b57582', 1000000, 0, 0, '', 'admin', 0, '1629735301', '23', '08', '2021'),
(2, 'admin@gmail.com', '8556b52a92e10ec6606c5ee47a44befcd776623a', 0, 0, 0, '::1', 'member', 0, '1633306650', '04', '10', '2021');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auto-card`
--
ALTER TABLE `auto-card`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auto-momo`
--
ALTER TABLE `auto-momo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auto-zalo-pay`
--
ALTER TABLE `auto-zalo-pay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_auto`
--
ALTER TABLE `bank_auto`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `list_bank`
--
ALTER TABLE `list_bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `list_server`
--
ALTER TABLE `list_server`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `list_service`
--
ALTER TABLE `list_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `list_service_child`
--
ALTER TABLE `list_service_child`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_system`
--
ALTER TABLE `log_system`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_suggest`
--
ALTER TABLE `message_suggest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsfeed`
--
ALTER TABLE `newsfeed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_list`
--
ALTER TABLE `support_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_message`
--
ALTER TABLE `support_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_problem`
--
ALTER TABLE `support_problem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `top-recharge`
--
ALTER TABLE `top-recharge`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auto-card`
--
ALTER TABLE `auto-card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auto-momo`
--
ALTER TABLE `auto-momo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auto-zalo-pay`
--
ALTER TABLE `auto-zalo-pay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bank_auto`
--
ALTER TABLE `bank_auto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `list_bank`
--
ALTER TABLE `list_bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `list_server`
--
ALTER TABLE `list_server`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `list_service`
--
ALTER TABLE `list_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `list_service_child`
--
ALTER TABLE `list_service_child`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `log_system`
--
ALTER TABLE `log_system`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `message_suggest`
--
ALTER TABLE `message_suggest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `newsfeed`
--
ALTER TABLE `newsfeed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `support_list`
--
ALTER TABLE `support_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_message`
--
ALTER TABLE `support_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_problem`
--
ALTER TABLE `support_problem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `top-recharge`
--
ALTER TABLE `top-recharge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
