<div class="wrap">	
	<h2><?php echo __( 'Delete Schedule') ?></h2>
	<p>Are you sure you want to delete this:</p>
	<form method="post"> 
		<input type="hidden" name="id" value="<?php if($banner)echo $banner->id;?>">
		<p>Title:<?php echo $banner->title;?><br />
		Image URL: <?php echo $banner->image_url; ?><br />		
		</p>
		<div>
			<label>&nbsp;</label>
			 <input type="hidden" name="redirect" value="<?php echo $redirect_url;?>" />
			<input type="submit" name="delete" value="Delete" />
		</div>
	</form>
</div>
