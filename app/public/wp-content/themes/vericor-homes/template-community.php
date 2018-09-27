<?php
/*
    Template Name: Community Template
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
<link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/assets/vendors/micromodal.css'; ?>">
<link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/assets/vendors/photoswipe.css'; ?>">
<link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/assets/vendors/photoswipe-default-ui.css'; ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.1.6/css/swiper.min.css">

	<div id="primary" class="content-area font-sans relative">

		<main id="main" class="site-main">

            <?php
            while ( have_posts() ) :
                the_post();

                get_template_part( 'template-parts/content', 'page' );

                $community_address = get_field('community_address');
                $community_logo = get_field('community_logo');
                $community_phone_number = get_field('community_phone_number');
                $community_agents = get_field('community_agents');
                $community_hours = get_field('community_hours');
                $community_title = get_the_title();

                $sitemap_desktop_image = get_field('sitemap_desktop_image');
                $sitemap_mobile_image = get_field('sitemap_mobile_image');
                $sitemap_lot_data = get_field('sitemap_lot_data');

                $community_gallery = get_field('community_gallery');
                $community_amenities = get_field('community_amenities');
            ?>

            <section class="py-12">
                <div class="container mx-auto px-3 mb-10">
                    <div class="w-full lg:flex shadow lg:flex-row-reverse bg-blue">
                        <div class="h-64 lg:w-1/2 lg:h-auto flex-none rounded-t lg:rounded-t-none lg:rounded-r text-center overflow-hidden" id="community-map"></div>
                        <div class="text-white rounded-b lg:rounded-b-none lg:rounded-l p-4 lg:p-8 flex flex-col justify-between leading-normal lg:w-1/2 lg:min-h-96">
                            <div class="">
                                <h2 class="font-bold text-xl md:text-2xl lg:text-3xl mb-2 lg:mb-4"><?php echo the_title(); ?></h2>
                                <?php if($community_address) { ?>
                                    <p class="text-base mb-1"><strong>Address:</strong> <?php echo $community_address; ?></p>
                                <?php } ?>
                                <?php if($community_phone_number) { ?>
                                    <p class="text-base mb-1"><strong>Phone:</strong> <?php echo $community_phone_number; ?></p>
                                <?php } ?>
                                <?php if($community_agents) { ?>
                                    <p class="text-base mb-1">
                                        <strong>Agents:</strong>
                                        <ul>
                                            <?php foreach ($community_agents as $agent) { ?>
                                                <li class="mb-2"><?php echo $agent['agent_name']; ?></li>
                                            <?php } ?>
                                        </ul>
                                    </p>
                                <?php } ?>
                                <?php if($community_hours) { ?>
                                    <p class="text-base mb-1"><strong>Hours:</strong> <?php echo $community_hours; ?></p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            
                <!-- About The Community -->
                <div class="container mx-auto px-3 mb-10">
                    <h1 class="capitalize font-normal mb-8 lg:text-3xl text-center text-2xl xl:text-4xl">About The Community</h1>
                    <div class="flex flex-wrap-reverse md:flex-wrap">
                        <div class="w-full md:w-2/3 md:pr-6 lg:pr-3">
                            <article class="wp-content leading-normal">
                                <?php the_content(); ?>
                            </article>
                        </div>
                        <div class="w-full md:w-1/3 md:pl-6 lg:pl-3 mb-6 md:mb-0 text-center">
                            <img class="lazyload" data-src="<?php echo $community_logo['url']; ?>" alt="<?php echo $community_title;?>"/>
                        </div>
                    </div>
                </div>
                <!-- End of About The Community -->

                <?php if( $community_gallery ) { $alternate_bg = 1; ?>
                    <section class="bg-yellow-lighter py-10 mb-10">
                        <div class="container mx-auto px-3">
                            <h1 class="capitalize font-normal mb-8 lg:text-3xl text-center text-2xl xl:text-4xl"><?php echo $community_title; ?> Gallery</h1>
                            <div class="swiper-container gallery">
                                <div class="swiper-wrapper align-items-center my-gallery">
                                    <!-- repeat elevations -->
                                    <?php if ($community_gallery) { ?>
                                        <?php $gcCount = 0; ?>
                                        <?php foreach( $community_gallery as $cgal ): ?>
                                            <!-- <div class="swiper-slide"> -->
                                                <?php 
                                                    $metadata = wp_get_attachment_metadata($cgal['ID']);
                                                    $width = $metadata['width'];
                                                    $height = $metadata['height'];
                                                    $source = wp_get_attachment_image_src($cgal['ID'], 'full', false);
                                                    $source_set = wp_get_attachment_image_srcset($cgal['ID'], null, false);
                                                ?>
                                                <figure class="swiper-slide cursor-pointer" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                                                    <a src="<?php echo $source[0]; ?>" itemprop="contentUrl" data-size="<?php echo $width.'x'.$height; ?>" data-index="<?php echo $gcCount; $gcCount++; ?>">
                                                        <?php //echo wp_get_attachment_image( $cgal['ID'], 'full', '',  ['class' => 'img-fluid'] ); ?>
                                                        <img data-srcset="<?php echo $source_set; ?>" class="lazyload shadow hover:shadow-md" />
                                                    </a>
                                                </figure>
                                            <!-- </div> -->
                                        <?php endforeach; ?>
                                    <?php } ?>								
                                </div>
                                <div class="swiper-button-prev-gal swiper-button-prev">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 44"><path d="M0,22L22,0l2.1,2.1L4.2,22l19.9,19.9L22,44L0,22L0,22L0,22z"></svg>
                                </div>
                                <div class="swiper-button-next-gal swiper-button-next">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 44"><path d="M27,22L27,22L5,44l-2.1-2.1L22.8,22L2.9,2.1L5,0L27,22L27,22z"></svg>
                                </div>
                            </div>
                            <div class="flex gallery justify-center mt-2 swiper-pagination swiper-pagination-bullets swiper-pagination-clickable w-100 w-full pin-l"></div>
                        </div>
                    </section>
                <?php } ?>

                <?php 
                    $inventory_query = new WP_Query(
                        array(
                            'post_type' => 'page',
                            'post_parent' => $post->ID,
                            'meta_key' => '_wp_page_template',
                            'meta_value' => 'template-inventory.php',
                            'orderby'   => 'price',
                            'order' => 'ASC'
                        )
                    );

                    if( $inventory_query -> have_posts() ) { ?>
                        <section class="mb-10">
                            <div class="container mx-auto px-3">
                                <h1 class="capitalize font-normal mb-8 lg:text-3xl text-center text-2xl xl:text-4xl"><?php echo $community_title; ?> Available Quick Move-In Homes</h1>
                                <div class="flex flex-wrap md:justify-center">
                                    <?php while ( $inventory_query -> have_posts() ) {
                                        $inventory_query->the_post();
                                        $inventory_title = get_the_title();
                                        $bedrooms = get_field('bedrooms');
                                        $bathrooms = get_field('bathrooms');
                                        $stories = get_field('stories');
                                        $square_feet = get_field('square_feet');
                                        $garage = get_field('garage');
                                        $master = get_field('master');
                                        $price = get_field('price');
                                        $source_set = wp_get_attachment_image_srcset(get_post_thumbnail_id(), null, false);
                                    ?>
                                        <div class="w-full md:w-1/2 lg:w-1/3 px-3 mb-10 relative">
                                            <a href="<?php echo get_the_permalink(); ?>"><span class="absolute pin mx-3"></span></a>
                                            <div class="rounded overflow-hidden shadow-md hover:shadow-lg bg-white">
                                                <img data-srcset="<?php echo $source_set; ?>" class="lazyload bg-gray-lightest" alt="<?php echo $inventory_title.' Exterior Image';?>" />
                                                <div class="p-5 pt-3">
                                                    <div class="text-2xl font-bold mb-2">
                                                        <?php echo $inventory_title; ?>
                                                    </div>
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
                                                                <p class="text-base font-bold text-center text-lg lg:text-xl">
                                                                    Price:<br>$<?php echo $price; ?>
                                                                </p>
                                                            <?php } else { ?>
                                                                <p class="text-base font-bold text-center text-lg lg:text-xl">
                                                                    Price:<br>Call Today
                                                                </p>
                                                            <?php } ?>
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

                <?php 
                    $models_query = new WP_Query(
                        array(
                            'post_type' => 'page',
                            'post_parent' => $post->ID,
                            //pull only inventory pages in this community
                            'meta_query' => array(
                                array(
                                    'key' => '_wp_page_template',
                                    'value' => 'template-model.php',
                                )
                            ),
                            //sort by price meta value
                            'meta_key' => 'price',
                            'orderby'   => 'meta_value_num',
                            'order' => 'ASC'
                        )
                    );

                    if( $models_query -> have_posts() ) { ?>
                        <section class="">
                            <div class="container mx-auto px-3">
                                <h1 class="capitalize font-normal mb-8 lg:text-3xl text-center text-2xl xl:text-4xl"><?php echo $community_title; ?> Available Models</h1>
                                <div class="flex flex-wrap md:justify-center">
                                    <?php while ( $models_query -> have_posts() ) {
                                        $models_query->the_post();
                                        $model_title = get_the_title();
                                        $bedrooms = get_field('bedrooms');
                                        $bathrooms = get_field('bathrooms');
                                        $stories = get_field('stories');
                                        $square_feet = get_field('square_feet');
                                        $garage = get_field('garage');
                                        $master = get_field('master');
                                        $price = get_field('price');
                                        $starting_from_price = get_field('starting_from_price');
                                        $source_set = wp_get_attachment_image_srcset(get_post_thumbnail_id(), null, false);
                                    ?>
                                        <div class="w-full md:w-1/2 lg:w-1/3 px-3 mb-10 relative">
                                            <a href="<?php echo get_the_permalink(); ?>"><span class="absolute pin mx-3"></span></a>
                                            <div class="rounded overflow-hidden shadow-md hover:shadow-lg bg-white">
                                                <img data-srcset="<?php echo $source_set; ?>" class="lazyload bg-gray-lightest" alt="<?php echo $model_title.' Exterior Image';?>" />
                                                <div class="p-5 pt-3">
                                                    <div class="text-2xl font-bold mb-2">
                                                        <?php echo $model_title; ?>
                                                    </div>
                                                    <div class="flex leading-normal">
                                                        <div class="w-2/3">
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
                                                        <div class="w-1/3">
                                                            <?php if ($price || $starting_from_price) { ?>
                                                                <p class="font-bold text-center text-lg lg:text-xl leading-none">
                                                                    <span class="mb-2 block">Base Price:</span>
                                                                    <?php if($starting_from_price) {
                                                                        echo '<span class="text-base">'.$starting_from_price.'</span>';
                                                                    } else {
                                                                        echo '$'.$price;
                                                                    }
                                                                    ?>
                                                                </p>
                                                            <?php } ?>         
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } wp_reset_postdata(); //end while ?>
                                </div>
                            </div>
                        </section>
                    <?php } //end if models?>

                    <?php if ( $sitemap_desktop_image ) { ?>
                        <section class="py-10 -mb-12 bg-gray-lightest">
                            <div class="container mx-auto px-3">
                                <h1 class="capitalize font-normal mb-8 lg:text-3xl text-center text-2xl xl:text-4xl">About The Community</h1>
                                
                                <div class="flex flex-wrap">
                                    <div class="w-full mb-6 lg:mb-0 lg:w-1/3">
                                        <!-- Desktop Sitemap -->
                                        <div class="relative hidden lg:block">
                                            <figure class="cursor-pointer text-center" data-micromodal-trigger="modal-1">
                                                <?php if ($sitemap_mobile_image) { ?>
                                                <img class="lazyload shadow hover:shadow-md" data-src="<?php echo $sitemap_mobile_image['url']; ?>" alt="<?php echo $community_title.' Site Map'; ?>" />
                                                <?php } else { ?>
                                                <img class="lazyload shadow hover:shadow-md" data-src="<?php echo $sitemap_desktop_image['url']; ?>" alt="<?php echo $community_title.' Site Map'; ?>" />
                                                <?php } ?>
                                                <figcaption class="flex items-center justify-center text-sm">
                                                    <svg viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="h-5 inline-block mr-2 w-5">
                                                        <g id="Page-1" stroke="none" stroke-width="1" fill-rule="evenodd">
                                                            <g id="icon-shape">
                                                                <path d="M7,7 L5,7 L5,9 L7,9 L7,11 L9,11 L9,9 L11,9 L11,7 L9,7 L9,5 L7,5 L7,7 Z M12.9056439,14.3198574 C11.5509601,15.3729184 9.84871145,16 8,16 C3.581722,16 0,12.418278 0,8 C0,3.581722 3.581722,0 8,0 C12.418278,0 16,3.581722 16,8 C16,9.84871145 15.3729184,11.5509601 14.3198574,12.9056439 L19.6568542,18.2426407 L18.2426407,19.6568542 L12.9056439,14.3198574 Z M8,14 C11.3137085,14 14,11.3137085 14,8 C14,4.6862915 11.3137085,2 8,2 C4.6862915,2 2,4.6862915 2,8 C2,11.3137085 4.6862915,14 8,14 Z" id="Combined-Shape"></path>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                    View Interactive Sitemap
                                                </figcaption>
                                            </figure>
                                        </div>
                                        <!-- End Desktop Sitemap -->
                                        <!-- Mobile Sitemap -->
                                        <div class="lg:hidden my-gallery">
                                            <?php if ( $sitemap_mobile_image ) { ?>
                                                <?php 
                                                    $metadata = wp_get_attachment_metadata($sitemap_mobile_image['ID']);
                                                    $width = $metadata['width'];
                                                    $height = $metadata['height'];
                                                    $source = $sitemap_mobile_image['url'];
                                                    $source_alt = $sitemap_mobile_image['alt'];
                                                ?>
                                                <figure class="cursor-pointer" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                                                    <a src="<?php echo $source; ?>" itemprop="contentUrl" data-size="<?php echo $width.'x'.$height; ?>" data-index="1">
                                                        <img class="lazyload shadow hover:shadow-md" data-src="<?php echo $source; ?>" alt="<?php echo $source_alt; ?>" />
                                                    </a>
                                                    <figcaption class="flex items-center justify-center text-sm">
                                                        <svg viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="h-5 inline-block mr-2 w-5">
                                                            <g id="Page-1" stroke="none" stroke-width="1" fill-rule="evenodd">
                                                                <g id="icon-shape">
                                                                    <path d="M7,7 L5,7 L5,9 L7,9 L7,11 L9,11 L9,9 L11,9 L11,7 L9,7 L9,5 L7,5 L7,7 Z M12.9056439,14.3198574 C11.5509601,15.3729184 9.84871145,16 8,16 C3.581722,16 0,12.418278 0,8 C0,3.581722 3.581722,0 8,0 C12.418278,0 16,3.581722 16,8 C16,9.84871145 15.3729184,11.5509601 14.3198574,12.9056439 L19.6568542,18.2426407 L18.2426407,19.6568542 L12.9056439,14.3198574 Z M8,14 C11.3137085,14 14,11.3137085 14,8 C14,4.6862915 11.3137085,2 8,2 C4.6862915,2 2,4.6862915 2,8 C2,11.3137085 4.6862915,14 8,14 Z" id="Combined-Shape"></path>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                        Zoom
                                                    </figcaption>
                                                </figure>
                                            <?php } else { ?>
                                                <img class="lazyload" data-src="<?php echo $sitemap_desktop_image['url']; ?>"/>
                                                <?php 
                                                    $metadata = wp_get_attachment_metadata($sitemap_desktop_image['ID']);
                                                    $width = $metadata['width'];
                                                    $height = $metadata['height'];
                                                    $source = $sitemap_desktop_image['url'];
                                                    $source_alt = $sitemap_mobile_image['alt'];
                                                ?>
                                                <figure class="cursor-pointer" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                                                    <a src="<?php echo $source; ?>" itemprop="contentUrl" data-size="<?php echo $width.'x'.$height; ?>" data-index="1">
                                                        <img class="lazyload" data-src="<?php echo $source; ?>" alt="<?php echo $source_alt; ?>" />
                                                    </a>
                                                    <figcaption class="flex items-center justify-center text-sm">
                                                        <svg viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="h-5 inline-block mr-2 w-5">
                                                            <g id="Page-1" stroke="none" stroke-width="1" fill-rule="evenodd">
                                                                <g id="icon-shape">
                                                                    <path d="M7,7 L5,7 L5,9 L7,9 L7,11 L9,11 L9,9 L11,9 L11,7 L9,7 L9,5 L7,5 L7,7 Z M12.9056439,14.3198574 C11.5509601,15.3729184 9.84871145,16 8,16 C3.581722,16 0,12.418278 0,8 C0,3.581722 3.581722,0 8,0 C12.418278,0 16,3.581722 16,8 C16,9.84871145 15.3729184,11.5509601 14.3198574,12.9056439 L19.6568542,18.2426407 L18.2426407,19.6568542 L12.9056439,14.3198574 Z M8,14 C11.3137085,14 14,11.3137085 14,8 C14,4.6862915 11.3137085,2 8,2 C4.6862915,2 2,4.6862915 2,8 C2,11.3137085 4.6862915,14 8,14 Z" id="Combined-Shape"></path>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                        Zoom
                                                    </figcaption>
                                                </figure>
                                            <?php } ?>
                                        </div>
                                        <!-- End Mobile Sitemap -->
                                    </div>
                                    <div class="w-full lg:w-2/3 lg:pl-6">
                                        <!-- Community Info: Schools, Utilities, Parks, Attractions, etc -->
                                        <?php if ($community_amenities) { ?>
                                            <div class="flex flex-wrap">
                                            <?php foreach( $community_amenities as $amenity_group ): ?>
                                                <div class="w-full md:w-1/2 mb-5">
                                                    <p class="font-serif mb-3 text-4xl text-blue">
                                                        <strong><?php echo $amenity_group['amenity_title']; ?></strong>
                                                    </p>
                                                    <ul>
                                                        <?php foreach( $amenity_group['amenity'] as $amenity_item ): ?>
                                                            <li class="mb-2">
                                                                <?php echo $amenity_item['amenity_item']; ?>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </div>
                                            <?php endforeach; ?>
                                            </div>
                                            
                                        <?php } else { ?>
                                            <div class="">
                                                <p class="text-center text-3xl text-gray">Amenity information coming soon!</p>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div><!-- .flex -->
                                
                            </div>
                        </section>
                    <?php } ?>

            </section>

            <?php endwhile; // End of the loop.
            ?>

		</main><!-- #main -->
    </div><!-- #primary -->
    
<?php if( $community_gallery ) { ?>
    <div id="gallery" class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="pswp__bg"></div>
		<div class="pswp__scroll-wrap">
			<div class="pswp__container">
				<div class="pswp__item"></div>
				<div class="pswp__item"></div>
				<div class="pswp__item"></div>
			</div>
			<div class="pswp__ui pswp__ui--hidden">
				<div class="pswp__top-bar">
					<div class="pswp__counter"></div>
					<button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
					<button class="pswp__button pswp__button--share" title="Share"></button>
					<button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
					<button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
					<div class="pswp__preloader">
						<div class="pswp__preloader__icn">
							<div class="pswp__preloader__cut">
								<div class="pswp__preloader__donut"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
					<div class="pswp__share-tooltip">
					</div>
				</div>
				<button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
				<button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
				<div class="pswp__caption hidden">
					<div class="pswp__caption__center">
					</div>
				</div>
			</div>
		</div>
    </div>
<?php } ?>

<?php if( $sitemap_desktop_image ) { ?>
    <!-- Sitemap Modal -->
    <div class="micromodal-slide modal" id="modal-1" aria-hidden="false">
        <div class="modal__overlay close-1" tabindex="-1" data-micromodal-close="">
            <div class="modal__container font-sans shadow-lg relative" role="dialog" id="sitemap-container" aria-modal="true" aria-labelledby="modal-1-title">
            <button id="downloadPDF" class="absolute bg-transparent border border-blue font-bold hidden hover:bg-blue hover:border-transparent hover:text-white lg:inline-block mr-8 mx-auto pin-r px-3 py-3 rounded-sm text-blue uppercase">Download PDF</button>
                <header class="modal__header mb-6">
                    <h2 class="text-3xl text-center w-full" id="modal-1-title">
                        <?php echo $community_title; ?> Sitemap
                    </h2>
                </header>

                <?php if ( get_edit_post_link() ) : ?>
                    <div class="p-3 pin w-full bg-blue text-white flex items-center justify-between shadow">
                        <div>
                            <button class="bg-green-lightest hover:bg-green text-green hover:text-white font-bold py-2 px-4 mr-4 rounded inline-flex items-center" id="add-lot-opener">
                                <svg viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="fill-current w-4 h-4 mr-2">
                                    <g id="Page-1" stroke="none" stroke-width="1" fill-rule="evenodd">
                                        <g id="icon-shape">
                                            <path d="M11,9 L11,5 L9,5 L9,9 L5,9 L5,11 L9,11 L9,15 L11,15 L11,11 L15,11 L15,9 L11,9 Z M10,20 C15.5228475,20 20,15.5228475 20,10 C20,4.4771525 15.5228475,0 10,0 C4.4771525,0 0,4.4771525 0,10 C0,15.5228475 4.4771525,20 10,20 Z M10,18 C14.418278,18 18,14.418278 18,10 C18,5.581722 14.418278,2 10,2 C5.581722,2 2,5.581722 2,10 C2,14.418278 5.581722,18 10,18 Z" id="Shape"></path>
                                        </g>
                                    </g>
                                </svg>
                                <span>Add</span>
                            </button>

                            <button class="bg-white hover:bg-yellow text-blue font-bold py-2 px-4 mr-4 rounded items-center hidden" id="status-button">
                                <svg viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="fill-current w-4 h-4 mr-2">
                                    <g id="Page-1" stroke="none" stroke-width="1" fill-rule="evenodd">
                                        <g id="icon-shape">
                                            <path d="M10,1 L20,7 L10,13 L0,7 L10,1 Z M16.6666667,11 L20,13 L10,19 L0,13 L3.33333333,11 L10,15 L16.6666667,11 Z" id="Combined-Shape"></path>
                                        </g>
                                    </g>
                                </svg>
                                <span>Status</span>
                            </button>

                            <button class="bg-white hover:bg-yellow text-blue font-bold py-2 px-4 mr-4 rounded items-center hidden" id="linked-button">
                                <svg viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="fill-current w-4 h-4 mr-2">
                                    <g id="Page-1" stroke="none" stroke-width="1" fill-rule="evenodd">
                                        <g id="icon-shape">
                                            <path d="M17,10 L20,10 L10,0 L0,10 L3,10 L3,20 L17,20 L17,10 Z M8,14 L12,14 L12,20 L8,20 L8,14 Z" id="Combined-Shape"></path>
                                        </g>
                                    </g>
                                </svg>
                                <span>Linked Inventory</span>
                            </button>

                            <button class="bg-white hover:bg-yellow text-blue font-bold py-2 px-4 mr-4 rounded items-center hidden" id="models-button">
                                <svg viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="fill-current w-4 h-4 mr-2">
                                    <g id="Page-1" stroke="none" stroke-width="1" fill-rule="evenodd">
                                        <g id="icon-shape">
                                            <path d="M17,10 L20,10 L10,0 L0,10 L3,10 L3,20 L17,20 L17,10 Z M8,14 L12,14 L12,20 L8,20 L8,14 Z" id="Combined-Shape"></path>
                                        </g>
                                    </g>
                                </svg>
                                <span>Available Models</span>
                            </button>

                            <button class="bg-red-lightest hover:bg-red text-red hover:text-white font-bold py-2 px-4 rounded items-center hidden" id="delete-button">
                                <svg viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="fill-current w-4 h-4 mr-2">
                                    <g id="Page-1" stroke="none" stroke-width="1" fill-rule="evenodd">
                                        <g id="icon-shape">
                                            <path d="M2,2 L18,2 L18,4 L2,4 L2,2 Z M8,0 L12,0 L14,2 L6,2 L8,0 Z M3,6 L17,6 L16,20 L4,20 L3,6 Z M8,8 L9,8 L9,18 L8,18 L8,8 Z M11,8 L12,8 L12,18 L11,18 L11,8 Z" id="Combined-Shape"></path>

                                        </g>
                                    </g>
                                </svg>
                                <span>Delete</span>
                            </button>
                        </div>

                        <div>
                            <button class="bg-white hover:bg-yellow text-blue font-bold py-2 px-4 rounded inline-flex items-center" id="save-button">
                                <svg viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="fill-current w-4 h-4 mr-2">
                                    <g id="Page-1" stroke="none" stroke-width="1" fill-rule="evenodd">
                                        <g id="icon-shape">
                                            <path d="M0,1.99079514 C0,0.891309342 0.894513756,0 1.99406028,0 L16,0 L20,4 L20,18.0059397 C20,19.1072288 19.1017876,20 18.0092049,20 L1.99079514,20 C0.891309342,20 0,19.1017876 0,18.0092049 L0,1.99079514 Z M5,2 L15,2 L15,8 L5,8 L5,2 Z M11,3 L14,3 L14,7 L11,7 L11,3 Z" id="Combined-Shape"></path>
                                        </g>
                                    </g>
                                </svg>
                                <span>Save</span>
                            </button>
                        </div>
                    </div>

                    <!-- Add Lot Wrapper -->
                    <div class="absolute bg-white border-2 border-blue border-solid p-5 rounded shadow-md z-10 hidden" id="add-lot-wrapper">
                        <label class="block text-gray text-sm font-bold mb-2" for="lot-label">
                            Lot Label
                        </label>
                        <form class="flex shadow" id="add-form">
                            <div class="">
                                <input class="appearance-none border border-blue border-r-0 focus:outline-none focus:shadow-outline leading-tight px-3 py-2 rounded rounded-r-none text-gray w-full h-10" id="lot-label" type="text">
                            </div>
                            <div class="">
                                <button class="bg-blue border-l-0 border-blue border focus:outline-none focus:shadow-outline font-bold text-white px-4 py-2 rounded rounded-l-none h-10" type="button" id="add-lot-button">
                                    Add
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- End of Add Lot Wrapper -->

                    <!-- Add Status Wrapper -->
                    <div class="absolute bg-white border-2 border-blue border-solid rounded shadow-md z-10 hidden" id="add-status-wrapper">
                        <ul class="list-reset">
                            <li class="border-b border-gray p-3 w-48 cursor-pointer hover:font-bold flex items-center swag" data-status="future">
                                <span class="h-4 w-4 mr-4 inline-block bg-future"></span>Future
                            </li>
                            <li class="border-b border-gray p-3 w-48 cursor-pointer hover:font-bold flex items-center swag" data-status="reserved">
                                <span class="h-4 w-4 mr-4 bg-reserved"></span>Reserved
                            </li>

                            <li class="border-b border-gray p-3 w-48 cursor-pointer hover:font-bold flex items-center swag" data-status="availablelot">
                                <span class="h-4 w-4 mr-4 bg-availablelot"></span>Available Lot
                            </li>
                            <li class="border-b border-gray p-3 w-48 cursor-pointer hover:font-bold flex items-center swag" data-status="availablehome">
                                <span class="h-4 w-4 mr-4 bg-availablehome"></span>Available Home
                                </li>

                            <li class="border-b border-gray p-3 w-48 cursor-pointer hover:font-bold flex items-center swag" data-status="moveinready">
                                <span class="h-4 w-4 mr-4 bg-moveinready"></span>Move-In Ready
                            </li>
                            <li class="border-b border-gray p-3 w-48 cursor-pointer hover:font-bold flex items-center swag" data-status="model">
                                <span class="h-4 w-4 mr-4 bg-model"></span>Model
                            </li>
                            <li class="p-3 w-48 cursor-pointer hover:font-bold flex items-center swag" data-status="sold">
                                <span class="h-4 w-4 mr-4 bg-sold"></span>Sold
                            </li>
                        </ul>
                    </div>
                    <!-- End of Add Status Wrapper -->

                    <!-- Link Inventory Wrapper -->
                    <?php 
                        $inventory_args = new WP_Query(
                            array(
                                'post_type' => 'page',
                                'post_parent' => $post->ID,
                                'meta_key' => '_wp_page_template',
                                'meta_value' => 'template-inventory.php'
                            )
                        );

                        // The Loop
                        if ( $inventory_args->have_posts() ) { ?>
                            <div class="absolute bg-white pin-r mr-8 p-2 border-2 border-blue border-solid rounded shadow-md z-10 hidden w-1/4" id="link-inventory-wrapper">
                                <p class="font-bold text-sm text-gray mb-2">Choose linked inventory:</p>
                                <ul class="border h-24 mb-2 list-reset overflow-auto p-3 rounded-sm text-sm text-center">
                                    <li class="border-b border-gray text-gray text-sm font-italic mb-2 py-2 text-gray hover:text-red cursor-pointer linked-inventory-item" data-inventory="" data-status="future">
                                        No linked inventory
                                    </li>
                                    <?php while ( $inventory_args->have_posts() ) {
                                        $inventory_args->the_post();
                                        $invTitle = get_the_title();
                                        $invID = get_the_ID();
                                        $invStatus = get_field('status');
                                    ?>
                                        <li class="border-b border-gray text-gray text-sm font-italic mb-2 py-2 text-gray hover:text-blue cursor-pointer linked-inventory-item" data-inventory="<?php echo $invID; ?>" data-status="moveinready">
                                            <?php echo $invTitle; ?>
                                        </li>
                                    <?php } ?>
                                </ul>
                                <div class="-mb-2 -mx-2 bg-blue pb-2 px-2 text-white">
                                    <p class="font-bold text-md mb-2 pt-4">Current Inventory:</p>
                                    <p class="text-sm" id="current-inventory">N/A</p>
                                </div>
                            </div>
                        <?php /* Restore original Post Data */
                            wp_reset_postdata();
                        } else { ?>
                            <div class="absolute bg-white pin-r mr-8 p-2 border-2 border-blue border-solid rounded shadow-md z-10 hidden" id="link-inventory-wrapper">
                                <p class="font-bold text-sm text-gray mb-2">Choose linked inventory:</p>
                                <ul class="list-reset">
                                    <li class="font-italic text-gray">There are no available inventory in this community.</li>
                                </ul>
                            </div>
                        <?php } ?>
                    <!-- End of Link Inventory Wrapper -->

                    <!-- Available Models Wrapper -->
                    <?php 
                        $model_args = new WP_Query(
                            array(
                                'post_type' => 'page',
                                'post_parent' => $post->ID,
                                'meta_key' => '_wp_page_template',
                                'meta_value' => 'template-model.php'
                            )
                        );

                        // The Loop
                        if ( $model_args->have_posts() ) { ?>
                            <div class="absolute bg-white pin-r mr-8 p-2 border-2 border-blue border-solid rounded shadow-md z-10 hidden w-1/4" id="available-models-wrapper">
                                <p class="font-bold text-sm text-gray mb-2">Choose Available Models:</p>
                                <ul class="border h-64 mb-2 list-reset overflow-auto p-3 rounded-sm text-sm text-center">
                                    <li class="border-b border-gray text-gray text-sm font-italic mb-2 py-2 text-gray hover:text-red cursor-pointer available-model-item" data-model="emptyItems" data-status="future">
                                        No available models
                                    </li>
                                    <?php while ( $model_args->have_posts() ) {
                                        $model_args->the_post();
                                        $modelTitle = get_the_title();
                                        $modelID = get_the_ID();
                                    ?>
                                        <li 
                                            class="border-b border-gray text-gray text-sm font-italic mb-2 py-2 text-gray hover:text-blue cursor-pointer available-model-item"
                                            data-model="<?php echo $modelID; ?>"
                                            data-modelname="<?php echo $modelTitle; ?>"
                                            data-status="availablehome"
                                        >
                                            <?php echo $modelTitle; ?>
                                        </li>
                                    <?php } ?>
                                </ul>
                                <div class="-mb-2 -mx-2 bg-blue pb-2 px-2 text-white">
                                    <p class="font-bold text-md mb-2 pt-4">Current Models:</p>
                                    <div class="text-sm" id="current-models">
                                    </div>
                                </div>
                            </div>
                        <?php /* Restore original Post Data */
                            wp_reset_postdata();
                        } else { ?>
                            <div class="absolute bg-white pin-r mr-8 p-2 border-2 border-blue border-solid rounded shadow-md z-10 hidden" id="available-models-wrapper">
                                <p class="font-bold text-sm text-gray mb-2">Choose linked models:</p>
                                <ul class="list-reset">
                                    <li class="font-italic text-gray">There are no available models in this community.</li>
                                </ul>
                            </div>
                        <?php } ?>
                    <!-- End of Available Models Wrapper -->
                <?php endif; ?>

                <div class="modal__content relative" id="modal-1-content">

                    <img data-src="<?php echo $sitemap_desktop_image['url']; ?>" alt="<?php echo $community_title.' Site Map';?>" class="shadow lazyload">
                    <div id="sitemap-data" class="absolute h-full pin-t w-full">
                    <?php if ( have_rows('sitemap_lot_data') ): ?>
                        
                        <?php while ( have_rows('sitemap_lot_data') ): the_row();
                            $lot_label = get_sub_field('label');
                            $linked_inventory = get_sub_field('linked_inventory');
                            $available_models = get_sub_field('available_models');
                            $status = get_sub_field('status');
                            $top_position = get_sub_field('top_position');
                            $left_position = get_sub_field('left_position');
                            $row_index = get_row_index();

                            //if linked inventory get status info and link to inventory
                            if ( $linked_inventory ) {
                                $status = get_field('status', $linked_inventory);
                                $wp_status = get_post_status( $linked_inventory );
                            }

                            if ( $available_models ) {
                                $modelNames = array();
                                foreach ($available_models as &$mod) {
                                    array_push($modelNames, get_the_title($mod));
                                }
                                unset($mod);
                            }

                        ?>
                            <div 
                                style="top:<?php echo $top_position; ?>%; left: <?php echo $left_position; ?>%"
                                class="absolute text-xs text-white rounded-full flex h-7 w-7 items-center justify-center sitemap-item shadow hover:shadow-md <?php echo 'bg-'.$status; ?> <?php if(!get_edit_post_link() && $linked_inventory && $wp_status == 'publish') { echo 'shadow-md sitemap-pop cursor-pointer';} ?><?php if(!get_edit_post_link() && $available_models && !$linked_inventory && $wp_status == 'publish') { echo 'shadow-md sitemap-pop-model cursor-pointer';} ?>"
                                data-id="<?php echo $row_index;?>"
                                data-label="<?php echo $lot_label; ?>"
                                data-status="<?php echo $status; ?>"
                                data-inventory="<?php echo $linked_inventory; ?>"
                                <?php if ( $linked_inventory ) { ?>
                                data-invtitle="<?php echo get_the_title($linked_inventory); ?>"
                                <?php } else { ?>
                                data-invtitle=""
                                <?php } ?>
                                <?php if( $available_models && !$linked_inventory ) { ?>
                                data-models="<?php print_r(json_encode($available_models));?>"
                                data-modelnames='<?php print_r(json_encode($modelNames));?>'
                                <?php } else { ?>
                                data-models="[]"
                                data-modelnames='[]'
                                <?php } ?>
                            >
                                <?php echo $lot_label; ?>
                            </div>
                        <?php endwhile; ?>

                    <?php endif; ?>
                        
                    </div>
                    <input class="hidden" id="updateFile" hidden value="<?php echo get_template_directory_uri() . '/functions/update-sitemap.php'; ?>">
                    <input class="hidden" id="getFile" hidden value="<?php echo get_template_directory_uri() . '/functions/sitemap-get-inventory.php'; ?>">
                    <input class="hidden" id="getFileModels" hidden value="<?php echo get_template_directory_uri() . '/functions/sitemap-get-models.php'; ?>">
                    <input class="hidden" id="id" hidden value="<?php echo get_the_ID(); ?>"> 
                    <input class="hidden" id="startIndex" hidden value="<?php if(!$row_index) { echo 0; } else { echo $row_index; } ?>"> 
                    <input class="hidden" id="rowIndex" hidden value="<?php if(!$row_index) { echo 0; } else { echo $row_index; } ?>">

                    <div class="micromodal-slide modal" id="modal-2" aria-hidden="false">
                        <div class="modal__overlay close-2" tabindex="-1">
                            <div class="border-t-8 border-yellow font-sans modal__container relative shadow-lg" role="dialog" aria-modal="true" aria-labelledby="modal-2-title">
                                <div class="modal__content relative" id="modal-2-content" style="margin-bottom: 0">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/loading-circle.svg" id="loader">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                
            </div>
        </div>
    </div>
