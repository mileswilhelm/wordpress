<?php
    $inventoryID = $_POST['inventoryID'];

    define( 'WP_USE_THEMES', false ); // Don't load theme support functionality
    $path = $_SERVER["DOCUMENT_ROOT"];
    require_once($path.'/wp-load.php');

    $post_query = new WP_Query(
        array(
            'post_type' => 'page',
            'p' => $inventoryID
        )
    );
    if ( $post_query->have_posts() ) {
        while ( $post_query->have_posts() ) {
            $post_query->the_post();

            $postID = get_the_ID();
            
            $street_address = get_field('street_address');
            $city = get_field('city');
            $state = get_field('state');

            $bedrooms = get_field('bedrooms');
            $bathrooms = get_field('bathrooms');
            $stories = get_field('stories');
            $square_feet = get_field('square_feet');
            $garage = get_field('garage');
            $master = get_field('master');
            $price = get_field('price');
        ?>
            <div class="flex flex-wrap" id="loaded-content">
                <div class="w-full mb-4 text-center leading-tight">
                    <h1 class="capitalize font-normal font-serif text-4xl text-blue"><?php echo $street_address; ?></h1>
                    <p class="text-xl text-gray"><?php echo $city . ', ' . $state; ?></p>
                </div>
                <div class="w-1/2 mb-4">
                    <?php echo get_the_post_thumbnail( $postID, '', array( 'class' => 'w-full' ) ); ?>
                </div>
                <div class="w-1/2">
                    <!-- info -->
                    <div class="mb-5 pl-6 leading-normal">
                        <?php if ( $price ) { ?>
                            <p class="text-blue text-3xl lg:text-3xl text-center mb-3"><strong>Price: $<?php echo $price; ?></strong></p>
                        <?php } else { ?>
                            <p class="text-blue text-3xl lg:text-3xl text-center mb-3"><strong>Price: Call Today!</strong></p>                        
                        <?php } ?>
                        <div class="flex flex-wrap">
                            <p class="text-lg w-1/2"><strong>Bedrooms</strong>: <?php echo $bedrooms; ?></p>
                            <p class="text-lg w-1/2"><strong>Bathrooms</strong>: <?php echo $bathrooms; ?></p>
                            <p class="text-lg w-1/2"><strong>Square Feet</strong>: <?php echo $square_feet; ?></p>
                            <p class="text-lg w-1/2"><strong>Stories</strong>: <?php echo $stories; ?></p>
                            <p class="text-lg w-1/2"><strong>Garage Size</strong>: <?php echo $garage; ?></p>
                            <p class="text-lg w-1/2"><strong>Master</strong>: <?php echo $master; ?></p>
                        </div>
                    </div>
                </div>
                <div class="w-full text-center">
                    <!-- click through -->
                    <a href="<?php echo get_the_permalink(); ?>" class="bg-blue text-white font-bold py-3 px-8 shadow hover:shadow-lg mx-auto inline-block uppercase rounded-sm">View More About This Home</a>
                </div>
            </div>
        <?php } //endwhile
    } //endif
?>