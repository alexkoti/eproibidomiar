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
					
					<?php
					$technical_needs = get_post_meta($post->ID, 'technical_needs', true);
					if( !empty($technical_needs) ){
						$file = wp_get_attachment_url($technical_needs);
						$filename = basename($file);
					?>
					<div class="necessidades-tecnicas">
						<h3>Necessidades técnicas</h3>
						<p>Baixe esse arquivo para saber quais são as características necessárias para viabilizar nossas apresentações.</p>
						<a href="<?php echo $file; ?>" target="_blank"><?php echo $filename; ?></a>
					</div>
					<?php } ?>
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