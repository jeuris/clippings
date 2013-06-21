	<?php if (isset($clippings)): ?>
		<div class="span" id="main-label">
			<h1 id="shadow-font">Select your label</h1>
		</div>

		<ul class="thumbnails">
		<?php foreach ($clippings as $clipping): ?>

			<li class="span">
				<a href="<?php echo \Uri::create('detail/' . $clipping[0]->id); ?>" class="thumbnail">
					<?php echo Html::img("data/clippings/" . $clipping[0]->id . '/' . $clipping[0]->thumb); ?>
            		<span class="label"><?php echo $clipping[0]->label->name; ?></span>
            	</a>
            </li>
		<?php endforeach; ?>
	<?php else: ?>
		
		<div class="span" id="main-label">
			<h1 id="shadow-font">No clippings<br />available.</h1>
		</div>

	<?php endif; ?>

	</ul>