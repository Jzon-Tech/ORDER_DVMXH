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
(1, 'https://hrincjobs-pro.s3.amazonaws.com/media/public/filer_public/66/6b/666b7279-64c1-4d52-b6be-be0b76c7b460/logo-mbbank-cmyk.png', 'NGUYEN VAN A', '0123456789023', 'H?? N???i', 'Vui l??ng chuy???n ????ng n???i dung, kh??ng h??? tr??? khi nh???p sai n???i dung');

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
(1, 'e051d529d3ae835a828da681c18bccff', 'facebook-buff-tang-like-bai-viet', 'ghi ch?? m??y ch??? abc', 10, 100, 'show'),
(2, '4e181aa5b8b2951e9a8b067b390209a3', 'facebook-buff-tang-cam-xuc-bai-viet', 'm??y ch??? abcasdasd', 100, 1000, 'show'),
(3, 'dfb9ede63d4dc8bbc9629dbda50f1fc7', 'facebook-buff-tang-cam-xuc-binh-luan', '??dasdasda', 1000, 1000, 'show'),
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
(1, 'f38c2ea16fb4797417c3cf74f4c4195d', 'facebook-buff-tang-like-bai-viet', 'fas fa-thumbs-up', 'T??ng like b??i vi???t', '[\"like|0\"]', 'false', '<ul style=\"color: rgb(129, 51, 51); font-family: Roboto, sans-serif; font-size: 14px;\"><li>C??ch l???y link t??ng like -&gt;&nbsp;<a href=\"https://bom.to/laylinkbai2\" style=\"color: rgb(50, 131, 246); text-decoration: none;\">https://bom.to/laylinkbai2</a></li><li>( L??u ?? c??ch ki???m tra id xem c?? c??i ???????c kh??ng ) khi b???n l???y link v?? h??? th???ng l???y id . b vi???t id v??o sau www.facebook.com/id ( id l?? id get ra ) r???i b???m truy c???p link r???i xem ????ng l?? b??i c???a b???n ????ng th?? l?? id ????ng ( d??ng n??c kh??ng ph???i b???n b?? v?? kh??ng c?? b???n chung ????? ki???m tra cho ch???c nh???t ) . ( n???u kh??ng v??o ???????c th?? l?? b???n l???y link sai v?? id ???? sai li??n h??? admin ????? h??? tr??? ! ( v?? d??? id c???a b???n l?? 831684720951329 th?? b???n v??o link www.facebook.com/831684720951329 n???u v??o m?? ra link ????ng v?? c?? n??t like ok th?? c??i ok )</li><li>Nh???p link www.facebook.com ( kh??ng d??ng link mbasic hay m.fb )</li><li>T??ng like avatar ho???c b??a c???n m??? m???c c??ng khai cho m???i ng?????i like - link ???nh h?????ng d???n -&gt; https://prnt.sc/tzlv6p</li><li>Like ng?????i vi???t ??ang ho???t ?????ng</li><li>Buff like kh??ng c?? ch??? ????? b???o h??nh ( n??n buff d?? 10 - 20% )</li><li>C???n t??ng nhanh c?? th??? c??i gi?? cao h??n gi?? m???c ?????nh 5?? - 10??</li><li>1 ID ch??? ???????c buff t???i ??a 10 l???n !</li><li>Ch??ng t??i KH??NG ho??n ti???n n???u b???n c??i sai id ho???c KH??NG ?????c h?????ng d???n l???y link + id v?? h?????ng d???n s??? d???ng v?? ??i???u kho???n b??n tr??n !</li></ul>', 'false', 100, 100000),
(2, 'f38c2ea16fb4797417c3cf74f4c4195d', 'facebook-buff-tang-cam-xuc-bai-viet', 'fas fa-heart', 'T??ng c???m x??c b??i vi???t', '[\"like|0\",\"love|40\",\"care|70\",\"haha|70\",\"wow|70\",\"sad|70\",\"angry|100\"]', 'false', '<ul style=\"color: rgb(129, 51, 51); font-family: Roboto, sans-serif; font-size: 14px;\"><li>C??ch l???y link t??ng like -&gt;&nbsp;<a href=\"https://bom.to/laylinkbai2\" style=\"color: rgb(50, 131, 246); text-decoration: none;\">https://bom.to/laylinkbai2</a></li><li>( L??u ?? c??ch ki???m tra id xem c?? c??i ???????c kh??ng ) khi b???n l???y link v?? h??? th???ng l???y id . b vi???t id v??o sau www.facebook.com/id ( id l?? id get ra ) r???i b???m truy c???p link r???i xem ????ng l?? b??i c???a b???n ????ng th?? l?? id ????ng ( d??ng n??c kh??ng ph???i b???n b?? v?? kh??ng c?? b???n chung ????? ki???m tra cho ch???c nh???t ) . ( n???u kh??ng v??o ???????c th?? l?? b???n l???y link sai v?? id ???? sai li??n h??? admin ????? h??? tr??? ! ( v?? d??? id c???a b???n l?? 831684720951329 th?? b???n v??o link www.facebook.com/831684720951329 n???u v??o m?? ra link ????ng v?? c?? n??t like ok th?? c??i ok )</li><li>Nh???p link www.facebook.com ( kh??ng d??ng link mbasic hay m.fb )</li><li>T??ng like avatar ho???c b??a c???n m??? m???c c??ng khai cho m???i ng?????i like - link ???nh h?????ng d???n -&gt; https://prnt.sc/tzlv6p</li><li>Like ng?????i vi???t ??ang ho???t ?????ng</li><li>Buff like kh??ng c?? ch??? ????? b???o h??nh ( n??n buff d?? 10 - 20% )</li><li>C???n t??ng nhanh c?? th??? c??i gi?? cao h??n gi?? m???c ?????nh 5?? - 10??</li><li>1 ID ch??? ???????c buff t???i ??a 10 l???n !</li><li>Ch??ng t??i KH??NG ho??n ti???n n???u b???n c??i sai id ho???c KH??NG ?????c h?????ng d???n l???y link + id v?? h?????ng d???n s??? d???ng v?? ??i???u kho???n b??n tr??n !</li></ul>', 'false', 100, 1000000),
(3, 'f38c2ea16fb4797417c3cf74f4c4195d', 'facebook-buff-tang-cam-xuc-binh-luan', 'fas fa-comments-dollar', 'T??ng c???m x??c b??nh lu???n', '[\"like|10\",\"love|\",\"care|10\",\"haha|10\",\"wow|10\",\"sad|10\",\"angry|10\"]', 'false', '<p>MUA M?? NGU???N LI??N H??? ZALO 0966142061</p>', 'false', 20, 1000),
(4, 'f38c2ea16fb4797417c3cf74f4c4195d', 'facebook-buff-tang-luot-binh-luan', 'fas fa-comment', 'T??ng l?????t b??nh lu???n', '', 'true', '<p>MUA M?? NGU???N LI??N H??? ZALO 0966142061</p>', 'false', 10, 100000),
(5, 'f38c2ea16fb4797417c3cf74f4c4195d', 'facebook-buff-tang-luot-theo-doi', 'fas fa-rss', 'T??ng l?????t theo d??i', '', '', '<p>MUA M?? NGU???N LI??N H??? ZALO 0966142061<br></p>', 'true', 100, 100000000);

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
(1, 'Anh/Ch??? c???n h??? tr??? g?? ????'),
(2, '???? x??? l?? xong Anh/Ch??? nh?? ^^'),
(3, 'Ch??c Anh/Ch??? c?? m???t ng??y m???i vui v??? &lt;3');

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
(6, 'd3610926ff37c45d0153f45ca02ad068', 'Qu???n tr??? vi??n', '<h1><span style=\"background-color: rgb(255, 255, 0);\">N???I DUNG B??I VI???T ??? ????Y</span></h1>', '1629712727'),
(7, '3b29cc4b600c349e836877b7804e311e', 'Qu???n tr??? vi??n', '<h3><b>ORDER_DVMXH V1</b></h3><h5><span style=\"background-color: rgb(255, 255, 0);\"><b>- Phi??n b???n hi???n t???i: V1</b></span></h5><h5><b style=\"background-color: rgb(0, 255, 0);\">Cam k???t h??? tr??? kh??ch khi c???n qua m???i n???n t???ng ??i???u khi???n t??? xa (??P D???NG KHI MUA CODE CH??NH CH???)</b></h5>', '1629712825');

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
(2, 'keyword', 't??? kh??a...'),
(3, 'description', 'm?? t???...'),
(4, 'og_image', 'https://i.ibb.co/3kB87Zh/jzon-tech-banner.png'),
(5, 'favicon', 'https://i.ibb.co/LkXNxwK/132036217-1495206850673524-1667284798950224339-n-2.jpg'),
(13, 'logo', 'https://i.ibb.co/KW8rPwn/VDr0-G1626661489-removebg-preview-1.png'),
(16, 'discount_member', '0'),
(17, 'discount_ctv', '10'),
(18, 'discount_agency', '30'),
(19, 'nofication', '<h5 style=\"font-family: \" avenir=\"\" next=\"\" w01\",=\"\" lato,=\"\" -apple-system,=\"\" system-ui,=\"\" blinkmacsystemfont,=\"\" \"segoe=\"\" ui\",=\"\" roboto,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(51,=\"\" 65,=\"\" 82);=\"\" text-align:=\"\" center;\"=\"\"><div style=\"text-align: left;\"><font color=\"#ff0000\"><b>????y l?? th??ng b??o</b></font></div></h5>'),
(20, 'support_caution', '- H??? tr??? trong gi??? h??nh ch??nh t??? Th??? 2 ?????n Th??? 6.<br>\n- Gi??? l??m vi???c t??? 9h30 s??ng ?????n 18h30 chi???u.<br>\n- Ngo??i gi??? l??m vi???c s??? h??? tr??? ch???m h??n v?? ph??? thu???c nh??n vi??n h??? tr??? Online.<br>\n- N???u v???n ????? kh??ng c???n g???p vui l??ng ch??? ?????n gi??? l??m vi???c ????? x??? l?? t???t nh???t, nh?????ng cho c??c b???n c???n h??? tr??? g???p ngo??i gi???.'),
(21, 'password_admin', 'a228fc7c09184446e54a8c345b7c3c2a395de7f9'),
(23, 'memo_name', 'DUCTHANH '),
(24, 'memo_mode', 'user'),
(25, 'momo_owner', 'PHAM DUC THIEN'),
(26, 'momo_phone', '0966142061'),
(27, 'momo_token', 'token_here'),
(28, 'momo_note', 'Chuy???n ????ng n???i dung s??? ???????c c???ng ti???n t??? ?????ng'),
(29, 'api_card1s', 'partner_id|partner_key'),
(30, 'banking_note', '<h2><font color=\"#0000ff\"><span style=\"background-color: rgb(0, 255, 255);\"><span style=\"font-weight: bolder;\">N???P NG??N H??NG/V?? ??I???N T???</span></span></font></h2><ul><li>T??? ?????ng c???ng ti???n khi chuy???n kho???n qua v?? MOMO, Zalo Pay</li><li>N???u ch??a th???y c???ng ti???n h??y li??n h??? ngay cho admin ho???c t???o y??u c???u h??? tr???</li><li>Nh???n 100% m???nh gi?? n???p (100k bank = 100k web)</li></ul>'),
(31, 'card_note', '<h2><b style=\"background-color: rgb(255, 255, 0);\"><font color=\"#ff0000\">N???P TH??? C??O T??? ?????NG</font></b></h2><ul><li>H??? th???ng duy???t th??? ho??n to??n t??? ?????ng 2 - 5 ph??t</li><li>N???u ch??a th???y c???ng ti???n h??y li??n h??? ngay cho admin ho???c t???o y??u c???u h??? tr???</li><li>Khuy???n kh??ch n???p qua Ng??n h??ng/V?? ??i???n t??? ????? kh??ng tr??? chi???t kh???u (nh???n 100% m???nh gi?? n???p)</li></ul>'),
(32, 'theme_mode', 'light'),
(33, 'color_navbar', 'color_12'),
(34, 'color_logo', 'color_1'),
(35, 'color_header', 'color_1'),
(36, 'landing_page', 'landing_4'),
(37, 'landing_describe', 'M?? t??? s??? ???????c hi???n th??? t???i ????y'),
(38, 'maintenance_mode', 'off'),
(39, 'zalo_owner', 'PHAM DUC THANH'),
(40, 'zalo_phone', '0966142061'),
(41, 'zalo_token', 'token_here'),
(42, 'zalo_note', 'Chuy???n ????ng n???i dung s??? ???????c c???ng ti???n t??? ?????ng'),
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
(1, '123', 'N???p ti???n'),
(2, '1231', 'Kh??c');

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
