<?php get_header(); ?>

<div class="page-head">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				Novidades 
				<?php
				single_tag_title( ' - ' );
				
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				if( $paged > 1 ){
					echo " - Página {$paged}";
				}
				?>
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
				
				miar_pagination();
				?>
			</div>
			<div class="col-md-4">
				<?php get_sidebar('blog'); ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>