<div class="box column-left">
	<div class="box-header">
		<h1>Nieuwe klant toevoegen</h1>
	</div>
	<div class="box-content">
		<?php echo render('customer/_form'); ?>
	</div>
</div>

<script type="text/javascript">
	<?php foreach ($errors as $error): ?>	
		notification(<?php echo "'".$error."', true"; ?>);
	<?php endforeach; ?>
</script>

