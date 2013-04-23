<?php
include_once(SERVER_ROOT."/models/database.php");
class Favorites_Model
{
	private $db_conn;

	public function __construct()
	{
		$this->db_conn = new Database_Model;
	}

	public function getFavorites($user)
	{
		$user = $this->db_conn->sanitize($user);
		$query = "SELECT * FROM Favorites WHERE username = '".$user."'";
		return $this->db_conn->plainQuery($query);
	}

	public function deleteFavorites($topic, $username)
	{
		$username = $this->db_conn->sanitize($username);
		$topic = $this->db_conn->sanitize($topic);
		$query = "DELETE FROM Favorites WHERE username = '".$username."' AND skill_name = '".$topic."'";
		return $this->db_conn->plainQuery($query);
	}

	public function addFavorites($topic, $username)
	{
		$username = $this->db_conn->sanitize($username);
		$topic = $this->db_conn->sanitize($topic);
		$query = "INSERT INTO Favorites VALUES ('".$username."','".$topic."')";
		return $this->db_conn->plainQuery($query);
	}
}
