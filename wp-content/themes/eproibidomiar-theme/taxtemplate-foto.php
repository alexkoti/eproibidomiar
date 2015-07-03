<?php get_header(); ?>

<div class="page-head">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php single_term_title('Fotos - '); ?>
			</div>
		</div>
	</div>
</div>

<div class="fotos-box">
	<div class="container">
		<div class="row">
			<div class="col-md-9 photos-list">
				<div class="row no-gutter">
					<div id="grid" data-columns>
						<?php
						if ( have_posts() ){
							while ( have_posts() ){
								the_post();
								get_template_part('photo', 'item');
							}
						}
						?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<?php miar_pagination(); ?>
					</div>
				</div>
			</div>
			<div class="col-md-3 sidebar">
				<?php get_template_part('sidebar', 'fotos'); ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>