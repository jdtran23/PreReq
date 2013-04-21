<?php
class Favorites_Controller
{
	private $view_name = "favorites";
	public function main($get_args)
	{
		if(2!=session_status())
			session_start();

		$favorites_model = new Favorites_Model;
		if(!isset($_SESSION['user']))
			die("Please Log in");

		/*Is a URL DECODE operation required for the get_args? */
		if(isset($get_args['del']))
			if(!$favorites_model->deleteFavorites(rawurldecode($get_args['del']), $_SESSION['user']))
				die("Favorite Deletion Failed");

		$favorite_result = $favorites_model->getFavorites($_SESSION['user']);
		if(!is_object($favorite_result))
			die("Failed to find your favorites!");

		$favorites_view = new View_Model($this->view_name);
		$favorites_view->assign("fav_array", $favorite_result);
	}
}