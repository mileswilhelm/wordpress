<?php
    $modelsID = $_POST['modelsID'];
    $modelsID = json_decode($modelsID);

    define( 'WP_USE_THEMES', false ); // Don't load theme support functionality
    $path = $_SERVER["DOCUMENT_ROOT"];
    require_once($path.'/wp-load.php');

    $post_query = new WP_Query(
        array(
            'post_type' => 'page',
            'post__in' => $modelsID
        )
    );
    if ( $post_query->have_posts() ) { ?>
        
        <div class="flex flex-wrap" id="loaded-content">
        <h1 class="text-3xl text-center w-full mb-4">Build One Of These Models On This Homesite</h1>
        
        <?php
        while ( $post_query->have_posts() ) {
            $post_query->the_post();

            $postID = get_the_ID();
            $model_title = get_the_title();

            $bedrooms = get_field('bedrooms');
            $bathrooms = get_field('bathrooms');
            $stories = get_field('stories');
            $square_feet = get_field('square_feet');
            $garage = get_field('garage');
            $master = get_field('master');
            $price = get_field('price');
            $starting_from_price = get_field('starting_from_price');
        ?>
            <div class="pb-4 mb-4 border-b-2 border-yellow border-dashed flex flex-wrap repeater-model-item">
                <div class="w-full mb-4 text-center leading-tight">
                    <h2 class="capitalize font-normal font-serif text-3xl text-blue"><?php echo $model_title; ?></h2>
                </div>
                <div class="w-1/2 mb-4">
                    <?php echo get_the_post_thumbnail( $postID, '', array( 'class' => 'w-full' ) ); ?>
                </div>
                <div class="w-1/2">
                    <!-- info -->
                    <div class="mb-5 pl-6 leading-normal">
                        <?php if ( $starting_from_price ) { ?>
                            <p class="text-blue text-xl lg:text-2xl text-center mb-3"><strong>Base Price: <?php echo $starting_from_price; ?></strong></p>
                        <?php } else if ( $price ) { ?>
                            <p class="text-blue text-3xl text-center mb-3"><strong>Base Price: $<?php echo $price; ?></strong></p>
                        <?php } else { ?>
                            <p class="text-blue text-3xl text-center mb-3"><strong>Price: Call Today!</strong></p>                        
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
                    <a href="<?php echo get_the_permalink(); ?>" class="bg-blue text-white font-bold py-3 px-8 shadow hover:shadow-lg mx-auto inline-block uppercase rounded-sm">View More About This Model</a>
                </div>
            </div>
        <?php } //endwhile ?>

        </div>
        
        <?php
    } //endif
?>