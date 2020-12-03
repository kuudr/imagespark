CREATE TABLE IF NOT EXISTS `users` (
                                       `id` int(11) NOT NULL AUTO_INCREMENT,
                                       `login` varchar(255) NOT NULL,
                                       `name` varchar(255) NOT NULL,
                                       `surname` varchar(255) NOT NULL,
                                       `email` varchar(320) NOT NULL,
                                       `address` varchar(255) NOT NULL,
                                       PRIMARY KEY (`id`),
                                       UNIQUE KEY `users_login_uindex` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;