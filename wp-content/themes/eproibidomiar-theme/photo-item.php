
<article id="post-<?php the_ID(); ?>" <?php post_class('photo-item'); ?> data-index="<?php global $i; echo $i; ?>">
	<div class="inner">
		<div class="photo">
			<?php
			$thumb_size = 'post-thumbnail';
			if( !is_front_page() ){
				$thumb_size = 'medium';
				$image_download = get_post_meta($post->ID, 'image_download', true);
				if( !empty($image_download) ){
					$link = wp_get_attachment_url($image_download);
					echo "<a href='{$link}' class='download' target='blank'>Baixar</a>";
				}
			}
			$image_lightbox = wp_get_attachment_image_src( get_post_meta($post->ID, '_thumbnail_id', true), 'large' );
			?>
			<a href="<?php echo $image_lightbox[0]; ?>" class="lightbox-image" data-sizes="<?php echo "{$image_lightbox[1]}x{$image_lightbox[2]}"; ?>"><?php the_post_thumbnail( $thumb_size, array( 'alt' => get_the_title(), 'class' => 'img-responsive' ) ); ?></a>
		</div>
		<div class="caption">
			<p><a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a></p>
			<?php if( !empty($image_download) ){ echo "<p class='download'><a href='{$link}' target='blank'>Baixar foto</a></p>"; } ?>
		</div>
	</div>
</article>
