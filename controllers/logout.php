<?php
include_once(SERVER_ROOT."/resources/lib.php");
class Logout_Controller{

	public function main()
	{
		if(session_status()!= 2)
			session_start();
		if(isset($_SESSION['user']))
		{
			unset($_SESSION['user']);
			include_once(SERVER_ROOT."/views/navbar.php");
			redirectToHomepage();
		}
		else
		{
			include_once(SERVER_ROOT."/views/navbar.php");
			redirectToHomepage();
		}
	}

}
