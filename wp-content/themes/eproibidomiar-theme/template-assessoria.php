<?php
/**
 * Template Name: Assessoria
 * 
 */

get_header();
?>

<div class="page-head">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1><?php echo apply_filters( 'the_title', $post->post_title ); ?></h1>
			</div>
		</div>
	</div>
</div>

<div class="page-box">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="owl-carousel owl-assessoria-photos">
					<?php
					$photos = get_post_meta($post->ID, 'assessoria_photos', true);
					if( !empty($photos) ){
						$photos = explode( ',', $photos );
						$i = 0;
						foreach( $photos as $photo ){
							$post = get_post($photo);
							setup_postdata($post);
							include('photo-item.php');
							wp_reset_postdata();
							$i++;
						}
					}
					?>
				</div>
			</div>
			<div class="col-md-6 col-md-push-6">
				<div class="owl-carousel owl-assessoria-photos2">
					<?php
					$photos = get_post_meta($post->ID, 'assessoria_photos', true);
					if( !empty($photos) ){
						$photos = explode( ',', $photos );
						$i = 0;
						foreach( $photos as $photo ){
							$post = get_post($photo);
							setup_postdata($post);
							include('photo-item.php');
							wp_reset_postdata();
							$i++;
						}
					}
					?>
				</div>
			</div>
			<div class="col-md-6 col-md-pull-6">
				<?php
				if ( have_posts() ){
					while ( have_posts() ){
						the_post();
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content">
						<?php the_content(); ?>
					</div>
					
					<?php
					$file = get_post_meta($post->ID, 'file', true);
					if( !empty($file) ){
						$file = wp_get_attachment_url($file);
						$filename = basename($file);
					?>
					<div class="necessidades-tecnicas">
						<?php opt_post_meta($post->ID, 'file_title', '<h3>%s</h3>'); ?>
						<?php opt_post_meta($post->ID, 'file_desc', '%s', true, 'the_content'); ?>
						<a href="<?php echo $file; ?>" target="_blank"><?php echo $filename; ?></a>
					</div>
					<?php } ?>
				</article>
				<?php
					}
				}
				?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>