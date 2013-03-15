<?php

	include("header.php"); 


		//session_start();
		if(!isSet($_SESSION['user']))
		{
			echo "LOG IN";
			break;
		}
		else {
			$user = $_SESSION['user'];
			$topic = $_GET['topic'];
			$db = new mysqli("engr-cpanel-mysql.engr.illinois.edu", "prereq_guest", "guest", "prereq_Wikipedia_Pages");  
			if(mysqli_connect_errno())
				die('Database Connection Fail'.mysql_error());
			
			$query = "INSERT INTO `Favorites`(`user_name`, `skill_title`) VALUES ('".$user."','".$topic."')";
			$result = $db->query($query);
		}
	Header( "Location: favorites.php" );
?>