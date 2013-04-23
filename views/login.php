<head>

	    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>

	<?php include("navbar.php"); ?>
	<script src = "resources/js/jquery.validate.js" type = "text/javascript"></script>

	<title>LOG-IN Page</title>

	<script type="text/javascript" language="javascript">
	$(document).ready(function() { 
		$("#login-form").validate({ 
			rules: { 
				username: {
				required: true,
	          	email: true 				
				},
				password: {// compound rule 
				required: true, 
				}
			},
			messages: {
				password: "Please enter your password.",
				username: "Please enter your email address."
			} 
		
	      }); 
	    });
	  </script> 
	
</head>
<body>
	<div class="row">
		<div class="span6"></div>
		
			<div class="container">
			<div class="span3">
			  <form class="login-form" action = "index.php?login" method = "post">
				<h2 class="form-login-heading">Please log in</h2>
				<input type="text" class="input-block-level" name="username" placeholder="Email address">
				<input type="password" class="input-block-level" name="password" placeholder="Password">
				 <!--<label class="checkbox">
				 <input type="checkbox" value="remember-me"> Remember me
				</label>-->
				<button class="btn btn-large btn-primary" type="submit">Log in</button> <div id="register-btn" class="btn btn-large"><a href="index.php?register">Register</a></div>
			  </form>
			</div>
			</div> <!-- /container -->
	
		<div class="span3"></div>
	</div>

</body>

