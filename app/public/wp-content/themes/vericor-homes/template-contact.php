<?php
/*
    Template Name: Contact Us Template
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
            
            $address_one = get_field('address_one');
            $address_two = get_field('address_two');
            $office_phone_number = get_field('office_phone_number');
            $fax_number = get_field('fax_number');
            $email_address = get_field('email_address');

		endwhile; // End of the loop.
		?>

		<section class="py-12">
			<div class="container mx-auto px-3">
				<div class="flex flex-wrap">
                    <div class="w-full lg:w-3/4 lg:pr-6 mb-10 lg:mb-0">
                        <div class="hidden mb-5 w-full relative" id="alertWrapper">
                            <div class="bg-blue-lightest border-blue border-t-2 px-4 py-3 shadow shadow-md text-blue" role="alert" id="form-alert">
                                <span class="absolute close mr-3 mt-3 pin-r pin-t">
                                    <svg viewport="0 0 15 15" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                        <line x1="1" y1="15" x2="15" y2="1" stroke-width="3"></line>
                                        <line x1="1" y1="1" x2="15" y2="15" stroke-width="3"></line>
                                    </svg>
                                </span>
                                <p class="font-bold" id="formMessage"></p>
                                <p class="mt-1 text-md" id="secondaryMessage"></p>
                            </div>
                        </div>
                        <form class="w-full" id="contact-form" method="post" action="<?php echo get_template_directory_uri() . '/functions/contact-form.php';?>">
                            <div class="flex flex-wrap w-full mb-4">
                                <div class="w-full md:w-1/2 md:pr-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-blue text-sm lg:text-xs font-bold mb-2" for="first-name">
                                        First Name
                                        <span class="text-red text-xl">*</span>
                                    </label>
                                    <input class="appearance-none block w-full border border-blue rounded py-3 px-4 mb-3 leading-tight focus:border-black shadow" id="first-name" name="first-name" type="text" placeholder="Jane" required>
                                </div>
                                <div class="w-full md:w-1/2 md:pl-3">
                                    <label class="block uppercase tracking-wide text-blue text-sm lg:text-xs font-bold mb-2" for="last-name">
                                        Last Name
                                        <span class="text-red text-xl">*</span>
                                    </label>
                                    <input class="appearance-none block w-full border border-blue rounded py-3 px-4 mb-3 leading-tight focus:border-black shadow" id="last-name" name="last-name" type="text" placeholder="Doe" required>
                                </div>
                            </div>
                            <div class="flex flex-wrap w-full mb-5">
                                <div class="w-full">
                                    <label class="block uppercase tracking-wide text-blue text-sm lg:text-xs font-bold mb-2" for="email">
                                        Email Address
                                        <span class="text-red text-xl">*</span>
                                    </label>
                                    <input class="appearance-none block w-full border border-blue rounded py-3 px-4 mb-3 leading-tight focus:border-black shadow" id="email" name="email" type="email" placeholder="janedoe@gmail.com" required>
                                </div>
                            </div>
                            <div class="flex flex-wrap w-full mb-5 pt-1">
                                <div class="w-full">
                                    <label class="block uppercase tracking-wide text-blue text-sm lg:text-xs font-bold mb-2" for="phone">
                                        Phone Number
                                    </label>
                                    <input class="appearance-none block w-full border border-blue rounded py-3 px-4 mb-3 leading-tight focus:border-black shadow" id="phone" name="phone" type="phone" placeholder="757-555-1234">
                                </div>
                            </div>
                            <div class="flex flex-wrap w-full mb-5 pt-1">
                                <div class="w-full">
                                    <label class="block uppercase tracking-wide text-blue text-sm lg:text-xs font-bold mb-2" for="comments">
                                        Comments/Questions
                                    </label>
                                    <textarea class="appearance-none block w-full border border-blue rounded py-3 px-4 mb-3 leading-tight focus:border-black shadow" id="comments" name="comments" placeholder="Comments/Questions"></textarea>
                                </div>
                            </div>
                            <button class="bg-blue text-white font-semibold py-3 px-6 border border-blue rounded shadow w-full md:w-1/2" id="formSubmit">
                                Submit
                            </button>
                        </form> <!-- form -->
                    </div>
                    <div class="w-full lg:w-1/4 lg:pl-3">
                        <div class="leading-normal text-center lg:text-left">
                            <h3 class="text-blue font-serif text-4xl">Vericor Homes</h3>
                            <address class="mb-3">
                                <?php echo $address_one;?><br>
                                <?php echo $address_two;?>
                            </address>
                            <div class="mb-3">
                                <p class="text-2xl font-bold mb-1">Office Phone:</p>
                                <a href="tel:1<?php echo $office_phone_number; ?>" class="text-xl text-blue hover:underline"><?php echo $office_phone_number; ?></a>
                            </div>
                            <?php if ( $fax_number ) { ?>
                                <div class="mb-3">
                                    <p class="text-2xl font-bold mb-1">Fax Number:</p>
                                    <a href="tel:1<?php echo $fax_number; ?>" class="text-xl text-blue hover:underline"><?php echo $fax_number ; ?></a>
                                </div>
                            <?php } ?>
                            <?php if ( $email_address ) { ?>
                                <p class="text-2xl font-bold mb-1">Email:</p>
                                <a href="mailto:<?php echo $email_address; ?>" class="text-xl text-blue hover:underline"><?php echo $email_address ; ?></a>
                            <?php } ?>
                        </div>
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
<script src="<?php echo get_template_directory_uri() . '/js/form.js'; ?>"></script>