<?php } ?>
<?php
// get_sidebar();
get_footer();
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Readmore.js/2.2.0/readmore.min.js"></script>
<script async defer src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<script async defer src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.debug.js"></script>
<script>
    if( $(window).width() > 767) {
        $('article.wp-content').readmore({
            collapsedHeight: 600,
            moreLink: '<a href="#" class="text-blue flex justify-center items-center text-center w-full font-bold">Read more <svg class="h-5 inline-block ml-2 w-5" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="Page-1" stroke="none" stroke-width="1" fill-rule="evenodd"><g id="icon-shape"><polygon id="Combined-Shape" points="9.29289322 12.9497475 10 13.6568542 15.6568542 8 14.2426407 6.58578644 10 10.8284271 5.75735931 6.58578644 4.34314575 8"></polygon></g></g></svg></a>',
            lessLink: '<a href="#" class="text-blue flex justify-center items-center text-center w-full font-bold">Read less <svg class="h-5 inline-block ml-2 w-5" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="Page-1" stroke="none" stroke-width="1" fill-rule="evenodd"><g id="icon-shape"><polygon id="Combined-Shape" points="10.7071068 7.05025253 10 6.34314575 4.34314575 12 5.75735931 13.4142136 10 9.17157288 14.2426407 13.4142136 15.6568542 12"></polygon></g></g></svg></a>'
        });
    }
