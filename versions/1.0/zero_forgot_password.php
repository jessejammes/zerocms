<?php
// (c)Perez Karjee(www.aas9.in)
// Project Site www.aas9.in/zerocms
// Created March 2014
include 'header.kate.php';
?>
<h1>Recover Password</h1>
<p>Forgot Password ? Enter Your Email Here, we'll send you a new one</p>
<form method="post" action="zero_transact_user.php">
	<div>
		<label for="email">Email Address: </label>
		<input type="text" id="email" name="email" maxlength="100"/>
		<input type="submit" name="action" value="Recover Password"/>
	</div>
</form>
<?php include 'footer.kate.php';
?>
