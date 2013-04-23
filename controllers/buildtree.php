<?php
	class Buildtree_Controller
	{
		private $view_name = 'buildtree';
	
		public function main(array $get_variables)
		{
			$topic = rawurldecode($get_variables['topic']);
			
			$view_model = new View_Model($this->view_name);
			$view_model->assign('topic', $topic);
		}
	}
