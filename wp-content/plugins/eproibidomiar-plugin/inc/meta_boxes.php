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
	$assessoria = get_page_ID_by_name('assessoria-de-imprensa');
	if( (isset($_GET['post']) and ($_GET['post'] == $assessoria or $_GET['post'] == $contratar)) or (isset($_POST['post_ID']) and ($_POST['post_ID'] == $assessoria or $_POST['post_ID'] == $contratar)) ){
		$meta_boxes[] = array(
			'id' => 'files_box', 
			'title' => 'Arquivo para download', 
			//'desc' => '',
			'post_type' => array('page'), 
			'context' => 'normal', 
			'priority' => 'default',
			'itens' => array(
				array(
					'name' => 'file',
					'type' => 'attach_select',
					'size' => 'medium',
					'label' => 'Arquivo',
				),
				array(
					'name' => 'file_title',
					'type' => 'text',
					'size' => 'large',
					'label' => 'Título',
				),
				array(
					'name' => 'file_desc',
					'type' => 'textarea',
					'size' => 'large',
					'label' => 'Descrição',
				),
			)
		);
	}
	if( (isset($_GET['post']) and $_GET['post'] == $assessoria) or (isset($_POST['post_ID']) and $_POST['post_ID'] == $assessoria) ){
		$meta_boxes[] = array(
			'id' => 'assessoria_photos_box', 
			'title' => 'Fotos', 
			//'desc' => '',
			'post_type' => array('page'), 
			'context' => 'normal', 
			'priority' => 'default',
			'itens' => array(
				array(
					'name' => 'assessoria_photos_title',
					'type' => 'text',
					'size' => 'large',
					'label' => 'Título',
				),
				array(
					'name' => 'assessoria_photos_desc',
					'type' => 'wp_editor',
					'size' => 'large',
					'label' => 'Descrição',
				),
				array(
					'name' => 'assessoria_photos',
					'type' => 'search_content_list',
					'label' => 'Fotos',
					'options' => array(
						'query_search' => array(
							'post_type' => 'foto',
							'posts_per_page' => -1,
						),
						'query_selecteds' => array(
							'post_type' => 'foto',
						),
					),
				),
			)
		);
	}
	
	//if( isset($_GET['post']) or isset($_POST['post_ID']) ){
	//	$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'];
	//	$template_file = get_post_meta($post_id, '_wp_page_template', true);
	//	if ($template_file == 'template-contratar.php') {
	//		$meta_boxes[] = array(
	//			'id' => 'assessoria_box', 
	//			'title' => 'Arquivo para download', 
	//			//'desc' => '',
	//			'post_type' => array('page'), 
	//			'context' => 'normal', 
	//			'priority' => 'default',
	//			'itens' => array(
	//				array(
	//					'name' => 'file',
	//					'type' => 'attach_select',
	//					'size' => 'medium',
	//					'label' => 'Arquivo',
	//				),
	//				array(
	//					'name' => 'file_title',
	//					'type' => 'text',
	//					'size' => 'large',
	//					'label' => 'Título',
	//				),
	//				array(
	//					'name' => 'file_desc',
	//					'type' => 'textarea',
	//					'size' => 'large',
	//					'label' => 'Descrição',
	//				),
	//			)
	//		);
	//	}
	//}
	
	
	/**
	 * datepicker multiple
	 * 
	 */
	$meta_boxes[] = array(
		'id' => 'datepicker_multiple_box', 
		'title' => 'Informações', 
		'post_type' => array('agenda'), 
		'context' => 'normal', 
		'priority' => 'default',
		'itens' => array(
			//array(
			//	'name' => 'post_content',
			//	'type' => 'wp_editor',
			//	'label' => 'Content (core)',
			//	'options' => array(
			//		'media_buttons' => true,
			//	),
			//),
			//array(
			//	'name' => 'color',
			//	'type' => 'color_picker',
			//	'label' => 'Cor simples',
			//),
			//array(
			//	'name' => 'teste_simples',
			//	'type' => 'text',
			//	'label' => 'Texto simples',
			//),
			//array(
			//	'name' => 'teste_simples_split',
			//	'type' => 'text',
			//	'label' => 'Texto split',
			//	'options' => array(
			//		'split' => array(
			//			'um' => array(),
			//			'dois' => array(),
			//		),
			//	),
			//),
			//array(
			//	'name' => 'test3',
			//	'type' => 'select',
			//	'label' => 'Select simples',
			//	'options' => array(
			//		'values' => array(
			//			'lorema' => 'ipsuma',
			//			'loremb' => 'ipsumb',
			//			'loremc' => 'ipsumc',
			//		),
			//	),
			//),
			array(
				'name' => 'performance_dates',
				'type' => 'date_picker_multiple',
				'layout' => 'block',
				'label' => 'Datas das apresentações',
				'options' => array(
					'num_months' => 4,
				),
				'callbacks' => array('miar_set_performance_dates'),
			),
			/**
			 * 
			 - callback ao salvar
			 - ordenar datas
			 - pegar a primeira e última e salvar como start e end
			 - E/OU salvar múltiplos post_meta de apresentações
			 * 
			 */
			array(
				'name' => 'performance_location',
				'type' => 'text',
				'label' => 'Nome do local',
				'size' => 'large',
			),
			array(
				'name' => 'performance_address',
				'type' => 'text',
				'label' => 'Endereço',
				'input_helper' => 'Adicione também a cidade e estado',
				'size' => 'full',
			),
			array(
				'name' => 'performance_city',
				'type' => 'text',
				'label' => 'Cidade, Estado',
				'size' => 'large',
			),
			array(
				'name' => 'performance_map',
				'type' => 'text',
				'label' => 'Endereço do google maps',
				'size' => 'full',
			),
			array(
				'name' => 'performance_time',
				'type' => 'text',
				'label' => 'Horário',
			),
			array(
				'name' => 'performance_cost',
				'type' => 'textarea',
				'label' => 'Preço',
				'attr' => array('class' => 'ipth_small'),
			),
			//array(
			//	'name' => 'show_dates',
			//	'type' => 'date_picker',
			//	'layout' => 'block',
			//	'duplicable' => true,
			//	'options' => array(
			//		'picker_type' => 'datetime',
			//		'split_time' => true,
			//	),
			//),
			//array(
			//	'name' => 'text_multiple',
			//	'type' => 'text',
			//	'label' => 'Texto duplicável simples',
			//	'duplicable' => true,
			//),
			//array(
			//	'name' => 'text_split',
			//	'type' => 'text',
			//	'label' => 'Texto duplicável split',
			//	'duplicable' => true,
			//	'options' => array(
			//		'split' => array(
			//			'um' => array(),
			//			'dois' => array(),
			//		),
			//	),
			//),
			//array(
			//	'name' => 'aaaaa',
			//	'type' => 'select',
			//	'label' => 'Select duplicável simples',
			//	'duplicable' => true,
			//	'options' => array(
			//		'values' => array(
			//			'lorema' => 'LOREM-A',
			//			'loremb' => 'LOREM-B',
			//			'loremc' => 'LOREM-C',
			//		),
			//	),
			//),
		)
	);
	
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


