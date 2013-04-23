<?php 
include("navbar.php"); 
$topic = rawurldecode($data['topic']);
?>

<div class="row">
		<br>
			


	<div class="span2"></div>
	
	<div class="span7">
		<br>
			
			<?php echo '<span id = "topic" style="display:none;">'.$topic.'</span>'; ?>
			<h3>You are now learning the fine art of:<br> <a href="#"><?php echo $topic; ?> <button class="btn btn-fav pull-right"><a  href = <?php echo 'index.php?displaySkill&topic='.rawurlencode($topic).'&fav=1'; ?>
			<i id = "favorite-button" ><i class='icon-star'>
			</i> Favorite</a></button>
			
			<a href="index.php?buildtree&topic=<?php echo $topic;?>"><button class="btn btn-fav pull-right" > 
			<i id = "visual-button" ><i class = 'icon-star'>
			</i> Visualize</button></a>
			
			</a></h3><span>
			
			<div class="wiki-preview btn">
		
		HTML
			
HyperText Markup Language (HTML) is the main markup language for creating web pages and other information that can be displayed in a web browser.
HTML is written in the form of HTML elements consisting of tags enclosed in angle brackets, within the web page content. HTML tags most commonly come in pairs like h1, although some tags, known as empty elements, are unpaired, for example <img>. The first tag in a pair is the start tag, the second tag is the end tag (they are also called opening tags and closing tags). In between these tags web designers can add text, tags, comments and other types of text-based content.
The purpose of a web browser is to read HTML documents and compose them into visible or audible web pages. The browser does not display the HTML tags, but uses the tags to interpret the content of the page.
HTML elements form the building blocks of all websites. HTML allows images and objects to be embedded and can be used to create interactive forms. It provides a means to create structured documents by denoting structural semantics for text such as headings, paragraphs, lists, links, quotes and other items. It can embed scripts written in languages such as JavaScript which affect the behavior of HTML web pages.
Web browsers can also refer to Cascading Style Sheets (CSS) to define the appearance and layout of text and other material. The W3C, maintainer of both the HTML and the CSS standards, encourages the use of CSS over explicit presentational HTML markup.[1]
		
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
			if(isset($data['results_obj']))
			{
				$result = $data['results_obj'];
				if($result->num_rows > 0)
				{
				  while($row = mysqli_fetch_array($result))
				  {
					  echo "<t><span class='prereq-item'><i class='icon-arrow-right'></i>&nbsp;<a href='index.php?displaySkill&topic=".$row[2]."&newprereq=0&prereq=''>".$row[2]."
					  </a></span>
					<i class='icon-thumbs-up'> 
					  </i><strong>" . " " . $row[4] . " <a href='upvote-btn'></strong><font color='green'>Upvotes" . " " . "</font></a>
					  <i class='icon-thumbs-down'>
					  </i><strong>" . " " . $row[5] . " <a href href='downvote-btn'></strong><font color='red'>Downvotes</font></a>";//." URL: ".$row 
					  echo "<t><br/>"; 
				  }
				}
				else
				  echo "<br><div class='alert alert-info'><strong>Wait! </strong>There are currently no prereqs. Add some!</div>";
		  }
		?>
		</br>
		Suggest a PreReq!
		<form NAME="searchform" class="form-search">
			<input NAME="typehere" id="searchterm" /*class='search_input'*/ class="input-large search-query" value="Type here..."onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"/> 
		</form> 
			
		<div id="results"></div>	
		
		<h5>Learning Resources</h5>
		<form action="/html/codes/html-comment-box-code-action.cfm" method="get">

		<textarea rows="4" cols="100"  placeholder="Share Learning Resources Here!"></textarea><br />
		<input class="btn" type="submit" value="Submit" />
		</form>

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


