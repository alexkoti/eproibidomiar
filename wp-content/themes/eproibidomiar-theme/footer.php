
<footer id="footer">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<blockquote>"Há diferenças e há igualdades - nem tudo deve ser igual, assim como nem tudo deve ser diferente. (...) é preciso que tenhamos o direito de ser diferentes quando a igualdade nos descaracteriza e o direito de ser iguais quando a diferença nos inferioriza." <br />
				<em>Boaventura de Sousa Santos, sociólogo português.</em></blockquote>
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
				<!-- a id="gototop" class="gototop" href="#"><i class="icon-chevron-up"></i></a><!--#gototop-->
			</div>
		</div>
	</div>
</footer><!--/#footer-->
<?php wp_footer(); ?>
</body>
</html>