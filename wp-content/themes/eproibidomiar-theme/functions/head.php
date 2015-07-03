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
	add_action( 'wp_print_styles', 'add_frontend_styles' );   // adicionar styles ao header
	add_action( 'wp_print_scripts', 'add_frontend_scripts' ); // adicionar scripts ao header
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
function add_frontend_styles(){
	$css = new BorosCss();
	$css->add('bootstrap.min');
	$css->add('wp');
	$css->add('animate');
	$css->add('font-awesome.min');
	$css->add('main');
	$css->add('owl.carousel');
	$css->add('owl.theme');
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
	
	/** MODELOS
	//simples, sem dependencia
	$css->add('forms');
	
	//encadeamento de 2 styles child
	$css->add('lightbox', 'lightbox')->child('lights', 'lightbox/themes')->child('shadows', 'lightbox/themes')->media('all');
	
	//subpasta, media print, alternate stylesheet
	$css->add('animations', 'anims')->media('print')->alt();
	
	//ies, encadeando child ie6 condicional
	$css->add('ies', 'ie', 'all')->child('ie6', 'ie', 'handheld')->cond('lte IE 8');
	
	//child de ies, media all, condicional
	$css->child('ie7', 'ie', 'all', 'ies')->cond('lte 8');
	
	//debug
	global $wp_styles;pre($wp_styles);
	/**/
}



/**
 * ==================================================
 * JAVASCRIPTS ======================================
 * ==================================================
 * Todos os scripts serão adicionados ao wp_footer() por padrão
 * 
 */
function add_frontend_scripts(){
	$js = new BorosJs();
	$js->jquery('jquery.validate.min', 'libs');
	$js->jquery('bootstrap.min', 'libs');
	$js->jquery('owl.carousel.min', 'libs');
	$js->jquery('salvattore.min', 'libs');
	$js->jquery('functions');
	
	/**
	$js->jquery('myjqueryfuncs');                      //jquery novo
	$js->jquery('jquery-ui-core');                     //jquery já registrado
	$js->add('effects');                               //simples
	$js->add('lightbox', 'lightbox');                  //simples subpasta
	$js->add('thickbox')->child('extendthick');        //encadeado, simples
	$js->add('thickbox')->child('extendthick', 'ext'); //encadeado, subpasta
	global $wp_scripts;pre($wp_scripts); //debug
	/**/
	
	// enqueues comuns/absolutos
	/**
	wp_enqueue_script(
		$handle = 'twitter_api', 
		$src = 'http://platform.twitter.com/widgets.js', 
		$deps = false, 
		$ver = null, 
		$in_footer = true
	);
	wp_enqueue_script(
		$handle = 'facebook_api', 
		$src = 'http://connect.facebook.net/pt_BR/all.js#xfbml=1', 
		$deps = false, 
		$ver = null, 
		$in_footer = true
	);
	/**/
}



