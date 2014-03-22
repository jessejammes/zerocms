<?php
// (c)Perez Karjee(www.aas9.in)
// Project Site www.aas9.in/zerocms
// Created March 2014
require 'db.kate.php';
require 'functions.kate.php';

$dbx = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD)
	or die('Fuck!,Unable To Connect.');
mysql_select_db(MYSQL_DB, $dbx) or die(mysql_error($dbx));

include 'header.kate.php';
output_story($dbx, $_GET['article_id']);
show_comments($dbx, $_GET['article_id'], TRUE);

include 'footer.kate.php';
?>
