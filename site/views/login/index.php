<div class="span10" id="page-label">
	<figure class="comotion" style="background-image: url(<?php echo \Uri::base(); ?>assets/img/comotion.png)"></figure>
	<h1 id="shadow-font-login">View and download<br />clippings</h1>
  </div>

<div class="span" id="login-holder">
	<?php echo Form::open(array('class' => 'well form-inline')); ?>

	<?php if (isset($_GET['destination'])): ?>
		<?php echo Form::hidden('destination',$_GET['destination']); ?>
	<?php endif; ?>

	<?php if (isset($login_error)): ?>
		<div class="alert alert-error">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<strong>Error.</strong>
			<span><?php echo $login_error; ?></span>
		</div>
	<?php endif; ?>

	<input type="text" class="input-large" id="email" name="email" placeholder="gebruikersnaam" />
	<input type="password" class="input-large" id="password" name="password" placeholder="Password" />
	<button type="submit" class="btn btn-inverse" name='submit'><i class="icon-user"></i></button>

	<?php echo Form::close(); ?>
</div>