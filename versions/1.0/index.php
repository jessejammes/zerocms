<?php
// (c)Perez Karjee(www.aas9.in)
// Project Site www.aas9.in/zerocms
// Created March 2014
require 'db.kate.php';
require 'functions.kate.php';

$dbx = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD) 
	or die('Fuck!, Unable to connect.');
	
mysql_select_db(MYSQL_DB, $dbx) or die(mysql_error($dbx));
include 'header.kate.php';

$sql = 'SELECT
		article_id
	FROM
		zero_articles
	WHERE
		is_published = TRUE
	ORDER BY
		publish_date DESC';
$result = mysql_query($sql, $dbx);

if(mysql_num_rows($result) == 0){
	echo '<p><strong>No Articles.</strong></p>';
} else {
		while ($row = mysql_fetch_array($result)) {
		output_story($dbx, $row['article_id'], TRUE);
	}
}
mysql_free_result($result);
include 'footer.kate.php';
?>
