<?php 
    /* Our Model Collection */
    get_header();
?>

	<div id="primary" class="content-area font-sans relative">

		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

		endwhile; // End of the loop.
		?>

		<section class="py-12">
			<div class="container mx-auto px-3">
                <?php 
                    $models_query = new WP_Query(
                        array(
                            'post_type' => 'page',
                            'post_parent' => 19,
                            'meta_key' => '_wp_page_template',
                            'meta_value' => 'template-model.php',
                            'orderby' => 'title',
                            'order'   => 'ASC',
                        )
                    );
                    if( $models_query -> have_posts() ) { ?>
                        <h1 class="capitalize font-normal mb-8 lg:text-3xl text-center text-2xl xl:text-4xl">Available Models</h1>
                        <div class="flex flex-wrap md:justify-center">
                            <?php while ( $models_query -> have_posts() ) {
                                $models_query->the_post();
                                $model_featured_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                                $model_title = get_the_title();
                                // $community_title = get_the_title( $post->post_parent );
                                $bedrooms = get_field('bedrooms');
                                $bathrooms = get_field('bathrooms');
                                $stories = get_field('stories');
                                $square_feet = get_field('square_feet');
                                $garage = get_field('garage');
                                $master = get_field('master');
                                $price = get_field('price');
                            ?>
                                <div class="w-full md:w-1/2 lg:w-1/3 px-3 mb-10 relative">
                                    <a href="<?php echo get_the_permalink(); ?>"><span class="absolute pin mx-3"></span></a>
                                    <div class="rounded overflow-hidden shadow-md hover:shadow-lg bg-white">
                                        <img class="w-full lazyload" data-src="<?php echo $model_featured_image; ?>" alt="">
                                        <!-- <span class="px-6 py-2 ribbon-front bg-blue text-white shadow-md text-lg"><?php //echo $community_title; ?></span> -->
                                        <div class="p-5 pt-3">
                                            <div class="text-2xl font-bold mb-1">
                                                <?php echo $model_title; ?>
                                            </div>
                                            <!-- <p class="text-blue mb-2"><?php echo $community_title; ?></p> -->
                                            <div class="flex leading-normal">
                                                <div class="w-1/2">
                                                    <?php if ($bedrooms) { ?>
                                                        <p class="text-gray text-base">
                                                            <strong>Bedrooms</strong>: <?php echo $bedrooms; ?>
                                                        </p>
                                                    <?php } ?>
                                                    <?php if ($bathrooms) { ?>
                                                        <p class="text-gray text-base">
                                                            <strong>Bathrooms</strong>: <?php echo $bathrooms; ?>
                                                        </p>
                                                    <?php } ?>
                                                    <?php if ($square_feet) { ?>
                                                        <p class="text-gray text-base">
                                                            <strong>Sq. Ft.</strong>: <?php echo $square_feet; ?>
                                                        </p>
                                                    <?php } ?>
                                                    <?php if ($garage) { ?>
                                                        <p class="text-gray text-base">
                                                            <strong>Garage</strong>: <?php echo $garage; ?>
                                                        </p>
                                                    <?php } ?>
                                                    <?php if ($stories) { ?>
                                                        <p class="text-gray text-base">
                                                            <strong>Stories</strong>: <?php echo $stories; ?>
                                                        </p>
                                                    <?php } ?>
                                                    <?php if ($master) { ?>
                                                        <p class="text-gray text-base">
                                                            <strong>Master</strong>: <?php echo $master; ?>
                                                        </p>
                                                    <?php } ?>
                                                </div>
                                                <div class="w-1/2">
                                                    <?php if ($price) { ?>
                                                        <p class="text-base font-bold hidden">
                                                            Base Price: $<?php echo $price; ?>
                                                        </p>
                                                    <?php } ?>         
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } wp_reset_postdata(); //end while ?>
                        </div>
                    <?php } ?>
			</div>
		</section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();
