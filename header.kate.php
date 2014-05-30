<?php session_start(); 
/// (c)Perez Karjee(www.aas9.in)
// Project Site www.aas9.in/zerocms
// Created March 2014
?>
<html>
<head>
<title>ZeroCMS</title>
<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
<h1>ZeroCMS</h1>
<?php
if(isset($_SESSION['name'])){
	echo '<p>You are currently logged in as: ' . $_SESSION['name'] . ' </p>';
}
?>
</div>
<div id="navright">
<form method="get" action="zero_search.php">
<div>
<label for="search">Search</label>
<?php
echo '<input type="text" id="search" name="search" ';
if(isset($_GET['keywords'])){
	echo ' value="' . htmlspecialchars($_GET['keywords']) . '" ';
	}
	echo '/>';
?>

<input type="submit" value="search" />
</div>
</form>
</div>
<div id='navigation'>
<a href="index.php">Articles</a>
<?php
if(isset($_SESSION['user_id'])){
	echo ' | <a href="zero_compose.php">Compose</a>';
	if($_SESSION['access_level'] > 1){
	echo ' | <a href="zero_pending.php">Review</a>';
	}
if($_SESSION['access_level'] > 2){
echo ' |<a href="zero_admin.php">Admin</a>';
}
echo ' | <a href="zero_cpanel.php">Kontrol Panel</a>';
echo ' | <a href="zero_transact_user.php?action=Logout">Logout</a>';
}
else {
	echo ' | <a href="zero_login.php">Login</a>';
}
	?>
	</div>
	<div id="articles">