</script>
<?php if( $community_gallery ) { ?>
    <script src="<?php echo get_template_directory_uri() . '/assets/vendors/photoswipe.min.js'; ?>"></script>
    <script src="<?php echo get_template_directory_uri() . '/assets/vendors/photoswipe-ui-default.min.js'; ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.1.6/js/swiper.min.js"></script>

    <script>
        var galSwiper = new Swiper('.swiper-container.gallery', {
            slidesPerView: 3,
            spaceBetween: 15,
            loop: true,
            autoHeight: false,
            pagination: {
                el: '.swiper-pagination.gallery',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next-gal',
                prevEl: '.swiper-button-prev-gal',
            },
            breakpoints: {
                992: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                768: {
                    slidesPerView: 1,
                    spaceBetween: 15,
                }
            },
            preloadImages: false
        });

        //photoswipe
        var initPhotoSwipeFromDOM = function(gallerySelector) {

            // parse slide data (url, title, size ...) from DOM elements 
            // (children of gallerySelector)
            var parseThumbnailElements = function(el) {
                var thumbElements = el.childNodes,
                numNodes = thumbElements.length,
                items = [],
                figureEl,
                linkEl,
                size,
                item;

                for(var i = 0; i < numNodes; i++) {

                    figureEl = thumbElements[i]; // <figure> element

                    // include only element nodes 
                    if(figureEl.nodeType !== 1) {
                        continue;
                    }

                    linkEl = figureEl.children[0]; // <a> element
                    // console.log(linkEl);

                    size = linkEl.getAttribute('data-size').split('x');

                    // create slide object
                    item = {
                        src: linkEl.getAttribute('src'),
                        w: parseInt(size[0], 10),
                        h: parseInt(size[1], 10)
                    };



                    if(figureEl.children.length > 1) {
                        // <figcaption> content
                        item.title = figureEl.children[1].innerHTML; 
                    }

                    if(linkEl.children.length > 0) {
                        // <img> thumbnail element, retrieving thumbnail url
                        item.msrc = linkEl.children[0].getAttribute('src');
                    } 

                    item.el = figureEl; // save link to element for getThumbBoundsFn
                    items.push(item);
                }
                // console.log(items);
                return items;
            };

            // find nearest parent element
            var closest = function closest(el, fn) {
                return el && ( fn(el) ? el : closest(el.parentNode, fn) );
            };

            // triggers when user clicks on thumbnail
            var onThumbnailsClick = function(e) {
                e = e || window.event;
                e.preventDefault ? e.preventDefault() : e.returnValue = false;

                var eTarget = e.target || e.srcElement;

                // find root element of slide
                var clickedListItem = closest(eTarget, function(el) {
                    return (el.tagName && el.tagName.toUpperCase() === 'FIGURE');
                    // return (el.tagName && el.tagName.toUpperCase() === 'IMG'); //changed to target img's for furthering the process
                });

                if(!clickedListItem) {
                    return;
                }

                // find index of clicked item by looping through all child nodes
                // alternatively, you may define index via data- attribute
                var clickedGallery = clickedListItem.parentNode,
                childNodes = clickedListItem.parentNode.childNodes,
                numChildNodes = childNodes.length,
                nodeIndex = 0,
                index;

                for (var i = 0; i < numChildNodes; i++) {
                    if(childNodes[i].nodeType !== 1) { 
                        continue; 
                    }

                    if(childNodes[i] === clickedListItem) {
                        index = nodeIndex;
                        break;
                    }
                    nodeIndex++;
                }



                if(index >= 0) {
                    // open PhotoSwipe if valid index found
                    openPhotoSwipe( index, clickedGallery );
                }
                return false;
            };

            // parse picture index and gallery index from URL (#&pid=1&gid=2)
            var photoswipeParseHash = function() {
                var hash = window.location.hash.substring(1),
                params = {};

                if(hash.length < 5) {
                    return params;
                }

                var vars = hash.split('&');
                for (var i = 0; i < vars.length; i++) {
                    if(!vars[i]) {
                        continue;
                    }
                    var pair = vars[i].split('=');  
                    if(pair.length < 2) {
                        continue;
                    }           
                    params[pair[0]] = pair[1];
                }

                if(params.gid) {
                    params.gid = parseInt(params.gid, 10);
                }

                return params;
            };

            var openPhotoSwipe = function(index, galleryElement, disableAnimation, fromURL) {
                var pswpElement = document.querySelectorAll('.pswp')[0],
                gallery,
                options,
                items;

                items = parseThumbnailElements(galleryElement);
                // console.log(items);

                // define options (if needed)
                options = {

                    // define gallery index (for URL)
                    galleryUID: galleryElement.getAttribute('data-pswp-uid'),

                    getThumbBoundsFn: function(index) {
                        // See Options -> getThumbBoundsFn section of documentation for more info
                        var thumbnail = items[index].el.getElementsByTagName('img')[0], // find thumbnail
                        pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
                        rect = thumbnail.getBoundingClientRect(); 

                        return {x:rect.left, y:rect.top + pageYScroll, w:rect.width};
                    }

                };

                // PhotoSwipe opened from URL
                if(fromURL) {
                    if(options.galleryPIDs) {
                        // parse real index when custom PIDs are used 
                        // http://photoswipe.com/documentation/faq.html#custom-pid-in-url
                        for(var j = 0; j < items.length; j++) {
                            if(items[j].pid == index) {
                                options.index = j;
                                break;
                            }
                        }
                    } else {
                        // in URL indexes start from 1
                        options.index = parseInt(index, 10) - 1;
                    }
                } else {
                    options.index = parseInt(index, 10);
                }

                // exit if index not found
                if( isNaN(options.index) ) {
                    return;
                }

                if(disableAnimation) {
                    options.showAnimationDuration = 0;
                }

                // Pass data to PhotoSwipe and initialize it
                gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
                gallery.init();
            };

            // loop through all gallery elements and bind events
            var galleryElements = document.querySelectorAll( gallerySelector );
            // console.log(galleryElements);

            for(var i = 0, l = galleryElements.length; i < l; i++) {
                // console.log(galleryElements[i]);
                galleryElements[i].setAttribute('data-pswp-uid', i+1);
                galleryElements[i].onclick = onThumbnailsClick;
            }

            // Parse URL and open gallery if it contains #&pid=3&gid=1
            var hashData = photoswipeParseHash();
            if(hashData.pid && hashData.gid) {
                openPhotoSwipe( hashData.pid ,  galleryElements[ hashData.gid - 1 ], true, true );
            }
        };

        // execute above function
        initPhotoSwipeFromDOM('.my-gallery');	
    </script>
<?php } ?>

