<?php
/**
 * MINI TEMPLATES
 * A diferença desse arquivo para o functions/frontend.php é que estas funções estão focadas no output de blocos frequentes, enquanto o 
 * frontend.php lida com configurações e filtros, como pre_get_posts, redirects e templates.
 * Normalmente este arquivo será muito customizado para cada tema, enquanto o frontend.php poderá exigir poucas ou nenhuma mudança.
 * 
 */

/**
 * ==================================================
 * PAGINAÇÃO ========================================
 * ==================================================
 * 
 * 
 */
function miar_pagination(){
	global $wp_query;
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$pagination_args = array(
		'query_type' => 'normal',
		'current' => $paged,
		'total' => $wp_query->found_posts,
		'posts_per_page' => $wp_query->query_vars['posts_per_page'],
		'options' => array(
			'num_pages' => 7,
			'link_class' => '',
			'prev_text' => '‹ Anterior',
			'next_text' => 'Próximo ›',
		),
	);
	boros_pagination( $pagination_args );
}

/**
 * ==================================================
 * CUSTOM SEARCH FORM ===============================
 * ==================================================
 * 
 */
add_filter( 'get_search_form', 'custom_search_form' );
function custom_search_form( $form ) {
	$query = esc_attr(apply_filters('the_search_query', get_search_query()));
	$value = ( $query == '' ) ? '' : $query;
	
	$form = '
	<form method="get" id="searchform" action="' . home_url() . '/" >
		<div class="input-group">
			<input type="text" value="' . $value. '" id="search_term" class="form-control" name="s" placeholder="Pesquisar" />
			<span class="input-group-btn"><button class="btn btn-danger" type="submit"><i class="icon-search"></i></button></span>
		</div>
	</form>';
	return $form;
}

/**
 * ==================================================
 * POSTMETA GERAL ===================================
 * ==================================================
 * Dados meta gerias do post: autor, data, categorias|termos aplicados, comentários.
 * Esta função certamente será muito customizada para cada site.
 */
function post_meta_posted_on(){
	global $post;
	$author_data = array(
		get_author_posts_url( get_the_author_meta( 'ID' ) ),
		get_the_author()
	);
	$author = vsprintf('<span class="author vcard"><a class="url fn n" href="%1$s" title="Ver todos os posts de %2$s">%2$s</a>', $author_data );
	
	$date_data = array(
		get_the_date('c'),
		get_the_date(),
	);
	$post_date = vsprintf('<time class="entry-date" datetime="%s" pubdate>%s</time>', $date_data );
	?>
	<div class="post_meta">
		<p class="author_date">Publicado por <?php echo $author; ?> em <span class="post_date"><?php echo $post_date; ?></span></p>
		<?php
		// caso queira mostar apenas uma taxonomia, eleminar o foreach e usar apenas o boros_terms('taxonomy_name').
		$taxonomies = get_taxonomies('', 'objects');
		foreach( $taxonomies as $taxonomy ){
			echo boros_terms( $post->ID, $taxonomy->name, true, "<p class='taxonomy_terms terms_{$taxonomy->name}'>{$taxonomy->label}: ", ' &gt; ', ', ', '</p>' );
		}
		?>
		<p class="comment_status"></p>
	</div>
	<?php
}

/**
 * ==================================================
 * CONTENT NAVIGATION (clone de twentyten) ==========
 * ==================================================
 * 
 * @param string $nav_id - id HTML apenas para identificação
 */
function custom_content_nav( $nav_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $nav_id; ?>" class="contents_nav">
			<div class="nav-previous"><?php next_posts_link( '&larr;  Anteriores' ); ?></div>
			<div class="nav-next"><?php previous_posts_link( 'Recentes &rarr;' ); ?></div>
		</nav><!-- #nav-above -->
	<?php endif;
}

/**
 * ==================================================
 * SHARE BOX ========================================
 * ==================================================
 * Requisitos:
 * - javascript de facebook e twitter linkados via 'head_config'
 * - opção de exibição controlado via painel de admin, opção 'share_active' - necessário para ativar/desativar bloco de share que é bem pesado.
 */
function share_box(){
	global $post;
	if( get_option( 'share_active' ) == true ){
?>
	<div class="share">
		<div>
			<?php if( !is_single() ){ ?><a class="comment_link" href="<?php comments_link(); ?>"><?php comments_number('Sem comentários', '1 comentário', '% comentários'); ?></a><?php } ?>
			<a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-count="horizontal"></a>
		</div>
		<div class="facebook_share" id="facebook_share_box_<?php the_ID(); ?>">
			<script type="text/javascript">
			//<![CDATA[
			document.getElementById("facebook_share_box_<?php the_ID(); ?>").innerHTML = '<fb:like href="<?php the_permalink(); ?>" show_faces="true" width="700"></' + 'fb:like>';
			//]]>
			</script>
		</div>
	</div>
<?php
	}
}



