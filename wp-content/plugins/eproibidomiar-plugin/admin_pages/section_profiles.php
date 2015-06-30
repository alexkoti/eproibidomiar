<?php
function section_profiles(){
	$args = array();
	$args[] = array(
		'title' => 'Ficha Técnica',
		'desc' => '',
		'block' => 'header',
	);
	
	$blocks = array(
		array(
			'name' => 'creators',
			'title' => 'Criadores',
		),
		array(
			'name' => 'cast',
			'title' => 'Elenco',
		),
		array(
			'name' => 'accessibility',
			'title' => 'Acessibilidade',
		),
		array(
			'name' => 'technicians',
			'title' => 'Técnicos',
		),
		array(
			'name' => 'author',
			'title' => 'Autor',
		),
	);
	
	foreach( $blocks as $block ){
		$args[] = array(
			'id' => "profiles-{$block['name']}",
			'title' => $block['title'],
			//'desc' => '',
			'block' => 'section',
			'itens' => array(
				array(
					'name' => "profiles-{$block['name']}-title",
					'type' => 'text',
					'label' => "Título",
					'size' => 'full',
				),
				array(
					'name' => "profiles-{$block['name']}-subtitle",
					'type' => 'text',
					'label' => "subtítulo",
					'size' => 'full',
				),
				array(
					'name' => "profiles-{$block['name']}-items",
					'type' => 'duplicate_group',
					'label' => 'Perfis',
					'group_itens' => array(
						array(
							'name' => 'name',
							'type' => 'text',
							'size' => 'full',
							'label' => 'Nome',
						),
						array(
							'name' => 'function',
							'type' => 'text',
							'size' => 'full',
							'label' => 'Função',
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
						array(
							'name' => 'text',
							'type' => 'textarea',
							'size' => 'full',
							'label' => 'Descrição',
							'attr' => array('class' => 'ipth_small'),
						),
					),
				),
			),
		);
	}
	
	return $args;
}






