<?php 
include_once(SERVER_ROOT."/resources/lib.php");

class Login_Controller
{
	private $view_name = "login";
	
	public function main(array $get_variables)
	{
		session_start();
		if(isset($_SESSION['user']))
			redirectToHomepage();
		else
		{	
			//Not logged in.
			$login_model = new Login_Model;
			if(isset($_POST['username']) && isset($_POST['password']))
			{
				$login_username = trim($_POST['username']).'';
				$login_password = trim($_POST['password']).'';
			
				$result = $login_model->loginUser($login_username, $login_password);	
				//Was user found?
				if($result)	
				{
					$_SESSION['user']=$login_username;
					redirectToHomepage();
				}
				echo "Login Failed! Try again.";
			}
		}
		//Login failed or there was no attempt at all.
		$login_view = new View_Model($this->view_name); 

	}


}


?>
