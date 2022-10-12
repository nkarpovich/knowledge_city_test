DROP TABLE IF EXISTS `api_users`;
CREATE TABLE `api_users`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `username` (`username`)
);

DROP TABLE IF EXISTS `students`;
CREATE TABLE `students`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    `last_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `username` (`username`)
);