<?php echo Form::open(array('class' => 'form-stacked', 'enctype'=>'multipart/form-data')); ?>
	<fieldset>
		<div class="clearfix">
			<p>naam:</p>
			<p>
				<?php echo Form::input('name', Input::post('name', isset($clipping) ? $clipping->name : ''), array('class' => '{validate:{required:true, minlength:3}}')); ?>
			</p>
		</div>
		<div class="clearfix">
			<p>label:</p>
			<div class="input">
				<p>
			        <select name="label_id" id="label_id" placeholder="label" class="{validate:{required:true}}">
			        	<option value="" disabled="disabled">kies een label</option>
						<?php 	
							foreach ($labels as $label)
							{
								if($clipping->label_id == $label->id || isset($_POST['label']) && $clipping->label_id == $_POST['label'])
								{
									echo "<option value=" . $label->id . " selected='selected'>" . $label->name . "</option>";
								}
								else
								{
									echo '<option value=' . $label->id . '>' . $label->name . '</option>';
								}
							}
						?>  					
					</select>
				</p>
			</div>
		</div>
		<div class="clearfix">
			<p>klant:</p>
			<div class="input">
				<p>
			        <select name="customer_id" id="customer_id" placeholder="klant" class="{validate:{required:true}}">
			        	<option value="" disabled="disabled">kies een klant</option>
						<?php 	
							foreach ($customers as $customer)
							{
								if($clipping->customer_id == $customer->id || isset($_POST['customer']) && $clipping->customer_id == $_POST['customer'])
								{
									echo "<option value=" . $customer->id . " selected='selected'>" . $customer->company_name . "</option>";
								}
								else
								{
									echo '<option value=' . $customer->id . '>' . $customer->company_name . '</option>';
								}
							}
						?>  					
					</select>
				</p>
			</div>
		</div>
		<div class="clearfix">
			<p>Publicatie datum:</p>
			<p>
            	<input type="text" name="publicationdate" class="datepicker {validate:{required:true}}" id="publicationdate" placeholder="datum" class="{validate:{required:true}}" />
            	<span class="icon calendar"></span>
          </p>
		</div>
		<div class="clearfix">
			<div class="input">
				<p>beschrijving:</p>
				<p>
					<?php echo Form::textarea('description', Input::post('message', isset($clipping) ? $clipping->description : ''), array('rows' => 8)); ?>
				</p>
			</div>
		</div>

		<div class="clearfix">
			<div class="input">
				<p>pdf bestand:</p>
				<p>
					<input type="file" id="image" name="preview" placeholder="kies een pdf"/>
				</p>
			</div>
		</div>
		<?php echo Form::submit('submit', 'Save', array('class' => 'button blue', 'id' => 'saveButton')); ?>
		<?php echo Html::anchor('clipping/index', 'terug', array('class'=>'button')); ?>
	</fieldset>
<?php echo Form::close(); ?>