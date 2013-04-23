<?php
include_once(SERVER_ROOT."/models/database.php");
class Register_Model
{
	private $db_conn;	
	public function __construct()
	{
		if(!class_exists("Database_Model"))
			die("Database connection failed");
		else
			$this->db_conn = new Database_Model;
	} 

	/*Will assume all inputs to function are verfified*/
	public function addUser($username, $password, $email)
	{
		$username = $this->db_conn->sanitize($username);
		$email =$this->db_conn->sanitize($email);
		$password = $this->db_conn->sanitize($password);
		$password = hash("sha256", $password);
		$query = "INSERT INTO User VALUES ('".$username."','".$email."','".$password."')";
		return $this->db_conn->plainQuery($query);
	}

}	


