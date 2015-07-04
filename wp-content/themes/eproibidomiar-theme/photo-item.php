
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
			$longdesc = false;
			?>
			<a href="<?php echo $image_lightbox[0]; ?>" class="lightbox-image" data-sizes="<?php echo "{$image_lightbox[1]}x{$image_lightbox[2]}"; ?>">
				<?php
				$_thumbnail_id = get_post_meta($post->ID, '_thumbnail_id', true);
				if( !empty($_thumbnail_id) ){
					$src = wp_get_attachment_image_src($_thumbnail_id, $thumb_size);
					$alt = get_the_title();
					$longdesc = add_query_arg('attachment_id', $_thumbnail_id, home_url());
					echo "<img src='{$src[0]}' alt='{$alt}' class='img-responsive' longdesc='{$longdesc}' />";
				}
				?>
			</a>
			<?php if( $longdesc != false ){ echo "<a href='{$longdesc}' class='sr-only'>descrição da imagem {$post->post_title}</a>"; } ?>
		</div>
		<div class="caption">
			<p><a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a></p>
			<?php if( !empty($image_download) ){ echo "<p class='download'><a href='{$link}' target='blank'>Baixar foto</a></p>"; } ?>
		</div>
	</div>
</article>
