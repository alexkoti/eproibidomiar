<?php
/**
 * Template Name: Contato
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

<div class="page-box contato-box">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<?php
				if ( have_posts() ){
					while ( have_posts() ){
						the_post();
						get_template_part( 'content', 'page' );
					}
				}
				?>
			</div>
			<div class="col-md-6">
				<?php boros_frontend_form_output('miar_form_contato'); ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>