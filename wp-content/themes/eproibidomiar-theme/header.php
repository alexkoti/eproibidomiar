<!doctype html>
<!--[if lt IE 7 ]> <html lang="pt" class="no-js ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html lang="pt" class="no-js ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html lang="pt" class="no-js ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html lang="pt" class="no-js ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="geo.country" content="br" />
<meta name="description" content="<?php bloginfo('description'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="home" href="<?php site_url('/'); ?>" />
<title><?php
global $page, $paged;
$title = wp_title( '|', true, 'right' );

// Add the blog name.
bloginfo( 'name' );

// Add the blog description for the home/front page.
$site_description = get_bloginfo( 'description', 'display' );
if ( $site_description && ( is_home() || is_front_page() ) )
	echo " | $site_description";

// Add a page number if necessary:
if ( $paged >= 2 || $page >= 2 )
	echo ' | ' . sprintf( 'Página %s', max( $paged, $page ) );
?></title>
<?php
if ( is_singular() && get_option( 'thread_comments' ) ){ wp_enqueue_script( 'comment-reply' ); }
wp_head();
?>
</head>
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