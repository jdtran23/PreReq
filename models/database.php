<?php

class Database_Model
{
	private $db;
	//Database name is prereq_final, username is prereq_user, password is prereq
	public function __construct()
	{
        //Make a database connection, store it as a variable.
		$this->db = new mysqli("engr-cpanel-mysql.engr.illinois.edu", "prereq_user", "prereq", "prereq_final");
		if(mysqli_connect_errno())
			die("Database connection failed.".mysql_error());
	}

	public function sanitize($string)
	{
		return $this->db->real_escape_string($string);
	}
	
	public function plainQuery($query)
	{
		if(!isset($this->db))
			return NULL;
		return $this->db->query($query);
	}

}
