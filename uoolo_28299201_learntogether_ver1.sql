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
(4, 'Chấm', 6, '2021-05-08 00:00:00', 2, 31),
(5, 'Repellendus blanditiis impedit? Occaecati eiusmod, varius, provident nostra. Mi iusto voluptate exercitation unde volutpat sit dicta. Eget! Pharetra. Voluptatem eu sequi eum, vulputate hendrerit nemo phasellus? Lorem natus minus quo inceptos ornare, semper cupiditate bibendum, donec quisquam aliquam per nunc habitant accusamus, aspernatur faucibus, eu ante justo omnis, quasi nam consequuntur cum condimentum sagittis augue etiam!', 8, '2021-05-08 00:00:00', 0, 30),
(6, 'Google không tính phí !', 1, '2021-05-08 00:00:00', 8, 28),
(7, 'Ôi bạn ơi...', 8, '2021-05-08 00:00:00', 0, 31),
(8, 'Đần ', 9, '2021-05-08 00:00:00', -2, 26),
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
  `first_date` datetime NOT NULL COMMENT 'Ngày đăng bài',
  `last_date` datetime NOT NULL COMMENT 'Ngày sửa đổi cuối cùng',
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
(17, 'Đây là ví dụ về đăng bài', ' 12345678901234567890123456789012345678901234567890', NULL, 0, '2021-05-02 00:00:00', '0000-00-00 00:00:00', 1, 1, 0),
(18, 'Em muốn hỏi về lập trình nhúng', 'Em chào mn và ad. Hiện nay e mới học xong ngôn ngữ C, C++ cơ bản nâng cao. Em muốn theo hướng lập trình nhúng thì giờ nên học tiếp như thế nào ạ, cho em xin roadmap của lập trình nhúng với ạ', NULL, 0, '2021-05-03 00:00:00', '0000-00-00 00:00:00', 1, 3, 0),
(19, 'Regex for Password (cứu nạn trong đêm)', 'Chuyện là em có được yêu cầu làm 1 regex về  mật khẩu dài 8-32 kí tự chỉ chứa số và chữ cái (ít nhất một số và ít nhất một chữ cái) \r\n<br><strong>String str = \"(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{8,32})$\";</strong><br>\r\nNhưng mà thầy kêu không được, tạo cái khác. Em  cạn ý tưởng nên mạn phép lên đây xin các bác chỉ giáo thêm ạ. em cảm ơn các bác trước, để em có thể ngủ sớm 1 chút ạ.﻿', NULL, 1, '2021-05-03 00:00:00', '0000-00-00 00:00:00', 1, 3, 0),
(20, 'Muốn có thêm học tập về C# nâng cao', 'Thì vấn đề là... tôi muốn học C# nâng cao. Học về lớp, hướng đối tượng, học về lập trình các phần mềm. Các cao nhân, quí bậc nếu có thể, LÀM ƠN hãy làm một khóa học như vậy. Cảm ơn!', NULL, 0, '2021-05-04 00:00:00', '0000-00-00 00:00:00', 1, 3, 0),
(21, '[HỎI] Python có hỗ trợ tốt app trên android không?', 'Mình mới học lập trình, và chọn ngôn ngữ học là python. giờ trên codelearn hoàn thành cũng kha khá mấy bài về cơ bản python, cấu trúc dữ liệu và giải thuật, thuật toán căn bản. Giờ mình định mày mò chút qua android (rảnh ngoài lúc học). Nhưng tìm trên mạng thì thấy nói python không hỗ trợ tốt cho android lắm. <br>\r\n\r\nThấy mọi người nói java hỗ trợ cho android tốt hơn, nhưng mình là lính mới, giờ học thêm về java nữa thì hơi loạn, nêm muốn vác python qua android luôn.<br>\r\n\r\nBác nào giúp thông não phát, python và android nó hợp nhau đến mức nào, nếu được thì cho xin ít lài liệu ( tốt nhất tiếng việt, tiếng anh tàm tạm) để mình cù cưa với python. <br>\r\n\r\nmình cảm ơn trước !', NULL, 0, '2021-05-04 00:00:00', '0000-00-00 00:00:00', 1, 3, 0),
(22, 'Inceptos perferendis vel malesuada?', 'Condimentum duis massa modi mi ad cumque! Cupidatat consequuntur molestiae ligula impedit, irure, sed laboris imperdiet? Fugit libero elementum quis quod possimus! Nullam ullamco nulla enim occaecat!<br>\r\nDolorem diam dolorem lacinia ultrices lectus, totam dicta, tincidunt pretium nihil molestias, eligendi quia eget porttitor litora nisl cumque facilisis dicta mus consequat erat! Mattis dolor eleifend pretium? Hendrerit amet? Alias congue inceptos, vero class augue, erat pulvinar maecenas, ad harum quam? Do ac ullam auctor provident est quo alias conubia magna vero. Felis. Ducimus accusantium per? Donec dolor vestibulum, parturient nesciunt omnis urna aliquam eveniet viverra excepteur magnam est a adipisci, aliquet alias aliquam conubia etiam expedita? Consectetuer dapibus pulvinar duis donec.', NULL, 2, '2021-05-04 00:00:00', '0000-00-00 00:00:00', 1, 5, 0),
(23, 'Lỗi về biến trong hàm đệ quy!', '\r\nMọi người cho mình hỏi mình có đoạn code ở dưới in ra chuỗi đảo ngược nhập từ bàn phím (dùng hàm đệ quy). Code chạy dc nhưng khi mình. Mọi người cho mình hỏi mình có đoạn code ở dưới in ra chuỗi đảo ngược nhập từ bàn phím (dùng hàm đệ quy). Code chạy dc nhưng khi mình', NULL, 0, '2021-05-04 00:00:00', '0000-00-00 00:00:00', 1, 5, 0),
(24, 'Question about java', '\r\nDoes have java advanced or just basic -> oop?', NULL, 0, '2021-05-05 00:00:00', '0000-00-00 00:00:00', 1, 5, 0),
(25, 'Làm sao để đổi thông tin cá nhân tài khoản', '\r\nMình muốn đổi thông tin tài khoản như ảnh đại diện và giới thiệu bản thân. Xin cảm ơn!', NULL, 0, '2021-05-05 00:00:00', '0000-00-00 00:00:00', 1, 5, 0),
(26, '[Help] Xin cách tạo đồng hồ đếm ngược', '\r\nE cần tạo 1 đồng hồ hiển thị thời gian làm bài còn lại cho 1 bài thi, vậy có thể dùng php ko hay phải làm thế nào ạ?\r\n', NULL, 0, '2021-05-06 00:00:00', '0000-00-00 00:00:00', 1, 6, 0),
(28, 'Tìm Bảng thuật ngữ code', '\r\nCó ai biết bảng thuật ngữ các câu lệnh trong c++ cho mình xin với ạ.Thanks', NULL, 0, '2021-05-07 00:00:00', '0000-00-00 00:00:00', 1, 7, 0),
(29, 'Website đang trong giai đoạn phát triển', 'Website đang trong giai đoạn phát triển, nên còn nhiều thiếu sót và lỗi, mong mọi người bỏ qua ! :))))', NULL, 29, '2021-05-07 00:00:00', '2021-05-20 12:09:56', 1, 1, 6),
(30, '[Định hướng] Định hướng từ 1 backend -> fullstack', '\r\nMình là một dev đã có tuổi (30 tuổi) và đang theo đuổi để trở thành một fullstack. Mình đã từng quan niệm là chỉ cần biết dev, có tư duy', NULL, 1, '2021-05-06 00:00:00', '0000-00-00 00:00:00', 1, 5, 0),
(31, 'Giới tính thứ ba => Tìm người chơi hệ Gay', 'Giới tính thứ ba hoặc giới tính thứ 3 là một khái niệm trong đó các cá nhân được phân loại, theo bản thân hoặc theo xã hội, không thuộc về nam giới hay nữ giới.', NULL, 6, '2021-05-07 00:00:00', '0000-00-00 00:00:00', 1, 9, -1),
(32, 'Bài học cuộc sống', 'Nhặt đút vào túi THAM LAM, nhặt giơ lên tiền của ai đây NGU DỐT nhưng mà nhặt được 20 triệu nhá \"CÒN CÁI NỊT\"  còn đúng CÁI NỊT thôi', NULL, 18, '2021-05-09 00:51:47', '0000-00-00 00:00:00', 1, 13, 2),
(35, 'This is test about text formating function', '<strong>In đậm</strong>\r\n<i>In nghiêng</i>\r\n<u>Gạch chân</u>\r\n', NULL, 9, '2021-05-30 22:42:47', '2021-05-30 22:42:47', 1, 3, 1);

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
(1, 'Hỏi đáp/Chia sẻ', 'Question/share'),
(2, 'C++', 'Cpp'),
(3, 'Java', 'Java'),
(4, 'PHP', 'php'),
(5, 'Python', 'python'),
(6, 'Cấu trúc dữ liệu ', 'data structures'),
(7, 'Giải thuật', 'Algorimths'),
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
  `fullname` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT 'Chưa có',
  `email` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT 'Chưa có',
  `level_id` int(11) NOT NULL DEFAULT '5',
  `user_quote` varchar(720) COLLATE utf8mb4_unicode_ci DEFAULT 'Học tập cùng LearnTogether',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `level_id` (`level_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `passwrd`, `avatar`, `fullname`, `email`, `phone_number`, `level_id`, `user_quote`) VALUES
(1, 'sysadmin', '$2y$10$ngPwr.wWccslXYfCyJ9RfemoxsW437Z88toLmWPgBUTAyqp4De2Pe', 'public/Uploads/Avatar/user-avatar-1.jpg', 'Nguyễn Đức Mạnh', 'vantasi2000@gmail.com', '0987175947', 1, 'Website đểu'),
(2, 'systester', '$2y$10$ngPwr.wWccslXYfCyJ9RfemoxsW437Z88toLmWPgBUTAyqp4De2Pe', 'public/Uploads/Avatar/user-avatar-2.png', 'Chưa có', 'testercute@gmail.com', 'Chưa có', 2, 'LearnTogether'),
(3, 'drgon10', '$2y$10$ngPwr.wWccslXYfCyJ9RfemoxsW437Z88toLmWPgBUTAyqp4De2Pe', 'public/Uploads/Avatar/user-avatar-3.jpg', 'Nguyễn Đức Mạnh', 'ducmanh01082000@gmail.com', 'Chưa có', 5, 'Học tập cùng LearnTogether'),
(5, 'RandomGuy', '$2y$10$MKL/MHxG..cjoyZKZrhsNOzjD086z7MBoNuiYaTD/cOTwzy9KZRr6', 'public/Uploads/Avatar/user-avatar-5.jpg', 'Chưa có', 'randomguy@learntogether.ihostfull.com', 'Chưa có', 5, 'Học tập cùng LearnTogether'),
(6, 'luuviettrung9x', '$2y$10$ydnSc9SQ8lOAaXvFncFobegJlP0hrNF2yFPKDx0/QK/bldRj9oMLW', 'public/Uploads/Avatar/user-avatar-6.jpg', 'Chưa có', 'baobei@gmail.com', 'Chưa có', 4, 'Pisces'),
(7, 'khuatsanh38', '$2y$10$0zGporgd6FHpHlc9ek7dOeX0WMt1mKHs/AKUKvpGTW3r1E0btMLfO', 'public/Uploads/Avatar/user-avatar-7.jpg', 'Khuất Văn Anh', 'liuposter@gmail.com', 'Chưa có', 4, '喜欢她的漂亮 <3 <3'),
(8, 'melodyy', '$2y$10$sSoPeG16p94qNo4RuirD9OUVcDxoe/12gWn/eRPWdwsRhX1lbamKu', 'public/Uploads/Avatar/user-avatar-8.png', 'Quốc Hảo', 'melodyy@gmail.com', 'Chưa có', 5, 'Sinh ra trong một gia đình nho giáo, có truyền thống yêu nước'),
(9, 'duylonh', '$2y$10$6A/dAeQD7HhcJUqmbjixUedpM4A.zl3tcwX/SsTCwuFAuuKuKDzXq', 'public/Uploads/Avatar/user-avatar-9.jpg', 'Phùng Duy Long', 'duylonh@gmail.com', 'Chưa có', 5, 'Người chơi hệ Support <br>Nhưng thích chơi ĐTCL'),
(12, 'anhanh', '$2y$10$edWNUAvVeBKCaVNBYPRame3jE3PwxVPj2gqtDG7uGwzc2YQnpajaq', 'public/Uploads/Avatar/user-avatar-12.jpg', 'Khuat Van Anh', 'anh@gmail.com', 'Chưa có', 3, 'haahahahahahahaha'),
(13, 'kingdragon', '$2y$10$AUzYIyKbDcdXL/s9oJxQBuqHjGQ8yAl0nZhOvpEuK/kv8HI3ERmDi', 'public/Uploads/Avatar/unset-icon.png', 'Dragon', 'trinhlonghp9999@gmail.com', '0123456789', 3, 'Nhặt đút vào túi THAM LAM, nhặt giơ lên tiền của ai đây NGU DỐT nhưng mà nhặt được 20 triệu nhá \"CÒN CÁI NỊT\" '),
(14, 'luuviettrung1103', '$2y$10$tRyJxG6Sueff1FyHxNZjaO9VszUEHxRqxo/aCvyJpToZFh/gMF5/2', 'public/Uploads/Avatar/unset-icon.png', 'Chưa có', 'luutrung9x@gmail.com', 'Chưa có', 5, 'Học tập cùng LearnTogether'),
(15, 'duongh399', '$2y$10$gWQRPhKPXZQihz3a1/3hUenPPQc39zaevupVHskWlZOjGAdsl079G', 'public/Uploads/Avatar/unset-icon.png', 'Chưa có', 'luongduongit99@gmail.com', 'Chưa có', 5, 'Học tập cùng LearnTogether');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