<?php if( $sitemap_desktop_image ) { ?>
    <?php if ( get_edit_post_link() ) : ?>
        <script src="<?php echo get_template_directory_uri() . '/assets/vendors/jquery-ui.min.js'; ?>"></script>
        <script src="<?php echo get_template_directory_uri() . '/js/community-sitemaps.js'; ?>"></script>
    <?php endif; ?>
    <?php if ( !get_edit_post_link() ) { ?>
        <script src="<?php echo get_template_directory_uri() . '/js/ajax-sitemap-data.js'; ?>"></script>
    <?php } ?>
    <script src="<?php echo get_template_directory_uri() . '/assets/vendors/micromodal.min.js'; ?>"></script>
    
    <script>
        document.addEventListener("DOMContentLoaded", function(){
            MicroModal.init({
                awaitCloseAnimation: true,
                disableScroll: true,
            });
        });

        $('.close-2').click(function(e) {
            if (e.target !== e.currentTarget) return;
            MicroModal.close('modal-2');
            $('#modal-1 > div > div').css('overflow', "");
            $('#loader').removeClass('hidden');
            $('#loaded-content').remove();
        });

        // var testDivElement = document.getElementById('sitemap-container');

        function savePDF() {
            var imgData;
            // $('#sitemap-container').css('overflow','visible');
            var divHeight = $('#sitemap-container').innerHeight();
            var divWidth = $('#sitemap-container').width();
            var divWidth = $('#modal-1-content').width();
            
            var pdf = new jsPDF('p', 'pt', 'a4');
            pdf.text(25, 25, "<?php echo get_the_title();?> Sitemap");
            pdf.addHTML($('#modal-1-content')[0], 25, 50, function() {
                pdf.save('<?php echo get_the_title();?>-sitemap.pdf');
                // pdf.output('datauri');
            }).then(function() {
                $('#downloadPDF').css('opacity', '1');
                $('#downloadPDF').removeAttr('disabled');
            });

            // html2canvas($("#sitemap-container").get(0), {
            //     windowHeight: 5000,
            //     windowWidth: 5000,
            //     // windowWidth: 3000,
            //     // windowHeight: 3000,
            //     useCORS: true,
            //     allowTaint: true,
            //     onrendered: function (canvas) {
            //         console.log(canvas);
            //         document.body.appendChild(canvas);
            //         imgData = canvas.toDataURL(
            //         'image/jpeg');
            //         var doc = new jsPDF('p', 'pt', 'a4');
            //             console.log('container width', divWidth);
            //             console.log('container height', divHeight);
            //             var width = doc.internal.pageSize.width;
            //             console.log('width', width);
            //             var ratio = (divWidth / divHeight);    
            //             console.log('ratio', ratio);
            //             var height = (width / ratio);
            //             console.log('height', height);
            //         doc.internal.scaleFactor = 1.40337;
            //         doc.addImage(imgData, 'JPEG', 0, 0, width, height);
            //         doc.save('<?php //echo get_the_title(); ?>-sitemap.pdf');
            //         // $('#sitemap-container').css('overflow','');
            //         $('#downloadPDF').css('opacity', '1');
            //         $('#downloadPDF').removeAttr('disabled');
            //     }
            // });
        }

        $('#downloadPDF').click(function() {
            $(this).css('opacity', '0');
            $('#downloadPDF').prop('disabled', true);
            savePDF();
        });
    </script>
<?php } ?>