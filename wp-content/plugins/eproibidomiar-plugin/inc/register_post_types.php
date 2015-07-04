<?php
/**
 * REGISTER POST TYPES
 * Configurações para adicionar custom post_types. Este arquivo trabalha em conjunto com o 'register_taxonomies.php'
 * 
 */

/**
 * ==================================================
 * ADICIONAR SUPORTE A POST FORMATS =================
 * ==================================================
 * Isso irá permitir o tema usar post_formats para os 'posts' padrão do wordpress. Caso sej apreciso adicionar esse recurso a outros post_types, usar add_post_type_support()
 * Se for preciso adicionar post_formats a um post_type e ao mesmo tempo não dar suporte aos posts comnuns, é preciso primeiro habilitar os post_formats ao tema, usando
 * add_theme_support(), adicionar o suporte ao post_type desejado e só então desabilitar os formats para posts, com remove_post_type_support().
 */
//add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );
//add_post_type_support( 'page', 'post-formats' );
//remove_post_type_support( 'post', 'post-formats' );

/**
 * ==================================================
 * REGISTER POST TYPES ==============================
 * ==================================================
 * 
 * 
 */
add_action( 'init', 'register_post_types' );
function register_post_types(){
	/**
	 * Fotos
	 * 
	 */
	$labels = array(
		'name' => 'Fotos',
		'singular_name' => 'Foto',
		'menu_name' => 'Fotos',
		'add_new' => 'Nova Foto',
		'add_new_item' => 'Adicionar Foto',
		'edit_item' => 'Editar Foto',
		'new_item' => 'Nova Foto',
		'view_item' => 'Ver Foto',
		'search_items' => 'Buscar Foto',
		'not_found' =>  'Nenhum encontrada',
		'not_found_in_trash' => 'Nenhum encontrada na lixeira',
		'parent_item_colon' => ''
	);
	$args = array(
		'labels' => $labels,
		'description' => 'Fotos',
		'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'show_in_nav_menus' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		//'has_archive' => 'fotos',
		'menu_icon' => 'dashicons-images-alt2',
		//'show_in_menu' => 'edit.php?post_type=artigo',
		'supports' => array(
			'title',
			'editor',
			'thumbnail',
		)
	); 
	register_post_type( 'foto' , $args );
	$columns_config = array(
		'post_type' => 'foto',
		'columns' => array(
			'cb' => '<input type="checkbox" />',
			'title' => 'Título',
			'thumb' => 'Foto',
			'terms_categoria_foto' => 'Categorias',
			'terms_tag_foto' => 'Tags',
			'terms_data_foto' => 'Data',
			'date' => 'Data',
		)
	);
	new BorosPostTypeColumns( $columns_config );
	
	/**
	 * Contatos
	 * 
	 */
	$labels = array(
		'name' => 'Contatos',
		'singular_name' => 'Contato',
		'menu_name' => 'Contatos',
		'add_new' => 'Nova Contato',
		'add_new_item' => 'Adicionar Contato',
		'edit_item' => 'Editar Contato',
		'new_item' => 'Novo Contato',
		'view_item' => 'Ver Contato',
		'search_items' => 'Buscar Contato',
		'not_found' =>  'Nenhum encontrado',
		'not_found_in_trash' => 'Nenhum encontrado na lixeira',
		'parent_item_colon' => ''
	);
	$args = array(
		'labels' => $labels,
		'description' => 'Contatos',
		'public' => false,
		'publicly_queryable' => false,
		'exclude_from_search' => true,
		'show_ui' => true,
		'show_in_nav_menus' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		//'has_archive' => 'Contatos',
		'menu_icon' => 'dashicons-email-alt',
		//'show_in_menu' => 'edit.php?post_type=artigo',
		'supports' => array(
			'title',
			'editor',
			'thumbnail',
		)
	); 
	register_post_type( 'contato' , $args );
	$columns_config = array(
		'post_type' => 'contato',
		'columns' => array(
			'cb' => '<input type="checkbox" />',
			'title' => 'Título',
			'date' => 'Data',
		)
	);
	new BorosPostTypeColumns( $columns_config );
}

/**
 * COLUNAS DE 'POSTS' e 'PAGES'
 * Configuração das colunas de listagem dos post_types core.
 * 
 */
add_filter('manage_posts_columns', 'control_posts_columns');
function control_posts_columns( $posts_columns ){
	$posts_columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => 'Título',
		'author' => 'Autor',
		'categories' => 'Categorias',
		'tags' => 'Tags',
		'thumb' => 'Imagem de destaque',
		'comments' => '<div class="vers"><img alt="Comentários" title="Comentários" src="' . get_bloginfo('wpurl') . '/wp-admin/images/comment-grey-bubble.png"></div>',
		'date' => 'Data',
	);
	return $posts_columns;
}
//add_filter('manage_pages_columns', 'control_pages_columns');
function control_pages_columns( $posts_columns ){
	$posts_columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => "Título",
		"thumb" => "Imagem de destaque",
		"date" => 'Data',
		"order" => 'Ordem',
	);
	return $posts_columns;
}


