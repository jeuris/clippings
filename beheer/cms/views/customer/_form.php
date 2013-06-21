<?php echo Form::open(array('class' => 'form-stacked')); ?>

	<fieldset>
		<div class="clearfix">
			<div class="input">
				<p>
					<?php echo Form::input('company_name', Input::post('company_name', isset($customer) ? $customer->company_name : ''), array('class' => '{validate: {required: true, minlength: 1}}', 'placeHolder' => 'bedrijfs naam')); ?>
				</p>
			</div>
		</div>
		<div class="clearfix">
			<div class="input">
				<p>
					<?php echo Form::input('first_name', Input::post('first_name', isset($customer) ? $customer->first_name : ''), array('class' => '{validate: {required: true, minlength: 2}}', 'placeHolder' => 'voornaam')); ?>
				</p>
			</div>
		</div>
		<div class="clearfix">
			<div class="input">
				<p>
					<?php echo Form::input('last_name', Input::post('last_name', isset($customer) ? $customer->last_name : ''), array('class' => '{validate: {required: true, minlength: 2}}', 'placeHolder' => 'achternaam')); ?>
				</p>
			</div>
		</div>
		<div class="clearfix">
			<div class="input">
				<p>
					<?php echo Form::input('email', Input::post('email', isset($customer) ? $customer->email : ''), array('class' => '{validate: {required: true, email: true}}', 'placeHolder' => 'email')); ?>
				</p>
			</div>
		</div>
		<div class="clearfix">
			<div class="input">
				<p>
					<?php echo Form::input('phone', Input::post('phone', isset($customer) ? $customer->phone : ''), array('placeHolder' => 'telefoon')); ?>
				</p>
			</div>
		</div>
		<div class="clearfix">
			<div class="input">
				<div class='combined'>
					<p class='large'>
						<?php echo Form::input('street', Input::post('street', isset($customer) ? $customer->street : ''), array('class' => '{validate: {required: true, minlength: 2}}', 'placeHolder' => 'straat')); ?>
					</p>
					<p class='small'>
						<?php echo Form::input('street_number', Input::post('street_number', isset($customer) ? $customer->street_number : ''), array('class' => '{validate: {required: true, minlength: 1}}', 'placeHolder' => 'nr.')); ?>
					</p>
				</div>
			</div>
		</div>
		<div class="clearfix">
			<div class="input">
				<p>
					<?php echo Form::input('zip', Input::post('zip', isset($customer) ? $customer->zip : ''), array('class' => '{validate: {required: true, minlength: 4}}', 'placeHolder' => 'postcode')); ?>
				</p>
			</div>
		</div>
		<div class="clearfix">
			<div class="input">
				<p>
					<?php echo Form::input('city', Input::post('city', isset($customer) ? $customer->city : ''), array('class' => '{validate: {required: true, minlength: 2}}', 'placeHolder' => 'stad')); ?>
				</p>
			</div>
		</div>
		<div class="clearfix">
			<div class="input">
				<p>
					<?php echo Form::input('country', Input::post('country', isset($customer) ? $customer->country : ''), array('class' => '{validate: {required: true, minlength: 2}}', 'placeHolder' => 'land')); ?>
				</p>
			</div>
		</div>
		<?php if(! isset($customer)): ?>
		</br>
		<p>klantaccount:</p>
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
		</br></br>
	<?php endif; ?>
		<div class="actions">
			<?php echo Html::anchor('customer', 'terug', array('class'=>'button')); ?>
			<?php echo Form::submit('submit', 'Save', array('class' => 'button blue')); ?>
		</div>
	</fieldset>
<?php echo Form::close(); ?>