
<div id="sidebar-blog" class="sidebar">
	
	<div class="widget search">
		<?php get_search_form(); ?>
	</div>
	
	<div class="widget categories">
		<ul>
			<?php wp_list_categories( array('title_li' => '') ); ?>
		<ul>
	</div>
	
	<div class="widget recent-posts">
		<?php
		$recent = new WP_Query( array('post_type' => 'post') );
		if( $recent->posts ){
			echo '<ul>';
			foreach( $recent->posts as $p ){
				$link = get_permalink($p->ID);
				echo "<li><a href='{$link}'>{$p->post_title}</a></li>";
			}
			echo '</ul>';
		}
		?>
	</div>
	
	<div class="widget tags">
		<?php wp_tag_cloud( array('smallest' => 12, 'largest' => 12) ); ?>
	</div>
	
</div>
