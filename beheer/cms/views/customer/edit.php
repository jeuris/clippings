	<?php
	$labelArray;

	foreach($labels as $label)
	{
		$labelArray[$label->id] = $label->name;
	}
?>

<div class="box column-right">
	<div class="box-header">
		<h1><?php echo $customer->company_name; ?> Labels</h1>
	</div>
	<?php if ($customer->labels): ?>
	<table class="datatable">
		<thead>
			<tr>
				<th>Name</th>
				<th>Datum</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($customer->labels as $label): ?>		
		<tr>
			<td><?php echo $label->name; ?></td>
			<td><?php echo date("d.m.y", $label->created_at); ?></td>
			<td>
				<?php echo Html::anchor('customer/deleteLabel/'.$customer->id .'/'.$label->id , 'verwijder', array('onclick' => "return confirm('Zeker weten? Dit verwijderd ook eventuele clippings van dit label.')", 'class'=>'button plain')); ?>
			</td>
		</tr>
		<?php endforeach; ?>	</tbody>
	</table>
	<?php else: ?>
	<div class="box-content">
		<p>Nog geen labels.</p>
	</div>
	<?php endif; ?>
	<div class="action_bar">
		<?php echo Html::anchor('#modalwindow', 'Voeg label toe', array('class' => 'button modal')); ?>
	</div>
</div>

<div class="box column-left">
	<div class="box-header">
		<h1><?php echo $customer->company_name; ?> account</h1>
	</div>
	<div class="box-content">
		Reset het wachtwoord of laat weten dat er clippings beschikbaar zijn.
	</div>
	<div class="action_bar">
		<?php echo Html::anchor('#resetWindow', 'Reset', array('class' => 'button modal')); ?>
		<?php echo Html::anchor('#clippingsWindow', 'Mail Clipping', array('class' => 'button modal')); ?>
	</div>
</div>

<div class="box column-left">
	<div class="box-header">
		<h1><?php echo $customer->company_name; ?> gegevens</h1>
	</div>
	<div class="box-content">
		<?php echo render('customer/_form'); ?>
	</div>
</div>




<?php 
	
	$customerLabel;
	
	foreach ($customer->labels as $label)
	{
		$customerLabel[$label->id] = $label->name;
	}
	
?>

	<div id="modalwindow" class="box"> 
		<div class="box-header">
			<h1>Voeg een label toe aan deze klant</h1> 
		</div>
		<div class="box-content"> 

		<?php echo Form::open(array('action' => 'customer/setLabel', 'class' => 'form-stacked'), array('customer_id' => $customer->id)); ?>

			<fieldset>
				<?php if(isset($labelArray)): ?>
				<p>Voeg een bestaand label toe:</p>
					<div class="clearfix">
						<div class="input">
							<div class="input">
								<p>
							       <?php echo Form::select('labelFromList', 'none', $labelArray);?>
								</p>
							</div>
						</div>
					</div>
					<p>
						<p>Of maak een nieuwe aan:</p>
					</p>
				<?php else: ?>
					<p>
						<p>Voeg een label toe:</p>
					</p>
				<?php endif; ?>
					<div class="clearfix">
						<div class="input">
							<p>
								<?php echo Form::input('label', Input::post('label'), array('class' => '{validate: {required: true, accept: pdf}}', 'placeHolder' => 'label naam')); ?>
							</p>
						</div>
					</div>
				</br>
				<div class="actions">
					<?php echo Html::anchor(Uri::current(), 'annuleer', array('class'=>'button')); ?>
					<?php echo Form::submit('submit', 'Save', array('class' => 'button blue')); ?>
				</div>
			</fieldset>
		<?php echo Form::close(); ?>

		</div>
	</div>

	<div id="resetWindow" class="box"> 
		<div class="box-header">
			<h1>Reset het wachtwoord van deze klant</h1> 
		</div>
		<div class="box-content"> 

		<?php echo Form::open(array('action' => 'customer/resetPassword', 'class' => 'form-stacked'), array('customer_id' => $customer->id, 'company_name' => $customer->company_name, 'email' => $customer->email)); ?>

			<fieldset>
					<div class="clearfix">
						<div class="input">
							<p>
								<?php echo Form::input('password', '', array('class' => '{validate: {required: true, minlength: 4}}', 'placeHolder' => 'wachtwoord')); ?>
							</p>
						</div>
					</div>
					<p>
						<input type="checkbox" name="emailClient" id="emailClient" checked="true"/>
						<label for="emailClient">Verstuur het wachtwoord naar de klant</label>
					</p>
				<div class="actions">
					<?php echo Html::anchor(Uri::current(), 'annuleer', array('class'=>'button')); ?>
					<?php echo Form::submit('submit', 'Save', array('class' => 'button blue')); ?>
				</div>
			</fieldset>
		<?php echo Form::close(); ?>

		</div>
	</div>

	<div id="clippingsWindow" class="box"> 
		<div class="box-header">
			<h1>Clipping mail</h1> 
		</div>
		<div class="box-content"> 
			<p>Laat deze klant middels mail weten dat er nieuwe clippings beschikbaar zijn.</p>
		<?php echo Form::open(array('action' => 'customer/sendClippingMail', 'class' => 'form-stacked'), array('customer_id' => $customer->id, 'company_name' => $customer->company_name, 'email' => $customer->email)); ?>

			<fieldset>
				<div class="actions">
					<?php echo Html::anchor(Uri::current(), 'annuleer', array('class'=>'button')); ?>
					<?php echo Form::submit('submit', 'Email', array('class' => 'button blue')); ?>
				</div>
			</fieldset>
		<?php echo Form::close(); ?>
		</div>
	</div>

