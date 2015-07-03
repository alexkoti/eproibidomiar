<?php get_header(); ?>

<div class="page-head">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				Fotos - <?php echo apply_filters('the_title', $post->post_title); ?>
			</div>
		</div>
	</div>
</div>

<div class="fotos-box">
	<div class="container">
		<div class="row">
			<div class="col-md-9 photos-list">
				<div class="row no-gutter">
					<?php
					if ( have_posts() ){
						while ( have_posts() ){
							the_post();
					?>
					<article id="post-<?php the_ID(); ?>" <?php post_class('photo-single'); ?>>
						<h1><?php the_title(); ?></h1>
						<div class="photo">
							<?php
							$image_download = get_post_meta($post->ID, 'image_download', true);
							if( !empty($image_download) ){
								$link = wp_get_attachment_url($image_download);
								echo "<a href='{$link}' class='download' target='blank'>Baixar</a>";
							}
							?>
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'large', array( 'alt' => get_the_title(), 'class' => 'img-responsive' ) ); ?></a>
						</div>
						<div class="caption">
							<?php the_content(); ?>
						</div>
					</article>
					<?php
						}
					}
					?>
				</div>
			</div>
			<div class="col-md-3 sidebar">
				<?php get_template_part('sidebar', 'fotos'); ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>