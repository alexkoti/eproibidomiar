<?php get_header(); ?>

<div class="page-head">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1><?php echo apply_filters( 'the_title', $post->post_title ); ?></h1>
			</div>
		</div>
	</div>
</div>

<div class="blog-box">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php
				if ( have_posts() ){
					while ( have_posts() ){
						the_post();
						get_template_part( 'content', 'page' );
					}
				}
				?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>