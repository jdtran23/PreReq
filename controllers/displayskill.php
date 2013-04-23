<?php
class Displayskill_Controller
{
	private $view_name = 'displayskill';
	
	public function main(array $get_variables)
	{
		$add_favorites_flag;

		if(2!=session_status())
			session_start();
		$displayskill_model = new Displayskill_Model;
		
		if(isset($get_variables['topic']))
		{
			$topic = rawurldecode($get_variables['topic']);
			$result = $displayskill_model->addSkill($topic);
		}
		else
			exit();

		if(isset($get_variables['fav']) && isset($_SESSION['user']))
		{
			$favorites_model = new Favorites_Model;
			$add_favorites_flag = $favorites_model->addFavorites($topic, $_SESSION['user']);
		}

		if(isset($get_variables['prereq']) && !empty($get_variables['prereq']))
		{
			$prereq = rawurldecode($get_variables['prereq']);
			$displayskill_model->addSkill($prereq);
			if(isset($get_variables['newprereq']) && 1 == $get_variables['newprereq'])
				$displayskill_model->addSuperSubskill($topic, $prereq);
		}

		//Do a confirmation that the topic we want to view exists in our database.
		$prereq_results = $displayskill_model->findURL($topic);
		if(is_object($prereq_results))
		{
			$view_model = new View_Model($this->view_name);
			$view_model->assign('topic', $topic);
			$view_model->assign('results_obj', $displayskill_model->getPrereqs($topic));
			if(isset($add_favorites_flag))
				$view_model->assign('add_fav_flag', $add_favorites_flag);
		}
		else
			echo "404.";
		
	}

} 
?>
