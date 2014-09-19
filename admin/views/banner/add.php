<div class="wrap">	
	<?php if(empty($banner->id)):?>
	<h2><?php echo __( 'Add Banner') ?></h2>
	<?php else:?>
	<h2><?php echo __( 'Edit Banner') ?></h2>
	<?php endif;?>
	<?php self::view('status');?>
	
	<form method="post"> 
		<input type="hidden" name="id" value="<?php if(!empty($banner->id))echo $banner->id;?>">
		<div>
			<label>Title</label><br />
			<input type="text" name="title" value="<?php if(isset($banner->title))echo $banner->title;?>" />
		</div>
		<div>
			<label>Image URL</label><br />			
			<label for="upload_image">
				<input id="upload_image" type="text" size="36" name="image_url" value="<?php if(isset($banner->image_url))echo $banner->image_url;?>" />
				<input id="upload_image_button" class="button" type="button" value="Upload Image" />
				<br />Enter a URL or upload an image
			</label>
		</div>
		<div>
			<label>Target URL</label><br />
			<input type="text" name="target_url" value="<?php if(isset($banner->target_url))echo $banner->target_url;?>" />
		</div>
		<div>
			<label>Target Window</label><br />
			<select name="target_window">
				<option <?php if(isset($banner->target_window) && $banner->target_window=='_self')echo 'selected';?> value="_self">_self</option>
				<option <?php if(isset($banner->target_window) && $banner->target_window=='_blank')echo 'selected';?> value="_blank">_blank</option>
			</select>
			
		</div>
		<div>
			<label>Order</label><br />
			<input type="text" name="image_order" value="<?php if(isset($banner->image_order))echo $banner->image_order;?>" />
		</div>
		<div>
			<label>&nbsp;</label>
			<input type="hidden" name="redirect" value="<?php echo $redirect_url;?>" />
			<input type="submit" name="save" value="Save" />
		</div>
	</form>	
	
</div>
