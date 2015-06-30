<?php
/**
 * Funções específicas para atender o frontend este site.
 * As funções listadas no começo do arquivo possuem maior prioridade de edição, as funções mais ao fim do arquivo muitas vezes não necessitam de personalização.
 * 
 * 
 */



/**
 * Template debug footer
 * 
 */
add_action( 'wp_footer', 'template_debug_footer', 99 );
function template_debug_footer(){
	global $template;
	$t = basename($template);
	echo "<!-- {$t} -->";
}



/**
 * Filtrar title em depoimentos
 * 
 */
add_filter( 'the_title', 'miar_filter_testimonial_title', 10, 2 );
function miar_filter_testimonial_title( $title, $post_id = null ){
	if( in_category('depoimentos', $post_id) ){
		return "&ldquo;{$title}&rdquo;";
	}
	return $title;
}



add_action( 'template_redirect', 'close_site' );
function close_site(){
	$logged_in_only = get_option('logged_in_only');
	if( !empty($logged_in_only) ){
		if( !is_user_logged_in() ){
			get_template_part('locked');
			exit();
		}
	}
}



/**
 * Disable the emoji's
 */
add_action( 'init', 'disable_emojis' );
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}

function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}



/**
 * ==================================================
 * GOOGLE ANALYTICS =================================
 * ==================================================
 * 
 * 
 */
add_action( 'wp_footer', 'footer_google_analytics' );
function footer_google_analytics(){
	opt_option('google_analytics');
}



/**
 * ==================================================
 * CUSTOM POSTS PER PAGE ============================
 * ==================================================
 * Definir a quantidade total de post por página em diferentes situações.
 * A quantidade padrão é definida pela option 'posts_per_page', gravada em wp_options, e definida via admin em 'Configurações > Leitura"
 * Como as situações possíveis de listagens são infinitas, é preciso codificar a verificação para cada caso.
 * 
 * IMPORTANTE:
 * Quando é definido uma página estática para a frontpage, a primeira vez que é chamado o filtro 'pre_get_posts', ocorre um erro, onde não se consegue acesso ao queried object.
 * Para resolver isso, é verificado se está na frontpage comparando a query_var 'page_id', que sempre está nas querys com a option 'page_on_front'. Em caso positivo, 
 * estamos na frontpage, portanto $query é retornado sem modificações. Essa primeira chamada de 'pre_get_posts' nesse caso específico não precisa ser modificada em nenhum caso.
 * 
 * As posteriores chamadas de pre_get_posts que precisem verificar is_front_page() rodarão normalmente. Por exemplo, se for feita uma nova requisição no meio da página, como
 * query_posts() ou WP_Query(), as verificações de is_front_page() funcionarão como esperado.
 * 
 */
//add_filter( 'pre_get_posts', 'filter_pre_get_posts' );
function filter_pre_get_posts( $query ){
	$page_on_front = get_option('page_on_front');
	if( $query->query_vars['page_id'] == $page_on_front ){
		return $query;
	}
	
	// definir a quantidade de posts padrão em chamadas de query_posts() e WP_Query() na frontpage. Sobrepõem qualquer definição das funções.
	if( is_front_page() ){
		$query->query_vars['posts_per_page'] = 3;
	}
	
	// definir a quantidade de posts padrão na home(home de posts)
	if( is_home() ){
		$query->query_vars['posts_per_page'] = 2;
	}
	
	// posts per page em fábrica de ideias
	if(
		(isset($wp_query->query_vars['post_type']) and $wp_query->query_vars['post_type'] == 'ideia') OR 
		(isset($wp_query->query_vars['taxonomy']) and $wp_query->query_vars['taxonomy'] == 'category-ideias')
	){
		if( $wp_query->is_single != true )
			$query->query_vars['posts_per_page'] = 14;
	}
	
	// remover vídeos da listagem normal de blogs
	if( !is_front_page() ){
		if ( isset($query->category_name) and $query->category_name != 'videos' AND $wp_query->is_admin == false ) {
			$exclude = get_cat_ID('videos');
			$query->set('cat', '-'.$exclude);
		}
	}

	return $query;
}



/**
 * ==================================================
 * REDIRECT =========================================
 * ==================================================
 * Redirecionar a página corrente para outro local.
 * Como as situações possíveis são infinitas, é preciso codificar a verificação para cada caso.
 */
//add_filter( 'parse_query', 'redirect_pages' );
function redirect_pages( &$q ) {
	if( empty($q->is_admin) and isset($q->query_vars['page_id']) ){
		// ID da página pedida
		$page_id = $q->query_vars['page_id'];
		
		if( $page_id == get_page_ID_by_name('Painel 5', 'page') ){
			$url = get_permalink( get_page_ID_by_name('Painel Home', 'page') );
			wp_redirect( $url, 301 );
			exit();
		}
	}
	/**
	pre($q);
	pre($q->query_vars['category_name']);
	pre($q->query_vars['posts_per_page']);
	pre($q->query_vars['numberposts']);
	pre($q->query_vars['posts_per_page']);
	pre($q->query_vars['numberposts']);
	/**/
}


