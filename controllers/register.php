<?php
include_once(SERVER_ROOT."/resources/lib.php");

class Register_Controller
{
	private $view_name = "register";

	public function main($get_variables)
	{
		if(session_status() != 2)
			session_start();
		if(isset($_SESSION['user']))
			redirectToHomepage();
			
		$registerView = new View_Model($this->view_name);
		

		/* 	If either username or password is not sent, do not try to register. 
			If only one of the username/password fields are unset, we alert the user */
		if(!isset($_POST['username']) || !isset($_POST['password']) || !isset($_POST['email']))
		{
			if(! (!isset($_POST['username']) && !isset($_POST['password']) && !isset($_POST['email']))) 
				$registerView->assign("badDetails", TRUE);
		}
		else
		{
			$username = rawurlencode($_POST['username']);
			$password = rawurlencode($_POST['password']);
			$email = rawurlencode($_POST['email']);

			if($username != $_POST['username'] || $password != $_POST['password'])
				$registerView->assign("invalidChars", TRUE);
			else
			{
				$register_model = new Register_Model;
				$result = $register_model->addUser($username, $password,$email);	
				$registerView->assign("regResult", $result); 
			}
		}
	}
		
}
