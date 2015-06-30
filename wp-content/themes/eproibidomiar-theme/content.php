
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php
	if( !in_category('Clipping') ){
	if( is_singular() ){
	?>
	<div class="post-thumbnail">
		<?php the_post_thumbnail( 'blog-image', array( 'alt' => get_the_title(), 'class' => 'img-responsive' ) ); ?>
	</div>
	<?php } else { ?>
	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
		<?php the_post_thumbnail( 'blog-image', array( 'alt' => get_the_title(), 'class' => 'img-responsive' ) );?>
	</a>
	<?php }} ?>

	<header class="entry-header">
		<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			endif;
			
			if( !in_category('Depoimentos') ){
				echo '<p class="post-meta">';
				printf( '<span class="%1$s">Publicado em </span> %2$s <span class="meta-sep">por</span> %3$s',
					'meta-prep meta-prep-author',
					sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
						get_permalink(),
						esc_attr( get_the_time() ),
						get_the_date('d\/m\/Y')
					),
					sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
						get_author_posts_url( get_the_author_meta( 'ID' ) ),
						esc_attr( sprintf( 'Ver todos os posts de %s', get_the_author() ) ),
						get_the_author()
					)
				);
				
				// Retrieves tag list of current post, separated by commas.
				$tag_list = get_the_tag_list( '', ', ' );
				if( $tag_list ){
					$posted_in = ' - em %1$s, tags: %2$s.';
				}
				elseif( is_object_in_taxonomy( get_post_type(), 'category' ) ){
					$posted_in = ' - em %1$s.';
				}
				// Prints the string, replacing the placeholders.
				printf(
					$posted_in,
					get_the_category_list( ', ' ),
					$tag_list
				);
				echo '</p>';
			}
		?>
	</header>
	
	<?php if( in_category('Clipping') ){ ?>
	<div class="clipping-data">
		<ul>
			<?php opt_post_meta($post->ID, 'clipping_data', '<li>Data: <strong>%s</strong></li>'); ?>
			<?php opt_post_meta($post->ID, 'clipping_author', '<li>Autor: <strong>%s</strong></li>'); ?>
			<?php opt_post_meta($post->ID, 'clipping_media', '<li>Veículo: <strong>%s</strong></li>'); ?>
		</ul>
	</div>
	<?php } ?>
	
	<div class="entry-content">
		<?php
		the_content();
		
		if( in_category('Depoimentos') ){
			opt_post_meta($post->ID, 'testimonial_author', '<p class="testimonial-author">%s</p>');
		}
		?>
	</div>
	
</article>
