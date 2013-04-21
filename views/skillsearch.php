<?php include("navbar.php"); ?>
<script>$("#nav-search").addClass("active");</script>

<body onLoad="document.forms.searchform.typehere.focus()">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<ul class="breadcrumb">
  <li><a href="#">Home</a> <span class="divider">/</span></li>
  <li><a href="#">Search</a> <span class="divider">/</span></li>
  <li class="active">Query1</li>s
</ul>

<div>

<div ALIGN=CENTER> 
<div><font size = 10>Start typing in a skill here...</font> </div> <!-- prereq.css is not linking, temp-->
<form NAME="searchform" class="form-search">
<input NAME="typehere" id="searchterm" /*class='search_input'*/ class="input-large search-query" value="Type here..."onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"/> 
</form> 
</div>

<div id="results"></div>

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
		$("#results").append("<div>"+"<a href='index.php?displaySkill&topic="+item.title.replace('&','%26')+"&newprereq=0&prereq='''>Learn it!</a>" + item.title + "</a><br>" + item.snippet +"</div>"); 
	  });
	});
  });
</script>







