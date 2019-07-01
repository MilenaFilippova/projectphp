create table `tasks` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`topic` VARCHAR(255),
	`type_n` INT(10) NOT NULL,
	`place` VARCHAR(255),
	`date_reserv` date,
	`time_reserv` time,
	`length` INT(10),
	`comment` TEXT,
	`status` ENUM('yes', 'no') DEFAULT 'no',
	PRIMARY KEY(`id`),
	INDEX `date` (`date_reserv`),
	INDEX `time` (`time_reserv`),
	INDEX `done` (`status`)
);