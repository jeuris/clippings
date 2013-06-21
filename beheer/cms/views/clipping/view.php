<h2>Viewing #<?php echo $clipping->id; ?></h2>

<p>
	<strong>Label:</strong>
	<?php echo $clipping->label; ?></p>
<p>
	<strong>Description:</strong>
	<?php echo $clipping->description; ?></p>
<p>
	<strong>Pdf url:</strong>
	<?php echo $clipping->pdf_url; ?></p>
<p>
	<strong>Customer id:</strong>
	<?php echo $clipping->customer_id; ?></p>

<?php echo Html::anchor('clipping/edit/'.$clipping->id, 'Edit'); ?> |
<?php echo Html::anchor('clipping', 'Back'); ?>