<?php
include_once(SERVER_ROOT."/models/database.php");
class Login_Model{

	private $db_conn;

	public function __construct()
	{
		if(!class_exists('Database_Model'))
			die("Database Model not found!");

		$this->db_conn = new Database_Model();
	}

	public function loginUser($user, $pass)
	{
		$pass = $this->db_conn->sanitize($pass);
		$user = $this->db_conn->sanitize($user);
		$query = "SELECT * FROM User WHERE username = '".$user."' AND password = '".$pass."'";
		$result = $this->db_conn->plainQuery($query);
		if($result->num_rows == 1)
			return true;
		if($result->num_rows < 1)
			return false;
		die("Two users have identical login informations. Integrity of our database keys are questionable.");
	}

}
