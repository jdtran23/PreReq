<?php 
include("navbar.php"); 
$topic = rawurldecode($data['topic']);
echo '<span id = "topic" style="display:none;">'.$topic.'</span>';
?>

<head>
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
	<!--<script type="text/javascript" src="buildTree.js"></script>-->
	<script type="text/javascript" src="d3/d3.js"></script>
    <script type="text/javascript" src="d3/d3.layout.js"></script>
	<script src = "resources/js/jquery-1.9.1.js" type = "text/javascript"></script>
	
		<div id="tree-container"></div>
	
	<script type = "text/javascript">
		var topic = document.getElementById("topic").textContent;
		console.log(topic);
		
		$.post("models/buildtree.php", {"arg": topic},
		function(json){
			function parse(json) {
				console.log(json);
				var arr = JSON.parse(json);
				//console.log(arr["Array"]);
				arr = arr["Array"];
				len = arr.length;
				
				var object = {name: arr[len-2], contents: []};
				object = parseRecurse(arr, object);
				//treeData = object;
				console.log("Object: " + object);
				j = object;
				return object;
				//console.log(object);
			}
			
				function parseRecurse(arr, obj) {
					var index = arr.indexOf(obj.name) + 1;
					//console.log("Key: " + obj.name);
					//console.log("Index: " + index);
					//debugger;
					if(index === 0) return obj;
					var deps = arr[index];
					//console.log(deps);
					//debugger;
					
					var object;
					for(var i = 0; i < deps.length; i++) {
						object = {name: deps[i], contents: []};
						//console.log("DEPS: " + deps[i]);
						//debugger;
						object = parseRecurse(arr, object);
						//console.log("DEPS: " + deps[i]);
						obj.contents.push(object);
						//console.log(object);
					}
		
					return obj;
				}
				
				function visit(parent, visitFn, childrenFn)
	{
		if (!parent) return;

		visitFn(parent);

		var children = childrenFn(parent);
		if (children) {
			var count = children.length;
			for (var i = 0; i < count; i++) {
				visit(children[i], visitFn, childrenFn);
			}
		}
	}

	function buildTree(containerName, customOptions)
	{
		// build the options object
		var options = $.extend({
			nodeRadius: 1, fontSize: 4
		}, customOptions);

		
		// Calculate total nodes, max label length
		var totalNodes = 0;
		var maxLabelLength = 0;
		visit(treeData, function(d)
		{
			totalNodes++;
			maxLabelLength = Math.max(d.name.length, maxLabelLength);
		}, function(d)
		{
			return d.contents && d.contents.length > 0 ? d.contents : null;
		});

		// size of the diagram
		var size = { width:$(containerName).outerWidth(), height: totalNodes * 50};

		var tree = d3.layout.tree()
			.sort(null)
			.size([size.height, size.width - maxLabelLength*options.fontSize])
			.children(function(d)
			{
				console.log(treeData);
				return (d.contents.length === 0) ? null : d.contents;
			});

		var nodes = tree.nodes(treeData);
		var links = tree.links(nodes);

		var layoutRoot = d3.select(containerName)
			.append("svg:svg").attr("width", size.width).attr("height", size.height)
			.append("svg:g")
			.attr("class", "container")
			.attr("transform", "translate(" + maxLabelLength + ",0)");


		// Edges between nodes as a <path class="link" />
		var link = d3.svg.diagonal()
			.projection(function(d)
			{
				return [d.y, d.x];
			});

		layoutRoot.selectAll("path.link")
			.data(links)
			.enter()
			.append("svg:path")
			.attr("class", "link")
			.attr("d", link);

		var nodeGroup = layoutRoot.selectAll("g.node")
			.data(nodes)
			.enter()
			.append("svg:g")
			.attr("class", "node")
			.attr("transform", function(d)
			{
				return "translate(" + d.y + "," + d.x + ")";
			});

		nodeGroup.append("svg:circle")
			.attr("class", "node-dot")
			.attr("r", options.nodeRadius);

		nodeGroup.append("svg:text")
			.attr("text-anchor", function(d)
			{
				return d.children ? "end" : "start";
			})
			.attr("dx", function(d)
			{
				var gap = 2 * options.nodeRadius;
				return d.children ? -gap : gap;
			})
			.attr("dy", 3)
			.text(function(d)
			{
				return d.name;
			});

	}

			
			
			var treeData = parse(json);
			buildTree("#tree-container");
			console.log(treeData);
		});
	</script>
</head>