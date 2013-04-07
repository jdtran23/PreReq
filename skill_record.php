<?php
	include("header.php");
	//We'll be using the database for bringing in new skills, etc.
	$db = new mysqli("engr-cpanel-mysql.engr.illinois.edu", "prereq_guest", "guest", "prereq_Wikipedia_Pages");
	if(mysqli_connect_errno())
		die('Database Connection Fail'.mysql_error());
	//The odd mb_convert_encoding forces a double-encoded title name into the ISO standard.
	$skillName = mb_convert_encoding($_POST['skillName'],'ISO-8859-15','utf-8');
	$wikiURL = mb_convert_encoding($_POST['wikiURL'],'ISO-8859-15','utf-8');
	//echo $skillName." " ;
	//Tries to insert into database.
	$query = "INSERT INTO `Skill` VALUES (?,?)";
	$stmt = $db->prepare($query);
	$stmt->bind_param("ss", $skillName, $wikiURL);
	$result = $stmt->execute();
	//echo "result".$result;
	$stmt->close();
	
	$db->close();
?>