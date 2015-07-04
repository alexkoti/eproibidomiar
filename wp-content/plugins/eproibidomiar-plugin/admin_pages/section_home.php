<?php
function section_home(){
	$args = array();
	$args[] = array(
		'title' => 'Home',
		'desc' => 'Opções da página inicial',
		'block' => 'header',
	);
	
	/**
	 * Slider
	 * 
	 */
	$args['sliders'] = array(
		'id' => 'sliders_box',
		'title' => 'Sliders',
		'block' => 'section',
		'itens' => array(
			array(
				'name' => 'home_slider',
				'type' => 'duplicate_group',
				'label' => 'Slides',
				'group_itens' => array(
					array(
						'name' => 'title',
						'type' => 'text',
						'size' => 'full',
						'label' => 'Título',
					),
					array(
						'name' => 'subtitle',
						'type' => 'text',
						'size' => 'full',
						'label' => 'Subtítulo',
					),
					array(
						'name' => 'image_xs',
						'type' => 'special_image',
						'label' => 'Imagem Mobile (XS)',
						'options' => array(
							'image_size' => 'thumbnail',
							'layout' => 'row',
							'width' => 100,
						),
					),
					array(
						'name' => 'image_sm',
						'type' => 'special_image',
						'label' => 'Imagem Tablet (SM)',
						'options' => array(
							'image_size' => 'thumbnail',
							'layout' => 'row',
							'width' => 100,
						),
					),
					array(
						'name' => 'image_md',
						'type' => 'special_image',
						'label' => 'Imagem Desktop (MD)',
						'options' => array(
							'image_size' => 'thumbnail',
							'layout' => 'row',
							'width' => 100,
						),
					),
					array(
						'name' => 'image_lg',
						'type' => 'special_image',
						'label' => 'Imagem Destop Large (LG)',
						'options' => array(
							'image_size' => 'thumbnail',
							'layout' => 'row',
							'width' => 100,
						),
					),
				),
			),
		),
	);
	
	/**
	 * Chamadas
	 * 
	 */
	$chamadas = array();
	for( $i = 1; $i <= 3; $i++ ){
		$chamadas[] = array(
			'name' => "home_feature_{$i}_title",
			'type' => 'text',
			'label' => "Chamada {$i} <small>(título)</small>",
			'size' => 'medium',
		);
		$chamadas[] = array(
			'name' => "home_feature_{$i}_text",
			'type' => 'textarea',
			'label' => "Chamada {$i} <small>(texto)</small>",
			'size' => 'medium',
			'attr' => array(
				'class' => 'ipth_small',
			),
		);
		$chamadas[] = array(
			'name' => "home_feature_{$i}_link",
			'type' => 'select_query_posts',
			'label' => "Chamada {$i} <small>(link)</small>",
			'options' => array(
				'query' => array(
					'post_type' => 'page',
					'posts_per_page' => -1,
				),
			),
		);
		$chamadas[] = array(
			'name' => "home_feature_{$i}_sep",
			'type' => 'separator',
		);
	}
	$args[] = array(
		'id' => 'front-page-features',
		'title' => 'Chamadas',
		'desc' => 'As 3 chamadas abaixo do slider principal',
		'block' => 'section',
		'itens' => $chamadas,
	);
	
	/**
	 * Fotos
	 * 
	 */
	$args[] = array(
		'id' => 'front-page-photos',
		'title' => 'Fotos',
		//'desc' => '',
		'block' => 'section',
		'itens' => array(
			array(
				'name' => 'home_photos',
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
		),
	);
	
	
	/**
	 * Testimonials
	 * 
	 */
	$args[] = array(
		'id' => 'front-page-testimonials',
		'title' => 'Depoimentos',
		//'desc' => '',
		'block' => 'section',
		'itens' => array(
			array(
				'name' => 'home_testimonials',
				'type' => 'search_content_list',
				'label' => 'Fotos',
				'options' => array(
					'query_search' => array(
						'post_type' => 'post',
						'posts_per_page' => -1,
						'category_name' => 'depoimentos',
					),
					'query_selecteds' => array(
						'post_type' => 'post',
						'category_name' => 'depoimentos',
					),
				),
			),
		),
	);
	
	/**
	 * Sponsors
	 * 
	 */
	$args[] = array(
		'id' => 'front-page-sponsors',
		'title' => 'Patrocinadores',
		//'desc' => '',
		'block' => 'section',
		'itens' => array(
			array(
				'name' => 'home_financing',
				'type' => 'duplicate_group',
				'label' => 'Financiamento',
				//'label_helper' => 'No link, não esquecer o <code>http://</code> no começo do link.<br /><br />Caso não seja preechido o nome, será usado o link como texto.',
				//'layout' => 'block',
				'group_itens' => array(
					array(
						'name' => 'name',
						'type' => 'text',
						'size' => 'medium',
						'label' => 'Nome',
					),
					array(
						'name' => 'link',
						'type' => 'text',
						'size' => 'medium',
						'label' => 'Link',
					),
					array(
						'name' => 'image',
						'type' => 'special_image',
						'label' => 'Imagem',
						'options' => array(
							'image_size' => 'full',
							'layout' => 'row',
							'width' => 150,
						),
					),
				),
			),
			array(
				'name' => 'home_supporters_partners',
				'type' => 'duplicate_group',
				'label' => 'Apoiadores e parceiros',
				//'label_helper' => 'No link, não esquecer o <code>http://</code> no começo do link.<br /><br />Caso não seja preechido o nome, será usado o link como texto.',
				//'layout' => 'block',
				'group_itens' => array(
					array(
						'name' => 'name',
						'type' => 'text',
						'size' => 'medium',
						'label' => 'Nome',
					),
					array(
						'name' => 'link',
						'type' => 'text',
						'size' => 'medium',
						'label' => 'Link',
					),
					array(
						'name' => 'image',
						'type' => 'special_image',
						'label' => 'Imagem',
						'options' => array(
							'image_size' => 'full',
							'layout' => 'row',
							'width' => 150,
						),
					),
				),
			),
		),
	);
	
	return $args;
}






