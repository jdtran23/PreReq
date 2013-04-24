<?php 
include("navbar.php");
include_once(SERVER_ROOT."/models/displayskill.php"); 
$display2_model = new Displayskill_Model();
$topic = rawurldecode($data['topic']);
$suggest_array = array();
$prereq_array = array();
if(isset($data['results_obj']))
{
	$result = $data['results_obj'];
	if($result->num_rows > 0)
	{
	  	while($row = mysqli_fetch_array($result))
	  	{
			$numDown = $display2_model->getDownvoteCount($topic, $row[1]);		
			$numUp = $display2_model->getUpvoteCount($topic, $row[1]);
			if($numUp>= 2)
				array_push($prereq_array, $row[1]);
			else
				array_push($suggest_array, $row[1]);
		}
	}
}

?>

<div class="row">
		<br>
			
	<?php echo '<span id = "topic" style="display:none;">'.$topic.'</span>'; ?>

	<div class="span2"></div>
	
	<div class="span7">
		<br>

			<h3>You are now learning the fine art of:<br> 
	

			<div id="display-btns">
			<a href="#"><?php echo $topic; ?> <button class="btn btn-fav pull-right"><a  href = <?php echo 'index.php?displaySkill&topic='.rawurlencode($topic).'&fav=1'; ?>		</h3>
	
			<i id =  ><i class='icon-star-empty'>
			</i> Favorite</a></button>
			</a>
			<a href="index.php?buildtree&topic=<?php echo $topic;?>"><button id = "visual-button" class="btn btn-fav pull-right" > 
			<i  ><i class = 'icon-th'>
			</i> Visualize</button></a>
			</div>

			
			<div class="wiki-preview btn">		
		<?php if(isset($data['topic']) && isset($data['snippet']))
			echo $data['snippet'];
		?>
				
					
			</div>
		<!--<iframe src="http://en.wikipedia.org/wiki/Ashton_Kutcher"></iframe>-->
		<?php
			//"<iframe width='700' height='700' src='http://www.en.wikipedia.org/wiki/". $topic ."'></iframe>"
			?>
	</div>

	<div class="span4">
		<br>



 
	<?php 
	if(isset($data['add_fav_flag']))
	  if($data['add_fav_flag'])
		echo "<br><div id='success-box' class='alert alert-success'><strong>Success! Added to favorites!</strong></div><script>hideSuccess();</script>";
	  else
		echo "<br><div class='alert alert-error'><strong>Oops!</strong> Add failed, perhaps you have already added this skill to your favorites</div>";
	?>

	<br> 

		<h5><span class='prereq-item'> Prerequisite Skills:<br></span></h5>
		
		<?php
			if(isset($data['results_obj']) && $data['results_obj']->num_rows > 0)
			{
				foreach($prereq_array as $prereq)
				{
					$numDown = $display2_model->getDownvoteCount($topic, $prereq);
					$numUp = $display2_model->getUpvoteCount($topic, $prereq);
				  	echo "<t><span class='prereq-item'><i class='icon-arrow-right'></i>&nbsp;<a href='index.php?displaySkill&topic=".$row[1]."&newprereq=0&prereq=''>".$prereq."
					  </a></span>
					<i class='icon-thumbs-up'> 
					  </i><strong>" . $numUp . " <a href=index.php?displaySkill&topic=". $topic."&up=1&newprereq=1&prereq=".$prereq."></strong><font color='green'> Upvotes" . " " . "</font></a>
					  <i class='icon-thumbs-down'>
					  </i><strong>" . " " . $numDown . " <a href=index.php?displaySkill&topic=". $topic."&down=1&newprereq=1&prereq=".$prereq."></strong><font color='red'>Downvotes</font></a><t><br/>";  	
				 }
			}
				 else
				  echo "<br><div class='alert alert-info'><strong>Wait! </strong>There are currently no prereqs. Add some!</div>";
		  
		?>
		</br>


		<h5><span class='suggest-item'> Suggested Skills:<br></span></h5>

		<?php
		if(isset($data['results_obj']) && $data['results_obj']->num_rows > 0)
		{
			foreach($suggest_array as $suggest)
			{
				$numDown = $display2_model->getDownvoteCount($topic, $suggest);
				$numUp = $display2_model->getUpvoteCount($topic, $suggest);
			 	echo "<t><span class='prereq-item'><i class='icon-arrow-right'></i>&nbsp;<a href='index.php?displaySkill&topic=".$suggest."&newprereq=0&prereq=''>".$suggest."
					  </a></span>
					<i class='icon-thumbs-up'> 
					  </i><strong>" . $numUp . " <a href=index.php?displaySkill&topic=". $topic."&up=1&newprereq=1&prereq=".$suggest."></strong><font color='green'> Upvotes" . " " . "</font></a>
					  <i class='icon-thumbs-down'>
					  </i><strong>" . " " . $numDown . " <a href=index.php?displaySkill&topic=". $topic."&down=1&newprereq=1&prereq=".$suggest."></strong><font color='red'>Downvotes</font></a><t><br/>";  	
			}
		}
			 else
			  echo "<br><div class='alert alert-info'>There are currently no suggested skills.</div>";
		?>

		</br>
		
		Suggest a PreReq!
		<form NAME="searchform" class="form-search">
			<input NAME="typehere" id="searchterm" /*class='search_input'*/ class="input-large search-query" value="Type here..."onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"/> 
		</form> 
			
		<div id="results"></div>	
			<!--
		<h5>Learning Resources</h5>
		<form action="/html/codes/html-comment-box-code-action.cfm" method="get">

		<textarea rows="4" cols="100"  placeholder="Share Learning Resources Here!"></textarea><br />
		<input class="btn" type="submit" value="Submit" />
		</form>
			-->

	</div>

	

</div>
</body>
<script>
  $("#searchterm").keyup(function(e){ //modified 
  var q = $("#searchterm").val();
  $.getJSON("http://en.wikipedia.org/w/api.php?callback=?",
  {
    srsearch: q,
    action: "query",
    list: "search",
    format: "json"
  },
  function(data) {
    var numResults = 0;
    $("#results").empty(); 
    $.each(data.query.search, function(i,item){
      console.log(item.title);
    $("#results").append("<div>"+"<a href='index.php?displaySkill&topic="+"<?php echo $topic; ?>"+"&newprereq=1&prereq="+escape(item.title)+"'''>Prereq It! </a>" + item.title + "</a><br>" + item.snippet +"</div>"); 
    });
  });
  });
  
  		var topic = document.getElementById("topic").textContent;
		console.log(topic);
</script>


