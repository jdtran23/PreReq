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

	public function addSuperSubskill($super, $sub)
	{
		$super_url = 'http://en.wikipedia.org/wiki/'.$super;
		$sub_url = 'http://en.wikipedia.org/wiki/'.$sub;
		//Super skill, url, subskill, url, upvotes, downvotes
		$query = 'INSERT INTO Super_Sub_Skill VALUES ("'.$super.'","'.$super_url.'","'.$sub.'","'.$sub_url.'",1,1)';
		return $this->db_conn->plainQuery($query);
	}
	
	public function findURL($skill)
	{
		$wikiURL = 'http://en.wikipedia.org/wiki/'.$skill;
		$query = 'SELECT * FROM Skill WHERE url = "'.$wikiURL.'"';
		return $this->db_conn->plainQuery($query);
	}

	public function getPrereqs($skill)
	{
		$wikiURL = 'http://en.wikipedia.org/wiki/'.$skill;
		$query = 'SELECT * FROM Super_Sub_Skill WHERE super_url = "'.$wikiURL.'"';
		return $this->db_conn->plainQuery($query);
	}

	public function addSkill($skill)
	{
		$wikiURL = 'http://en.wikipedia.org/wiki/'.$skill;
		$query = 'INSERT INTO Skill VALUES ("'.$skill.'","'.$wikiURL.'")';
		$result = $this->db_conn->plainQuery($query);
		if(is_object($result))
			return true;
		/* Query failed */
		return false;
	}

}