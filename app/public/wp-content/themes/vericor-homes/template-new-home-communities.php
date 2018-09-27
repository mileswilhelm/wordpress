<?php
/*
    Template Name: New Home Communities Template
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

                $community_address = get_field('community_address');
            ?>

            <section class="py-12">
                
                <?php 
                    $community_query = new WP_Query(
                        array(
                            'post_type' => 'page',
                            'post_parent' => $post->ID,
                            'meta_key' => '_wp_page_template',
                            'meta_value' => 'template-community.php'
                        )
                    );

                    if( $community_query -> have_posts() ) { ?>
                        <section class="">
                            <div class="container mx-auto px-3">
                                <h1 class="capitalize font-normal mb-8 lg:text-3xl text-center text-2xl xl:text-4xl">Vericor Homes is Building In These Fine Communities</h1>
                                <div class="flex flex-wrap md:justify-center">
                                    <?php while ( $community_query -> have_posts() ) {
                                        $community_query->the_post();
                                        $community_featured_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                                        $community_title = get_the_title();
                                        $community_excerpt = get_field('community_excerpt');
                                    ?>
                                        <div class="w-full md:w-1/2 lg:w-1/3 px-3 mb-10 relative">
                                            <a href="<?php echo get_the_permalink(); ?>"><span class="absolute pin mx-3"></span></a>
                                            <div class="rounded overflow-hidden shadow-md hover:shadow-lg bg-white">
                                                <img class="w-full lazyload" data-src="<?php echo $community_featured_image; ?>" alt="<?php echo $community_title; ?>">
                                                <!-- put a coming soon image if no featured image -->
                                                <div class="p-5 pt-3">
                                                    <div class="text-2xl font-bold mb-2">
                                                        <?php echo $community_title; ?>
                                                    </div>
                                                    <div class="flex leading-normal">
                                                        <div class="">
                                                            <p><?php echo $community_excerpt; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } wp_reset_postdata(); //end while ?>
                                </div>
                            </div>
                        </section>
                    <?php } //end if inventory?>

            </section>

            <?php endwhile; // End of the loop.
            ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();
