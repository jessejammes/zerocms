<?php
// (c)Perez Karjee(www.aas9.in)
// Project Site www.aas9.in/zerocms
// Created March 2014
include 'header.kate.php';
?>
<h1>Member Login</h1>
<form method="post" action="zero_transact_user.php">
<table>
	<tr>
		<td><label for email="email">Email Address:</label></td>
		<td><input type="text" id="email" name="email" maxlength="100"/></td>
	</tr>
	<tr>
		<td><label for="password">Password</label></td>
		<td><input type="password" id="password" name="password" maxlength="20"/></td>
	</tr>
	<tr>
		<td> </td>
		<td><input type="submit" name="action" value="Login"/></td>
		</tr>
</table>
</form>
<p>Not A Member Yet ? <a href="zero_user_account.php">Create A New Account</a></p>
<p><a href="zero_forgot_password.php">Forgot Your Password ?</a></p>
<?php include 'footer.kate.php';
?>
