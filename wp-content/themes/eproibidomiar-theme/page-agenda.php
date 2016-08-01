<?php get_header(); ?>

<div class="page-head">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1><?php echo apply_filters( 'the_title', $post->post_title ); ?></h1>
			</div>
		</div>
	</div>
</div>

<?php
$agenda_head_title = get_option('agenda_head_title');
$agenda_head_text = get_option('agenda_head_text');
if( !empty($agenda_head_text) ){
?>
<div class="agenda-head">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="text">
					<?php opt_option('agenda_head_title', '<h2>%s</h2>'); ?>
					<?php opt_option('agenda_head_text', '%s', true, 'the_content'); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>

<div class="agenda-box">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php
				if ( have_posts() ){
					while ( have_posts() ){
						the_post();
						get_template_part( 'content', 'page' );
						
						$config = array(
							'post_type'             => 'agenda',
							'post_meta'             => 'performance_date',
							//'day'         => 1,
							//'month'       => 11,
							//'year'        => 2011,
							//'accepted_metas' => array('performance_date'),
							//'taxonomies' => array('category', 'post_tag'),
							//'taxonomies' => 'category',
						);
						$calendar = boros_calendar($config);
						//pre($calendar);
						//$calendar->get_posts_table_by_post_meta();
						//$calendar->get_posts_table_by_date();
						$calendar->get_posts();
						$calendar->show_calendar_head();
						echo '<div id="calendar-table-box">';
                            echo "<h2 class='calendar-month-name'>{$calendar->__get('month_name')}</h2>";
							$calendar->show_calendar_table();
						echo '</div>';
						$calendar->show_calendar_footer();
					}
				}
				?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>