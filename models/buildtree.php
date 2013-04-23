<?php                                                                  
    $arg = $_POST['arg'];                                                                                                                  

	$array;
	$db = new mysqli("engr-cpanel-mysql.engr.illinois.edu", "prereq_guest", "guest", "prereq_Wikipedia_Pages");

	function dfs($skill, $depth) {
		 
		global $array;
		global $db;
		  
		if(mysqli_connect_errno())
			die('Database Connection Fail'.mysql_error());
			
		$query = "SELECT sub_name FROM Super_Sub_Skill WHERE super_name = '".$skill."'";
		$result = $db->query($query);
		
		$valueArray = array();
		
		++$depth;
		while($row = mysqli_fetch_array($result))
		{
			array_push($valueArray, $row[0]);
			dfs($row[0], $depth);
		}
		
		/*
		 *	Odd number index = KEY
		 *	Even number index = VALUE array
		 */
		$arr = array($skill, $valueArray); 
		$array = array_merge((array)$array, $arr);
	}
	dfs($arg, 0);
	echo json_encode(array('Array' => $array));
?>