<?php

class Chpass_Controller
{
	public $view_name = 'chpass';
	

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
			echo '
			<div class="row">
				<div class="span6"></div>
				<div class="span4">
					<form action = "index.php?chpass" method = "post">
					New Password : <input name ="new_password" type="password"  maxlength="12" size="12"/><br/> 
					Confirm Password : <input name ="pass_confirm" type="password" minlength = "6"  maxlength="12" size="12"/><br/> 
					Old Password : <input name ="old_password" type="password"  minlength = "6" maxlength="12" size="12"/><br/> 
					<input type ="submit" class = "btn btn-warning" name ="submit" value="Change Password"/>
					</form>
				</div>
			</div>
				
				';
		}	
		$db = new mysqli("engr-cpanel-mysql.engr.illinois.edu", "prereq_guest", "guest", "prereq_Wikipedia_Pages");  //Arbitrary selected credentials.
		if(mysqli_connect_errno())
			die('Database Connection Fail'.mysql_error());

		//Confirm that a user has properly filled in the form with all the values.
		$empty_new_pass = empty($_POST['new_password']);
		$empty_confirm_pass = empty($_POST['pass_confirm']);
		$empty_old_pass = empty($_POST['old_password']);
		if(!$empty_new_pass && !$empty_old_pass && !$empty_confirm_pass  && isset($_SESSION['user']))
		{
			if($_POST['new_password'] != $_POST['pass_confirm'])
				die("The passwords do not match");
			$old_pass = hash("sha256",$db->real_escape_string($_POST['old_password']) );
			$user = $db->real_escape_string($_SESSION['user']);
			$query = "SELECT * FROM User WHERE username = '".$user."' AND password = '".$old_pass."'";	
			$result = $db->query($query);
			if(1 == $result->num_rows)
			{
				$new_pass = hash("sha256", trim($_POST['new_password']));
				$query = "UPDATE User SET password='".$new_pass."' WHERE username = '".$_SESSION['user']."'";
				$result = $db->query($query);
				//echo $result;
				if(1==$result)
					echo "Password Changed Successfully";
				else
					echo "Password Change Failed";
			}
			else
				echo "Credentials incorrect"; 
		}
	}

}
