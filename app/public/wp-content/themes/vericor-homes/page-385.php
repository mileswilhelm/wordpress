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

		endwhile; // End of the loop.
		?>

		<section class="py-12">
			<div class="container mx-auto px-3">
                <h1 class="capitalize font-normal mb-10 lg:text-3xl text-center text-2xl xl:text-4xl">We Value Our Relationship With Agents!</h1>
                <div class="flex flex-wrap">
                    <div class="w-full wp-content leading-normal">
                        <?php the_content(); ?>
                    </div>
                    <div class="w-full lg:w-1/2 hidden">
                    
                    </div>
                </div>
			</div>
		</section>

        <section class="py-12 bg-yellow-lighter">
			<div class="container mx-auto px-3">
                <h2 class="capitalize font-normal mb-10 lg:text-3xl text-center text-2xl xl:text-4xl text-blue">Join our Real Estate Agent Incentive Program!</h2>
                <div class="flex flex-wrap">
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
                    <form class="w-full flex flex-wrap" id="contact-form" method="post" action="<?php echo get_template_directory_uri() . '/functions/agent-form.php';?>">

                        <div class="w-full lg:w-1/2 lg:pr-3 mb-4 lg:mb-0">
                            <div class="flex flex-wrap w-full mb-2">
                                <div class="w-full md:w-1/2 md:pr-3 mb-2 md:mb-0">
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
                            <div class="flex flex-wrap w-full mb-2">
                                <div class="w-full">
                                    <label class="block uppercase tracking-wide text-blue text-sm lg:text-xs font-bold mb-2" for="email">
                                        Email Address
                                        <span class="text-red text-xl">*</span>
                                    </label>
                                    <input class="appearance-none block w-full border border-blue rounded py-3 px-4 mb-3 leading-tight focus:border-black shadow" id="email" name="email" type="email" placeholder="janedoe@gmail.com" required>
                                </div>
                            </div>
                            <div class="flex flex-wrap w-full mb-2 pt-1">
                                <div class="w-full">
                                    <label class="block uppercase tracking-wide text-blue text-sm lg:text-xs font-bold mb-2" for="phone">
                                        Phone Number
                                    </label>
                                    <input class="appearance-none block w-full border border-blue rounded py-3 px-4 mb-3 leading-tight focus:border-black shadow" id="phone" name="phone" type="phone" placeholder="757-555-1234">
                                </div>
                            </div>
                            <div class="flex flex-wrap w-full">
                                <div class="w-full">
                                    <label class="block uppercase tracking-wide text-blue text-sm lg:text-xs font-bold mb-2" for="company">
                                        Company
                                        <span class="text-red text-xl">*</span>
                                    </label>
                                    <input class="appearance-none block w-full border border-blue rounded py-3 px-4 mb-3 leading-tight focus:border-black shadow" id="company" name="company" type="text" placeholder="Company Name" required>
                                </div>
                            </div>
                        </div> <!-- end of 1st half -->
                        <div class="w-full lg:w-1/2 lg:pl-3 mb-2 lg:mb-0">
                            <div class="flex flex-wrap w-full mb-2">
                                <div class="w-full">
                                    <label class="block uppercase tracking-wide text-blue text-sm lg:text-xs font-bold mb-2" for="staddress">
                                        Street Address
                                        <span class="text-red text-xl">*</span>
                                    </label>
                                    <input class="appearance-none block w-full border border-blue rounded py-3 px-4 mb-3 leading-tight focus:border-black shadow" id="staddress" name="staddress" type="text" placeholder="12507 East Boundary Road" required>
                                </div>
                            </div>
                            <div class="flex flex-wrap justify-between xl:mb-2">
                                <div class="flex flex-wrap w-full xl:w-64 mb-2 xl:mb-0">
                                    <div class="w-full">
                                        <label class="block uppercase tracking-wide text-blue text-sm lg:text-xs font-bold mb-2" for="city">
                                            City
                                            <span class="text-red text-xl">*</span>
                                        </label>
                                        <input class="appearance-none block w-full border border-blue rounded py-3 px-4 mb-3 leading-tight focus:border-black shadow" id="city" name="city" type="text" placeholder="Midlothian" required>
                                    </div>
                                </div>
                                <div class="flex flex-wrap w-full xl:w-24 mb-2 xl:mb-0">
                                    <div class="w-full">
                                        <label class="block uppercase tracking-wide text-blue text-sm lg:text-xs font-bold mb-2" for="state">
                                            State
                                            <span class="text-red text-xl">*</span>
                                        </label>
                                        <input class="appearance-none block w-full border border-blue rounded py-3 px-4 mb-3 leading-tight focus:border-black shadow" id="state" name="state" type="text" placeholder="VA" required>
                                    </div>
                                </div>
                                <div class="flex flex-wrap w-full xl:w-48 mb-2 xl:mb-0">
                                    <div class="w-full">
                                        <label class="block uppercase tracking-wide text-blue text-sm lg:text-xs font-bold mb-2" for="zip">
                                            Zip Code
                                            <span class="text-red text-xl">*</span>
                                        </label>
                                        <input class="appearance-none block w-full border border-blue rounded py-3 px-4 mb-3 leading-tight focus:border-black shadow" id="zip" name="zip" type="text" placeholder="23112" required>
                                    </div>
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
                            <button class="bg-blue text-white font-semibold py-3 px-6 border border-blue rounded shadow w-full md:w-1/2 flex justify-center mx-auto" id="formSubmit">
                                Submit
                            </button>
                        </div> <!-- end of 2nd half -->
                    </form> <!-- form -->
                    
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
