CREATE TABLE `users` (
  `user_id` int PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `username` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL UNIQUE,
  `passwrd` varchar(450) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci DEFAULT 'Public/Images/unset-icon.png',
  `fullname` text COLLATE utf8mb4_unicode_ci DEFAULT 'Chưa có',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL UNIQUE,
  `phone_number` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT 'Chưa có',
  `level_id` int NOT NULL DEFAULT 5,
  `user_quote` text COLLATE utf8mb4_unicode_ci DEFAULT 'Học tập cùng LearnTogether',
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `levels` (
  `level_id` int PRIMARY KEY NOT NULL DEFAULT 5,
  `level_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Thành viên' UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `tags` (
  `tag_id` int PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `tag_name` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL UNIQUE,
  `tag_slug` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `comments_news`(
	`comment_id` int PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `content` longtext,
  `user_id` int,
  `date` date,
  `like` int NOT NULL DEFAULT 0,
  `dislike` int NOT NULL DEFAULT 0,
  `news_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `comments_posts`(
	`comment_id` int PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `content` longtext,
  `user_id` int,
  `date` date,
  `scores` int NOT NULL DEFAULT 0,
  `post_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `comments_courses`(
	`comment_id` int PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `content` longtext,
  `user_id` int,
  `date` date,
  `like` int NOT NULL DEFAULT 0,
  `dislike` int NOT NULL DEFAULT 0,
  `course_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `news` (
	`news_id` int PRIMARY KEY AUTO_INCREMENT,
  `rating` int NOT NULL DEFAULT 0,
  `title` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `view_number` int DEFAULT 0,
  `date` date NOT NULL,
  `tag_id` int NOT NULL,
  `user_id` int NOT NULL
)  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `posts` (
	`post_id` int PRIMARY KEY AUTO_INCREMENT,
  `scores` int NOT null DEFAULT 0,
  `title` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `view_number` int DEFAULT 0,
  `date` date NOT NULL,
  `tag_id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `courses` (
	`course_id` int PRIMARY KEY AUTO_INCREMENT,
  `title` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `view_number` int DEFAULT 0,
  `date` date NOT NULL,
  `tag_id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `users` ADD FOREIGN KEY (`level_id`) REFERENCES levels(`level_id`);
ALTER TABLE `comments_news` ADD FOREIGN KEY (`user_id`) REFERENCES users(`user_id`);
ALTER TABLE `comments_news` ADD FOREIGN KEY (`news_id`) REFERENCES news(`news_id`);
ALTER TABLE `comments_posts` ADD FOREIGN KEY (`user_id`) REFERENCES users(`user_id`);
ALTER TABLE `comments_posts` ADD FOREIGN KEY (`post_id`) REFERENCES posts(`post_id`);
ALTER TABLE `comments_courses` ADD FOREIGN KEY (`user_id`) REFERENCES users(`user_id`);
ALTER TABLE `comments_courses` ADD FOREIGN KEY (`course_id`) REFERENCES courses(`course_id`);
ALTER TABLE `courses` ADD FOREIGN KEY (`user_id`) REFERENCES users(`user_id`);
ALTER TABLE `courses` ADD FOREIGN KEY (`tag_id`) REFERENCES tags(`tag_id`);
ALTER TABLE `news` ADD FOREIGN KEY (`user_id`) REFERENCES users(`user_id`);
ALTER TABLE `news` ADD FOREIGN KEY (`tag_id`) REFERENCES tags(`tag_id`);
ALTER TABLE `posts` ADD FOREIGN KEY (`user_id`) REFERENCES users(`user_id`);
ALTER TABLE `posts` ADD FOREIGN KEY (`tag_id`) REFERENCES tags(`tag_id`);

INSERT INTO `tags` (`tag_id`, `tag_name`, `tag_slug`) VALUES
(1, 'Chia sẻ', 'share'),
(2, 'C++', 'Cpp'),
(3, 'Java', 'Java'),
(4, 'PHP', 'php'),
(5, 'Python', 'python'),
(6, 'Cấu trúc dữ liệu ', 'data structures'),
(7, 'Giải thuật', 'Algorimths');
INSERT INTO `levels` (`level_id`, `level_name`) VALUES
(1, 'Founder'),
(3, 'Kiểm duyệt'),
(2, 'Quản trị viên'),
(4, 'Sáng tạo nội dung'),
(5, 'Thành viên');
INSERT INTO `users` (`user_id`, `username`, `passwrd`, `fullname`, `email`, `phone_number`, `level_id`) VALUES
(1, 'sysadmin', '$2y$10$b9LTwCTTs//lM/KYR2EpRetJ2kWdLcMUL8OLClb4aoC3fZsGevlEi', 'Nguyễn Đức Mạnh', 'vantasi2000@gmail.com', '0987175947', 1),
(2, 'systester', '$2y$10$/OOKteiWS5ugc0WOvjaXtuTw4YI2cjn0GAS.0qbR56tU/Gj31zbRW', 'Chưa có', 'testercute@gmail.com', 'Chưa có', 3);
