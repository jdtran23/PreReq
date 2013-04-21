<?php

class Chpass_Controller
{
	public $view_name = 'test';
	

	//Bypass all MVC classes and stuff because this file is really small to begin with..
	public function main(array $getVariables)
	{
		include_once(SERVER_ROOT."/views/navbar.php");
		if(2!=session_status())
			session_start();

		if(!isset($_SESSION['user']))
		{
			echo "No user logged in. Cannot change password";
			exit();
		}
		else
		{				
			echo '<form action = "index.php?chpass" method = "post">';
			echo 'New Password : <input name ="new_password" type="password"  maxlength="24" size="12"/><br/> ';
			echo '<input type ="submit" class = "btn btn-warning" name ="submit" value="Change Password"/>';
			echo '</form>';
		}
		
		$db = new mysqli("engr-cpanel-mysql.engr.illinois.edu", "prereq_guest", "guest", "prereq_Wikipedia_Pages");  //Arbitrary selected credentials.
		if(mysqli_connect_errno())
			die('Database Connection Fail'.mysql_error());

		if(!empty($_POST['new_password']) && isset($_SESSION['user'])) //USER LOGGED IN AND SUBMITTED A NEW PASSWORD
		{
			$new_pass = trim($_POST['new_password']).'';
			$query = "UPDATE Users SET password='".$new_pass."' WHERE user_name = '".$_SESSION['user']."'";
			$result = $db->query($query);
			//echo $result;
			if(1==$result)
				echo "Password Changed Successfully";
		}

	}

}