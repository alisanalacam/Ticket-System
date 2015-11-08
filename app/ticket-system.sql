SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

CREATE TABLE IF NOT EXISTS `ticket_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `ticket_id` (`ticket_id`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `ticket_category` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_name` (`category_name`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `ticket_priority` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `priority_name` varchar(30) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `priority_name` (`priority_name`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `ticket_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) NOT NULL,
  `reply_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reply_id` (`reply_id`),
  KEY `ticket_id` (`ticket_id`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `ticket_status` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(30) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `status_name` (`status_name`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `ticket_topic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `recepient_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `category_id` smallint(6) NOT NULL,
  `priority_id` smallint(6) NOT NULL,
  `status_id` smallint(6) NOT NULL DEFAULT '1',
  `content` text NOT NULL,
  `user_ip` varchar(20) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `deleted` (`deleted`),
  KEY `status_id` (`status_id`),
  KEY `category_id` (`category_id`),
  KEY `priority_id` (`priority_id`),
  KEY `recepient_id` (`recepient_id`),
  KEY `author_id` (`author_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `salt` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '0',
  `role` text,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

INSERT INTO `users` (`id`, `name`, `surname`, `username`, `email`, `salt`, `password`, `enabled`, `role`, `deleted`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'ALAÇAM', NULL, 'admin@gmail.com', 'hc03oebynuo0kk0gg04ww4w8kccosgs', '7R61WzkipiJy4WT9OpxDkylq0H24rKz5oRLtBqfeTcXk3lqlgjCZF16JA8sZp9VjXWl9M+1DLMEl27/hZzQXVw==', 1, 'ROLE_ADMIN', 0, '2015-11-07 12:19:58', NULL, NULL),
(2, 'Alişan', 'ALAÇAM', NULL, 'alisanalacam@gmail.com', 'hc03oebynuo0kk0gg04ww4w8kccosgs', '7R61WzkipiJy4WT9OpxDkylq0H24rKz5oRLtBqfeTcXk3lqlgjCZF16JA8sZp9VjXWl9M+1DLMEl27/hZzQXVw==', 1, 'ROLE_USER', 0, '2015-11-07 12:19:58', NULL, NULL);
