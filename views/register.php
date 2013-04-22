<?php include("navbar.php"); ?>

<html>
<head>
	<title>Registration</title>
	<script src = "js/jquery.validate.js" type = "text/javascript"></script>
	
	<script src = "js/register.js" type = "text/javascript"></script>
</script>
	
	
</head>
<body onLoad="document.forms.registerform.username.focus()">

	<?php

	if ( isset($data['badDetails']) && $data['badDetails'] )
		echo "Left something blank?";
	else
	{
		if( isset($data['invalidChars']) && $data['invalidChars'] )
			echo "Invalid characters in your username or password!";
		else
			if (isset($data['regResult']) && $data['regResult'])
				echo "Registration Success! <br>";
			if(isset($data['regResult']) && !$data['regResult'])
				echo "Registration Failed! <br>";
	}
	
	?>
	
	 <div class="span4">
    </div>
	
	<div class="span5" >
	<h1 class="pagination-centered">Registration </h1>
		<fieldset>
		<form action = "index.php?register" method = "post" id="registerform"class="form-horizontal">
		<div class="control-group">
				<label class="control-label" for="username">Username: </label> 
				<div class="controls"><input name ="username" type="text"  maxlength="12" size="12"/>
				</div>
				</div>
		<div class="control-group">
				<label class="control-label" for="password">Password: </label>
				<div class="controls">
				<input name ="password" type="password"  maxlength="12" size="12"/>
				</div></div>
		<div class="control-group">
			<label class="control-label" for="email">Email: </label><div class="controls"><input name ="email" type="text"  maxlength="30" size="24"/></div></div>
		<input type ="submit" name ="submit" value="Register" class="btn btn-primary pull-right"/>
		</form>
		</fieldset>
	</div>
	 <div class="span3>
    </div>
	

	

</body>
</html>
