<?php 
include("navbar.php"); 
$topic = rawurldecode($data['topic']);
?>

<div ALIGN=CENTER> 
<h3> You are now learning the fine art of <font color='blue'><?php echo $topic; ?></font>.</h3><br>
</div>

<div ALIGN=LEFT>
<a href = <?php echo 'index.php?displaySkill&topic='.rawurlencode($topic).'&fav=1'; ?> class="btn btn-primary">Add to Favorites</a>
 
  <?php 
    if(isset($data['add_fav_flag']))
      if($data['add_fav_flag'])
        echo "Added to favorites!";
      else
        echo "Add failed!"; ?>

<br>
<span class='prereq-item'> PREREQS ARE:<br></span>
<?php
    if(isset($data['results_obj']))
    {
        $result = $data['results_obj'];
        if($result->num_rows > 0)
        {
          while($row = mysqli_fetch_array($result))
          {
          echo "<t><span class='prereq-item'><i class='icon-arrow-right'></i>SKILL: <a href='index.php?displaySkill&topic=".$row[2]."&newprereq=0&prereq=''>".$row[2]."</a></span> <font color='green'><i class='icon-thumbs-up'></i> Up Vote </font><font color='red'><i class='icon-thumbs-down'></i> Down Vote</font>";//." URL: ".$row
          echo "<t><br/>";
          }
        }
        else
          echo "<br><h4>There are currently no prereqs! Add some!</h4>";
  }
?>
</div>


<div ALIGN = CENTER>
<font size = 3>Suggest a PreReq!</font>
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
    $("#results").append("<div>"+"<a href='index.php?displaySkill&topic="+"<?php echo $topic; ?>"+"&newprereq=1&prereq="+escape(item.title)+"'''>Learn it!</a>" + item.title + "</a><br>" + item.snippet +"</div>"); 
    });
  });
  });
</script>


