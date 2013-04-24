	<script type="text/javascript" src="d3/d3.js"></script>
    <script type="text/javascript" src="d3/d3.layout.js"></script>

		<style>
		g.node {
			font-family: Verdana, Helvetica;
			font-size: 8px;
			font-weight: bold;
		}
		circle.node-dot {
			fill: lightsalmon;
			stroke: blue;
			stroke-width: 10px;
		}

		path.link {
			fill: none;
			stroke: black;
		}
	</style>

<div id="tree-container"></div>
<?php 
include("navbar.php"); 
$topic = rawurldecode($data['topic']);
echo '<span id = "topic" style="display:none;">'.$topic.'</span>';
//echo $topic;
?>
<script src = "views/spaghetti.js" type = "text/javascript"></script>
