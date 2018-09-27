<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $lotItems = json_decode(strip_tags($_POST["items"]));
        $startIndex = strip_tags($_POST["startIndex"]);
        $postid = strip_tags($_POST["id"]);

        if ( !isset($startIndex) ) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Oops! The start index wasn't found, so the function ended early.";
            exit;
        }

        if ( empty($postid) ) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Oops! The specific post to update wasn't found, so the function ended early.";
            exit;
        }

        // exit;

        //get how many rows exist in sitemap_lot_data
        define( 'WP_USE_THEMES', false ); // Don't load theme support functionality
        $path = $_SERVER["DOCUMENT_ROOT"];
        require_once($path.'/wp-load.php');

        $post_query = new WP_Query(
            array(
                'post_type' => 'page',
                'p' => $postid
            )
        );

        // The Loop
        if ( $post_query->have_posts() ) {
            while ( $post_query->have_posts() ) {
                $post_query->the_post();
                $sitemap_lot_data = get_field('sitemap_lot_data');
                while ( have_rows('sitemap_lot_data') ): the_row();
                    $row_index = get_row_index();
                    // the function delete_row reindexes all of the rows after one is deleting
                    // so always delete the first row in order to delete them all
                    delete_row( 'sitemap_lot_data', 1);
                    echo 'Row '.$row_index.' deleted. | ';
                endwhile;

                if ( $lotItems ) {
                    foreach( $lotItems as $item ) {
        
                        $data = array(
                            'label' => $item->label,
                            'linked_inventory' => $item->inventory,
                            'status' => $item->status,
                            'top_position' => $item->top,
                            'left_position' => $item->left,
                            'available_models' => $item->models
                        );
                        // print_r($data);
                        $runAdd = add_row( 'sitemap_lot_data', $data );
                        echo 'Row added successfully.';
                    }
                }

            }
            wp_reset_postdata();
        }

        // print_r($items);

    }