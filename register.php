<?php include("header.php"); ?>

<?php
	$db = new mysqli("engr-cpanel-mysql.engr.illinois.edu", "prereq_guest", "guest", "prereq_Wikipedia_Pages");  //Arbitrary selected credentials.
	if(mysqli_connect_errno())
		die('Database Connection Fail'.mysql_error());
?>
<html>
<head>
	<title>Registration</title>

	<script src = "js/jquery.validate.js" type = "text/javascript"></script>
	
	
	<script>
	$(document).ready(function() {
  $("#register-form").validate({
    rules: {
      name: "required",    // simple rule, converted to {required: true}
      email: {             // compound rule
      required: true,
      email: true
      },
      password: {
        required: true
      },
    },
  });
});

</script>
	<!--
	<script>
  $(document).ready(function(){
    $.validator.addMethod("username", function(value, element) {
        return this.optional(element) || /^[a-z0-9\_]+$/i.test(value);
    }, "Username must contain only letters, numbers, or underscore.");
    $("#register-form").validate();
  });
  </script>
	-->
	<!--
	<script type="text/javascript"> 
8	    $(document).ready(function() { 
9	      $("#register-form").validate({ 
10	        rules: { 
11	          username: "required",// simple rule, converted to {required:true} 
				password:{
				required: true
				},
12	          email: {// compound rule 
13	          required: true, 
14	          email: true 
15	        	}
26	      }); 
27	    }); 
28	  </script> 
	-->
	
	
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
		
	echo '<form action = "register.php" method = "post" id="register-form">';
	echo 'Username : <input name ="username" type="text"  maxlength="12" size="12"/><br/>';
	echo 'Password : <input name ="password" type="password"  maxlength="12" size="12"/><br/> ';
	echo 'Email : <input name ="email" type="text"  maxlength="30" size="24"/><br/> ';
	echo '<input type ="submit" name ="submit" value="Register" class="btn btn-primary"/>';
	echo '</form>';
	
	?>
</body>
</html>

<?php 
	$db->close();
?>