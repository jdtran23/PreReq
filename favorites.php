<?php include("navbar.php"); ?>
<script>$("#nav-favorites").addClass("active");</script>

<body>

<h1>Favorites</h1>
</body>

<?php 
//We'll be using the database for bringing in new skills, etc.
	$db = new mysqli("engr-cpanel-mysql.engr.illinois.edu", "prereq_guest", "guest", "prereq_Wikipedia_Pages");
	if(mysqli_connect_errno())
		die('Database Connection Fail'.mysql_error());
	if(!isset($_SESSION['user']))
	{
		printf("<script>location.href='login.php'</script>");
	}
	else
	{
		$user = $_SESSION['user'];
		$query = "SELECT * FROM Favorites WHERE user_name = '".$user."'";
		$result = $db->query($query);
	
		while($row = mysqli_fetch_array($result))
		{
			echo '<span class="favorite-item"><i class="icon-star"></i><strong><t> SKILL: </strong><a href="displaySkill.php?topic='.$row[1].'&newprereq=0&prereq='.'"</a>'.$row[1].'</span><a href="delete-favorite.php?del='.$row[1].'" class="btn btn-danger">Delete</a>';//." URL: ".$row[3];  
			echo "<t><br />";
		}
	}
?>