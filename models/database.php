<?php

class Database_Model
{
	private $db;

	public function __construct()
	{
        //Make a database connection, store it as a variable.
		$this->db = new mysqli("engr-cpanel-mysql.engr.illinois.edu", "prereq_guest", "guest", "prereq_Wikipedia_Pages");
		if(mysqli_connect_errno())
			die("Database connection failed.".mysql_error());
	}
	
	public function plainQuery($query)
	{
		if(!isset($this->db))
			return NULL;
		return $this->db->query($query);
	}

}