
<footer id="footer">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<blockquote>
					<?php opt_option('footer_text', '%s', true, 'the_content'); ?>
					<?php opt_option('footer_author', '<em>%s</em>'); ?>
				</blockquote>
			</div>
			<div class="col-sm-6">
				<?php
				if ( has_nav_menu( 'menu_footer' ) ) {
					wp_nav_menu(array(
						'theme_location'  => 'menu_footer',
						'container'       => false,
						'menu_class'      => 'nav-footer pull-right',
						'fallback_cb'     => 'wp_page_menu',
						'walker'          => new wp_bootstrap_mobile_navwalker()
					)); 
				}
				?>
			</div>
		</div>
	</div>
</footer><!--/#footer-->
<?php wp_footer(); ?>
</body>
</html>