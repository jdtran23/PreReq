<?php

class Home_Controller
{
	public $view_name = 'home';
	
	public function main(array $getVariables)
	{
		$home_model = new Home_Model;
		$view_model = new View_Model($this->view_name);
		/*$test_model->readArticle('new');
		$view_model->assign('title', 'The Title');
		$view_model->assign('content', 'The content');*/
	}

}