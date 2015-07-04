<?php get_template_part('head'); ?>
<body <?php body_class(); ?>>
<?php do_action( 'header_debug' ); ?>

<header class="navbar navbar-inverse navbar-fixed-top wet-asphalt" role="banner" id="box-menu-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="<?php echo home_url( '/' ); ?>" id="logo-header" class="navbar-brand" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<span><?php bloginfo( 'name' ); ?></span>
			</a>
		</div>
		
		<div class="hidden-xs">
			<?php
			if ( has_nav_menu( 'menu_header' ) ) {
				wp_nav_menu(array(
					'theme_location'  => 'menu_header',
					'container'       => false,
					'menu_class'      => 'nav navbar-nav navbar-main',
					'fallback_cb'     => 'wp_page_menu',
					'walker'          => new wp_bootstrap_navwalker()
				)); 
			}
			?>
		</div>

		<div id="mobile-menu" class="visible-xs">
			<div class="collapse navbar-collapse">
			<?php
			if ( has_nav_menu( 'menu_header' ) ) {
				wp_nav_menu(array(
					'theme_location'  => 'menu_header',
					'container'       => false,
					'menu_class'      => 'nav navbar-nav',
					'fallback_cb'     => 'wp_page_menu',
					'walker'          => new wp_bootstrap_mobile_navwalker()
				)); 
			}
			?>
			</div>
		</div><!--/.visible-xs-->
	</div>
</header><!--/header-->