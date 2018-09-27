<?php
/**
 * Template for displaying search forms in Vericor Homes
 *
 * @package Vericor_Homes
 */

?>

<?php $unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>
<div class="container mx-auto text-center">

        
            <label class="block text-gray text-sm font-bold mb-2 text-left w-full md:w-1/2 mx-auto" for="<?php echo $unique_id; ?>">
                <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'twentyseventeen' ); ?></span>
            </label>
            <form role="search" method="get" class="flex justify-center mx-auto search-form shadow w-full md:w-1/2" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <div class="flex-1">
                    <input class="appearance-none border border-blue border-r-0 focus:outline-none focus:shadow-outline leading-tight px-3 py-2 rounded rounded-r-none text-gray w-full h-10" type="search" id="<?php echo $unique_id; ?>" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'twentyseventeen' ); ?>" value="<?php echo get_search_query(); ?>" name="s">
                </div>
                <div class="">
                    <button class="bg-blue border-l-0 border-blue border focus:outline-none focus:shadow-outline font-bold text-white px-4 py-2 rounded rounded-l-none h-10" type="submit" >
                        <span class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'twentyseventeen' ); ?></span>
                    </button>
                </div>
            </form>

    </form>
</div>

