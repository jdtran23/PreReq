<?php 

class View_Model
{
	//Buffer for values we put onto the page
	private $data= array();
	private $render= FALSE;
	
	public function __construct($page)
	{
		$file=SERVER_ROOT.'/views/'.strtolower($page).'.php';
		//If the file can be found, put the file location in the render variable
		//so that we can first populate the $data array before we render.
		if(file_exists($file))
			$this->render=$file;
	}

	public function assign($variable, $value)
	{	
		$this->data[$variable]=$value;
	}
	
	public function __destruct()
	{
		//create a local resource object that holds assigned values.
		$data = $this->data;
		//include the view file, now with valid $data values
		include($this->render);
	}
}