<?php if(!empty($customerLabel)): ?>


<div class="box column-right">
	<div class="box-header">
		<h1><?php echo $customer->company_name; ?> clippings</h1>
	</div>
	<?php if ($customer->clippings): ?>
	<table class="datatable">
		<thead>
			<tr>
				<th>Naam</th>
				<th>Label</th>
				<th>Publicatie datum</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($customer->clippings as $clipping): ?>		
		<tr>
			<td><?php echo $clipping->name; ?></td>
			<td><?php echo $clipping->label->name; ?></td>
			<td><?php echo date("d.m.y", $clipping->publicationdate); ?></td>
			<td><?php echo Html::anchor('customer/deleteClipping/'.$customer->id.'/'.$clipping->id, 'verwijder', array('class'=>'button plain', 'onclick' => "return confirm('Are you sure?')")); ?></td>
		</tr>
		<?php endforeach; ?>	
		</tbody>
	</table>
	<?php else: ?>
	<div class="box-content">
		<p>Nog geen clippings.</p>
	</div>
	<?php endif; ?>
		<div class="action_bar">
	 		<?php echo Html::anchor('#clippingModal', 'Voeg clipping toe', array('class' => 'button modal')); ?>
		</div>
</div>


<div id="clippingModal" class="box"> 
	<div class="box-header">
		<h1>Voeg een clipping toe aan deze klant</h1> 
	</div>
	<div class="box-content">
		<?php echo Form::open(array('action' => 'customer/setClipping', 'class' => 'form-stacked', 'enctype'=>'multipart/form-data'), array('customer_id' => $customer->id)); ?>
			<fieldset>
				<div class="clearfix">
					<div class="input">
						<p>
							<?php echo Form::input('name', Input::post('name'), array('class' => '{validate: {required: true, minlength: 2}}', 'placeHolder' => 'Naam van de clipping')); ?>
						</p>
					</div>
				</div>
				<p></p>
					<div class="clearfix">
						<div class="input">
							<div class="input">
								<p>
							       label: <?php echo Form::select('clippingLabel', 'none', $customerLabel);?>
								</p>
							</div>
						</div>
					</div>
					<div class="clearfix">
						<p>
                    		<input type="text" name="publicationdate" class="datepicker {validate:{required:true}}" id="publicationdate" placeholder="Publicatie datum" class="{validate:{required:true}}" />
                    		<span class="icon calendar"></span>
                  		</p>
					</div>
					<div class="clearfix">
						<div class="input">
							<p>
								<?php echo Form::textarea('description', '', array('placeholder' => 'beschrijving')); ?>
							</p>
						</div>
					</div>
					<div class="clearfix">
						<div class="input">
							<p>
								<?php echo Form::file('file', array('id' => 'file', 'placeholder' => 'pdf upload', 'class' => '{validate:{required:true, minlength: 10}}'));?>
							</p>
						</div>
					</div>
				</br>
				<div class="actions">
					<?php echo Html::anchor(Uri::current(), 'annuleer', array('class'=>'button')); ?>
					<?php echo Form::submit('submit', 'Save', array('class' => 'button blue', 'id' => 'saveButton')); ?>
				</div>
			</fieldset>
		<?php echo Form::close(); ?>
	</div>
</div>



<?php endif; ?>