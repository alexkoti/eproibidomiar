<?php
/**
 * Template Name: Contratar
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
			<div class="col-md-6">
				<?php
				if ( have_posts() ){
					while ( have_posts() ){
						the_post();
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content">
						<?php the_content(); ?>
					</div>
				</article>
				<?php
					}
				}
				?>
			</div>
			<div class="col-md-6">
				<div class="hentry">
					<?php the_post_thumbnail( 'full', array( 'alt' => get_the_title(), 'class' => 'img-responsive' ) ); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>