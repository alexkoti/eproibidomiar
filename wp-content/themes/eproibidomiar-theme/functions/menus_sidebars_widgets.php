<?php
/**
 * ==================================================
 * REGISTER MENUS ===================================
 * ==================================================
 * Aqui apenas são adicionadas posições pré-definidas de menus, e não são registrados nenhum menu de fato.
 * São registrados locais(placeholders), aonde poderão ser adicionados menus criados. O nome ideal seria 'register_menu_location', 
 * pois não são criados menus previamente, apenas via admin.
 * 
 * ATENÇÃO: o indice 'menu_footer' é utilizado pelo bootstrap_nav_menu_walker(), caso seja preciso modificar o índice, é
 * preciso atualizar 
 */
register_nav_menus(
	array(
	  'menu_header' => 'Posição Cabeçalho',
	  'menu_footer' => 'Posição Rodapé',
	)
);

// incluir as classes originais para montar o menu:
include('lib/navwalker.php');
include('lib/navwalker-mobile.php');

// FIXO: Adicionar item 'Home' às páginas dsponíveis para criar menus
add_filter( 'wp_page_menu_args', 'home_page_menu_args' );
function home_page_menu_args( $args ){
	$args['show_home'] = true;
	return $args;
}

/**
 * ==================================================
 * REGISTER SIDEBARS ================================
 * ==================================================
 * Aqui são registrados os sidebars para serem exibidos no admin e no frontend ao mesmo tempo
 * 
 * @param string    $name             Nome que irá aprecer no controle do admin
 * @param string    $description      Descrição que aparece no admin
 * @param string    $before_widget    HTML de abertura do widget. Geralmente é usado <LI>, mas pode ser qualquer tag de bloco.
 * @param string    $after_widget     HTML de fechamento
 * @param string    $before_title     HTML de abertura do título do widget. Lembre-se que alguns widgets podem ser configurados com ou sem título, então a formatação deverá prever esses casos.
 * @param string    $after_title      HTML de fechamento
 * 
 */
//add_action( 'widgets_init', 'register_sidebars_init' );
function register_sidebars_init(){
	
	// Registrar um novo sidebar
	$args = array(
		'name' => 'Sidebar Geral',
		'id' => 'sidebar_geral',
		'description' => 'Sidebar Geral',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	);
	register_sidebar( $args );
}

/**
 * ==================================================
 * CLASSES DO MENU ==================================
 * ==================================================
 * 
 * 
 * 
 */
add_filter( 'nav_menu_css_class', 'miar_nav_menu_css_class', 999999999999, 2 );
function miar_nav_menu_css_class( $classes, $item ){
	if( (is_post_type_archive('foto') or is_tax(array('categoria_foto', 'tag_foto', 'data_foto'))) ){
		if( $item->title == 'Novidades' ){
			$classes = array('menu-item');
		}
		elseif( $item->title == 'Fotos' ){
			$classes[] = 'active';
			return $classes;
		}
	}
	if( is_singular('foto') and $item->title == 'Fotos' ){
		$classes[] = 'active';
		return $classes;
	}
	
	return $classes;
}
//add_filter( 'walker_nav_menu_start_el', 'aaa', 99, 4 );
function aaa($item_output, $item, $depth, $args){
	pre(func_get_args());
	
	return $item_output;
}



/**
 * ==================================================
 * WP_LIST_PAGE ACTIVE CLASS ========================
 * ==================================================
 * Adicionar a class .active no link ativo em wp_list_pages();
 * 
 */
add_filter( 'page_css_class', 'boros_page_css_class', 10, 5 );
function boros_page_css_class( $css_class, $page, $depth, $args, $current_page ){
	if( $current_page == $page->ID ){
		$css_class[] = 'active';
	}
	return $css_class;
}



/**
 * ==================================================
 * BOOTSTRAP MENU ===================================
 * ==================================================
 * 
 * 
 */
class bootstrap_nav_menu_walker extends Walker_Nav_Menu {
	function start_lvl( &$output, $depth = 0, $args = array() ){
		// depth dependent classes
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		$display_depth = ( $depth + 1); // because it counts the first submenu as 0
		$classes = array(
			'dropdown-menu',
			'sub-menu',
			( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
			( $display_depth >=2 ? 'sub-sub-menu' : '' ),
			'menu-depth-' . $display_depth
		);
		$class_names = implode( ' ', $classes );
		$output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
	}
	
	function start_el( &$output, $item, $depth = 0, $args = array(), $current_object_id = 0 ){
		//pre($item, 'item');
		//pre($args, 'args');
		global $wp_query;
		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
		
		$depth_class_names = "li_normal depth-{$depth}";
		if( $depth == 0 ){
			$depth_class_names = "dropdown depth-{$depth}";
		}
		
		$output .= $indent . '<li class="' . $depth_class_names . '">';
		
		$link_classes = '';
		/**
		 * Caso seja o primeiro nível, adicionar class de dropdown, mas apenas quando o existirem childs.
		 * obs: foi usado o $GLOBALS para evitar novas queries de menu
		 * 
		 * ATENÇÃO: o índice 'menu_header' é relativo aos slots de menus registrados em register_menus(), neste mesmo arquivo.
		 * 
		 */
		if( !isset($GLOBALS['header_menu_cache']) ){
			//pal('sem cache');
			$menu_locations = get_nav_menu_locations();
			$menu_header_items = wp_get_nav_menu_items( $menu_locations['menu_header'] );
			$GLOBALS['header_menu_cache'] = array(
				'menu_locations' => $menu_locations,
				'menu_header_items' => $menu_header_items,
			);
		}
		else{
			//pal('COM cache');
			$menu_locations = $GLOBALS['header_menu_cache']['menu_locations'];
			$menu_header_items = $GLOBALS['header_menu_cache']['menu_header_items'];
		}
		$childs = false;
		if( isset($menu_locations['menu_header']) ){
			foreach( $menu_header_items as $i ){
				if( $i->menu_item_parent == $item->ID ){
					$childs[] = $i;
				}
			}
			// possui childs!
			if( !empty($childs) and $depth == 0 ){
				$link_classes = 'class="dropdown-toggle" data-toggle="dropdown"';
				$item->title .= ' <b class="caret"></b>';
			}
		}
		
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		$attributes .= " {$link_classes}";
		
		$item_output = sprintf(
			'%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s' . "\n",
			$args->before,
			$attributes,
			$args->link_before,
			apply_filters( 'the_title', $item->title, $item->ID ),
			$args->link_after,
			$args->after
		);
		
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}






