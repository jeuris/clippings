<?php echo Form::open(array('class' => 'form-stacked')); ?>

	<fieldset>
		<div class="clearfix">
			<div class="input">
				<p>
					<?php echo Form::input('name', Input::post('name', isset($label) ? $label->name : ''), array('class' => 'span6', 'placeHolder' => 'naam')); ?>
				</p>
			</div>
		</div>
		<div class="actions">
			<?php echo Html::anchor('labels', 'terug', array('class'=>'button')); ?>
			<?php echo Form::submit('submit', 'Save', array('class' => 'button blue')); ?>
		</div>
	</fieldset>
<?php echo Form::close(); ?>