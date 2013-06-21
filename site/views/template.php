<!DOCTYPE html>
<html>
    <head>

        <meta charset="utf-8">
        <title><?php echo $title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="description" content="">
	    <meta name="author" content="">

	    <script src="http://code.jquery.com/jquery-latest.js"></script>
		<?php echo Asset::js('bootstrap-transition.js'); ?>
		<?php echo Asset::js('bootstrap-alert.js'); ?>
		<?php echo Asset::js('bootstrap-modal.js'); ?>
		<?php echo Asset::js('bootstrap-dropdown.js'); ?>
		<?php echo Asset::js('bootstrap-scrollspy.js'); ?>
		<?php echo Asset::js('bootstrap-tab.js'); ?>
		<?php echo Asset::js('bootstrap-tooltip.js'); ?>
		<?php echo Asset::js('bootstrap-popover.js'); ?>
		<?php echo Asset::js('bootstrap-button.js'); ?>
		<?php echo Asset::js('bootstrap-collapse.js'); ?>
		<?php echo Asset::js('bootstrap-carousel.js'); ?>
		<?php echo Asset::js('bootstrap-typeahead.js'); ?>
		<?php echo Asset::js('app.js'); ?>

	    <!-- Le styles -->

	    <?php echo Asset::css('bootstrap.css'); ?>

	    <style>
	      body {
	        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
	      }
	    </style>

	    <?php echo Asset::css('bootstrap-responsive.css'); ?>

	    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	    <!--[if lt IE 9]>
	      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	    <![endif]-->

    </head>
    <body>

    	<div class="navbar navbar-fixed-top">
	      <div class="navbar-inner">

	        <div class="container">
	          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </a>
	          <a class="brand" href="<?php echo Uri::create('/overview/') ;?>">clippings</a>
	          <div class="nav-collapse">
	            <ul class="nav">
	              <li><a href="<?php echo Uri::create('/overview/') ;?>"><i style="filter: alpha(opacity=50); -khtml-opacity: 0.5; -moz-opacity: 0.5; opacity: 0.5;" class="icon-th icon-white"></i> overview</a></li>
	              <li><a href="http://comotion.nl" target="_blank"><i style="filter: alpha(opacity=50); -khtml-opacity: 0.5; -moz-opacity: 0.5; opacity: 0.5;" class="icon-home icon-white"></i> comotion website</a></li>
	              
	            </u>
	            


	            <div class="pull-right">
	            	<ul class="nav">
	            		<li><a href="<?php echo Uri::base(true) . 'login/logout';?>"><i style="filter: alpha(opacity=50); -khtml-opacity: 0.5; -moz-opacity: 0.5; opacity: 0.5;" class="icon-user icon-white"></i> log out</a></li>
	            	</ul>
	            </div>
	          </div>
	        </div>
	      </div>
	    </div>

	    <figure class="logo" style="background-image: url(<?php echo \Uri::base(); ?>assets/img/logo.png)"></figure>


	    <div class="container">

			<?php echo $content; ?>

			<div class="span" id="footer-message">
		        <h1 id="shadow-font-footer">Powered by <a href="http://maximumawesome.nl/" id="shadow-font-footer">Maximum Awesome</a></h1>
		    </div>

		</div>

    </body>
</html>