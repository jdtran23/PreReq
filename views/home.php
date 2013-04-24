<?php include("navbar.php"); ?>
	 <script>$("#nav-home").addClass("active");</script>

  <body>
    <div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
        <h1>Welcome <?php if(isset($_SESSION['user'])) echo "back "; ?>to PreReq!</h1>
        <p>Our project, PreReq, is a discovery tool that complements the process of learning. 
		When a person wants to pick up a new skill, they can visit our website, search the topic being learned, 
		and see a list of prerequisite skills they need to learn first. Content becomes prioritized as users in a community vote on which prerequisite skills 
		or topics they think are most important.</p>

	<?php 
	if(!isset($_SESSION['user']))
        	echo '<p><a href="index.php?register" class="btn btn-primary btn-large">Sign Up Here!</a></p>';
	?>
      </div>


      <hr>

      <footer>
        <p>&copy; Team PythonOnRailsTheSQL 2013</p>
      </footer>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-1.9.1.js"></script>
    <!--<script src="js/bootstrap-transition.js"></script>
    <script src="../prereq/js/bootstrap-alert.js"></script>
    <script src="../prereq/js/bootstrap-modal.js"></script>
    <script src="../prereq/js/bootstrap-dropdown.js"></script>
    <script src="../prereq/js/bootstrap-scrollspy.js"></script>
    <script src="../prereq/js/bootstrap-tab.js"></script>
    <script src="../prereq/js/bootstrap-tooltip.js"></script>
    <script src="../prereq/js/bootstrap-popover.js"></script>
    <script src="../prereq/js/bootstrap-button.js"></script>
    <script src="../prereq/js/bootstrap-collapse.js"></script>
    <script src="../prereq/js/bootstrap-carousel.js"></script>
    <script src="../prereq/js/bootstrap-typeahead.js"></script>-->

  </body>
</html>
