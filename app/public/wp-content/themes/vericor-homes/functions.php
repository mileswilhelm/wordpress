<?php
/**
 * Vericor Homes functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Vericor_Homes
 */

if ( ! function_exists( 'vericor_homes_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function vericor_homes_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Vericor Homes, use a find and replace
		 * to change 'vericor-homes' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'vericor-homes', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'vericor-homes' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'vericor_homes_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'vericor_homes_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function vericor_homes_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'vericor_homes_content_width', 640 );
}
add_action( 'after_setup_theme', 'vericor_homes_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function vericor_homes_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'vericor-homes' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'vericor-homes' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'vericor_homes_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function vericor_homes_scripts() {
	wp_enqueue_style( 'vericor-homes-style', get_stylesheet_uri() );

	wp_enqueue_script( 'vericor-homes-navigation', get_template_directory_uri() . '/js/navigation.js', array(), null, true );
	wp_enqueue_script( 'vericor-homes-jquery', 'https://code.jquery.com/jquery-3.3.1.min.js', array(), null, true );
	wp_enqueue_script( 'vericor-homes-scripts', get_template_directory_uri() . '/js/custom.js', array(), null, true );
	wp_enqueue_script( 'vericor-homes-lazysizes', get_template_directory_uri() . '/assets/vendors/lazysizes.min.js', array(), null, true );

	wp_enqueue_script( 'vericor-homes-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), null, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'vericor_homes_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function my_acf_init() {
	acf_update_setting('google_api_key', 'AIzaSyAtq-bYRZRKw0UYjaeO6T9kKjPstI6Iguk');
}
  
add_action('acf/init', 'my_acf_init');

function facebook_pixel() {
	echo '<!-- Facebook Pixel Code -->
	<script>
	!function(f,b,e,v,n,t,s)
	{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version=\'2.0\';
	n.queue=[];t=b.createElement(e);t.async=!0;
	t.src=v;s=b.getElementsByTagName(e)[0];
	s.parentNode.insertBefore(t,s)}(window,document,\'script\',
	\'https://connect.facebook.net/en_US/fbevents.js\');
	fbq(\'init\', \'1436022099862851\');
	fbq(\'track\', \'PageView\');
	</script>
	<noscript>
	<img height="1" width="1"
	src="https://www.facebook.com/tr?id=1436022099862851&ev=PageView
	&noscript=1"/>
	</noscript>
	<!-- End Facebook Pixel Code -->';
}
add_action('wp_footer', 'facebook_pixel');


/* Add Async to scripts */
/* https://matthewhorne.me/defer-async-wordpress-scripts/ */
function add_async_attribute($tag, $handle) {
	// add script handles to the array below
	$scripts_to_async = array('vericor-homes-navigation', 'vericor-homes-scripts', 'vericor-homes-skip-link-focus-fix', 'wp-embed');

	foreach($scripts_to_async as $async_script) {
		if ($async_script === $handle) {
			return str_replace(' src', ' async="async" src', $tag);
		}
	}
	return $tag;
}

add_filter('script_loader_tag', 'add_async_attribute', 10, 2);

/* Hide the admin bar for all users */
show_admin_bar(false);

function my_login_redirect( $redirect_to, $request, $user ) {
    //is there a user to check?
    if (isset($user->roles) && is_array($user->roles)) {
        //check for subscribers
        if (in_array('subscriber', $user->roles)) {
            // redirect them to another URL, in this case, the homepage 
            $redirect_to =  home_url().'/homeowners';
        }
    }

    return $redirect_to;
}

add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );

function custom_login_logo() {
	echo '<style type="text/css">
		body.login div#login h1 a {
			background-image: url('.get_template_directory_uri().'/assets/vericor-horizontal-blue-gray.png);
			background-size: 275px 60px;
			height: 60px;
			width: 275px;
			margin-bottom: 2.5rem;
		}
		.login #nav a,
		.login label,
		.login #backtoblog a {
			color: #014a8a!important;
		}

		.login form {
			box-shadow: 0 4px 8px 0 rgba(0,0,0,.12), 0 2px 4px 0 rgba(0,0,0,.08)!important;
			border-radius: 4px;
			border-top: 8px solid #fbd872;
			transition: box-shadow 0.24s ease-out;
		}

		.login form:hover {
			box-shadow: 0 15px 30px 0 rgba(0,0,0,.11), 0 5px 15px 0 rgba(0,0,0,.08)!important;
		}

		.wp-core-ui .button-primary {
			background: #014a8a!important;
			border-color: #014a8a!important;
			text-shadow: 0 0 transparent!important;
			box-shadow: 0 2px 4px 0 rgba(0,0,0,.1)!important;
			transition: box-shadow 0.2s ease-out;
		}

		.wp-core-ui .button-primary:hover {
			box-shadow: 0 4px 8px 0 rgba(0,0,0,.12), 0 2px 4px 0 rgba(0,0,0,.08)!important;
		}

		@media (min-width: 992px) {
			#login {
				width: 600px!important;
			}
		}
	</style>';
}
add_action( 'login_enqueue_scripts', 'custom_login_logo' );