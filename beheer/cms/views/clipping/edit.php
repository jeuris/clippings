<script type="text/javascript">
	
	function changepdf()
	{
		$('.clipping').css({'width' : '100%'});
		$('.clipping').empty();
		$('<p><input type="file" id="image" name="preview" placeholder="clipping"/></p>').appendTo($('.clipping'));
		$('.clipping p input').last().customFileInput();
	}

</script>

<div class="box">
	<div class="box-header">
		<h1>Clipping aanpassen</h1>
	</div>
	<div class="box-content">
		<?php if(isset($errors) && count($errors) > 0)
		{
			$error = array_shift($errors);
			echo '<p>' . $error . '</p>';
		}
		?>
		
		<?php echo Form::open(array('class' => 'form-stacked', 'enctype'=>'multipart/form-data')); ?>
		<div class="column-left">
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
					        	<option value="" disabled="disabled">label</option>
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
					        	<option value="" disabled="disabled">klant</option>
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
		            	<input type="text" name="publicationdate" class="datepicker {validate:{required:true}}" id="publicationdate" placeholder="datum" class="{validate:{required:true}}" value=<?php echo Input::post('publicationdate', isset($clipping) ? date("m/d/y", $clipping->publicationdate) : '')?>>
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
				<?php echo Form::submit('submit', 'Save', array('class' => 'button blue', 'id' => 'saveButton')); ?>
				<?php echo Html::anchor('clipping/index', 'terug', array('class'=>'button')); ?>
			</fieldset>
		</div>
		<div class="column-right">
			<div class="clipping">
				<?php echo Html::img('../data/clippings/' . $clipping->id . '/' . $image->url, array('class' => 'clipping-img'));?>
				<a href="#" class="button blue" id="clippings-edit" onClick="changepdf();">edit</a>
			</div>
		</div>
		<div class="clearfix">
		<?php echo Form::close(); ?>
	</div>
</div>










