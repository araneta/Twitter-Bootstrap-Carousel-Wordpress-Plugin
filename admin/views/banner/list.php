<div class="wrap">	
	<h2><?php echo __( 'Banners') ?></h2>
	<?php self::view('status');?>
	<p><a href="<?php menu_page_url(LMJ_CAROUSEL_SLUG.'_banner_entry');?>">Add Banner</a></p>
	<table class="wp-list-table widefat fixed pages">
		<thead>
			<tr>
				<th class="column-title" width="140">Title</th>				
				<th width="300">Target URL</th>
				<th width="100">Order</th>
				<th width="100">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php if(!$banners):?>
				<tr><td colspan="4">Empty</td></tr>
			<?php else: ?>
				<?php
				$r = "alternate";
				?>
				<?php foreach($banners as $b):?>
					<tr class="<?php if($r=="even"){$r="alternate";}else{$r="even";}echo $r;?>">
						<td><?php echo htmlspecialchars($b->title);?>
						</td>
						<td><?php echo htmlspecialchars($b->target_url);?></td>
						<td><?php echo htmlspecialchars($b->image_order);?></td>						
						<td>
							<a href="<?php menu_page_url(LMJ_CAROUSEL_SLUG.'_banner_entry');?>&id=<?php echo $b->id;?>">Edit</a>
							<a href="<?php menu_page_url(LMJ_CAROUSEL_SLUG.'_banner_entry');?>&delid=<?php echo $b->id;?>">Delete</a>
						</td>
					</tr>
				<?php endforeach;?>
			<?php endif;?>
		</tbody>
	</table>
</div>	
