<div class="box">
  <div class="box-header">
    <h1>Opsomming van alle labels</h1>
  </div>
<?php if ($labels): ?>
<table class="datatable">
	<thead>
		<tr>
			<th>Name</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($labels as $label): ?>		<tr>

			<td><?php echo $label->name; ?></td>
			<td>
				<?php echo Html::anchor('labels/edit/'.$label->id, 'bewerken', array('class'=>'button plain')); ?>
				<?php echo Html::anchor('labels/delete/'.$label->id, 'verwijderen', array('onclick' => "return confirm('Are you sure?')", 'class'=>'button plain')); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<div class="box-content">
	<p>Nog geen labels</p>
</div>
<?php endif; ?>
<div class="action_bar">
	<?php echo Html::anchor('labels/create', 'Nieuw label', array('class' => 'button blue')); ?>
</div>

	




