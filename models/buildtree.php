<?php                                                                  
    $arg = $_POST['arg'];                                                                                                                  

	$array;
	$db = new mysqli("engr-cpanel-mysql.engr.illinois.edu", "prereq_user", "prereq", "prereq_final");

	function dfs($skill, $depth) {
		 
		global $array;
		global $db;
		  
		if(mysqli_connect_errno())
			die('Database Connection Fail'.mysql_error());
			
		$query = "SELECT skill_name2 FROM SuperSubSkill WHERE skill_name1 = '".$skill."'";
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