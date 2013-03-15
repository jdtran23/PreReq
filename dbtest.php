<html>
<head>
	<title>REGISTRATION PAGE</title>
</head>
<body>

</body>
</html>
<?php 
$opts = array('http' =>
  array(
    'user_agent' => 'MyBot/1.0 (http://www.mysite.com/)'
  )
);
$context = stream_context_create($opts);

$url = 'http://en.wikipedia.org/w/api.php?action=query&titles=Your_Highness&prop=revisions&rvprop=content&rvsection=0';
var_dump(file_get_contents($url, FALSE, $context));
?>


