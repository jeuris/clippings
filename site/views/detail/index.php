<?php if ($clippings): ?>

	<?php foreach ($clippings as $clipping): ?>

	<div class="span">
	<h1 id="shadow-font"><?php echo $clipping->label->name; ?></h1>
	</div>

	<section class="control-panel-top">

	</section>

	<section class="clipping">

		<div class="span7" id="button-holder">

	    	<div class="year-buttons">
	        <h1 id="shadow-font-mini">select</h1>
	        <div class="btn-group" id="month-buttons">
	        	<a class="btn btn-inverse btn-small" href="#" id="yearbtn"><?php echo date('Y', $clipping->publicationdate); ?></a>
	        	<a class="btn btn-inverse dropdown-toggle btn-small" data-toggle="dropdown" href="#"><span class="caret"></span></a>
	        	<ul class="dropdown-menu" id="years" data-source="<?php echo \Uri::create('ajax/months'); ?>">
	        		<li><a href="#"><?php echo date('Y', $clipping->publicationdate); ?></a></li>
	            </ul>
	        </div>
	        <div class="btn-group" id="month-buttons">
	        	<a class="btn btn-inverse btn-small" href="#" id="month-indicator" data-source="<?php echo date('n', $clipping->publicationdate); ?>"><?php echo date('F', $clipping->publicationdate); ?></a>
	            <a class="btn btn-inverse dropdown-toggle btn-small" data-toggle="dropdown" href="#"><span class="caret"></span></a>
	            <ul class="dropdown-menu" id="months" data-source="<?php echo \Uri::create('ajax/clippings'); ?>">
	            </ul>
	    	</div>
			<div class="btn-group" id="collection-buttons">
				<a class="btn btn-inverse btn-small" href="#"><?php echo $clipping->name; ?></a>
				<a class="btn btn-inverse dropdown-toggle btn-small" data-toggle="dropdown" href="#"><span class="caret"></span></a>
				<ul class="dropdown-menu" id="collections" data-source="<?php echo \Uri::create('detail/index/'); ?>">
					
		        </ul>
			</div>
	    </div>  

	    <?php if ($images): ?>        

	    <div id="myCarousel" class="carousel slide">
	    	<div class="carousel-inner">
	    		
			<?php
			$i = 0;
			foreach($images as $image)
			{

				echo '
				<img src="'. \Uri::create( 'data/clippings/' . $clipping->id . '/' . $image->url) .'" class="item'. ($i++ == 0 ? ' active' : '') .'" data-url="'. \Uri::create('download/image/'. $image->id) . '/' . $clipping->id . '" />';

			}
			?>

			<?php else: ?>

			<?php endif; ?>
	    	
			</div>
				<!-- Carousel nav -->
				<a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
				<a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
		</div>

	    </div>

	    <div class="span4">
			<h1 id="shadow-font-mini">download</h1>
			<div class="btn-group" id="download-btns">
				<a class="btn btn-inverse btn-small" id="download-image" rel="tooltip" data-title="download this image"><i class="icon-picture icon-white"></i> image</a>
				<a class="btn btn-inverse btn-small" id="download-clipping" rel="tooltip" data-title="download this clipping" data-url='<?php echo \Uri::create("download/clipping/" . $clipping->id); ?>'><i class="icon-file icon-white"></i> clipping</a>
				<a class="btn btn-inverse btn-small" id="download-collection" rel="tooltip" data-title="download all clippings from selected month" data-url='<?php echo \Uri::create("download/collection/" . date('Y', $clipping->publicationdate) . '/' . date('n', $clipping->publicationdate) . '/' . $customer ); ?>'><i class="icon-calendar icon-white"></i> full month</a>
			</div>

			<h1 id="shadow-font-small"><?php echo $clipping->name; ?></h1>
			<p style="color: #B8B8B8"><?php echo $clipping->description; ?></p>

		</div>

	</section>


	<?php endforeach; ?>
	<?php else: ?>

<?php endif; ?>

<script>
	
	customer = '<?php echo $customer; ?>';

	Detail.init();
	Detail.clipping();

</script>