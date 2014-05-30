<?php
// (c)Perez Karjee(www.aas9.in)
// Project Site http://www.aas9.in/zerocms
// Github http://github.com/pcx1256/zerocms
// Created March 2014

require 'db.kate.php';

$dbx = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD) or
	die ('Fuck! unable to connect.');
	
mysql_select_db(MYSQL_DB, $dbx) or die(mysql_error($dbx));

$sql = 'CREATE TABLE IF NOT EXISTS zero_access_levels(
		access_level 	TINYINT UNSIGNED 	NOT NULL AUTO_INCREMENT,
		access_name 	VARCHAR(50) 		NOT NULL DEFAULT " ",
		PRIMARY KEY (access_level)
)

ENGINE=MyISAM';
mysql_query($sql, $dbx) or die(mysql_error($dbx));

$sql = 'INSERT IGNORE INTO zero_access_levels
		(access_level, access_name)
	VALUES
		(1, "User"),
		(2, "Moderator"),
		(3, "Administrator")';
mysql_query($sql, $dbx) or die(mysql_error($dbx));

$sql = 'CREATE TABLE IF NOT EXISTS zero_users (
		user_id 		INTEGER UNSIGNED 	NOT NULL AUTO_INCREMENT,
		email			VARCHAR (100) 		NOT NULL UNIQUE,
		password		CHAR(41) 			NOT NULL,
		name			VARCHAR(100) 		NOT NULL,
		access_level 	TINYINT UNSIGNED 	NOT NULL DEFAULT 1,
		PRIMARY KEY(user_id)
		)
	ENGINE=MyISAM';
mysql_query($sql, $dbx) or die(mysql_error($dbx));
$sql = 'INSERT IGNORE INTO zero_users
		(user_id, email, password, name, access_level)
		VALUES
		(NULL, "admin@domain.com", PASSWORD("password"), "Administrator", 3)';
	mysql_query($sql, $dbx) or die(mysql_error($dbx));
	
$sql = 'CREATE TABLE IF NOT EXISTS zero_articles (
		article_id 		INTEGER UNSIGNED 	NOT NULL AUTO_INCREMENT,
		user_id 		INTEGER UNSIGNED 	NOT NULL,
		is_published 	BOOLEAN 			NOT NULL DEFAULT FALSE,
		submit_date 	DATETIME 			NOT NULL,
		publish_date 	DATETIME,
		title 			VARCHAR(255) 		NOT NULL,
		article_text 	MEDIUMTEXT,
		
		PRIMARY KEY(article_id),
		FOREIGN KEY(user_id) REFERENCES zero_users(user_id),
		INDEX(user_id, submit_date),
		FULLTEXT INDEX (title, article_text)
		)
		ENGINE=MyISAM';
	mysql_query($sql, $dbx) or die(mysql_error($dbx));
	
$sql = 'CREATE TABLE IF NOT EXISTS zero_comments (
		comment_id		INTEGER UNSIGNED 	NOT NULL AUTO_INCREMENT,
		article_id		INTEGER UNSIGNED 	NOT NULL,
		user_id			INTEGER UNSIGNED 	NOT NULL,
		comment_date 	DATETIME 			NOT NULL,
		comment_text 	MEDIUMTEXT,
		
		PRIMARY KEY(comment_id),
		FOREIGN KEY(article_id) REFERENCES zero_articles(article_id),
		FOREIGN KEY(user_id) REFERENCES zero_users(user_id)
)
	ENGINE=MyISAM';
mysql_query($sql, $dbx) or die(mysql_error($dbx));
echo 'Fuck Yeah! Successfull';
?>
