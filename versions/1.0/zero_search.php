<?php
// (c)Perez Karjee(www.aas9.in)
// Project Site www.aas9.in/zerocms
// Created March 2014
require 'db.kate.php';
require 'functions.kate.php';

$dbx = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD)
	or die('Fuck!, Unable To Connect.');
	
mysql_select_db(MYSQL_DB, $dbx) or die(mysql_error($dbx));
include 'header.kate.php';

$search = (isset($_GET['search'])) ? $_GET['search'] : '';

$sql = 'SELECT
		article_id
	FROM
		zero_articles
	WHERE
		MATCH(title, article_text) AGAINST ("' . 
			mysql_real_escape_string($search, $dbx) . '" IN BOOLEAN MODE)
	ORDER BY
		MATCH(title, article_text) AGAINST ("' . 
			mysql_real_escape_string($search, $dbx) . '" IN BOOLEAN MODE)
	
	DESC';
$result = mysql_query($sql, $dbx) or die(mysql_error($dbx));

if(mysql_num_rows($result) == 0){
	echo '<p><strong>No Articles Found.</strong></p>';
}else{
	while($row = mysql_fetch_array($result)){
		output_story($dbx, $row['article_id'], TRUE);
	}
}
mysql_free_result($result);
include 'footer.kate.php';
?>
