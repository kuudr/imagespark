CREATE TABLE `articles` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `article_name` varchar(255) NOT NULL,
                            `text` varchar(8000) CHARACTER SET utf8 NOT NULL,
                            `created_by` varchar(255) NOT NULL,
                            `created_at` timestamp(6) NOT NULL,
                            PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1
