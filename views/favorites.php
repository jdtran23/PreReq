<?php include("navbar.php"); 
if(isset($data['fav_array']))
{
		$result = $data['fav_array'];
		while($row = mysqli_fetch_array($result))
		{
			echo '<span class="favorite-item"><i class="icon-star"></i><strong><t> SKILL: </strong><a href="index.php?displaySkill&topic='.$row[1].'&newprereq=0&prereq='.'"</a>'.$row[1].'</span><a href="index.php?favorites&del='.$row[1].'" class="btn btn-danger">Delete</a>';//." URL: ".$row[3];  
			echo "<t><br />";
		}
}
?>
