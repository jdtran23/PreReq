<?php include("header.php"); ?>


<?php
	//get access to session global array
	session_start();
	
	$old_user = $_SESSION['user'];
	unset($_SESSION['user']);
	session_destroy();\
	printf("<script>location.href='index.php'</script>");
?>
<!--
<html>
<body>
<?php/* 
	if(empty($old_user))
		print "You weren't even logged in... <br>";
	else
		print "Logged out <br>";
		*/
?>
<a href="login.php" class="btn btn-primary">Back to Login</a>

</body>
</html>

-->