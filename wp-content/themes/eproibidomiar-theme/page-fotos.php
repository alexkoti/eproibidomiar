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
				<div class="row no-gutter">
					<div id="grid" data-columns>
						<?php
						$args = array(
							'post_type' => 'foto',
							'posts_per_page' => 10,
						);
						$paged = isset($_GET['pg']) ? (int)$_GET['pg'] : 1;
						$args['paged'] = $paged;
						$fotos = new WP_Query($args);
						if( $fotos->posts ){
							$i = 0;
							foreach( $fotos->posts as $post ){
								setup_postdata($post);
								get_template_part('photo', 'item');
								$i++;
							}
						}
						wp_reset_query();
						?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<?php miar_pagination($fotos, $paged); ?>
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