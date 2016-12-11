<?php
/**
 * AÇÔES EXTRAS ON SAVE
 * Gravar dados adicionais e actions extras
 * 
 * 
 * 
 */



/**
 * Adicionar os dias individuais para cada data de apresentação
 * Os dados serão feitos no callback meta_box de agenda 'performance_dates', no lugar do hook 'save_post'
 * 
 */
function miar_set_performance_dates( $post, $element_config, $value ){
	if( !empty($value) ){
		// gravar post_metas
		$performance_dates = explode(',', $value);
		sort($performance_dates);
		delete_post_meta($post->ID, 'performance_date');
		foreach( $performance_dates as $date ){
			add_post_meta( $post->ID, 'performance_date', $date );
		}
		
		// resetar o transient respectivos
		delete_transient("boros_cldr_agenda");
		$month = date('m', strtotime($post->post_date));
		delete_transient("boros_cldr_agenda_{$month}");
		delete_transient('boros_cldr_agenda_performance_date');
		delete_transient("boros_cldr_agenda_performance_date_{$month}");
		
		//miar_set_events_in_years( $post->ID, $performance_dates, true );
	}
	
	return $value;
}

/**
 * Ao apagar um post, remover os dias do array geral de anos
 * 
 */
add_action( 'trashed_post', 'miar_trashed_post', 11, 2 );
function miar_trashed_post( $post_id ){
	$p = get_post($post_id);
	
	// resetar o transient respectivos
	delete_transient("boros_cldr_agenda");
	$month = date('m', strtotime($p->post_date));
	delete_transient("boros_cldr_agenda_{$month}");
	delete_transient('boros_cldr_agenda_performance_date');
	delete_transient("boros_cldr_agenda_performance_date_{$month}");
}

/**
 * Ao restaurar um post da lixeira, voltar os dias no array geral de anos
 * 
 */
add_action( 'untrashed_post', 'miar_untrashed_post', 11, 2 );
function miar_untrashed_post( $post_id ){
	$p = get_post($post_id);
	
	// resetar o transient respectivos
	delete_transient("boros_cldr_agenda");
	$month = date('m', strtotime($p->post_date));
	delete_transient("boros_cldr_agenda_{$month}");
	delete_transient('boros_cldr_agenda_performance_date');
	delete_transient("boros_cldr_agenda_performance_date_{$month}");
}


