-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql200.ihostfull.com
-- Generation Time: Jun 15, 2021 at 09:15 AM
-- Server version: 5.6.48-88.0
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uoolo_28299201_learntogether_ver1`
--
CREATE DATABASE IF NOT EXISTS `uoolo_28299201_learntogether_ver1` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `uoolo_28299201_learntogether_ver1`;

-- --------------------------------------------------------

--
-- Table structure for table `comments_courses`
--

CREATE TABLE IF NOT EXISTS `comments_courses` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `user_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `like` int(11) NOT NULL DEFAULT '0',
  `dislike` int(11) NOT NULL DEFAULT '0',
  `course_id` int(11) NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `user_id` (`user_id`),
  KEY `course_id` (`course_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments_news`
--

CREATE TABLE IF NOT EXISTS `comments_news` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `user_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `like` int(11) NOT NULL DEFAULT '0',
  `dislike` int(11) NOT NULL DEFAULT '0',
  `news_id` int(11) NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `user_id` (`user_id`),
  KEY `news_id` (`news_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments_posts`
--

CREATE TABLE IF NOT EXISTS `comments_posts` (
  `cmt_id` int(11) NOT NULL AUTO_INCREMENT,
  `cmt_content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `cmt_date` datetime NOT NULL,
  `cmt_score` int(11) NOT NULL DEFAULT '0',
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`cmt_id`),
  KEY `user_id` (`user_id`),
  KEY `post_id` (`post_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments_posts`
--

INSERT INTO `comments_posts` (`cmt_id`, `cmt_content`, `user_id`, `cmt_date`, `cmt_score`, `post_id`) VALUES
(1, 'Test comment ', 3, '2021-05-04 00:00:00', 0, 1),
(2, 'TEst comment', 2, '2021-05-04 00:00:00', 0, 1),
(3, 'Quos fugit, praesentium nostrum rerum beatae veritatis ratione natus fuga fuga maiores, enim iste? Interdum, quidem, libero?', 7, '2021-05-08 00:00:00', -3, 26),
(4, 'Ch???m', 6, '2021-05-08 00:00:00', 2, 31),
(5, 'Repellendus blanditiis impedit? Occaecati eiusmod, varius, provident nostra. Mi iusto voluptate exercitation unde volutpat sit dicta. Eget! Pharetra. Voluptatem eu sequi eum, vulputate hendrerit nemo phasellus? Lorem natus minus quo inceptos ornare, semper cupiditate bibendum, donec quisquam aliquam per nunc habitant accusamus, aspernatur faucibus, eu ante justo omnis, quasi nam consequuntur cum condimentum sagittis augue etiam!', 8, '2021-05-08 00:00:00', 0, 30),
(6, 'Google kh??ng t??nh ph?? !', 1, '2021-05-08 00:00:00', 8, 28),
(7, '??i b???n ??i...', 8, '2021-05-08 00:00:00', 0, 31),
(8, '?????n ', 9, '2021-05-08 00:00:00', -2, 26),
(9, '+ 1', 3, '2021-05-08 23:48:40', 0, 29),
(10, '+1', 9, '2021-05-08 23:49:12', 0, 29),
(11, '+1', 7, '2021-05-08 23:49:46', 0, 29),
(12, '+ 1', 2, '2021-05-08 23:50:22', 0, 29),
(13, '+1', 8, '2021-05-08 23:50:53', 0, 29),
(14, 'dm th long xam lon\r\n', 12, '2021-05-09 00:05:02', 1, 31),
(15, 'dm th long xam lon\r\n', 12, '2021-05-09 00:05:02', 0, 31),
(16, 'dm th long xam lon\r\n', 12, '2021-05-09 00:05:04', 0, 31),
(17, 'Xamlon :))', 1, '2021-05-18 11:12:49', 1, 32),
(18, 'vl', 15, '2021-06-05 16:28:04', 0, 35);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `view_number` int(11) DEFAULT '0',
  `date` date NOT NULL,
  `tag_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`course_id`),
  KEY `user_id` (`user_id`),
  KEY `tag_id` (`tag_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE IF NOT EXISTS `levels` (
  `level_id` int(11) NOT NULL DEFAULT '5',
  `level_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Member',
  PRIMARY KEY (`level_id`),
  UNIQUE KEY `level_name` (`level_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`level_id`, `level_name`) VALUES
(2, 'Admin'),
(4, 'Creation'),
(1, 'Founder'),
(5, 'Member'),
(3, 'Mod');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `rating` int(11) NOT NULL DEFAULT '0',
  `title` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `view_number` int(11) DEFAULT '0',
  `date` date NOT NULL,
  `tag_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`news_id`),
  KEY `user_id` (`user_id`),
  KEY `tag_id` (`tag_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `view_number` int(11) NOT NULL DEFAULT '0',
  `first_date` datetime NOT NULL COMMENT 'Ng??y ????ng b??i',
  `last_date` datetime NOT NULL COMMENT 'Ng??y s???a ?????i cu???i c??ng',
  `tag_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `score` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`post_id`),
  KEY `user_id` (`user_id`),
  KEY `tag_id` (`tag_id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `title`, `content`, `image`, `view_number`, `first_date`, `last_date`, `tag_id`, `user_id`, `score`) VALUES
