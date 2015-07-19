<?php
/**
 * MINI TEMPLATES
 * A diferença desse arquivo para o functions/frontend.php é que estas funções estão focadas no output de blocos frequentes, enquanto o 
 * frontend.php lida com configurações e filtros, como pre_get_posts, redirects e templates.
 * Normalmente este arquivo será muito customizado para cada tema, enquanto o frontend.php poderá exigir poucas ou nenhuma mudança.
 * 
 */

/**
 * ==================================================
 * PAGINAÇÃO ========================================
 * ==================================================
 * 
 * 
 */
function miar_pagination( $query = false, $paged = false ){
	if( $query == false ){
		global $wp_query;
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$pagination_args = array(
			'query_type' => 'normal',
			'current' => $paged,
			'total' => $wp_query->found_posts,
			'posts_per_page' => $wp_query->query_vars['posts_per_page'],
			'options' => array(
				'num_pages' => 7,
				'link_class' => '',
				'prev_text' => '‹ Anterior',
				'next_text' => 'Próximo ›',
			),
		);
		boros_pagination( $pagination_args );
	}
	else{
		$pagination_args = array(
			'query_type' => 'wpdb',
			'current' => $paged,
			'total' => $query->found_posts,
			'posts_per_page' => $query->query_vars['posts_per_page'],
			'options' => array(
				'ul_class' => 'pagination-photos',
				'num_pages' => 7,
				'link_class' => '',
				'prev_text' => '‹ Anterior',
				'next_text' => 'Próximo ›',
			),
		);
		boros_pagination( $pagination_args );
	}
}

/**
 * ==================================================
 * CUSTOM SEARCH FORM ===============================
 * ==================================================
 * 
 */
add_filter( 'get_search_form', 'custom_search_form' );
function custom_search_form( $form ) {
	$query = esc_attr(apply_filters('the_search_query', get_search_query()));
	$value = ( $query == '' ) ? '' : $query;
	$search_url = home_url('/');
	if( is_page('fotos') ){
		$search_url = get_permalink( get_page_ID_by_name('fotos') );
	}
	
	$form = '
	<form method="get" id="searchform" action="' . $search_url . '" >
		<div class="input-group">
			<input type="text" value="' . $value. '" id="search_term" class="form-control" name="s" placeholder="Pesquisar" />
			<span class="input-group-btn"><button class="btn btn-danger" type="submit"><i class="icon-search"></i></button></span>
		</div>
	</form>';
	return $form;
}

/**
 * ==================================================
 * DATAS DAS FOTOS ==================================
 * ==================================================
 * Widget com links das listagens das fotos, agrupados por data
 * 
 */
function miar_foto_datas(){
	$out = array();
	$cats = get_terms( 'data_foto', array('hide_empty' => true) );
	$month_names = array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
	$years = array();
	$months = array();
	
	foreach( $cats as $cat ){
		if( $cat->parent == 0 ){
			$years[$cat->term_id]['term'] = $cat;
			$years[$cat->term_id]['name'] = $cat->name;
			$out[$cat->name]['term'] = $cat;
		}
	}
	
	foreach( $cats as $cat ){
		if( $cat->parent != 0 ){
			$parent = $years[$cat->parent]['term'];
			$months[$parent->name][$cat->name] = $cat;
		}
	}
	
	foreach( $years as $year ){
		$mtmp = array();
		foreach( $month_names as $m ){
			//pal($m);
			//pre($year);
			if( isset($months[$year['name']][$m]) ){
				//pre($months[$year['name']][$m], $m);
				$out[$year['name']]['child'][] = $months[$year['name']][$m];
			}
		}
	}
	//pre($out);
	foreach( $out as $year ){
		//$link = get_term_link($year['term'], 'data_foto');
		echo "<dt>{$year['term']->name}</dt>";
		foreach( $year['child'] as $month ){
			$mlink = get_term_link($month, 'data_foto');
			echo "<dd><a href='{$mlink}'>{$month->name}</a></dd>";
		}
	}
}

/**
 * ==================================================
 * CALENDÁRIO =======================================
 * ==================================================
 * Filtros de output dos calendários
 * 
 */
