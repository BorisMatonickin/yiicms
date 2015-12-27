-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2015 at 06:27 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `yiicms`
--
CREATE DATABASE IF NOT EXISTS `yiicms` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `yiicms`;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_name` (`category_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`) VALUES
(12, 'Art'),
(1, 'Books'),
(2, 'Commerce'),
(24, 'Computer Science'),
(11, 'Culture'),
(21, 'Economics'),
(3, 'Entertainment'),
(4, 'Fashion'),
(5, 'Film'),
(6, 'Health'),
(9, 'History'),
(18, 'Literature'),
(23, 'Music'),
(17, 'Philosophy'),
(22, 'Politics'),
(7, 'Science'),
(10, 'Sport'),
(8, 'Technology');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `page_id` int(11) unsigned NOT NULL,
  `comment` mediumtext NOT NULL,
  `created_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk3_user` (`user_id`),
  KEY `fk1_page` (`page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- RELATIONS FOR TABLE `comment`:
--   `page_id`
--       `page` -> `id`
--   `user_id`
--       `user` -> `id`
--

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `page_id`, `comment`, `created_at`) VALUES
(1, 1, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2015-11-30 09:36:21'),
(2, 1, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2015-11-30 09:36:21'),
(3, 3, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2015-11-30 09:36:21'),
(4, 3, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2015-11-30 09:36:21'),
(5, 1, 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2015-11-30 09:36:21'),
(6, 4, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.', '2015-12-13 17:25:34');

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE IF NOT EXISTS `file` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `name` varchar(80) NOT NULL,
  `type` varchar(45) NOT NULL,
  `size` int(10) unsigned NOT NULL,
  `description` mediumtext,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk2_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- RELATIONS FOR TABLE `file`:
--   `user_id`
--       `user` -> `id`
--

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1448563172),
('m130524_201442_init', 1448565232),
('m151126_185737_create_page_table', 1448566281),
('m151126_193302_create_file_table', 1448567375),
('m151126_195341_create_comment_table', 1448568281),
('m151126_200529_create_reply_table', 1448568802),
('m151127_165010_create_page_file_table', 1448643738),
('m151127_173757_create_tag_table', 1448646147),
('m151127_174403_create_page_tag_table', 1448646824),
('m151127_175438_create_category_table', 1448647304),
('m151127_181058_create_page_category_table', 1448647884),
('m151128_113625_add_role_column_to_user', 1448711770),
('m151128_163018_insert_page_table', 1448729284),
('m151128_170214_insert_file_table', 1448873635),
('m151130_085523_insert_category_table', 1448874707),
('m151130_092804_insert_comment_table', 1448876181),
('m151130_093720_insert_tag_table', 1448877067),
('m151130_100350_add_user_id_column_to_reply', 1448878093),
('m151130_100903_insert_reply_table', 1448878403),
('m151130_173519_insert_page_category_table', 1448905264),
('m151130_174217_insert_page_file_table', 1448905556),
('m151130_174708_insert_page_tag_table', 1448906268),
('m151130_183419_add_first_last_name_columns_to_user_table', 1448909011),
('m151203_092438_add_image_columns_to_user_page', 1449136540);

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `live` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL,
  `content` longtext,
  `cover_image` varchar(60) DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk1_user` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- RELATIONS FOR TABLE `page`:
--   `user_id`
--       `user` -> `id`
--

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `user_id`, `live`, `title`, `content`, `cover_image`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Consequat bibendum quam liquam viverra', 'Curabitur quis libero leo, pharetra mattis eros. Praesent consequat libero eget dolor convallis velrhoncus magna scelerisque. Donec nisl ante, elementum eget posuere a, consectetur a metus. Proin aadipiscing sapien. Suspendisse vehicula porta lectus vel semper. Nullam sapien elit, lacinia eu tristique non.posuere at mi. Morbi at turpis id urna ullamcorper ullamcorper.', 'blog1.jpg', '2015-12-13 21:29:12', '2015-12-26 15:45:54'),
(2, 2, 1, 'Consequat bibendum quam liquam viverra', 'Curabitur quis libero leo, pharetra mattis eros. Praesent consequat libero eget dolor convallis velrhoncus magna scelerisque. Donec nisl ante, elementum eget posuere a, consectetur a metus. Proin a adipiscing sapien. Suspendisse vehicula porta lectus vel semper. Nullam sapien elit, lacinia eu tristique non.posuere at mi. Morbi at turpis id urna ullamcorper ullamcorper.', 'blog2.jpg', '2015-12-13 21:32:15', '2015-12-13 21:32:15'),
(3, 2, 1, 'Consequat bibendum quam liquam viverra', 'Curabitur quis libero leo, pharetra mattis eros. Praesent consequat libero eget dolor convallis velrhoncus magna scelerisque. Donec nisl ante, elementum eget posuere a, consectetur a metus. Proin a adipiscing sapien. Suspendisse vehicula porta lectus vel semper. Nullam sapien elit, lacinia eu tristique non.posuere at mi. Morbi at turpis id urna ullamcorper ullamcorper.', '730_1_134914_01_726x290.jpg', '2015-12-13 21:33:03', '2015-12-13 21:33:03'),
(4, 2, 1, 'Consequat bibendum quam liquam viverra', 'Curabitur quis libero leo, pharetra mattis eros. Praesent consequat libero eget dolor convallis velrhoncus magna scelerisque. Donec nisl ante, elementum eget posuere a, consectetur a metus. Proin a adipiscing sapien. Suspendisse vehicula porta lectus vel semper. Nullam sapien elit, lacinia eu tristique non.posuere at mi. Morbi at turpis id urna ullamcorper ullamcorper.', '730_1_134975_01_726x290.jpg', '2015-12-13 21:33:21', '2015-12-13 21:33:21'),
(5, 2, 0, 'Consequat bibendum quam liquam viverra', 'Curabitur quis libero leo, pharetra mattis eros. Praesent consequat libero eget dolor convallis velrhoncus magna scelerisque. Donec nisl ante, elementum eget posuere a, consectetur a metus. Proin a adipiscing sapien. Suspendisse vehicula porta lectus vel semper. Nullam sapien elit, lacinia eu tristique non.posuere at mi. Morbi at turpis id urna ullamcorper ullamcorper.', '12382382840340f.jpg', '2015-12-13 21:33:43', '2015-12-23 19:52:09'),
(7, 2, 1, 'Lorem ipsum dolor sit amet', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 'vQC3sxnL.jpg', '2015-12-23 20:06:19', '2015-12-23 20:54:44');

-- --------------------------------------------------------

--
-- Table structure for table `page_category`
--

CREATE TABLE IF NOT EXISTS `page_category` (
  `page_id` int(11) unsigned NOT NULL,
  `category_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`page_id`,`category_id`),
  KEY `fk4_category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS FOR TABLE `page_category`:
--   `page_id`
--       `page` -> `id`
--   `category_id`
--       `category` -> `id`
--

--
-- Dumping data for table `page_category`
--

INSERT INTO `page_category` (`page_id`, `category_id`) VALUES
(1, 2),
(7, 3),
(5, 6),
(3, 7),
(2, 8),
(4, 8),
(7, 10);

-- --------------------------------------------------------

--
-- Table structure for table `page_file`
--

CREATE TABLE IF NOT EXISTS `page_file` (
  `page_id` int(11) unsigned NOT NULL,
  `file_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`page_id`,`file_id`),
  KEY `idx_page_id` (`page_id`),
  KEY `idx_file_id` (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS FOR TABLE `page_file`:
--   `file_id`
--       `file` -> `id`
--   `page_id`
--       `page` -> `id`
--

-- --------------------------------------------------------

--
-- Table structure for table `page_tag`
--

CREATE TABLE IF NOT EXISTS `page_tag` (
  `page_id` int(11) unsigned NOT NULL,
  `tag_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`page_id`,`tag_id`),
  KEY `fk2_tag_id` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS FOR TABLE `page_tag`:
--   `page_id`
--       `page` -> `id`
--   `tag_id`
--       `tag` -> `id`
--

--
-- Dumping data for table `page_tag`
--

INSERT INTO `page_tag` (`page_id`, `tag_id`) VALUES
(4, 2),
(7, 5),
(1, 6),
(5, 7),
(2, 9),
(4, 10),
(3, 11),
(3, 12),
(1, 13),
(5, 14),
(2, 15),
(7, 16),
(7, 17),
(7, 22);

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE IF NOT EXISTS `reply` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `comment_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `reply` mediumtext NOT NULL,
  `created_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk1_comment` (`comment_id`),
  KEY `fk4_user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- RELATIONS FOR TABLE `reply`:
--   `comment_id`
--       `comment` -> `id`
--   `user_id`
--       `user` -> `id`
--

--
-- Dumping data for table `reply`
--

INSERT INTO `reply` (`id`, `comment_id`, `user_id`, `reply`, `created_at`) VALUES
(1, 1, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2015-11-30 10:13:23'),
(2, 3, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2015-11-30 10:13:23'),
(4, 4, 1, 'Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus.', '2015-12-13 19:18:55'),
(5, 4, 3, 'Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.', '2015-12-13 19:20:21');

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tag_title` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag_title` (`tag_title`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id`, `tag_title`) VALUES
(19, ' Rugby Football'),
(21, 'America'),
(6, 'Apple'),
(4, 'Barcelona'),
(11, 'Biology'),
(12, 'Evolution'),
(15, 'Finance'),
(8, 'Fitness'),
(14, 'Food'),
(5, 'Football'),
(7, 'Health'),
(13, 'IT'),
(3, 'London'),
(1, 'Office'),
(2, 'Race'),
(17, 'Rugby'),
(10, 'Sci-Fi'),
(16, 'Sport'),
(9, 'Stock'),
(20, 'United States'),
(22, 'USA');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `first_name` varchar(60) DEFAULT NULL,
  `last_name` varchar(80) DEFAULT NULL,
  `profile_image` varchar(60) DEFAULT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `role` smallint(6) NOT NULL DEFAULT '10',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `first_name`, `last_name`, `profile_image`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `role`, `created_at`, `updated_at`) VALUES
(1, 'John', 'John', 'Doe', '1.jpg', '9-dPUhx6kjTHjT6XXcZRdcYkyhKVVP92', '$2y$13$MqZ27.ABvU2vNvuVcL7SReEXoo0x3R.xNr7JvCdpld7LuKAQa5o0e', '_yPGnrNTbQtFXXt-MFtJMF-V-78ZupeV_1450124022', 'john.d@example.com', 1, 10, '2015-11-28 14:48:29', '2015-12-26 15:30:28'),
(2, 'Jessica', 'Jessica', 'Bluhm', '2.jpg', 'QSJ-JpKRQiq1z5HNiRajXNa4eA2nYmhJ', '$2y$13$nlXVoxAx4TY8/hqRt42xXeuKHeQkltFHUX7g900C/FXNci3WiOnai', NULL, 'jessica.l@example.com', 1, 20, '2015-11-30 18:44:36', '2015-12-15 17:31:32'),
(3, 'Mark', 'Marcus', 'Donne', '3.jpg', 'hP9OmISBpecIvRpEGlv2QUph5RqJOGGY', '$2y$13$gy5YZDW4I444zqBYUi9xxO/Ko.pUNHyE6Ez9H.oeBJdD7rbFl9O6y', NULL, 'mark.b@example.com', 1, 10, '2015-11-28 14:49:48', '2015-12-15 17:28:43'),
(4, 'Eric', NULL, NULL, NULL, 'fRLs9M9jrNUYqa6T5ZM-6a6GvgYVAaVG', '$2y$13$9dbaMNBPBvlGtGG7DG/t2u9Qp5v1HrIUsyDJoyjESl/CXaUvjqhPe', NULL, 'eric.j@example.com', 1, 10, '2015-12-13 15:22:45', '2015-12-13 15:22:45');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk1_page` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk3_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `file`
--
ALTER TABLE `file`
  ADD CONSTRAINT `fk2_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `page`
--
ALTER TABLE `page`
  ADD CONSTRAINT `fk1_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `page_category`
--
ALTER TABLE `page_category`
  ADD CONSTRAINT `fk3_page_id` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk4_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `page_file`
--
ALTER TABLE `page_file`
  ADD CONSTRAINT `fk_file_id` FOREIGN KEY (`file_id`) REFERENCES `file` (`id`),
  ADD CONSTRAINT `fk_page_id` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`);

--
-- Constraints for table `page_tag`
--
ALTER TABLE `page_tag`
  ADD CONSTRAINT `fk1_page_id` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk2_tag_id` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `reply`
--
ALTER TABLE `reply`
  ADD CONSTRAINT `fk1_comment` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk4_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
