<?php include("navbar.php"); ?>

<?php
	if(!isset($_POST['username']) || !isset($_POST['password']))
	{
		1==1; // Not sure how if/else rules work in PHP derp.	
		//If this case is evaluated. Execution falls through, and session is not set. Should display login page.
	}
	else
	{
		//Get access to the session array to do user verification
		session_start();
		$db = new mysqli("engr-cpanel-mysql.engr.illinois.edu", "prereq_guest", "guest", "prereq_Wikipedia_Pages");  //Arbitrary selected credentials.
		if(mysqli_connect_errno())
			die('Database Connection Fail'.mysql_error());

		$login_username = trim($_POST['username']).'';
		$login_password = trim($_POST['password']).'';
		
		
		//Prepared query begin.
		$query = "SELECT * FROM `Users` WHERE (`user_name`= ? AND `password`=?)";
		$stmt = $db->prepare($query);
		$stmt->bind_param("ss", $login_username, $login_password);
		$result = $stmt->execute();
		
		//Commits query tuples from request into object.
		$stmt->store_result();
		
		//Was user found?
		if(mysqli_stmt_affected_rows ($stmt))
		{	
			//Yes, create session id.
			$_SESSION['user']=$login_username;
					
			printf("<script>location.href='index.php'</script>");

		}
		else
		{
			printf("<script>location.href='login.php'</script>");
		}
		
		$stmt->close();
		
		$db->close();
	}
?>

<html>
<head>

	<title>LOG-IN Page</title>
	
</head>
<body>

	<h1>Login Page</h1>

	<?php
		if(isset($_SESSION['user']))
		{
			print 'you are logged in as '.$_SESSION['user'].'<br>';
			echo '<a href="logout.php" class="btn btn-primary"> LOG OUT </a><br/>';
		}
		else 
		{
			//prints the login page
			if(isset($login_username))
				print 'Login fail!';
			echo '<form action = "login.php" method = "post">';
			echo 'Username : <input name ="username" type="text"  maxlength="12" size="12"/><br/>';
			echo 'Password : <input name ="password" type="text"  maxlength="12" size="12"/><br/>';
			echo '<input type ="submit" name ="submit" class="btn" value="Log In"/>';
			echo ' <a href="register.php">Register</a>';
			echo '</form>';
		}
	?>
</body>
</html>
