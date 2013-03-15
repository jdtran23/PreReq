<?php

	$db = new mysqli("engr-cpanel-mysql.engr.illinois.edu", "prereq_guest", "guest", "prereq_Wikipedia_Pages");
	if(mysqli_connect_errno())
		die('Database Connection Fail'.mysql_error());
	session_start();
	if(!isset($_SESSION['user']))
	{
		Header( "Location: login.php" );
	}
	else
	{
		$del = $_GET['del'];
		$user = $_SESSION['user'];
		$query = "DELETE FROM Favorites WHERE user_name = '".$user."' AND skill_title='".$del."'";
		$result = $db->query($query);
		Header( "Location: favorites.php" );
	}
?>