<?php get_header(); ?>

<div class="page-head">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				Fotos
			</div>
		</div>
	</div>
</div>

<div class="fotos-box">
	<div class="container">
		<div class="row">
			<div class="col-md-9 photos-list">
				<div class="row">
					<div class="col-md-12 sidebar sidebar-xs visible-xs">
						<div class="widget categories">
							<ul>
								<?php wp_list_categories( array('taxonomy' => 'categoria_foto', 'title_li' => false) ); ?>
								<li><a href="<?php page_permalink_by_name('fotos'); ?>">Todas</a></li>
							</ul>
						</div>
					</div>
				</div>
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
							
							$_thumbnail_id = get_post_meta($post->ID, '_thumbnail_id', true);
							if( !empty($_thumbnail_id) ){
								$src = wp_get_attachment_image_src($_thumbnail_id, 'large');
								$alt = get_the_title();
								$longdesc = add_query_arg('attachment_id', $_thumbnail_id, home_url());
								echo "<img src='{$src[0]}' alt='{$alt}' class='img-responsive' longdesc='{$longdesc}' />";
							}
							echo "<a href='{$longdesc}' class='sr-only'>descrição da imagem {$post->post_title}</a>";
							?>
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