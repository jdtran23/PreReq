//Refactor the wikipedia code.
function speak_with_wikipedia(e){
	var q = $("#searchterm").val();
	console.log(q);
	$.getJSON("http://en.wikipedia.org/w/api.php?callback=?",
	{
	  srsearch: q,
	  action: "query",
	  list: "search",
	  format: "json"
	},
	function(data) {
	  $("#results").empty();
	  $.each(data.query.search, function(i,item){
		
		//Odd bug. Odd characters are not being handled properly. Simon & Garfunkel becomes Simon.
		$.post("skill_record.php", {skillName : item.title, wikiURL : 'http://en.wikipedia.org/wiki/' + decodeURI(item.title) }, 
			function(data){
				if (data.length>0){ 
					 $("#searchterm").html(data); 
				}
				$("#results").append("<div>"+"<a href='displaySkill.php?topic="+item.title+"'>Learn it!</a>" + item.title + "</a><br>" + item.snippet +"</div>"); 
		});
	  });
	});
  }