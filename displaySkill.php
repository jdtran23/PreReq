<?php
	include("header.php");
	header('Content-type: text/html; charset=utf-8');
	
	$db = new mysqli("engr-cpanel-mysql.engr.illinois.edu", "prereq_guest", "guest", "prereq_Wikipedia_Pages");  
	if(mysqli_connect_errno())
		die('Database Connection Fail'.mysql_error());
		
	if(isset($_GET['topic']))	
		$topic = $_GET['topic'];
	if(isset($_GET['newprereq']))
		$newPrereq = $_GET['newprereq'];
	if(isset($_GET['prereq']))
		$prereq = $_GET['prereq'];

	$url = "http://en.wikipedia.org/wiki/".$topic;
	$prereqUrl = "http://en.wikipedia.org/wiki/".$prereq;
	echo '<a href = "displaySkillFav.php?topic='.$topic.'" class="btn btn-primary">MY FAVORITE!!!!</a>';
	//session_start();
	//if($_SERVER['HTTP_REFERER'] == 'http://localhost/411Proj/skill-search.php')
		//This state should be changed only if referrer is skill-search.php. In the future, update the above URL to reflect webpage URL.
	
	//$_SESSION['123'] = $topic;
	echo "<h3> You are now learning the fine art of <font color='blue'>".$topic."</font></h3><br>";

		
	/* Implement user favorites in this file.
		The URL should be the exact same as the key for the Skill database.
		0. Call the session_start() to get access to $_SESSION array. 'user' index should map to the username (key) if user is logged in.  
		1. Check that a user is logged in.
		2. Use the username and the $url variable to implement favorites.
		(3) make a user profile page somehow allows users to delete favorites for 3/11. 
		*/

	//Check if user is engaging in monkey business.
	//This 404 should only occur if the database entry for this page is removed between when the user searchs and user clicks on the "Learn" link.
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
				console.log(data);
					//records all skills in our database.
					$.post("skill_record.php", {skillName : item.title, wikiURL : 'http://en.wikipedia.org/wiki/' + decodeURI(item.title) }, 
						function(data){
							if (data.length>0){ 
								$("#searchterm").html(data); 
							}
							var subskillReq = getXMLHTTPRequest();
							
							//<!-- Broken -->
							$("#results").append("<div>"+"<a href='displaySkill.php?topic="+ "<?php echo $topic; ?>"+"&newprereq=1&prereq=" +item.title+"'>This is a Prereq!</a>" + item.title + "</a><br>" + item.snippet +"</div>"); 
						}
					);
				}
				);
			});
		});
		</script>