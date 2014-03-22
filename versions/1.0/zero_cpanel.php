<?php
// (c)Perez Karjee(www.aas9.in)
// Project Site www.aas9.in/zerocms
// Created March 2014
require 'db.kate.php';
require 'functions.kate.php';
include 'header.kate.php';

$dbx = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD) or
    die ('Unable to connect. Check your connection parameters.');


mysql_select_db(MYSQL_DB, $dbx) or die(mysql_error($dbx));

$sql = 'SELECT
        email, name
    FROM
        zero_users
    WHERE
        user_id=' . $_SESSION['user_id'];
$result = mysql_query($sql, $dbx) or die(mysql_error($dbx));

$row = mysql_fetch_array($result);
extract($row);
mysql_free_result($result);
?>
<h2>User Info</h2>
<form method="post" action="zero_transact_user.php">
 <table>
  <tr>
   <td><label for="name">Full Name:</label></td>
   <td><input type="text" id="name" name="name" maxlength="100"
     value="<?php echo htmlspecialchars($name); ?>"/></td>
  </tr><tr>
   <td><label for="email">Email Address:</label></td>
   <td><input type="text" id="email" name="email" maxlength="100"
     value="<?php echo htmlspecialchars($email); ?>"/></td>
  </tr><tr>
   <td> </td>
   <td><input type="submit" name="action" value="Change my info"/></td>
  </tr>
 </table>
</form>
<?php
echo '<h2>Pending Articles</h2>';

$sql = 'SELECT
        article_id, UNIX_TIMESTAMP(submit_date) AS submit_date, title
    FROM
        zero_articles
    WHERE
        is_published = FALSE AND
        user_id = ' . $_SESSION['user_id'] . '
    ORDER BY
        submit_date ASC';
$result = mysql_query($sql, $dbx) or die(mysql_error($dbx));

if (mysql_num_rows($result) == 0) {
    echo '<p><strong>There are currently no pending articles.</strong></p>';
} else {
    echo '<ul>';
    while ($row = mysql_fetch_array($result)) {
        echo '<li><a href="zero_review_article.php?article_id=' .
            $row['article_id'] . '">' . htmlspecialchars($row['title']) .
            '</a> (submitted ' . date('F j, Y', $row['submit_date']) .
            ')</li>';
    }
    echo '</ul>';
}
mysql_free_result($result);

echo '<h2>Published Articles</h2>';

$sql = 'SELECT
        article_id, UNIX_TIMESTAMP(publish_date) AS publish_date, title
    FROM
        zero_articles
    WHERE
        is_published = TRUE AND
        user_id = ' . $_SESSION['user_id'] . '
    ORDER BY
        publish_date ASC';
$result = mysql_query($sql, $dbx) or die(mysql_error($dbx));

if (mysql_num_rows($result) == 0) {
    echo '<p><strong>There are currently no published articles.</strong></p>';
} else {
    echo '<ul>';
    while ($row = mysql_fetch_array($result)) {
        echo '<li><a href="zero_review_article.php?article_id=' .
            $row['article_id'] . '">' . htmlspecialchars($row['title']) .
            '</a> (published ' . date('F j, Y', $row['publish_date']) .
            ')</li>';
    }
    echo '</ul>';
}
mysql_free_result($result);

include 'footer.kate.php';
?>
