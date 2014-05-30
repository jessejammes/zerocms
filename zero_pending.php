<?php
// (c)Perez Karjee(www.aas9.in)
// Project Site www.aas9.in/zerocms
// Created March 2014
require 'db.kate.php';
include 'header.kate.php';

$dbx = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD) or
    die ('Unable to connect. Check your connection parameters.');

mysql_select_db(MYSQL_DB, $dbx) or die(mysql_error($dbx));

echo '<h2>Article Availability</h2>';

echo '<h3>Pending Articles</h3>';
$sql = 'SELECT
        article_id, title, UNIX_TIMESTAMP(submit_date) AS submit_date
    FROM
        zero_articles
    WHERE
        is_published = FALSE
    ORDER BY
        title ASC';
$result = mysql_query($sql, $dbx) or die(mysql_error($dbx));

if (mysql_num_rows($result) == 0) {
    echo '<p><strong>No pending articles available.</strong></p>';
} else {
    echo '<ul>';
    while ($row = mysql_fetch_array($result)) {
        echo '<li><a href="zero_review_article.php?article_id=' .
            $row['article_id'] . '">' . htmlspecialchars($row['title']) .
            '</a> (' . date('F j, Y', $row['submit_date']) . ')</li>';
    }
    echo '</ul>';
}
mysql_free_result($result);

echo '<h3>Published Articles</h3>';
$sql = 'SELECT
        article_id, title, UNIX_TIMESTAMP(publish_date) AS publish_date
    FROM
        zero_articles
    WHERE
        is_published = TRUE
    ORDER BY
        title ASC';
$result = mysql_query($sql, $dbx) or die(mysql_error($dbx));

if (mysql_num_rows($result) == 0) {
    echo '<p><strong>No published articles available.</strong></p>';
} else {
    echo '<ul>';
    while ($row = mysql_fetch_array($result)) {
        echo '<li><a href="zero_review_article.php?article_id=' .
            $row['article_id'] . '">' . htmlspecialchars($row['title']) .
            '</a> (' . date('F j, Y', $row['publish_date']) . ')</li>';
    }
    echo '</ul>';
}
mysql_free_result($result);

include 'footer.kate.php';
?>
