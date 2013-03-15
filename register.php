<?php include("header.php"); ?>

<?php
	$db = new mysqli("engr-cpanel-mysql.engr.illinois.edu", "prereq_guest", "guest", "prereq_Wikipedia_Pages");  //Arbitrary selected credentials.
	if(mysqli_connect_errno())
		die('Database Connection Fail'.mysql_error());
?>
<html>
<head>
	<title>REGISTRATION</title>
</head>
<body>
	<h1>Registration </h1>
	<?php
	if(!empty($_POST['username']))
	{
	//Reminder : check for minimum lengths, etc. maybe in the sending page.
	$register_username = trim($_POST['username']).'';
	$register_password = trim($_POST['password']).'';
	$register_email = trim($_POST['email']).'';
	
	if ( !$register_email || !$register_password || !$register_username )
	{
		print "Left something blank?";
		exit();
	}
		//Prepared query begin.
		$query = "INSERT INTO `Users` (`user_name`, `password`, `email`) VALUES (?,?,?)";
		$stmt = $db->prepare($query);
		//Bind parameters.	
		$stmt->bind_param("sss", $register_username, $register_password, $register_email);
		//Send query.
		$result = $stmt->execute();
		$stmt->close();
		if($result)
		{
			print "Registration Success!";
			exit();
		}
	}
	if(!empty($_POST['username']))
		print "User or email already exists!";
		
	echo '<form action = "register.php" method = "post">';
	echo 'Username : <input name ="username" type="text"  maxlength="12" size="12"/><br/>';
	echo 'Password : <input name ="password" type="password"  maxlength="12" size="12"/><br/> ';
	echo 'Email : <input name ="email" type="text"  maxlength="30" size="24"/><br/> ';
	echo '<input type ="submit" name ="submit" value="Register"/>';
	echo '</form>';
	
	?>
</body>
</html>

<?php 
	$db->close();
?>