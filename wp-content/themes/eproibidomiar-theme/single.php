<?php get_header(); ?>

<div class="page-head">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Novidades</h1>
			</div>
		</div>
	</div>
</div>

<div class="blog-box">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<?php
				if ( have_posts() ){
					while ( have_posts() ){
						the_post();
						get_template_part( 'content' );
					}
				}
				the_post_navigation( array(
					'next_text' => '<span>‹</span> %title',
					'prev_text' => '%title <span>›</span>',
				) );
				?>
			</div>
			<div class="col-md-4">
				<?php get_sidebar('blog'); ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>