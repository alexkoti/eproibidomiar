<?php
/**
 * CONFIGURAÇÔES PARA O HEAD DO FRONTEND
 * Configurações a serem aplicadas do <head> do frontend, basicamente são as adições dos javascripts e stylesheets, 
 * mas incluindo as manipulações de qualquer elemento do <head>, como description, keywords, rels diversos, etc
 * Jquery e scripts dependentes são declarados aqui, mesmo sendo renderizados no final no wp_footer();
 * 
 * 
 * 
 */

/**
 * ==================================================
 * ADD ACTIONS/FILTERS ==============================
 * ==================================================
 * 
 * 
 */
if( !is_admin() ){
	add_action( 'init', 'add_frontend_scripts' );             // adicionar scripts ao header
	add_action( 'wp_head', 'work_opengraph', 99 );            // iniciar o opengraph, caso esteja ativado
	remove_action('wp_head', 'wp_generator');                 // remover a assinatura de versão do wordpress
}

function work_opengraph(){
	if( get_option('og_active') == true ){
		opengraph_tags();
	}
}



/**
 * ==================================================
 * STYLESHEETS ======================================
 * ==================================================
 * 
 * 
 */
function add_frontend_scripts(){
	$css = new BorosCss();
	$css->add('bootstrap.min');
	$css->add('wp');
	$css->add('animate');
	$css->add('font-awesome.min');
	$css->add('main');
	$css->add('owl.carousel');
	$css->add('owl.theme');
	$css->add('photoswipe');
	$css->add('default-skin', 'default-skin');
	$css->add('eproibidomiar');
	
	if( defined('LOCALHOST') and LOCALHOST == true ){
		$css->add('responsive-debug');
	}
	
	if( !defined('LOCALHOST') ){
		$args = array(
			'name' => 'Font-Coustard-RobotoSlab',
			'src' => 'http://fonts.googleapis.com/css?family=Coustard|Roboto+Slab:400,700,300',
			'parent' => false,
			'version' => '1',
			'media' => 'screen',
		);
		$css->abs($args);
	}
    
    
	$js = new BorosJs();
	$js->jquery('jquery.validate.min', 'libs');
	$js->jquery('bootstrap.min', 'libs');
	$js->jquery('owl.carousel.min', 'libs');
	$js->jquery('salvattore.min', 'libs');
	$js->jquery('photoswipe.min', 'libs');
	$js->jquery('photoswipe-ui-default.min', 'libs');
	$js->jquery('functions');
}



