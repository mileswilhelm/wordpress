<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Vericor_Homes
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main font-sans">

			<section class="error-404 not-found py-10 h-half">
				<header class="page-header text-center mb-8">
					<h1 class="page-title text-3xl lg:text-5xl font-serif text-blue"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'vericor-homes' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p class="text-center">
						<a href="<?php echo get_home_url(); ?>" class="text-blue hover:underline">Return Home</a>
					</p>
					<!-- <p class="text-center mb-5"><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'vericor-homes' ); ?></p> -->

					<?php
						//get_search_form();
					?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
