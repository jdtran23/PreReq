<?php include("navbar.php"); ?>

<?php
	$db = new mysqli("engr-cpanel-mysql.engr.illinois.edu", "prereq_guest", "guest", "prereq_Wikipedia_Pages");  //Arbitrary selected credentials.
	if(mysqli_connect_errno())
		die('Database Connection Fail'.mysql_error());
?>
<html>
<head>
	<title>Registration</title>
	<script src = "js/jquery.validate.js" type = "text/javascript"></script>
	
	<script src = "js/register.js" type = "text/javascript"></script>
</script>
	
	
</head>
<body onLoad="document.forms.registerform.username.focus()">

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
	?>
	
	 <div class="span4">
    </div>
	
	<div class="span5" >
	<h1 class="pagination-centered">Registration </h1>
		<fieldset>
		<form action = "register.php" method = "post" id="registerform"class="form-horizontal">
		<div class="control-group">
				<label class="control-label" for="username">Username: </label> 
				<div class="controls"><input name ="username" type="text"  maxlength="12" size="12"/>
				</div>
				</div>
		<div class="control-group">
				<label class="control-label" for="password">Password: </label>
				<div class="controls">
				<input name ="password" type="password"  maxlength="12" size="12"/>
				</div></div>
		<div class="control-group">
			<label class="control-label" for="email">Email: </label><div class="controls"><input name ="email" type="text"  maxlength="30" size="24"/></div></div>
		<input type ="submit" name ="submit" value="Register" class="btn btn-primary pull-right"/>
		</form>
		</fieldset>
	</div>
	 <div class="span3>
    </div>
	

	

</body>
</html>

<?php 
	$db->close();
?>