CREATE DATABASE IF NOT EXISTS `justwatch`;
USE `justwatch`;


CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_email` (`email`) 
);


CREATE TABLE IF NOT EXISTS `contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imdb` varchar(15) NOT NULL,
  `provider` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_imdb` (`imdb`) 
);


CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(255) NOT NULL,
  `imdb_c` varchar(15) NOT NULL,
  `text` text NOT NULL,
  `date_c` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_email`) REFERENCES `users` (`email`),
  FOREIGN KEY (`imdb_c`) REFERENCES `contents` (`imdb`)
);


CREATE TABLE IF NOT EXISTS `providers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `url` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `lists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `imdb` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`imdb`) REFERENCES `contents` (`imdb`),
  FOREIGN KEY (`email`) REFERENCES `users` (`email`)
);