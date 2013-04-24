
<?php
    $arg = $_POST['arg'];                                                                                                                  

	$array;
	$dictionary;
	$db = new mysqli("engr-cpanel-mysql.engr.illinois.edu", "prereq_user", "prereq", "prereq_final");
	$skill = $arg;
	$query = "SELECT skill_name2 FROM SuperSubSkill WHERE skill_name1 = '".$skill."'";
	$result = $db->query($query);
	//print_r($result);

	function dfs($skill, $depth) {
		 
		global $array;
		global $db;
		global $dictionary;
		
		if(mysqli_connect_errno())
			die('Database Connection Fail'.mysql_error());
			
		$query = "SELECT skill_name2 FROM SuperSubSkill WHERE skill_name1 = '".$skill."'";
		$result = $db->query($query);
		//echo $result;
		
		$valueArray = array();
		$dictionary = array();
		
		++$depth;
		while($row = mysqli_fetch_array($result))
		{
			if(array_search($row[0],$dictionary)) continue;
			array_push($dictionary, $row[0]);

			array_push($valueArray, $row[0]);
			dfs($row[0], $depth);
		}
		$arr = array($skill, $valueArray); 
		$array = array_merge((array)$array, $arr);
	}
	
	dfs($arg, 0);
	echo json_encode(array('Array' => $array));

?>


