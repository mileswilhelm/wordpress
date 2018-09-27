<?php
/*
    Template Name: Model Template
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.1.6/css/swiper.min.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/assets/vendors/photoswipe.css'; ?>">
<link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/assets/vendors/photoswipe-default-ui.css'; ?>">

	<div id="primary" class="content-area font-sans relative">

		<main id="main" class="site-main">

            <?php
            while ( have_posts() ) :
                the_post();

                // $model_featured_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                // $model_title = get_the_title();
                $bedrooms = get_field('bedrooms');
                $bathrooms = get_field('bathrooms');
                $stories = get_field('stories');
                $square_feet = get_field('square_feet');
                $garage = get_field('garage');
                $master = get_field('master');
                $price = get_field('price');
                $starting_from_price = get_field('starting_from_price');
                $model_photo_gallery = get_field('model_photo_gallery');
                $floor_plans = get_field('floor_plans');
            ?>

            <section class="py-12">       
                <div class="container mx-auto px-3">
                    <header class="entry-header text-center mb-8">
                        <?php the_title( '<h1 class="capitalize font-normal font-serif text-blue text-4xl md:text-5xl">', '</h1>' ); ?>
                        <p class="text-xl text-gray">
                            <a class="hover:underline" href="<?php echo get_the_permalink( $post->post_parent ); ?>"><?php echo get_the_title( $post->post_parent ); ?></a>
                        </p>
                    </header><!-- .entry-header -->
                    <section class="mb-10 relative lg:w-3/4 lg:mx-auto xl:w-4/5">
                        <nav class="model-nav">
                            <ul class="list-reset flex text-lg md:text-xl">
                                <li class="mr-6 active">
                                    <a class="text-blue hover:text-blue-darker" href="#">Elevations</a>
                                </li>
                            </ul>
                        </nav>
                        <div class="swiper-container main gallery">
                            <?php if ($model_photo_gallery) { ?>
                                <div class="w-full swiper-wrapper my-gallery">
                                    <?php $mpgCount = 0; ?>
                                    <?php foreach( $model_photo_gallery as $mpg ): ?>
                                        <!-- <div class="swiper-slide"> -->
                                            <?php 
                                                $metadata = wp_get_attachment_metadata($mpg['ID']);
                                                $width = $metadata['width'];
                                                $height = $metadata['height'];
                                                $source = wp_get_attachment_image_src($mpg['ID'], 'full', false);
                                            ?>
                                            <figure class="swiper-slide" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                                                <a src="<?php echo $source[0]; ?>" itemprop="contentUrl" data-size="<?php echo $width.'x'.$height; ?>" data-index="<?php echo $mpgCount; $mpgCount++; ?>">
                                                    <?php echo wp_get_attachment_image( $mpg['ID'], 'full', false, array( "class" => "cursor-pointer" ) ); ?>
                                                </a>
                                                <figcaption class="-mt-10 pl-4 pb-12 text-white text-xl text-shadow">
                                                    <?php echo $mpg['caption']; ?>
                                                </figcaption>
                                            </figure>
                                        <!-- </div> -->
                                    <?php endforeach; ?>
                                </div>
                                <?php if ( count($model_photo_gallery) > 1 ) {?>
                                    <div class="swiper-button-prev main">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 44"><path d="M0,22L22,0l2.1,2.1L4.2,22l19.9,19.9L22,44L0,22L0,22L0,22z"></svg>
                                    </div>
                                    <div class="swiper-button-next main">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 44"><path d="M27,22L27,22L5,44l-2.1-2.1L22.8,22L2.9,2.1L5,0L27,22L27,22z"></svg>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <?php if ( count($model_photo_gallery) > 1 ) {?>
                            <div class="swiper-pagination main flex w-full justify-center mt-2"></div>
                        <?php } ?>
                    </section>
                    <section class="<?php if( $floor_plans ) { ?>mb-10<?php } ?>">
                        <div class="flex flex-col-reverse lg:flex-row flex-wrap">
                            <div class="lg:w-2/3 lg:pr-3 w-full">
                                <div class="wp-content leading-normal">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                            <div class="mb-5 lg:mb-0 lg:w-1/3 lg:pl-3 w-full leading-normal">
                                <p class="text-blue text-3xl lg:text-3xl text-center mb-3">
                                    <strong>
                                        <span>Base Price:</span>
                                        <?php if($starting_from_price) {
                                            echo '<br><span>'.$starting_from_price.'</span>';
                                        } else {
                                            echo '$'.$price;
                                        }
                                        ?>
                                    </strong>
                                </p>
                                <div class="lg:pl-11">
                                    <p class="text-lg"><strong>Bedrooms</strong>: <?php echo $bedrooms; ?></p>
                                    <p class="text-lg"><strong>Bathrooms</strong>: <?php echo $bathrooms; ?></p>
                                    <p class="text-lg"><strong>Square Feet</strong>: <?php echo $square_feet; ?></p>
                                    <p class="text-lg"><strong>Stories</strong>: <?php echo $stories; ?></p>
                                    <p class="text-lg"><strong>Garage Size</strong>: <?php echo $garage; ?></p>
                                    <p class="text-lg"><strong>Master</strong>: <?php echo $master; ?></p>
                                </div>
                            </div>
                        </div>
                    </section>
                </div> <!-- .container -->
                <?php if( $floor_plans ) { ?>
                    <div class="py-10">
                        <div class="container mx-auto px-3">
                            <h1 class="capitalize font-normal mb-8 font-bold lg:text-3xl text-center text-2xl xl:text-4xl">Floor Plans</h1>

                            <div class="swiper-container fp md:w-2/3 lg:w-3/5 gallery">
                                <?php if ($floor_plans) { ?>
                                    <div class="w-full swiper-wrapper my-gallery">
                                        <?php $fpCount = 0; ?>
                                        <?php foreach( $floor_plans as $fp ): ?>
                                            <!-- <div class="swiper-slide"> -->
                                                <?php 
                                                    $metadata = wp_get_attachment_metadata($fp['ID']);
                                                    $width = $metadata['width'];
                                                    $height = $metadata['height'];
                                                    $source = wp_get_attachment_image_src($fp['ID'], 'full', false);
                                                ?>
                                                <figure class="swiper-slide" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                                                    <a src="<?php echo $source[0]; ?>" itemprop="contentUrl" data-size="<?php echo $width.'x'.$height; ?>" data-index="<?php echo $fpCount; $fpCount++; ?>">
                                                        <?php echo wp_get_attachment_image( $fp['ID'], 'full', false, array( "class" => "cursor-pointer" ) ); ?>
                                                    </a>
                                                    <figcaption class="-mt-10 pl-4 pb-12 text-xl">
                                                        <?php echo $fp['caption']; ?>
                                                    </figcaption>
                                                </figure>
                                            <!-- </div> -->
                                        <?php endforeach; ?>
                                    </div>
                                    <?php if ( count($floor_plans) > 1 ) {?>
                                        <div class="swiper-button-prev fp">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 44"><path d="M0,22L22,0l2.1,2.1L4.2,22l19.9,19.9L22,44L0,22L0,22L0,22z"></svg>
                                        </div>
                                        <div class="swiper-button-next fp">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 44"><path d="M27,22L27,22L5,44l-2.1-2.1L22.8,22L2.9,2.1L5,0L27,22L27,22z"></svg>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                            <?php if ( count($floor_plans) > 1 ) {?>
                                <div class="relative">
                                    <div class="swiper-pagination fp flex w-full justify-center mt-2"></div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </section>

            <?php endwhile; // End of the loop.
            ?>

		</main><!-- #main -->
	</div><!-- #primary -->

    <?php if( $floor_plans || $model_photo_gallery ) { ?>
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
                    <div class="pswp__caption">
                        <div class="pswp__caption__center" style="text-align: center;font-size: 1rem;">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.1.6/js/swiper.min.js"></script>

<?php if ( count($model_photo_gallery) > 1 ) { ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            var swiper = new Swiper('.swiper-container.main', {
                spaceBetween: 100,
                pagination: {
                    el: '.swiper-pagination.main',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next.main',
                    prevEl: '.swiper-button-prev.main',
                },
            });

        });
    </script>
<?php } ?>
<?php if ( $floor_plans ) { ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var swiperFp = new Swiper('.swiper-container.fp', {
                spaceBetween: 100,
                pagination: {
                    el: '.swiper-pagination.fp',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next.fp',
                    prevEl: '.swiper-button-prev.fp',
                },
            });
        });
    </script>
<?php } ?>
<?php if ( $floor_plans || $model_photo_gallery ) { ?>
    <script src="<?php echo get_template_directory_uri() . '/assets/vendors/photoswipe.min.js'; ?>"></script>
    <script src="<?php echo get_template_directory_uri() . '/assets/vendors/photoswipe-ui-default.min.js'; ?>"></script>
    <script>
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
