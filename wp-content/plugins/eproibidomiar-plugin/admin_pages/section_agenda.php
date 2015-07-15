<?php
function section_agenda(){
	$args = array();
	$args[] = array(
		'title' => 'Opções da Agenda',
		'desc' => '',
		'block' => 'header',
	);
	
	$args[] = array(
		'id' => 'agenda_head_box',
		'title' => 'Chamda',
		'desc' => 'Chamada do cabeçalho da agenda',
		'block' => 'section',
		'itens' => array(
			array(
				'name' => 'agenda_head_title',
				'type' => 'text',
				'label' => 'Título',
				'size' => 'full',
			),
			array(
				'name' => 'agenda_head_text',
				'type' => 'wp_editor',
				'label' => 'Texto',
			),
		),
	);
	return $args;
}






