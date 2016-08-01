<?php
function section_emails(){
	$args = array();
	$args[] = array(
		'title' => 'Configurações de Emails',
		'desc' => 'Configurações dos emails automáticos do sistema e formulário de contato',
		'block' => 'header',
	);
	$args[] = array(
		'id' => 'emails_general_box',
		'title' => 'Novo usuário',
		'desc' => 'Configurações gerais',
		'block' => 'section',
		'itens' => array(
			array(
				'name' => 'email_content_type',
				'type' => 'checkbox',
				'std' => '',
				'label' => '<code>content-type</code> dos emails',
				'label_helper' => 'Ativar para poder enviar emails formatados com HTML e imagens',
				'input_helper' => 'Habilitar <code>text/html</code>',
			),
			array(
				'name' => 'email_from',
				'type' => 'text',
				'size' => 'small',
				'std' => get_bloginfo('admin_email'),
				'label' => 'Email remetente dos emails enviados pelo site',
				'label_helper' => 'Caso não seja preenchido, será usado o email do administrador do site.<br /><br />Este email também receberá os avisos de novo usuário e formulários de contato.',
			),
			array(
				'name' => 'email_from_name',
				'type' => 'text',
				'size' => 'small',
				'std' => get_bloginfo('name'),
				'label' => 'Nome do remetente dos emails enviados pelo site',
				'label_helper' => 'Caso não seja preenchido, será usado o nome do site',
			),
		),
	);
	return $args;
}






