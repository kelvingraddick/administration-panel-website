CREATE TABLE `blog_posts` (
  `id` bigint(30) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
  `content` varchar(10000) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
  `url` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
  `author` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'post',
  `published` set('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  `image1` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
  `image2` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
  `image3` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
  `image4` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
  `image5` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
  `image6` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
  `image7` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
  `image8` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `contacts` (
  `id` bigint(30) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` varchar(10000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email_address`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `contracts` (
  `id` bigint(30) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(30) NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'n/a',
  `contract_url` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
  `signature_url` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_signed` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `events` (
  `id` bigint(30) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(10000) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
  `date_and_time` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_index` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `photo_albums` (
  `id` bigint(30) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(10000) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
  `image_url` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_index` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `photos` (
  `id` bigint(30) NOT NULL AUTO_INCREMENT,
  `photo_album_id` bigint(30) DEFAULT NULL,
  `url` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(10000) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
  `order_index` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `seo` (
  `id` bigint(30) NOT NULL AUTO_INCREMENT,
  `page` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywords` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `header` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `page` (`page`),
  UNIQUE KEY `display` (`display`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

CREATE TABLE `settings` (
  `id` bigint(30) NOT NULL AUTO_INCREMENT,
  `code` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(10000) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `settings` (`id`, `code`, `value`) VALUES
(1, 'logo', ''),
(3, 'phone_number', '111-222-3333'),
(2, 'email_address', 'test@test.com'),
(17, 'about_us', 'About Us'),
(4, 'contact_name', 'Contact Name'),
(5, 'address_1', 'Address 1'),
(6, 'address_2', ''),
(7, 'city', 'Somewhere'),
(8, 'state', 'Someplace'),
(9, 'zip', '00000'),
(10, 'hours_weekday', ''),
(11, 'hours_saturday', ''),
(12, 'hours_sunday', ''),
(13, 'facebook_link', ''),
(14, 'twitter_link', ''),
(15, 'linkedin_link', ''),
(16, 'instagram_link', '');

CREATE TABLE `users` (
  `id` bigint(30) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NOT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` varchar(10000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_time` timestamp NULL DEFAULT NULL,
  `session` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email_address`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `type`, `first_name`, `last_name`, `email_address`, `phone_number`, `password`, `notes`, `created_time`, `updated_time`, `session`) VALUES
(1, 0, 'Kelvin', 'Graddick', 'kelvingraddick@gmail.com', '7067736354', 'wavelink', '', '2018-03-18 15:00:11', NULL, 'none')

CREATE TABLE `admins` (
  `id` bigint(30) NOT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(10000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `session` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email_address`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `admins` (`id`, `first_name`, `last_name`, `email_address`, `phone_number`, `password`, `description`, `session`) VALUES
(1, 'Kelvin', 'Graddick', 'kelvingraddick@gmail.com', '7067736354', 'wavelink', '', '24.99.0.145');