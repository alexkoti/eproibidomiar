<?php
function section_networks(){
	$args = array();
	
	$args[] = array(
		'id' => 'network_opengraph',
		'title' => 'Opengraph e Share Options',
		'desc' => 'Meta informações de compartilhamento[facebook e redes sociais]',
		'block' => 'section',
		'section' => 'redes_sociais',
		'itens' => array(
			array(
				'name' => 'og_active',
				'type' => 'checkbox',
				'std' => '',
				'label' => 'Opengraph Tags Ativado',
				'label_helper' => 'São as tags de indexação do Facebook',
				'input_helper' => 'Ativar',
			),
			array(
				'name' => 'gplus_active',
				'type' => 'checkbox',
				'std' => '',
				'label' => 'Gplus Tags Ativado',
				'label_helper' => 'São as tags de indexação do G+',
				'input_helper' => 'Ativar',
			),
		),
	);
	
	return $args;
}

