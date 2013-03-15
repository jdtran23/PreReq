
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<!-- Charset -->
	<?php header('Content-type: text/html; charset=utf-8'); ?>
	<!-- ajax library -->
	<script src = "ajaxlib.js" type = "text/javascript"></script>
	<!-- javascript library -->
	<script src = "javascriptlib.js" type = "text/javascript"></script>
	<script src = "js/prereq.js" type = "text/javascript"></script>
    <title>PreReq</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/prereq.css" rel="stylesheet">
	<style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../prereq/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../prereq/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../prereq/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../prereq/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="../prereq/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="../prereq/img/prereq.ico">
  
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="index.php">PreReq</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="index.php"><i class="icon-home icon-white"></i> Home</a></li>
			   <li><a href="skill-search.php">Skill Search</a></li>
			  <li><a href="favorites.php">Favorites</a></li>
              <li><a href="chpass.php">Change Password</a></li>
              <li><a href="#contact">Contact</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <li class="nav-header">Nav header</li>
                  <li><a href="#">Separated link</a></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li>
            </ul>
			
			<?php 
			session_start();
			if(!isset($_SESSION['user']))
			{
				echo'<form action = "login.php" method = "post" class="navbar-form pull-right" >
						<div id="navbar-login">
					  <input name="username" class="span2" type="text" placeholder="Email">
					  <input name="password"class="span2" type="password" placeholder="Password">
					  <button class="btn" type="submit">Log In</button>
						</div>
				  </form>';
				
			 }
			 else
			 {
				$user = $_SESSION['user'];
				 echo '<form class="navbar-form pull-right" action = "logout.php" >
					<div id="navbar-logout">
					  <span id="loggedintext">You are now logged in as <strong>'.$user.'</strong>.</span>
					  <button class="btn btn-primary" type="submit" >Log Out</button>
					</div>
				</form>';
			}
			
			?>
			
			
			
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
  
  </head>
  
  
