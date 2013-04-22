<?php include("navbar.php"); ?>
<html>
<head>

	<title>LOG-IN Page</title>
	
</head>
<body>

	<h1>Login Page</h1>
<form action = "index.php?login" method = "post">
Username : <input name ="username" type="text"  maxlength="12" size="12"/><br/>
Password : <input name ="password" type="password"  maxlength="12" size="12"/><br/>
<input type ="submit" name ="submit" class="btn" value="Log In"/>
<a href="index.php?register">Register</a>
</form>';

