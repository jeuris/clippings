<div class="box">
	<div class="box-header">
		<h1>Clipping aanmaken</h1>
	</div>
	<div class="box-content">
		<?php if(isset($errors) && count($errors) > 0)
		{
			$error = array_shift($errors);
			echo '<p>' . $error . '</p>';
		}
		echo render('clipping/_form'); 
		?>
	</div>
</div>


