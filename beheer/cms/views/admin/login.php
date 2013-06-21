<div id="login_form">
	<?php echo Form::open(array()); ?>
	
		<?php if (isset($_GET['destination'])): ?>
			<?php echo Form::hidden('destination',$_GET['destination']); ?>
		<?php endif; ?>

		<?php if (isset($login_error)): ?>
			<div class="error"><p><?php echo $login_error; ?></p></div>
		<?php endif; ?>
		
		<p>
			<input type="text" id="email" name="email" placeholder="gebruikersnaam" class="{validate: {required: true}}" />
		</p>
        <p>
			<input type="password" id="password" name="password" placeholder="Password" class="{validate: {required: true}}" />
		</p>
       <button type="submit" name='submit' class="button blue">Login</button>

	<?php echo Form::close(); ?>
</div>