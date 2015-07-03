<?php
/**
 * ==================================================
 * META BOXES CONFIGURAÇÂO ==========================
 * ==================================================
 * 
 */
add_action( 'admin_init', 'my_meta_boxes' );
function my_meta_boxes(){
	
	$meta_boxes = array();
	$meta_boxes[] = array(
		'id' => 'clipping_box', 
		'title' => 'Clipping', 
		'desc' => 'Informações de Clipping',
		'post_type' => array('post'), 
		'context' => 'normal', 
		'priority' => 'default',
		'itens' => array(
			array(
				'name' => 'clipping_data',
				'type' => 'text',
				'size' => 'medium',
				'label' => 'Data',
			),
			array(
				'name' => 'clipping_author',
				'type' => 'text',
				'size' => 'medium',
				'label' => 'Autor',
			),
			array(
				'name' => 'clipping_media',
				'type' => 'text',
				'size' => 'medium',
				'label' => 'Veículo',
			),
		)
	);
	
	$meta_boxes[] = array(
		'id' => 'testimonial_box', 
		'title' => 'Depoimento', 
		//'desc' => '',
		'post_type' => array('post'), 
		'context' => 'normal', 
		'priority' => 'default',
		'itens' => array(
			array(
				'name' => 'testimonial_author',
				'type' => 'text',
				'size' => 'full',
				'label' => 'Autor',
			),
		)
	);
	
	$meta_boxes[] = array(
		'id' => 'image_download_box', 
		'title' => 'Imagem para download', 
		//'desc' => '',
		'post_type' => array('foto'), 
		'context' => 'normal', 
		'priority' => 'default',
		'itens' => array(
			array(
				'name' => 'image_download',
				'type' => 'special_image',
				'label' => 'Imagem',
				'options' => array(
					'image_size' => 'thumbnail',
					'layout' => 'row',
					'width' => 100,
				),
			),
		)
	);
	
	$contratar = get_page_ID_by_name('contratar-apresentacoes');
	if( (isset($_GET['post']) and $_GET['post'] == $contratar) or (isset($_POST['post_ID']) and $_POST['post_ID'] == $contratar) ){
		$meta_boxes[] = array(
			'id' => 'contratar_box', 
			'title' => 'Arquivo de Necessidades técnicas', 
			//'desc' => '',
			'post_type' => array('page'), 
			'context' => 'normal', 
			'priority' => 'default',
			'itens' => array(
				array(
					'name' => 'technical_needs',
					'type' => 'attach_select',
					'size' => 'medium',
					'label' => 'Arquivo',
				),
			)
		);
	}
	
	$my_meta_boxes = new BorosMetaBoxes( $meta_boxes );
}



/* ========================================================================== */
/* REMOVER META BOXES ======================================================= */
/* ========================================================================== */
/**
 * Remover meta_boxes das telas de edição. As custom taxonomies são removidas nessa função em vez da declaração 'show_ui' => false',
 * pois assim é exibida as páginas de controle das taxonomias no menu principal, mas removendo os controles de histórias 
 * das páginas de edição.
 * 
 * Padrão de nomenclatura:
 * Hierachical Taxonomy:		"{$tax-name}div"
 * Non-Hierachical Taxonomy:	"tagsdiv-{$tax-name}"
 */
//add_action('do_meta_boxes', 'remove_custom_meta_boxes', 10, 3);
function remove_custom_meta_boxes( $post_type, $context, $post ){
	global $wp_meta_boxes, $post;
	//pre($wp_meta_boxes);
	
	$removes = array(
		'post' => array(
			'postimagediv',
			'categorydiv',
		),
	);
	
	if( isset($removes[$post_type]) ){
		foreach( $removes[$post_type] as $box ){
			remove_meta_box( $box, $post_type, $context );
		}
	}
}


