<?php

class Home_Model
{

	public function __construct()
	{
	}
	
	public function readArticle($articleName)
	{
		echo $this->articles[$articleName]['content'];
	}

}