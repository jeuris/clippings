<div class="box">
  <div class="box-header">
    <h1>Opsomming van alle klanten</h1>
  </div>
<?php if ($customers): ?>
<table class="datatable">
	<thead>
		<tr>
			<th>Bedrijf</th>
			<th>Naam</th>
			<th>Achternaam</th>
			<th>Email</th>
			<th>Telefoon</th>
			<th>Stad</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($customers as $customer): ?>		<tr>

			<td><?php echo $customer->company_name; ?></td>
			<td><?php echo $customer->first_name; ?></td>
			<td><?php echo $customer->last_name; ?></td>
			<td><?php echo $customer->email; ?></td>
			<td><?php echo $customer->phone; ?></td>
			<td><?php echo $customer->city; ?></td>
			<td>
				<?php echo Html::anchor('customer/edit/'.$customer->id, 'bewerken', array('class'=>'button plain')); ?>
				<?php echo Html::anchor('customer/delete/'.$customer->id, 'verwijderen', array('class'=>'button plain', 'onclick' => "return confirm('Are you sure?')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<div class="box-content">
	<p>Nog geen klanten</p>
</div>
<?php endif; ?>
<div class="action_bar">
	<?php echo Html::anchor('customer/create', 'Nieuwe klant', array('class' => 'button blue')); ?>
</div>
