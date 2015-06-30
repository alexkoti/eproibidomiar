
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post-thumbnail">
		<?php the_post_thumbnail( 'blog-image', array( 'alt' => get_the_title(), 'class' => 'img-responsive' ) ); ?>
	</div>
	
	<div class="entry-content">
		<?php the_content(); ?>
	</div>
	
</article>