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
		$query = "SELECT * FROM Favorites WHERE user_name = '".$user."'";
		return $this->db_conn->plainQuery($query);
	}

	public function deleteFavorites($topic, $username)
	{
		$query = "DELETE FROM Favorites WHERE user_name = '".$username."' AND skill_title = '".$topic."'";
		return $this->db_conn->plainQuery($query);
	}

	public function addFavorites($topic, $username)
	{
		$query = "INSERT INTO Favorites VALUES ('".$username."','".$topic."')";
		return $this->db_conn->plainQuery($query);
	}
}