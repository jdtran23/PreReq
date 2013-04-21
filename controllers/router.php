<?php
/* This file describes MVC Front Controller.
URI is parsed to determine the correct page.
*/

//Function is automatically invoked when a working with undefined objects.
function __autoload($className)
{
	//Our class naming convention goes like className_Controller. Parse the class name.
	list($class, $garbage) = explode('_', $className);
	$file = SERVER_ROOT.'/models/'.strtolower($class).'.php';
	
	if(file_exists($file))
	{
		include_once($file);
	}
	else
	{
		die($file.' not found.');
	}
}

#Replace QUERY_STRING with the page to be shown.
#http://www.example.com/index.php?QUERY_STRING&example_get=example_value
$request = $_SERVER['QUERY_STRING'];
$parsed = explode('&', $request);
$pageRequest = array_shift($parsed);

#Retrieved the GET variables
$getVars = array();
foreach($parsed as $parsedGET)
{
	list($variable, $value) = explode ('=', $parsedGET);
	$getVars[$variable] = $value;		
}

#No particular page requested, go to our homepage
if(empty($pageRequest))
	$pageRequest=HOME_PAGE;

$targetURL = SERVER_ROOT.'/controllers/'.strtolower($pageRequest).'.php';
//Creates the appropriated class object for requested web page.
if(file_exists($targetURL))
{
	//Load code for target webpage	
	include_once($targetURL);
	$className = ucfirst($pageRequest).'_Controller';
	if(class_exists($className))
		$controller = new $className; 
	else
		die("Class not found!");
}
else
	die('404 File not found');
	
$controller->main($getVars);
