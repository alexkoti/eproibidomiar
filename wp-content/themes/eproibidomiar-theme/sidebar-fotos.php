
<div class="widget search">
	<?php get_search_form(); ?>
</div>
<div class="widget categories">
	<ul>
		<?php wp_list_categories( array('taxonomy' => 'categoria_foto', 'title_li' => false) ); ?>
		<li><a href="<?php page_permalink_by_name('fotos'); ?>">Todas</a></li>
	</ul>
</div>
<div class="widget tags">
	<?php wp_tag_cloud( array('taxonomy' => 'tag_foto', 'smallest' => 12, 'largest' => 12) ); ?>
</div>
<div class="widget dates">
	<h3>Arquivo</h3>
	<dl>
		<?php miar_foto_datas(); ?>
	</dl>
</div>