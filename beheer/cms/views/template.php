<!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $title; ?></title>
    

		<?php echo Asset::css('custom.css'); ?>
		<?php echo Asset::css('reset.css'); ?>
		<?php echo Asset::css('icons.css'); ?>
		<?php echo Asset::css('formalize.css'); ?>
		<?php echo Asset::css('checkboxes.css'); ?>
		<?php echo Asset::css('sourcerer.css'); ?>
		<?php echo Asset::css('jqueryui.css'); ?>
		<?php echo Asset::css('tipsy.css'); ?>
		<?php echo Asset::css('calendar.css'); ?>
		<?php echo Asset::css('tags.css'); ?>
		<?php echo Asset::css('selectboxes.css'); ?>
		<?php echo Asset::css('960.css'); ?>
		<?php echo Asset::css('main.css'); ?>
		<?php echo Asset::css('portrait.css', array('media' => 'all and (orientation:portrait)')); ?>
		
		<?php echo Asset::js('custom.js'); ?>
		<?php echo Asset::js('jquery.min.js'); ?>
		<?php echo Asset::js('jqueryui.min.js'); ?>
		<?php echo Asset::js('jquery.cookies.js'); ?>
		<?php echo Asset::js('jquery.pjax.js'); ?>
		<?php echo Asset::js('formalize.min.js'); ?>
		<?php echo Asset::js('jquery.metadata.js'); ?>
		<?php echo Asset::js('jquery.validate.js'); ?>
		<?php echo Asset::js('jquery.checkboxes.js'); ?>
		<?php echo Asset::js('jquery.chosen.js'); ?>
		<?php echo Asset::js('jquery.fileinput.js'); ?>
		<?php echo Asset::js('jquery.datatables.js'); ?>
		<?php echo Asset::js('jquery.sourcerer.js'); ?>
		<?php echo Asset::js('jquery.tipsy.js'); ?>
		<?php echo Asset::js('jquery.calendar.js'); ?>
		<?php echo Asset::js('jquery.inputtags.min.js'); ?>
		<?php echo Asset::js('jquery.wymeditor.js'); ?>
		<?php echo Asset::js('jquery.livequery.js'); ?>
		<?php echo Asset::js('jquery.flot.min.js'); ?>
		<?php echo Asset::js('application.js'); ?>


    </head>
    <body>
	
		<!-- Primary navigation -->
		<nav id="primary">
		  <ul>
		    <li class='active'>
		      <a href=<?php echo Uri::base(true) . 'customer';?>>
		        <span class="icon32 info"></span>
		        Clippings
		      </a>
		    </li>
			<li class="bottom">
				<a href=<?php echo Uri::base(true) . 'admin/logout';?>>
				<span class="icon32 quit"></span>
 					Log out
				</a>
			</li>
		  </ul>
		</nav>

		<!-- Secondary navigation -->
	    <nav id="secondary">
	      	<ul>
	        	<li <?php if (Uri::segment(1)=="customer") echo "class='active'"; ?>><a href=<?php echo Uri::base(true) . 'customer';?>>klanten</a></li>
				<li <?php if (Uri::segment(1)=="labels") echo "class='active'"; ?>><a href=<?php echo Uri::base(true) . 'labels';?>>labels</a></li>
				<li <?php if (Uri::segment(1)=="clipping") echo "class='active'"; ?>><a href=<?php echo Uri::base(true) . 'clipping';?>>clippings</a></li>
	      	</ul>
	      	<div id="notifications">
	        	<ul>
	        	</ul>
	      	</div>
	    </nav>
		
		<section id="maincontainer">
				<div id="main" class="container_12">
  				<?php echo $content; ?>
			</div>
		</section>

    </body>
    </html>