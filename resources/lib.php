<?php
include_once(SERVER_ROOT."/controllers/home.php");
function redirectToHomepage()
{
		if(class_exists('Home_Controller'))
		{
			$mainPage = new Home_Controller;
			$mainPage->main([]);
		}
		else
			echo "Error trying to load the homepage";
		exit();
}
?>