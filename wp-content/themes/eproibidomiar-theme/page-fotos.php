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
					<div id="grid" data-columns>
						<?php
						$args = array(
							'post_type' => 'foto',
							'posts_per_page' => 20,
						);
						$paged = isset($_GET['pg']) ? (int)$_GET['pg'] : 1;
						$args['paged'] = $paged;
						$fotos = new WP_Query($args);
						if( $fotos->posts ){
							$i = 0;
							foreach( $fotos->posts as $post ){
								setup_postdata($post);
								include('photo-item.php');
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