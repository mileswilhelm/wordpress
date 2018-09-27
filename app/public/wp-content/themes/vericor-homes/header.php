<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Vericor_Homes
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="p:domain_verify" content="5559e70a3717ed696f4753cacbddd14d"/>
	<meta name="theme-color" content="#004b87"/>
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="icon" type="image/png" href="/favicon.png" />
	<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
	<link rel="preconnect" href="https://fonts.googleapis.com/" crossorigin>
	<link rel="preconnect" href="https://maps.gstatic.com/" crossorigin>
	<link rel="preconnect" href="https://use.typekit.net/" crossorigin>
	<link rel="preconnect" href="https://connect.facebook.net/" crossorigin>

	<?php wp_head(); ?>
	<link rel="stylesheet" href="https://use.typekit.net/uex0bxs.css">
	<link href="https://fonts.googleapis.com/css?family=Raleway:400,400i,700" rel="stylesheet">

</head>

<?php if( !is_page_template( 'template-display.php' ) ) { ?>
	<body <?php body_class(); ?>>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text hidden" href="#content"><?php esc_html_e( 'Skip to content', 'vericor-homes' ); ?></a>
		<div class="menu-overlay menu-toggle z-30 fixed pin-t pin-l h-full w-full lg:hidden"></div>

		<header id="masthead" class="site-header bg-yellow color-blue fixed w-full shadow z-40">
			<div class="mx-auto px-3 lg:px-10">
				<?php
				if ( is_front_page() && is_home() ) :
					?>
					<h1 class="site-title visuallyhidden"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				else :
					?>
					<p class="site-title visuallyhidden"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
				endif; ?>
				<nav id="site-navigation" class="main-navigation flex items-center flex-wrap py-6">
					<div class="flex items-center flex-no-shrink lg:mr-auto">
						<a href="/">
							<img src="<?php echo get_template_directory_uri();?>/assets/vericor-horizontal-blue-gray.png" class="max-w-full main-logo">
						</a>
					</div>
					<?php
					wp_nav_menu( array(
						'container'      => false,
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
						'menu_class'     => 'list-reset hidden font-sans text-center xl:text-lg font-bold fixed lg:static pin lg:items-center lg:pin-none bg-blue lg:bg-transparent text-white lg:text-blue flex lg:flex-1 flex-col lg:flex-row h-screen lg:h-auto lg:justify-end',
					) );
					?>
					<button class="border border-blue flex hover:border-white hover:text-white items-center lg:hidden menu-toggle ml-auto mr-2 px-3 py-2 rounded text-blue mobile-menu-button" aria-controls="primary-menu" aria-expanded="false">
						<svg class="h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
							<title>Menu</title>
							<path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
						</svg>
					</button>
					<div class="border-t-2 fixed flex justify-center lg:hidden pin-b pin-r py-4 text-white w-4/5 z-50 text-3xl" id="mobile-socmed">
						<a href="#" class="hover:text-yellow"><i class="icon icon-facebook"></i></a>
					</div> <!-- mobile social media menu icons -->
				</nav><!-- #site-navigation -->
			</div>

			
		</header><!-- #masthead -->

		
		<div id="content" class="site-content">
<?php } else { ?>
	<body <?php body_class(); ?>>
	<div id="content">
<?php } ?>