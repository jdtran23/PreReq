<?php include("navbar.php"); ?>
<script>$("#nav-search").addClass("active");</script>

<body onLoad="document.forms.searchform.typehere.focus()">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


	<div class="row">
	<div class="span5"></div>
	<div class="span7">
		<div ALIGN=CENTER> 
		<div><font size = 10>Start typing in a skill here...</font> </div> <!-- prereq.css is not linking, temp-->
		<form NAME="searchform" class="form-search">
		<input NAME="typehere" id="searchterm" /*class='search_input'*/ class="input-large search-query" value="Type here..."onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"/> 
		</form> 
		</div>

		<div id="results"></div>
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
		$("#results").append("<div>"+"<strong>" + item.title + "</strong></a>"  + "<a class='pull-right' href='index.php?displaySkill&topic="+item.title.replace('&','%26')+"&newprereq=0&prereq='''>Learn it!</a> <br>"+ item.snippet +"<hr SIZE='4'></div>")  ; 
	  });
	});
  });
</script>







