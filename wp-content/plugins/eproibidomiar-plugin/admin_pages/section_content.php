<?php
function section_content(){
	$args = array();
	$args[] = array(
		'title' => 'Opções gerais de conteúdo',
		'desc' => '',
		'block' => 'header',
	);
	$args[] = array(
		'id' => 'site_options_post_format',
		'title' => 'Formatação',
		'desc' => 'Opções padrão de elementos visuais',
		'block' => 'section',
		'itens' => array(
			array(
				'name' => 'post_default_image',
				'type' => 'special_image',
				'label' => 'Imagem padrão para os posts',
				'label_helper' => 'Será usado quando não existir a imagem de destaque do conteúdo',
			),
		),
	);
	
	$args[] = array(
		'id' => 'site_options_footer',
		'title' => 'Rodapé',
		'desc' => 'Texto de rodapé',
		'block' => 'section',
		'itens' => array(
			array(
				'name' => 'footer_author',
				'type' => 'text',
				'label' => 'Autor',
				'size' => 'medium',
			),
			array(
				'name' => 'footer_text',
				'type' => 'wp_editor',
				'label' => 'Texto',
			),
		),
	);
	return $args;
}






