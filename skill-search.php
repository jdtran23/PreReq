<?php include("header.php"); ?>

<body onLoad="document.forms.searchform.typehere.focus()">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<ul class="breadcrumb">
  <li><a href="#">Home</a> <span class="divider">/</span></li>
  <li><a href="#">Search</a> <span class="divider">/</span></li>
  <li class="active">Query1</li>
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
//	  $("#results").append("<p>You Are Searching <b>" + q + "</b> </p>");+ q +
	  $.each(data.query.search, function(i,item){
			console.log(item.title);
		
		//Odd bug. Odd characters are not being handled properly. Simon & Garfunkel becomes Simon.
		/*$.post("skill_record.php", {skillName : item.title,
							wikiURL : 'http://en.wikipedia.org/wiki/' + decodeURI(item.title) }, function(data){	
			//alert("Data Loaded: " + data);
			//This function takes the output from the php script and displays it in some fashion.
			if (data.length>0){ 
				 $("#searchterm").html(data); 
			}
			console.log(data);
			$("#results").append("<div>"+"<a href='displaySkill.php?topic="+item.title+"&newprereq=0&prereq='''>Learn it!</a>" + item.title + "</a><br>" + item.snippet +"</div>"); 
			numResults++;
			if(numResults==9)
				return;
		});*/
$("#results").append("<div>"+"<a href='displaySkill.php?topic="+item.title+"&newprereq=0&prereq='''>Learn it!</a>" + item.title + "</a><br>" + item.snippet +"</div>"); 
	  });
	});
  });
</script>







