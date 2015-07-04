<?php
/**
 * ==================================================
 * CONTATO ==========================================
 * ==================================================
 * 
 * 
 * 
 */

add_action( 'init', 'miar_form_contato' );
function miar_form_contato(){
	
	$message = "Um novo contato foi realizado através do site 'É proibido miar':<br />";
	$message .= "<strong>Nome:</strong> %%NOME%%<br />";
	$message .= "<strong>Email:</strong> %%EMAIL%% <br />";
	$message .= "<strong>Telefone:</strong> %%TELEFONE%% <br />";
	$message .= "<strong>Mensagem</strong> : %%MENSAGEM%%<br />";
	
	$frontend_forms_test_mode = get_option('frontend_forms_test_mode');
	
	/**
	 * Definir valores padrão ou valores de teste
	 * 
	 */
	if( $frontend_forms_test_mode == true ){
		$fake_person = new ProfileGen();
		$fake_person->set_localhost_config( $full_email = false, $email_prefix = 'dev.alexkoti+', $service = 'gmail.com' );
		$profile_data = $fake_person->profile();
		
		$nome     = $profile_data['name'];
		$email    = $profile_data['email'];
		$telefone = '(11) 98708 1770';
		$mensagem = $profile_data['mensagem'];
	}
	else{
		$nome     = '';
		$email    = '';
		$telefone = '';
		$mensagem = '';
	}
	
	$first_block = array(
		array(
			'std' => $nome,
			'name' => 'nome',
			'type' => 'text',
			'label' => 'Nome *',
			'attr' => array(
				'elem_class' => 'col-md-12',
				'class' => 'form-control',
			),
			'validate' => array(
				'required' => array(
					'rule' => 'required',
					'message' => 'É preciso preencher seu nome.',
				),
			),
		),
		array(
			'std' => $email,
			'name' => 'email',
			'type' => 'text',
			'label' => 'Email *',
			'attr' => array(
				'elem_class' => 'col-md-12',
				'class' => 'form-control',
			),
			'validate' => array(
				'required' => array(
					'rule' => 'required',
					'message' => 'É preciso preencher seu e-mail.',
				),
				'email' => array(
					'rule' => 'email',
					'message' => 'É preciso preencher um e-mail válido.',
				),
			),
		),
		array(
			'std' => $telefone,
			'name' => 'telefone',
			'type' => 'text',
			'label' => 'Telefone (opcional)',
			'attr' => array(
				'elem_class' => 'col-md-12',
				'class' => 'form-control',
				'placeholder' => '(DDD) Telefone',
			),
		),
		array(
			'std' => $mensagem,
			'name' => 'mensagem',
			'type' => 'textarea',
			'label' => 'Mensagem',
			'options' => array(
				'reset_after_success' => true,
			),
			'attr' => array(
				'elem_class' => 'col-md-12',
				'class' => 'form-control',
				'placeholder' => 'Digite a mensagem aqui',
			),
			'validate' => array(
				'required' => array(
					'rule' => 'required',
					'message' => 'É preciso escrever sua mensagem.',
				),
				'strip_tags' => array(
					'rule' => 'strip_tags',
				),
			),
		),
	);
	
	$first_block[] = array(
		'name' => 'submit',
		'type' => 'submit',
		'std' => 'Enviar',
		'attr' => array(
			'elem_class' => 'col-md-6',
			'class' => 'form-control',
			'class' => 'btn btn-default',
		),
	);
	
	
	$elements = array(
		array(
			'id' => 'contato_first_block',
			'itens' => $first_block,
		),
	);
	
	$config = array(
		'form_name' => 'miar_form_contato',
		'core_post_fields' => array(
			'post_type' => 'contato',
			'post_author' => 1,
			'post_title' => 'Contato: %%NOME%%',
			'post_status' => 'publish',
		),
		'accepted_metas' => array(
			'nome' => '',
			'email' => '',
			'telefone' => '',
			'mensagem' => '',
		),
		'form_id' => 'formulario-fale-conosco',
		'action_append' => false,
		'output_function' => 'bootstrap3',
		'class' => '',
		'login_required' => false,
		'redirect_on_sucess' => false,
		'messages' => array(
			'success' => 'Mensagem enviada com sucesso!',
			'error' => 'Ocorreram algun(s) erro(s), por favor verifique.',
		),
		'callbacks' => array(
			'success' => array(
				array(
					'function' => 'notify_by_email',
					'args' => array(
						'title' => 'Contato: %%NOME%%',
						'message' => $message,
						'to' => get_option('admin_email')
					),
				),
			),
		),
	);
	
	$context = array(
		'type' => 'frontend',
		'object_type' => 'post',
		'object_id' => 0, // 0 new post
	);
	
	$my_frontend_form = new BorosFrontendForm( $config, $context, $elements );
}










