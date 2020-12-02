CREATE DATABASE IF NOT EXISTS `imagespark` /*!40100 DEFAULT CHARACTER SET utf8 */;

CREATE TABLE IF NOT EXISTS `articles` (
                                          `id` int(11) NOT NULL AUTO_INCREMENT,
                                          `article_name` varchar(255) NOT NULL,
                                          `text` varchar(8000) CHARACTER SET utf8 NOT NULL,
                                          `created_by` varchar(255) NOT NULL,
                                          `created_at` timestamp(6) NOT NULL,
                                          PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `users` (
                                       `id` int(11) NOT NULL AUTO_INCREMENT,
                                       `login` varchar(255) NOT NULL,
                                       `name` varchar(255) NOT NULL,
                                       `surname` varchar(255) NOT NULL,
                                       `email` varchar(320) NOT NULL,
                                       `address` varchar(255) NOT NULL,
                                       PRIMARY KEY (`id`),
                                       UNIQUE KEY `users_login_uindex` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8