<?php
include_once(SERVER_ROOT."/models/database.php");
class Displayskill_Model
{
	private $db_conn = NULL;
	public function __construct()
	{
        //Make a database connection, store it as a variable.
        if(!class_exists("Database_Model"))
            echo "DEBUG ME -> Database model not found.";
        else
        {
            $this->db_conn = new Database_Model;
        }

	}

	//returns -1 if no user logged in, session is destroyed(no user logged in), or empty topic is passed in
	public function upvote($super, $sub)
	{
		//Sanitizing may cause trouble for pages with special chars.
		$super = $this->db_conn->sanitize($super);
		$sub = $this->db_conn->sanitize($sub);
		if(empty($super) || empty($sub) || 2!=session_status() || !isset($_SESSION['user']) )
			return -1;	
		$query = 'INSERT INTO Upvotes VALUES ("'.$super.'","'.$sub.'","'.$_SESSION['user'].'")';
		$result = $this->db_conn->plainQuery($query);
		if(is_object($result))
			return 1;
		/* Query failed */
		return 0;
	}

	public function downvote($super, $sub)
	{
		//Sanitizing may cause trouble for pages with special chars.
		$super = $this->db_conn->sanitize($super);
		$sub = $this->db_conn->sanitize($sub);
		if(empty($super) || empty($sub) || 2!=session_status() || !isset($_SESSION['user']) )
			return -1;	
		$query = 'INSERT INTO Downvotes VALUES ("'.$super.'","'.$sub.'","'.$_SESSION['user'].'")';
		$result = $this->db_conn->plainQuery($query);
		if(is_object($result))
			return 1;
		/* Query failed */
		return 0;
	}

	public function addSuperSubskill($super, $sub)
	{
		$super = $this->db_conn->sanitize($super);
		$sub = $this->db_conn->sanitize($sub);
		$super_url = 'http://en.wikipedia.org/wiki/'.$super;
		$sub_url = 'http://en.wikipedia.org/wiki/'.$sub;
		//Super skill, url, subskill, url, upvotes, downvotes
		$query = 'INSERT INTO SuperSubSkill VALUES ("'.$super.'", "'.$sub.'")';
		return $this->db_conn->plainQuery($query);
	}
	
	public function findURL($skill)
	{	
		$skill = $this->db_conn->sanitize($skill);
		//$wikiURL = 'http://en.wikipedia.org/wiki/'.$skill;
		//$query = 'SELECT * FROM Skill WHERE url = "'.$wikiURL.'"';
		$query = 'SELECT * FROM Skill WHERE skill_name = "'.$skill.'"';
		return $this->db_conn->plainQuery($query);
	}

	public function getPrereqs($skill)
	{
		$skill = $this->db_conn->sanitize($skill);
		//$wikiURL = 'http://en.wikipedia.org/wiki/'.$skill;
		//$query = 'SELECT * FROM SuperSubSkill WHERE skill1 = "'.$wikiURL.'"';
		$query = 'SELECT * FROM SuperSubSkill WHERE skill_name1 = "'.$skill.'"';
		return $this->db_conn->plainQuery($query);
	}

	public function addSkill($skill)
	{
		$skill = $this->db_conn->sanitize($skill);
		$wikiURL = 'http://en.wikipedia.org/wiki/'.$skill;
		$query = 'INSERT INTO Skill VALUES ("'.$skill.'","'.$wikiURL.'")';
		$result = $this->db_conn->plainQuery($query);
		if(is_object($result))
			return true;
		/* Query failed */
		return false;
	}
	
	public function getUpvoteCount($superskill, $subskill)
	{
		$subskill = $this->db_conn->sanitize($subskill);
		$superskill = $this->db_conn->sanitize($superskill);
		$query = 'SELECT COUNT(username) FROM Upvotes WHERE skill_name1 = "'.$superskill.'" AND skill_name2 ="'.$subskill.'"';
		$result = $this->db_conn->plainQuery($query);
		$num = $result->fetch_row()[0];
		if(is_object($result))
			return $num;
		/* Query failed */
		return false;
	}
	
	public function getDownvoteCount($superskill, $subskill)
	{
		$subskill = $this->db_conn->sanitize($subskill);
		$superskill = $this->db_conn->sanitize($superskill);
		$query = 'SELECT COUNT(username) FROM Downvotes WHERE skill_name1 = "'.$superskill.'" AND skill_name2 ="'.$subskill.'"';
		$result = $this->db_conn->plainQuery($query);
		$num = $result->fetch_row()[0];
		if(is_object($result))
			return $num;
		/* Query failed */
		return false;
	}


	
}
