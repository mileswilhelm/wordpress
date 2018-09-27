<?php 
    /* Welcome Agents */
    get_header();
?>

	<div id="primary" class="content-area font-sans relative">

		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

            get_template_part( 'template-parts/content', 'page' );
            
            $mortgage_section_header = get_field('mortgage_section_header');
            $mortgage_company_logo = get_field('mortgage_company_logo');
            $mortgage_company_slogan = get_field('mortgage_company_slogan');
            $mortgage_contact_image = get_field('mortgage_contact_image');
            $mortgage_contact_name = get_field('mortgage_contact_name');
            $mortgage_contact_nmls = get_field('mortgage_contact_nmls');
            $mortgage_contact_address_one = get_field('mortgage_contact_address_one');
            $mortgage_contact_address_two = get_field('mortgage_contact_address_two');
            $mortgage_contact_info_line_one = get_field('mortgage_contact_info_line_one');
            $mortgage_contact_info_line_two = get_field('mortgage_contact_info_line_two');
            $mortgage_contact_info_line_three = get_field('mortgage_contact_info_line_three');

		endwhile; // End of the loop.
		?>

		<section class="py-12">
			<div class="container mx-auto px-3">
                <h1 class="capitalize font-normal mb-10 lg:text-3xl text-center text-2xl xl:text-4xl"><?php echo $mortgage_section_header; ?></h1>
                <div class="flex flex-wrap">
                    <div class="w-full lg:w-1/5 leading-normal">
                        <h2 class="text-blue text-center font-normal text-xl lg:text-2xl xl:text-3xl mb-6"><?php echo $mortgage_company_slogan; ?></h2>
                        <img src="<?php echo $mortgage_company_logo['url']; ?>">
                    </div>
                    <div class="w-full lg:w-3/4 lg:pl-6 wp-content leading-normal">
                        <?php the_content(); ?>
                    </div>
                </div>
			</div>
		</section>

        <!-- Contact Card -->
        <section class="pb-12">
            <div class="container mx-auto px-3">
                <div class="w-full lg:flex lg:justify-center shadow-md hover:shadow-lg">
                    <div class="h-48 lg:h-auto lg:w-1/4 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('<?php echo $mortgage_contact_image['url']; ?>'); background-position: center center; background-size: cover;" alt="<?php echo $mortgage_contact_name; ?>">
                    </div>
                    <div class="bg-white p-5 pt-3 lg:pt-5 flex flex-col justify-between lg:w-1/2 leading-normal">
                        <div class="relative">
                            <p class="font-bold text-xl"><?php echo $mortgage_contact_name; ?></p>
                            <p class="text-gray mb-4">NMLSR#: <?php echo $mortgage_contact_nmls; ?></p>
                            <p class=""><?php echo $mortgage_contact_address_one; ?></p>
                            <p class="mb-4"><?php echo $mortgage_contact_address_two; ?></p>
                            <p class=""><?php echo $mortgage_contact_info_line_one; ?></p>
                            <p class=""><?php echo $mortgage_contact_info_line_two; ?></p>
                            <p class=""><?php echo $mortgage_contact_info_line_three; ?></p>
                            <img class="absolute pin-b pin-r w-24" src="<?php echo get_template_directory_uri() . '/assets/homes-icon.jpg';?>" alt="MBA Member and Equal Housing Opportunity Mortgage Lender">
                        </div>
                    </div>
                    <div class="bg-white lg:rounded-r rounded-b lg:rounded-b-none lg:rounded-r text-center lg:w-1/4 flex flex-col items-center justify-between py-5">
                        <img class="w-1/2 hidden lg:inline" src="<?php echo $mortgage_company_logo['url']; ?>">
                        <a href="https://www.benchmarkmortgage.com/rob/" target="_blank" rel="noopener noreferrer" class="bg-transparent hover:bg-blue text-blue font-bold hover:text-white py-3 px-8 border border-blue hover:border-transparent mx-auto inline-block uppercase rounded-sm text-lg">Contact Now</a>
                    </div>
                </div>
            </div>
        </section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();
?>
