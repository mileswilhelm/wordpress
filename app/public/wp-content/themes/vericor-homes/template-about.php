<?php
/*
    Template Name: About Us Template
 *
 *
 * The template for displaying all community pages
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Vericor_Homes
 */

get_header();
?>

	<div id="primary" class="content-area font-sans relative">

		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );
			$homebuilders = get_field('homebuilder');
			$quality_homes_copy = get_field('quality_homes_copy');

		endwhile; // End of the loop.
		?>

		<section class="py-10">
			<div class="container mx-auto px-3">
				<div class="wp-content leading-normal">
                    <?php the_content(); ?>
                </div>
			</div>
		</section>

		<section class="bg-yellow-lighter px-3 py-10">
			<div class="container mx-auto px-3">
				<h2 class="text-blue text-center lg:text-4xl text-3xl">Over 75 Years Of Combined Home Building Experience!</h2>
				<!-- <div class="flex flex-wrap">
					<?php 
						while( have_rows('homebuilder') ): the_row();
						$homebuilder_image = get_sub_field('image');
						$homebuilder_name = get_sub_field('name');
					?>
						<div class="w-full md:w-1/3">
							<div class="flex flex-col justify-center items-center mb-8 md:mb-0">
								<img class="border-4 border-blue h-64 p-2 rounded-full w-64 mb-4 shadow-md lazyload" data-src="<?php echo $homebuilder_image['url']; ?>" alt="<?php echo $homebuilder_image['alt']; ?>">
								<p class="text-gray text-center text-xl md:text-2xl text-bold"><?php echo $homebuilder_name; ?></p>
							</div>
						</div>
					<?php endwhile; ?>
                </div> -->

				<div class="wp-content leading-normal">
					<p>
						<?php echo $quality_homes_copy; ?>
					</p>
                </div>

			</div>
		</section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();
