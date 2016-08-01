<?php
function section_general(){
	$args = array();
	$args[] = array(
		'title' => 'Variadas',
		'desc' => get_bloginfo('blogname') . ' - Opções gerais',
		'block' => 'header',
	);
	$args[] = array(
		'id' => 'site_options_analytics',
		'title' => 'Google Analytics',
		'block' => 'section',
		'itens' => array(
			array(
				'name' => 'google_analytics',
				'type' => 'textarea',
				'size' => 'medium',
				'label' => 'Código do Google Analytics',
				'input_helper' => '<br />Colar tudo, incluindo o <code>&lt;script type=&quot;text/javascript&quot;&gt;&lt;/script&gt;</code>',
			),
		),
	);
	return $args;
}






