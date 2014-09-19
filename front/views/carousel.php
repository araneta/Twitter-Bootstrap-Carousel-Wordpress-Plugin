<?php

$ncount = count($banners);
?>
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
	<!-- Indicators -->
	<ol class="carousel-indicators">
		<?php for($i=0;$i<$ncount;$i++):?>
		<li data-target="#carousel-example-generic" data-slide-to="<?php echo $i;?>" class="<?php if($i==0)echo 'active';?>"></li>
		<?php endfor;?>		
	</ol>

	<!-- Wrapper for slides -->
	<div class="carousel-inner">
		<?php 
		$i = 0;
		foreach($banners as $b):?>
		<div class="item <?php if($i==0)echo 'active';?>">
			<a href="<?php echo $b->target_url;?>"><img src="<?php echo $b->image_url;?>" alt="<?php echo $b->title;?>"></a>
			<div class="carousel-caption">							
			</div>
		</div>
		<?php $i++;?>
		<?php endforeach;?>		
	</div>
	<!-- Controls -->
	<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
		<img src="<?php bloginfo('template_url');?>/images/banner/slider_left.png">
	</a>
	<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
		<img src="<?php bloginfo('template_url');?>/images/banner/slider_right.png">
	</a>
</div>
