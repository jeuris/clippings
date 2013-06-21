<h2>Viewing #<?php echo $label->id; ?></h2>

<p>
	<strong>Name:</strong>
	<?php echo $label->name; ?></p>

<?php echo Html::anchor('labels/edit/'.$label->id, 'Edit'); ?> |
<?php echo Html::anchor('labels', 'Back'); ?>