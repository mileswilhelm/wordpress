<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Vericor_Homes
 */

?>
<?php if ( get_edit_post_link() ) : ?>
	<?php
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'vericor-homes' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="absolute bg-blue edit-link font-bold hover:bg-blue-dark mr-4 mt-4 pin-r pin-t px-4 py-2 rounded text-blue text-white shadow">',
			'</span>'
		);
	?>
<?php endif; ?>
<article id="post-<?php the_ID(); ?>" class="">
	<?php if( has_post_thumbnail() ) { ?>
	<header 
		class="entry-header h-half scrollFade"
		style="background: linear-gradient(rgba(0,0,0,0) 80%, rgba(0,74,135,0.8)), url(<?php echo get_the_post_thumbnail_url(); ?>) no-repeat center center;background-size: cover;"
	>
		<div class="container flex h-full items-end justify-center mx-auto pb-12 xl:pb-20">
			<?php the_title( '<h1 class="capitalize font-normal font-serif text-white text-4xl md:text-5xl lg:text-6xl hero-header">', '</h1>' ); ?>
		</div>
	</header><!-- .entry-header -->
	<?php } else { ?>
		<header class="entry-header text-center py-12">
			<?php the_title( '<h1 class="capitalize font-normal font-serif text-blue text-4xl md:text-5xl lg:text-6xl">', '</h1>' ); ?>
		</header><!-- .entry-header -->
	<?php } ?>
	
</article><!-- #post-<?php the_ID(); ?> -->
