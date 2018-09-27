<?php
get_header();
?>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/assets/vendors/tiny-gallery.css">

	<div id="primary" class="content-area font-sans z-0">
        <header 
            class="hero-image relative bg-gray-lightest"
        >
            <div class="h-full w-full home-gallery">
                <?php
                    $home_gallery = get_field('home_gallery');
                    if( $home_gallery ): 
                ?>
                        <?php foreach( $home_gallery as $hg_image ): ?>
                            <div class="home-gallery-image hero-image">
                                <img class="lazyload w-full hero-image" data-src="<?php echo $hg_image['url']; ?>" alt="<?php echo $hg_image['alt']; ?>"/>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
            </div>
            <div class="absolute flex items-end justify-center mx-auto pb-12 pin-b w-full xl:pb-20">
                <h1 class="text-white font-serif text-4xl md:text-5xl hero-header">Your Life. Your Style.</h1>
            </div>
        </header>
		<main id="main" class="container mx-auto px-3 py-12">

            <h1 class="capitalize font-normal mb-10 lg:text-3xl text-center text-2xl xl:text-4xl">Vericor Homes is now building in these communities:</h1>

            <div class="flex flex-col lg:flex-row lg:justify-around">
                <div class="max-w-md mx-auto lg:max-w-sm rounded overflow-hidden shadow-md hover:shadow-lg mb-10 lg:mb-0">
                    <img class="w-full lazyload" data-src="<?php echo get_template_directory_uri(); ?>/assets/magnolia-green-featured-image.jpg" alt="Magnolia Green Pool and Amenities">
                    <div class="flex px-3 pt-8 pb-4">
                        
                        <div class="w-1/3 text-center">
                            <img class="lazyload" data-src="<?php echo get_template_directory_uri(); ?>/assets/magnolia-green-logo-small.png" alt="Magnolia Green">                            
                        </div>
                        <div class="w-2/3 text-center px-2">
                            <p class="text-grey-darker mb-5">
                                Masterfully planned with bountiful room for growth, a vibrant community filled with a growing array of amenities within Chesterfield County.
                            </p>
                            
                            <address class="font-bold roman">
                                17301<br/>
                                Memorial Tournament Drive<br/>
                                Moseley, VA 23120
                            </address>
                        </div>

                    </div>
                    <div class="px-3 pt-4 pb-8 text-center">
                        <a href="/new-home-communities/magnolia-green" class="bg-transparent hover:bg-blue text-blue font-bold hover:text-white py-3 px-8 border border-blue hover:border-transparent mx-auto inline-block uppercase rounded-sm text-lg">Click Here For More Info</a>
                    </div>
                </div>

                <div class="max-w-md mx-auto lg:max-w-sm rounded overflow-hidden shadow-md hover:shadow-lg">
                    <img class="w-full lazyload" data-src="<?php echo get_template_directory_uri(); ?>/assets/harpers-mill-featured-image.jpg" alt="Harpers Mill Pool">
                    <div class="flex px-3 pt-8 pb-4">
                        
                        <div class="w-1/3 text-center">
                            <img class="lazyload" data-src="<?php echo get_template_directory_uri(); ?>/assets/harpers-mill-logo-small.png" alt="Harpers Mill">
                        </div>
                        <div class="w-2/3 text-center px-2">
                            <p class="text-grey-darker mb-5">
                                Over 240 acres of scenic views, stunning amenity centers, and life-enhancing activities just 25 minutes from the popular Downtown Richmond area.
                            </p>
                            
                            <address class="font-bold roman">
                                8600<br/>
                                Pullman Lane<br/>
                                Chesterfield, VA 23832
                            </address>
                        </div>

                    </div>
                    <div class="px-3 pt-4 pb-8 text-center">
                        <a href="/new-home-communities/harpers-mill" class="bg-transparent hover:bg-blue text-blue font-bold hover:text-white py-3 px-8 border border-blue hover:border-transparent mx-auto inline-block uppercase rounded-sm text-lg">Click Here For More Info</a>
                    </div>
                </div>

            </div>

            <!-- google maps -->
            <div class="lg:px-12 mt-10 relative">
                <div class="bg-blue text-white w-full text-center p-4 leading-normal lg:leading-none">
                    <h3>Let Vericor build you an exceptional home in a community where you'll love to live.</h3>
                </div>
                <div class="w-full h-half" id="community-page-map"></div>
            </div>

        </main><!-- #main -->

        <section class="bg-gray-lighter text-white py-12">
            <div class="container mx-auto px-3 md:px-20">
                <ul class="list-reset flex flex-col sm:flex-row justify-center lg:text-3xl text-center text-2xl xl:text-4xl uppercase md:pt-1">
                    <li class="list-logo-after">Hard Work</li>
                    <li class="list-logo-after sm:mx-10 lg:mx-0 my-5 sm:my-0">Innovation</li>
                    <li>Integrity</li>
                </ul>
            </div>
        </section>

        <section class="bg-yellow-lighter py-12">
            <div class="container mx-auto px-3 md:px-20">
                <p class="text-xl lg:text-2xl text-center leading-normal">Vericor Homes is a different kind of homebuilder—one that uses experience, craftsmanship, and a collaborative approach to give you an exceptional lifestyle homebuilding experience for a space where you will love to live. We believe in a strong commitment to integrity and service to our customers, our trade partners, and our employees.</p>
            </div>
        </section>
	</div><!-- #primary -->

<?php
get_footer();
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.8.6/min/tiny-slider.js"></script>
<script>
    var slider = tns({
        'container': '.home-gallery',
        'lazyload': true,
        'autoplay': true,
        'autoplayTimeout': 10000,
        'speed': 480,
        'mouseDrag': true
    });
</script>