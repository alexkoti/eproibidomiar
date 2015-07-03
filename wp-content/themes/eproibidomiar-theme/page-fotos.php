<?php get_header(); ?>

<div class="page-head">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				Fotos
				<?php
				// categorias
				?>
			</div>
		</div>
	</div>
</div>

<div class="fotos-box">
	<div class="container">
		<div class="row">
			<div class="col-md-9 photos-list">
				<div class="row no-gutter">
					<?php
					if ( have_posts() ){
						while ( have_posts() ){
							the_post();
					?>
					<article id="post-<?php the_ID(); ?>" <?php post_class('photo-item col-md-4 col-sm-6'); ?>>
						<div class="inner">
							<div class="photo">
								<?php the_post_thumbnail( 'medium', array( 'alt' => get_the_title(), 'class' => 'img-responsive' ) ); ?>
							</div>
							<div class="caption">
								<?php the_title(); ?>
							</div>
						</div>
					</article>
					<?php
						}
					}
					?>
				</div>
			</div>
			<div class="col-md-3 sidebar">
				<div class="widget search">
					<?php get_search_form(); ?>
				</div>
				<div class="widget categories">
					<ul>
						<li><a href="<?php page_permalink_by_name('fotos'); ?>">Todas as categorias</a></li>
						<?php wp_list_categories( array('taxonomy' => 'categoria_foto', 'title_li' => false) ); ?>
					</ul>
				</div>
				<div class="widget tags">
					<?php wp_tag_cloud( array('taxonomy' => 'tag_foto', 'smallest' => 12, 'largest' => 12) ); ?>
				</div>
				<div class="widget dates">
					<ul>
						<?php
						$years = array();
						$dates = get_terms( 'data_foto', array('hide_empty' => false) );
						foreach( $dates as $date ){
							if( $date->parent == 0 ){
								$years[$date->term_id]['term'] = $date;
							}
							else{
								$years[$date->parent]['child'][] = $date;
							}
						}
						
						pre($years);
						?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>