<div class="box">
	  <div class="box-header">
	    <h1>Opsomming van alle labels</h1>
	  </div>
	<?php if ($clippings): ?>
	<table class="datatable">
		<thead>
			<tr>
				<th style="width:40px">Img</th>
				<th>Label</th>
				<th>Bedrijf</th>
				<th>Titel</th>
				<th>Omschrijving</th>
				<th>Publicatie datum</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
	<?php foreach ($clippings as $clipping): ?>		
	<tr>
		<td style="padding: 12px 14px"><?php echo Html::img('../data/clippings/' . $clipping->id . '/' . $clipping->thumb, array('style' => 'max-height:100px;')); ?></td>
		<td style="vertical-align:middle"><?php echo $clipping->label->name; ?></td>
		<td style="vertical-align:middle"><?php echo $clipping->customer->company_name; ?></td>
		<td style="vertical-align:middle"><?php echo $clipping->name; ?></td>
		<td style="vertical-align:middle"><?php 
			if(strlen($clipping->description) > 20)
			{
				echo substr($clipping->description, 0, 20) . '....';
			}
			else
			{
				echo $clipping->description; 
			}
			
			?></td>
		<td style="vertical-align:middle"><?php echo date("m/d/y", $clipping->publicationdate); ?></td>
		<td style="vertical-align:middle">
			<?php echo Html::anchor('clipping/edit/'.$clipping->id, 'bewerken', array('class' => 'button plain')); ?>
			<?php echo Html::anchor('clipping/delete/'.$clipping->id, 'verwijderen', array('onclick' => "return confirm('Are you sure?')", 'class' => 'button plain')); ?>
		</td>
	</tr>
	<?php endforeach; ?>	</tbody>
	</table>

	<?php else: ?>
	<div class="box-content">
		<p>Nog geen clippings</p>
	</div>
	<?php endif; ?>
	<div class="action_bar">
		<?php echo Html::anchor('clipping/create', 'Nieuwe Clipping', array('class' => 'button blue')); ?>
	</div>