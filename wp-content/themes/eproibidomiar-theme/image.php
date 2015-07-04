<?php get_template_part('head'); ?>
<body <?php body_class(); ?>>
<figure>
	<?php
	if ( have_posts() ){
		while ( have_posts() ){
			the_post();
			$img = wp_get_attachment_image_src($post->ID, 'large');
			?>
			<h1><?php the_title(); ?></h1>
			<div><?php the_content(); ?></div>
			<img src="<?php echo $img [0]; ?>" alt=" " />
			<?php
		}
	}
	?>
</figure>

<?php wp_footer(); ?>
</body>
</html>