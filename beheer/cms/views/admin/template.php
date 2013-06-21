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
    <body id='login'>
		<div id="login_container">
			<?php echo $content; ?>
		</div>
    </body>
    </html>