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
 * Callback do meta_box de agenda 'performance_dates'
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
		
		// resetar o transient respectivo
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
 * Adicionar ou remover apresentações na opção de anos
 * 
 */
function miar_set_events_in_years( $post_id, $dates, $add = true ){
	$performances_in_years = get_option('performances_in_years');
	if( empty($performances_in_years) ){
		$performances_in_years = array();
	}
	
	foreach( $dates as $date ){
		$dt = explode('-', $date);
		$y = $dt[0];
		$m = $dt[1];
		$d = $dt[2];
		
		// adicionar post ao dia
		if( $add == true ){
			if( isset($performances_in_years[$y][$m][$d]) ){
				if( !in_array( $post_id, $performances_in_years[$y][$m][$d] ) ){
					$performances_in_years[$y][$m][$d][] = $post_id;
				}
			}
			else{
				$performances_in_years[$y][$m][$d][] = $post_id;
			}
		}
		// remover post do dia
		else{
			$performances_in_years[$y][$m][$d] = array_diff($performances_in_years[$y][$m][$d], array($post_id));
		}
	}
	
	$performances_in_years = boros_trim_array($performances_in_years);
	ksortRecursive($performances_in_years);
	update_option('performances_in_years', $performances_in_years);
}

/**
 * Ao apagar um post, remover os dias do array geral de anos
 * 
 */
add_action( 'trashed_post', 'miar_trashed_post', 11, 2 );
function miar_trashed_post( $post_id, $post = null ){
	$performance_date = get_post_meta($post_id, 'performance_date');
	if( !empty($performance_date) ){
		miar_set_events_in_years($post_id, $performance_date, false);
	}
}

/**
 * Ao restaurar um post da lixeira, voltar os dias no array geral de anos
 * 
 */
add_action( 'untrashed_post', 'miar_untrashed_post', 11, 2 );
function miar_untrashed_post( $post_id, $post = null ){
	$performance_date = get_post_meta($post_id, 'performance_date');
	if( !empty($performance_date) ){
		miar_set_events_in_years($post_id, $performance_date, true);
	}
}