(1, 'this is temp examble', 'this is examble', NULL, 0, '2021-05-02 00:00:00', '0000-00-00 00:00:00', 1, 3, 0),
(17, '????y l?? v?? d??? v??? ????ng b??i', ' 12345678901234567890123456789012345678901234567890', NULL, 0, '2021-05-02 00:00:00', '0000-00-00 00:00:00', 1, 1, 0),
(18, 'Em mu???n h???i v??? l???p tr??nh nh??ng', 'Em ch??o mn v?? ad. Hi???n nay e m???i h???c xong ng??n ng??? C, C++ c?? b???n n??ng cao. Em mu???n theo h?????ng l???p tr??nh nh??ng th?? gi??? n??n h???c ti???p nh?? th??? n??o ???, cho em xin roadmap c???a l???p tr??nh nh??ng v???i ???', NULL, 0, '2021-05-03 00:00:00', '0000-00-00 00:00:00', 1, 3, 0),
(19, 'Regex for Password (c???u n???n trong ????m)', 'Chuy???n l?? em c?? ???????c y??u c???u l??m 1 regex v???  m???t kh???u d??i 8-32 k?? t??? ch??? ch???a s??? v?? ch??? c??i (??t nh???t m???t s??? v?? ??t nh???t m???t ch??? c??i) \r\n<br><strong>String str = \"(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{8,32})$\";</strong><br>\r\nNh??ng m?? th???y k??u kh??ng ???????c, t???o c??i kh??c. Em  c???n ?? t?????ng n??n m???n ph??p l??n ????y xin c??c b??c ch??? gi??o th??m ???. em c???m ??n c??c b??c tr?????c, ????? em c?? th??? ng??? s???m 1 ch??t ???.???', NULL, 1, '2021-05-03 00:00:00', '0000-00-00 00:00:00', 1, 3, 0),
(20, 'Mu???n c?? th??m h???c t???p v??? C# n??ng cao', 'Th?? v???n ????? l??... t??i mu???n h???c C# n??ng cao. H???c v??? l???p, h?????ng ?????i t?????ng, h???c v??? l???p tr??nh c??c ph???n m???m. C??c cao nh??n, qu?? b???c n???u c?? th???, L??M ??N h??y l??m m???t kh??a h???c nh?? v???y. C???m ??n!', NULL, 0, '2021-05-04 00:00:00', '0000-00-00 00:00:00', 1, 3, 0),
(21, '[H???I] Python c?? h??? tr??? t???t app tr??n android kh??ng?', 'M??nh m???i h???c l???p tr??nh, v?? ch???n ng??n ng??? h???c l?? python. gi??? tr??n codelearn ho??n th??nh c??ng kha kh?? m???y b??i v??? c?? b???n python, c???u tr??c d??? li???u v?? gi???i thu???t, thu???t to??n c??n b???n. Gi??? m??nh ?????nh m??y m?? ch??t qua android (r???nh ngo??i l??c h???c). Nh??ng t??m tr??n m???ng th?? th???y n??i python kh??ng h??? tr??? t???t cho android l???m. <br>\r\n\r\nTh???y m???i ng?????i n??i java h??? tr??? cho android t???t h??n, nh??ng m??nh l?? l??nh m???i, gi??? h???c th??m v??? java n???a th?? h??i lo???n, n??m mu???n v??c python qua android lu??n.<br>\r\n\r\nB??c n??o gi??p th??ng n??o ph??t, python v?? android n?? h???p nhau ?????n m???c n??o, n???u ???????c th?? cho xin ??t l??i li???u ( t???t nh???t ti???ng vi???t, ti???ng anh t??m t???m) ????? m??nh c?? c??a v???i python. <br>\r\n\r\nm??nh c???m ??n tr?????c !', NULL, 0, '2021-05-04 00:00:00', '0000-00-00 00:00:00', 1, 3, 0),
(22, 'Inceptos perferendis vel malesuada?', 'Condimentum duis massa modi mi ad cumque! Cupidatat consequuntur molestiae ligula impedit, irure, sed laboris imperdiet? Fugit libero elementum quis quod possimus! Nullam ullamco nulla enim occaecat!<br>\r\nDolorem diam dolorem lacinia ultrices lectus, totam dicta, tincidunt pretium nihil molestias, eligendi quia eget porttitor litora nisl cumque facilisis dicta mus consequat erat! Mattis dolor eleifend pretium? Hendrerit amet? Alias congue inceptos, vero class augue, erat pulvinar maecenas, ad harum quam? Do ac ullam auctor provident est quo alias conubia magna vero. Felis. Ducimus accusantium per? Donec dolor vestibulum, parturient nesciunt omnis urna aliquam eveniet viverra excepteur magnam est a adipisci, aliquet alias aliquam conubia etiam expedita? Consectetuer dapibus pulvinar duis donec.', NULL, 2, '2021-05-04 00:00:00', '0000-00-00 00:00:00', 1, 5, 0),
(23, 'L???i v??? bi???n trong h??m ????? quy!', '\r\nM???i ng?????i cho m??nh h???i m??nh c?? ??o???n code ??? d?????i in ra chu???i ?????o ng?????c nh???p t??? b??n ph??m (d??ng h??m ????? quy). Code ch???y dc nh??ng khi m??nh. M???i ng?????i cho m??nh h???i m??nh c?? ??o???n code ??? d?????i in ra chu???i ?????o ng?????c nh???p t??? b??n ph??m (d??ng h??m ????? quy). Code ch???y dc nh??ng khi m??nh', NULL, 0, '2021-05-04 00:00:00', '0000-00-00 00:00:00', 1, 5, 0),
(24, 'Question about java', '\r\nDoes have java advanced or just basic -> oop?', NULL, 0, '2021-05-05 00:00:00', '0000-00-00 00:00:00', 1, 5, 0),
(25, 'L??m sao ????? ?????i th??ng tin c?? nh??n t??i kho???n', '\r\nM??nh mu???n ?????i th??ng tin t??i kho???n nh?? ???nh ?????i di???n v?? gi???i thi???u b???n th??n. Xin c???m ??n!', NULL, 0, '2021-05-05 00:00:00', '0000-00-00 00:00:00', 1, 5, 0),
(26, '[Help] Xin c??ch t???o ?????ng h??? ?????m ng?????c', '\r\nE c???n t???o 1 ?????ng h??? hi???n th??? th???i gian l??m b??i c??n l???i cho 1 b??i thi, v???y c?? th??? d??ng php ko hay ph???i l??m th??? n??o ????\r\n', NULL, 0, '2021-05-06 00:00:00', '0000-00-00 00:00:00', 1, 6, 0),
(28, 'T??m B???ng thu???t ng??? code', '\r\nC?? ai bi???t b???ng thu???t ng??? c??c c??u l???nh trong c++ cho m??nh xin v???i ???.Thanks', NULL, 0, '2021-05-07 00:00:00', '0000-00-00 00:00:00', 1, 7, 0),
(29, 'Website ??ang trong giai ??o???n ph??t tri???n', 'Website ??ang trong giai ??o???n ph??t tri???n, n??n c??n nhi???u thi???u s??t v?? l???i, mong m???i ng?????i b??? qua ! :))))', NULL, 29, '2021-05-07 00:00:00', '2021-05-20 12:09:56', 1, 1, 6),
(30, '[?????nh h?????ng] ?????nh h?????ng t??? 1 backend -> fullstack', '\r\nM??nh l?? m???t dev ???? c?? tu???i (30 tu???i) v?? ??ang theo ??u???i ????? tr??? th??nh m???t fullstack. M??nh ???? t???ng quan ni???m l?? ch??? c???n bi???t dev, c?? t?? duy', NULL, 1, '2021-05-06 00:00:00', '0000-00-00 00:00:00', 1, 5, 0),
(31, 'Gi???i t??nh th??? ba => T??m ng?????i ch??i h??? Gay', 'Gi???i t??nh th??? ba ho???c gi???i t??nh th??? 3 l?? m???t kh??i ni???m trong ???? c??c c?? nh??n ???????c ph??n lo???i, theo b???n th??n ho???c theo x?? h???i, kh??ng thu???c v??? nam gi???i hay n??? gi???i.', NULL, 6, '2021-05-07 00:00:00', '0000-00-00 00:00:00', 1, 9, -1),
(32, 'B??i h???c cu???c s???ng', 'Nh???t ????t v??o t??i THAM LAM, nh???t gi?? l??n ti???n c???a ai ????y NGU D???T nh??ng m?? nh???t ???????c 20 tri???u nh?? \"C??N C??I N???T\"  c??n ????ng C??I N???T th??i', NULL, 18, '2021-05-09 00:51:47', '0000-00-00 00:00:00', 1, 13, 2),
(35, 'This is test about text formating function', '<strong>In ?????m</strong>\r\n<i>In nghi??ng</i>\r\n<u>G???ch ch??n</u>\r\n', NULL, 9, '2021-05-30 22:42:47', '2021-05-30 22:42:47', 1, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE IF NOT EXISTS `scores` (
  `score_id` int(11) NOT NULL AUTO_INCREMENT,
  `score_type` int(11) NOT NULL COMMENT '1: up, -1: down',
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`score_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`score_id`, `score_type`, `user_id`, `post_id`) VALUES
(1, 1, 1, 29),
(3, 1, 3, 29),
(4, 1, 2, 29),
(5, 1, 3, 32),
(6, -1, 3, 31),
(7, 1, 9, 29),
(8, 1, 8, 29),
(9, 1, 7, 29),
(10, 1, 8, 32),
(11, 1, 15, 35);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `tag_id` int(11) NOT NULL,
  `tag_name` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag_slug` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag_id`, `tag_name`, `tag_slug`) VALUES
(1, 'H???i ????p/Chia s???', 'Question/share'),
(2, 'C++', 'Cpp'),
(3, 'Java', 'Java'),
(4, 'PHP', 'php'),
(5, 'Python', 'python'),
(6, 'C???u tr??c d??? li???u ', 'data structures'),
(7, 'Gi???i thu???t', 'Algorimths'),
(8, 'C#', 'C-sharp');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passwrd` varchar(450) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(720) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'public/Uploads/Avatar/unset-icon.png',
  `fullname` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT 'Ch??a c??',
  `email` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT 'Ch??a c??',
  `level_id` int(11) NOT NULL DEFAULT '5',
  `user_quote` varchar(720) COLLATE utf8mb4_unicode_ci DEFAULT 'H???c t???p c??ng LearnTogether',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `level_id` (`level_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `passwrd`, `avatar`, `fullname`, `email`, `phone_number`, `level_id`, `user_quote`) VALUES
(1, 'sysadmin', '$2y$10$ngPwr.wWccslXYfCyJ9RfemoxsW437Z88toLmWPgBUTAyqp4De2Pe', 'public/Uploads/Avatar/user-avatar-1.jpg', 'Nguy???n ?????c M???nh', 'vantasi2000@gmail.com', '0987175947', 1, 'Website ?????u'),
(2, 'systester', '$2y$10$ngPwr.wWccslXYfCyJ9RfemoxsW437Z88toLmWPgBUTAyqp4De2Pe', 'public/Uploads/Avatar/user-avatar-2.png', 'Ch??a c??', 'testercute@gmail.com', 'Ch??a c??', 2, 'LearnTogether'),
(3, 'drgon10', '$2y$10$ngPwr.wWccslXYfCyJ9RfemoxsW437Z88toLmWPgBUTAyqp4De2Pe', 'public/Uploads/Avatar/user-avatar-3.jpg', 'Nguy???n ?????c M???nh', 'ducmanh01082000@gmail.com', 'Ch??a c??', 5, 'H???c t???p c??ng LearnTogether'),
(5, 'RandomGuy', '$2y$10$MKL/MHxG..cjoyZKZrhsNOzjD086z7MBoNuiYaTD/cOTwzy9KZRr6', 'public/Uploads/Avatar/user-avatar-5.jpg', 'Ch??a c??', 'randomguy@learntogether.ihostfull.com', 'Ch??a c??', 5, 'H???c t???p c??ng LearnTogether'),
(6, 'luuviettrung9x', '$2y$10$ydnSc9SQ8lOAaXvFncFobegJlP0hrNF2yFPKDx0/QK/bldRj9oMLW', 'public/Uploads/Avatar/user-avatar-6.jpg', 'Ch??a c??', 'baobei@gmail.com', 'Ch??a c??', 4, 'Pisces'),
(7, 'khuatsanh38', '$2y$10$0zGporgd6FHpHlc9ek7dOeX0WMt1mKHs/AKUKvpGTW3r1E0btMLfO', 'public/Uploads/Avatar/user-avatar-7.jpg', 'Khu???t V??n Anh', 'liuposter@gmail.com', 'Ch??a c??', 4, '?????????????????? <3 <3'),
(8, 'melodyy', '$2y$10$sSoPeG16p94qNo4RuirD9OUVcDxoe/12gWn/eRPWdwsRhX1lbamKu', 'public/Uploads/Avatar/user-avatar-8.png', 'Qu???c H???o', 'melodyy@gmail.com', 'Ch??a c??', 5, 'Sinh ra trong m???t gia ????nh nho gi??o, c?? truy???n th???ng y??u n?????c'),
(9, 'duylonh', '$2y$10$6A/dAeQD7HhcJUqmbjixUedpM4A.zl3tcwX/SsTCwuFAuuKuKDzXq', 'public/Uploads/Avatar/user-avatar-9.jpg', 'Ph??ng Duy Long', 'duylonh@gmail.com', 'Ch??a c??', 5, 'Ng?????i ch??i h??? Support <br>Nh??ng th??ch ch??i ??TCL'),
(12, 'anhanh', '$2y$10$edWNUAvVeBKCaVNBYPRame3jE3PwxVPj2gqtDG7uGwzc2YQnpajaq', 'public/Uploads/Avatar/user-avatar-12.jpg', 'Khuat Van Anh', 'anh@gmail.com', 'Ch??a c??', 3, 'haahahahahahahaha'),
(13, 'kingdragon', '$2y$10$AUzYIyKbDcdXL/s9oJxQBuqHjGQ8yAl0nZhOvpEuK/kv8HI3ERmDi', 'public/Uploads/Avatar/unset-icon.png', 'Dragon', 'trinhlonghp9999@gmail.com', '0123456789', 3, 'Nh???t ????t v??o t??i THAM LAM, nh???t gi?? l??n ti???n c???a ai ????y NGU D???T nh??ng m?? nh???t ???????c 20 tri???u nh?? \"C??N C??I N???T\" '),
(14, 'luuviettrung1103', '$2y$10$tRyJxG6Sueff1FyHxNZjaO9VszUEHxRqxo/aCvyJpToZFh/gMF5/2', 'public/Uploads/Avatar/unset-icon.png', 'Ch??a c??', 'luutrung9x@gmail.com', 'Ch??a c??', 5, 'H???c t???p c??ng LearnTogether'),
(15, 'duongh399', '$2y$10$gWQRPhKPXZQihz3a1/3hUenPPQc39zaevupVHskWlZOjGAdsl079G', 'public/Uploads/Avatar/unset-icon.png', 'Ch??a c??', 'luongduongit99@gmail.com', 'Ch??a c??', 5, 'H???c t???p c??ng LearnTogether');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
