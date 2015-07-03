
<article id="post-<?php the_ID(); ?>" <?php post_class('photo-item'); ?>>
	<div class="inner">
		<div class="photo">
			<?php
			$image_download = get_post_meta($post->ID, 'image_download', true);
			if( !empty($image_download) ){
				$link = wp_get_attachment_url($image_download);
				echo "<a href='{$link}' class='download' target='blank'>Baixar</a>";
			}
			?>
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium', array( 'alt' => get_the_title(), 'class' => 'img-responsive' ) ); ?></a>
		</div>
		<div class="caption">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</div>
	</div>
</article>
