<?php
	include("navbar.php");
	 <script>$("#nav-search").addClass("active");</script>
	Header('Content-type: text/html; charset=utf-8');
	
	$db = new mysqli("engr-cpanel-mysql.engr.illinois.edu", "prereq_guest", "guest", "prereq_Wikipedia_Pages");  
	if(mysqli_connect_errno())
		die('Database Connection Fail'.mysql_error());
		
	if(isset($_GET['topic']))	
	{
		$topic = $_GET['topic'];		
		$wikiURL = 'http://en.wikipedia.org/wiki/'.$topic;
		$query = "INSERT INTO `Skill` VALUES (?,?)";
		$stmt = $db->prepare($query);
		$stmt->bind_param("ss", $topic, $wikiURL);
		$result = $stmt->execute();
		$stmt->close();
	}
	if(isset($_GET['newprereq']))
		$newPrereq = $_GET['newprereq'];
	if(isset($_GET['prereq']))
	{
		$prereq = $_GET['prereq'];	
		echo $prereq;
		$wikiURL = 'http://en.wikipedia.org/wiki/'.$prereq;
		$query = "INSERT INTO `Skill` VALUES (?,?)";
		$stmt = $db->prepare($query);
		$stmt->bind_param("ss", $prereq, $wikiURL);
		$result = $stmt->execute();
		$stmt->close();
	}
	$url = "http://en.wikipedia.org/wiki/".$topic;
	$prereqUrl = "http://en.wikipedia.org/wiki/".$prereq;
	echo '<a href = "displaySkillFav.php?topic='.$topic.'" class="btn btn-primary">MY FAVORITE!!!!</a>';
	echo "<h3> You are now learning the fine art of <font color='blue'>".$topic."</font></h3><br>";
	$query = "SELECT * FROM Skill WHERE url = '".$url."'";
	$result = $db->query($query);
	
	if(!$result || ($result->num_rows == 0))
	echo "<h1> 404 </h1>";
	else
	{
		//if the newPrereq is true but $prereq is false, do nothing. Perhaps handle in the future.
		if($newPrereq && !empty($prereq))
		{
			$query = "INSERT INTO `Super_Sub_Skill`(`super_name`, `super_url`, `sub_name`, `sub_url`, `upvotes`, `downvotes`) VALUES (?,?,?,?,?,?)";
			$stmt = $db->prepare($query);
			//Keep track of what users upvote/downvote. New database!
			$a=1;$b=0;
			$stmt->bind_param("ssssii", $topic, $url, $prereq, $prereqUrl,$a,$b);
			$result = $stmt->execute();
			$stmt->close();
		}
	
		$query = "SELECT * FROM Super_Sub_Skill WHERE super_url = '".$url."'";
		$result = $db->query($query);
		echo "<span class='prereq-item'>PREREQS ARE:<br></span><br>";
		if($result || 0 == $result->num_rows)
		{
			while($row = mysqli_fetch_array($result))
			{
			echo "<t><span class='prereq-item'><i class='icon-arrow-right'></i>SKILL: <a href='displaySkill.php?topic=".$row[2]."&newprereq=0&prereq=''>".$row[2]."</a></span> <font color='green'><i class='icon-thumbs-up'></i> Up Vote </font><font color='red'><i class='icon-thumbs-down'></i> Down Vote</font>";//." URL: ".$row
			echo "<t><br />";
			}
		}
		else
			echo "<br><h2>There are currently no prereqs! Add some!</h2>";
		//Actual page body
		//Div for the add subskill module		
		echo "<div id = 'add_subskill'>";
	}
?>
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<br/>
		<form>
		Type in a Skill here:<input id="searchterm" class='search_input' value="Type here...."onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"/> 
		</form> 

		<div id="results"></div>
		<script>
		$("#searchterm").keyup(function(e){
			var q = $("#searchterm").val();
			$.getJSON("http://en.wikipedia.org/w/api.php?callback=?",
			{
				srsearch: q,
				action: "query",
				list: "search",
				format: "json"
			},
			//Callback uses wikipedia's JSON object
			function(data) {
				$("#results").empty();
				$.each(data.query.search, 
				function(i,item){
					$("#results").append("<div>"+"<a href='displaySkill.php?topic="+ "<?php echo str_replace('&', '%26', $topic); ?>"+"&newprereq=1&prereq=" +item.title.replace('&','%26')+"'>This is a Prereq!</a>" + item.title + "</a><br>" + item.snippet +"</div>"); 
				}
				);
			});
		});
		</script>