add_filter( 'boros_calendar_event_day_output', 'miar_calendar_day_output', 10, 5 );
function miar_calendar_day_output( $output, $post, $day, $link, $title ){
	//pre($post->metas);
	//pre($day['day_num']);
	$performance_location = isset($post->metas['performance_location']) ? sprintf('<li class="performance-ico performance-location">%s</li>'                                       , $post->metas['performance_location'][0])                           : '';
	$performance_time     = isset($post->metas['performance_location']) ? sprintf('<li class="performance-ico performance-time">%s</li>'                                           , $post->metas['performance_time'][0])                               : '';
	$performance_city     = isset($post->metas['performance_city'])     ? sprintf('<li class="performance-ico performance-city-state">%s</li>'                                     , $post->metas['performance_city'][0])                               : '';
	$performance_map      = isset($post->metas['performance_map'])      ? sprintf('<a href="%s" class="performance-ico performance-map-link" target="_blank">Ver no mapa</a>'      , $post->metas['performance_map'][0])                                : '';
	$performance_address  = isset($post->metas['performance_address'])  ? sprintf('<li class="performance-ico performance-address">%s %s</li>'                                     , $post->metas['performance_address'][0], $performance_map)          : '';
	$performance_cost     = isset($post->metas['performance_cost'])     ? sprintf('<li class="performance-ico performance-cost">%s</li>'                                           , apply_filters('the_content', $post->metas['performance_cost'][0])) : '';
	$day_num              = $day['day_num'];
	
	return sprintf(
		'<div class="performance-item">
			<div class="event-btn-ovelay"></div>
			<ul class="hidden-xs">
				%1$s 
				%2$s 
				%3$s
			</ul>
			<div class="visible-xs performance-info-xs">
				<div class="event-day-number">%7$s</div>
				<h3>%4$s</h3>
				<ul>
					%1$s 
					%2$s 
					%5$s 
					%6$s
				</ul>
			</div>
			<div class="event-pop-up">
				<span class="glyphicon glyphicon-remove"></span>
				<h3>%4$s</h3>
				<ul>
					%1$s 
					%2$s 
					%5$s 
					%6$s
				</ul>
			</div>
		</div>',
		$performance_location,
		$performance_time,
		$performance_city,
		$post->post_title,
		$performance_address,
		$performance_cost,
		$day_num
	);
}

add_filter( 'boros_calendar_prev_next_month_link', 'miar_calendar_prev_next_month_link', 10, 6 );
function miar_calendar_prev_next_month_link( $html, $direction, $date_obj, $link, $class, $title ){
	$icon = $direction == 'prev' ? '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>' : '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>';
	return sprintf('<a href="%s" class="%s btn btn-default">%s</a>', $link, $class, $icon);
}

add_filter( 'boros_calendar_month_dropdown', 'miar_calendar_month_dropdown', 10, 3 );
function miar_calendar_month_dropdown( $dropdown, $class, $dropdown_opts ){
	if( empty($dropdown) ){
		return $dropdown;
	}
	
	$opts = '';
	foreach( $dropdown_opts as $option ){
		$opts .= "<option value='{$option['link']}'{$option['selected']}>{$option['month_name']} {$option['year']}</option>";
	}
	return sprintf( '<select class="%s"><option>-</option>%s</select>', $class, $opts );
}

add_filter( 'boros_calendar_head', 'miar_calendar_head', 10, 4 );
function miar_calendar_head( $html, $prev, $next, $dropdown ){
	if( empty($dropdown) ){
		return $html;
	}
	
	return sprintf('
		<div class="calendar-nav calendar-nav-head row">
			<div class="col-md-9 col-sm-12">
				<h2>Saiba onde estaremos e venha nos assistir!</h2>
				<p>Programe-se! Nossas apresentações duram em torno de 1 hora e reservamos cerca de 30 minutos após o espetáculos para que o público tire fotos com os atores.</p>
			</div>
			<div class="col-md-3 col-sm-12">
				<form action="" class="form-inline clearfix">
					<div class="form-group">
						%s
						%s
						<label>%s</label>
					</div>
				</form>
			</div>
		</div>',
		$prev, 
		$next,
		$dropdown
	);
}

add_filter( 'boros_calendar_footer', 'miar_calendar_footer', 10, 4 );
function miar_calendar_footer( $html, $prev, $next, $dropdown ){
	if( empty($dropdown) ){
		return $html;
	}
	
	return sprintf('
		<div class="calendar-nav calendar-nav-footer row">
			<div class="col-md-9 col-sm-12"></div>
			<div class="col-md-3 col-sm-12">
				<form action="" class="form-inline clearfix">
					<div class="form-group">
						%s
						%s
						<label>%s</label>
					</div>
				</form>
			</div>
		</div>',
		$prev, 
		$next,
		$dropdown
	);
}



