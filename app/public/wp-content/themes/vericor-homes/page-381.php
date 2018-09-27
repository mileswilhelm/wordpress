<?php 
    /* Homeowners */
    get_header();
?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/assets/vendors/micromodal.css'; ?>">

	<div id="primary" class="content-area font-sans relative">

		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

		endwhile; // End of the loop.
		?>

        <!-- if logged out -->
        <?php if( !is_user_logged_in() ) { ?>

		<section class="py-12">
			<div class="container mx-auto px-3">
                <h1 class="capitalize font-normal mb-10 lg:text-3xl text-center text-2xl xl:text-4xl">Welcome Vericor Homeowners!</h1>
                <div class="flex flex-wrap">
                    <div class="w-full mb-4 lg:mb-0 lg:w-1/2 lg:pr-6 wp-content leading-normal">
                        <?php the_content(); ?>
                    </div>
                    <div class="w-full lg:w-1/2 lg:pl-6">
                        <div class="rounded shadow-md w-full pb-4">
                            <div class="bg-blue h-12 rounded text-center text-white flex justify-center items-center rounded-b-none">
                                <h2 class="font-thin">Homeowner Portal</h2>
                            </div>
                            <form class="mb-4 p-4" action="/wp-login.php" method="post">
                                <div class="mb-4">
                                    <label class="block text-blue text-sm font-bold mb-2" for="log">
                                        Username
                                    </label>
                                    <input class="appearance-none block w-full border border-blue rounded py-3 px-4 mb-3 leading-tight focus:border-black shadow" id="log" name="log" type="text" placeholder="Username">
                                </div>
                                <div class="mb-6">
                                    <label class="block text-blue text-sm font-bold mb-2" for="pwd">
                                        Password
                                    </label>
                                    <input class="appearance-none block w-full border border-blue rounded py-3 px-4 mb-3 leading-tight focus:border-black shadow" name="pwd" id="pwd" type="password" placeholder="******************">
                                </div>
                                <div class="flex items-center justify-between">
                                    <button class="bg-blue text-white font-semibold py-3 px-6 border border-blue rounded shadow hover:shadow-md w-full md:w-1/2 flex justify-center mx-auto" name="submit" id="submit" type="submit">
                                        Sign In
                                    </button>
                                </div>
                                <input type="hidden" name="redirect_to" value="/homeowners" />
                            </form>
                            <p class="mb-4 text-center">Don't have a log-in? <span data-micromodal-trigger="modal-2" class="text-blue underline font-bold cursor-pointer">Register here!</span></p>
                            <p class="text-center">Forgot your log-in or password? <a href="<?php echo get_site_url(); ?>/wp-login.php?action=lostpassword" class="text-blue underline font-bold">Click here</a> to recover it</p>
                        </div>
                    </div>
                </div>
			</div>
            <div class="micromodal-slide modal" id="modal-2" aria-hidden="false">
                <div class="modal__overlay close-2" tabindex="-1" data-micromodal-close="">
                    <div class="modal__container font-sans shadow-lg relative w-full mx-2 lg:w-1/2 xl:w-2/5 lg:mx-0 border-t-8 border-yellow mb-auto" style="padding: 1rem 1.5rem;margin-top:4%;" role="dialog" id="register-container" aria-modal="true" aria-labelledby="modal-2-title">
                        <header class="modal__header mb-4 flex-wrap">
                            <h2 class="text-3xl text-center w-full" id="modal-2-title">
                                Account Registration
                            </h2>
                        </header>
                        <div class="modal__content relative" id="modal-2-content">
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
                            <!-- Form -->
                            <form class="w-full flex flex-wrap" id="register-form" method="post" action="<?php echo get_template_directory_uri() . '/functions/insert-user.php';?>">
                                <div class="w-full">
                                    <div class="flex flex-wrap w-full">
                                        <div class="w-full">
                                            <label class="block uppercase tracking-wide text-blue text-sm lg:text-xs font-bold mb-2" for="user_login">
                                                Username
                                                <span class="text-red text-xl">*</span>
                                            </label>
                                            <input class="appearance-none block w-full border border-blue rounded py-3 px-4 mb-3 leading-tight focus:border-black shadow" id="user_login" name="user_login" type="text" placeholder="username" required>
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap w-full">
                                        <div class="w-full">
                                            <label class="block uppercase tracking-wide text-blue text-sm lg:text-xs font-bold mb-2" for="first_name">
                                                First Name
                                                <span class="text-red text-xl">*</span>
                                            </label>
                                            <input class="appearance-none block w-full border border-blue rounded py-3 px-4 mb-3 leading-tight focus:border-black shadow" id="first_name" name="first_name" type="text" placeholder="Jane" required>
                                        </div>
                                        <div class="w-full">
                                            <label class="block uppercase tracking-wide text-blue text-sm lg:text-xs font-bold mb-2" for="last_name">
                                                Last Name
                                                <span class="text-red text-xl">*</span>
                                            </label>
                                            <input class="appearance-none block w-full border border-blue rounded py-3 px-4 mb-3 leading-tight focus:border-black shadow" id="last_name" name="last_name" type="text" placeholder="Doe" required>
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap w-full">
                                        <div class="w-full">
                                            <label class="block uppercase tracking-wide text-blue text-sm lg:text-xs font-bold mb-2" for="user_email">
                                                Email Address
                                                <span class="text-red text-xl">*</span>
                                            </label>
                                            <input class="appearance-none block w-full border border-blue rounded py-3 px-4 mb-3 leading-tight focus:border-black shadow" id="user_email" name="user_email" type="email" placeholder="janedoe@gmail.com" required>
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap w-full">
                                        <div class="w-full">
                                            <label class="block uppercase tracking-wide text-blue text-sm lg:text-xs font-bold mb-2" for="direct_number">
                                                Phone Number
                                                <span class="text-red text-xl">*</span>
                                            </label>
                                            <input class="appearance-none block w-full border border-blue rounded py-3 px-4 mb-3 leading-tight focus:border-black shadow" id="direct_number" name="direct_number" type="tel" placeholder="5551234567" required>
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap w-full">
                                        <div class="w-full">
                                            <label class="block uppercase tracking-wide text-blue text-sm lg:text-xs font-bold mb-2" for="direct_address">
                                                Address
                                                <span class="text-red text-xl">*</span>
                                            </label>
                                            <input class="appearance-none block w-full border border-blue rounded py-3 px-4 mb-3 leading-tight focus:border-black shadow" id="direct_address" name="direct_address" type="text" placeholder="123 Example St Midlothian, VA 23112" required>
                                        </div>
                                    </div>
                                    <button class="bg-blue text-white font-semibold py-3 px-6 border border-blue rounded shadow w-full md:w-1/2 flex justify-center mx-auto mt-4" id="registerSubmit">
                                        Submit
                                    </button>
                                </div>
                                <input name="redirect_to" value="/homeowners" type="hidden">
                                <input name="type" value="confirm" type="hidden">
                                <input name="user_insert" value="<?php echo get_template_directory_uri();?>/functions/insert-user.php" type="hidden">
                            </form>
                            <!-- end Form -->
                        </div>
                    </div>
                </div>
            </div>
		</section>

        <?php } else { ?>

            <!-- if logged in -->
            <?php
                $homeowners_logged_in_copy = get_field('homeowners_logged_in_copy');
                $important_homeowner_documents = get_field('important_homeowner_documents');
                $user_first_name = wp_get_current_user()->user_firstname;
                $user_last_name = wp_get_current_user()->user_lastname;
            ?>
            <section class="py-12">
                
			    <div class="container mx-auto px-3 relative">
                    
                    <div class="mb-12">
                        <h1 class="capitalize font-normal mb-10 lg:text-3xl text-center text-2xl xl:text-4xl">Homeowner Portal</h1>
                        <a href="<?php echo get_site_url(); ?>/wp-login.php?action=logout&redirect_to=%2Fhomeowners" class="bg-white hover:bg-blue text-blue hover:text-white font-semibold py-3 px-6 border-2 border-blue rounded shadow hover:shadow-md flex justify-center mx-auto relative md:absolute pin-t pin-l mb-8 md:mb-0 -mt-4 md:-mt-0" id="formLogin">
                            <svg viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="fill-current w-4 h-4 mr-2 inline-flex">
                                <g id="Page-1" stroke="none" stroke-width="1" fill-rule="evenodd">
                                    <g id="icon-shape">
                                        <path d="M0,10 C0,15.5228475 4.4771525,20 10,20 C15.5228475,20 20,15.5228475 20,10 C20,4.4771525 15.5228475,1.01453063e-15 10,0 C4.4771525,-1.01453063e-15 3.55271368e-15,4.4771525 0,10 L0,10 Z M2,10 C2,14.418278 5.581722,18 10,18 C14.418278,18 18,14.418278 18,10 C18,5.581722 14.418278,2 10,2 C5.581722,2 2,5.581722 2,10 L2,10 Z M10,8 L10,12 L15,12 L15,8 L10,8 L10,8 Z M5,10 L10,15 L10,5 L5,10 L5,10 Z" id="Combined-Shape"></path>
                                    </g>
                                </g>
                            </svg>
                            Log Out
                        </a>
                        <div class="flex flex-wrap mb-2">
                            <div class="w-full mb-2">
                                <h2 class="font-serif text-blue text-2xl md:text-3xl lg:text-4xl">Hello, <?php echo $user_first_name.' '.$user_last_name; ?> </h2>
                            </div>
                            <div class="w-full wp-content leading-normal">
                                <?php echo $homeowners_logged_in_copy; ?>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <button class="bg-yellow text-blue font-thin py-3 px-6 border border-yellow rounded shadow hover:shadow-md w-full md:w-1/2 flex justify-center mx-auto text-xl xl:text-2xl" id="serviceRequest" data-micromodal-trigger="modal-1">
                                Homeowner Service Request
                            </button>
                        </div>
                    </div>
                </div>
                <div class="-mb-12 py-12 bg-gray-lightest">
                    <div class="container mx-auto px-3">
                        <h2 class="capitalize font-normal mb-10 lg:text-3xl text-center text-2xl xl:text-4xl">Important Homeowner Documents</h2>
                        <div class="flex flex-wrap flex-row justify-center items-center">
                            <?php if ( have_rows('important_homeowner_documents') ) { ?>
                                <?php while ( have_rows('important_homeowner_documents') ) : the_row(); 
                                    $document_title = get_sub_field('document_title');
                                    $document_preview_image = get_sub_field('document_preview_image');
                                    $document = get_sub_field('document');
                                ?>
                                    <!-- for each homeowner document -->
                                    <div class="w-full md:w-1/2 lg:w-1/3 mb-4 md:mb-6 lg:mb-8 px-2 md:px-3 lg:px-4 homeowner-document-item">
                                        <div class="rounded shadow-md hover:shadow-lg p-4 flex flex-col flex-wrap justify-center items-center bg-white">
                                            <img src="<?php echo $document_preview_image['url'];?>" class="mb-4 w-3/4">
                                            <h3 class="mb-4"><?php echo $document_title;?></h3>
                                            <div class="flex items-center justify-between w-full">
                                                <a href="<?php echo $document['url'];?>" class="bg-blue text-white font-semibold py-3 px-6 border border-blue rounded shadow hover:shadow-md flex justify-center mx-auto">
                                                <svg viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="fill-current h-4 inline-flex mr-4 w-4">
                                                    <g id="Page-1" stroke="none" stroke-width="1" fill-rule="evenodd">
                                                        <g id="icon-shape">
                                                            <path d="M9,10 L7,10 L7,12 L9,12 L9,14 L11,14 L11,12 L13,12 L13,10 L11,10 L11,8 L9,8 L9,10 Z M4,18 L4,2 L12,2 L12,6 L16,6 L16,18 L4,18 Z M2,19 L2,0 L3,0 L12,0 L14,0 L18,4 L18,6 L18,20 L17,20 L2,20 L2,19 Z" id="Combined-Shape"></path>
                                                        </g>
                                                    </g>
                                                </svg>
                                                <span>Download</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </section>
            <div class="micromodal-slide modal" id="modal-1" aria-hidden="false">
                <div class="modal__overlay close-1" tabindex="-1" data-micromodal-close="">
                    <div class="modal__container font-sans shadow-lg relative w-full mx-2 lg:w-4/5 lg:mx-0 border-t-8 border-yellow mb-auto" style="padding: 1rem 1.5rem;" role="dialog" id="service-request-container" aria-modal="true" aria-labelledby="modal-1-title">
                        <header class="modal__header mb-6 flex-wrap">
                            <h2 class="text-3xl text-center w-full mb-4" id="modal-1-title">
                                Homeowner Service Request
                            </h2>
                            <h3 class="capitalize font-normal lg:text-xl text-center text-lg text-blue w-full text-center">Tell us how we can best serve you.</h3>
                        </header>
                        <div class="modal__content relative" id="modal-1-content">
                            <section class="">
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
                                        <form class="w-full flex flex-wrap" id="contact-form" method="post" action="<?php echo get_template_directory_uri() . '/functions/homeowner-form.php';?>">

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
                                                            Homeowner Contact Email
                                                            <span class="text-red text-xl">*</span>
                                                        </label>
                                                        <input class="appearance-none block w-full border border-blue rounded py-3 px-4 mb-3 leading-tight focus:border-black shadow" id="email" name="email" type="email" placeholder="janedoe@gmail.com" required>
                                                    </div>
                                                </div>
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
                                                <div class="flex flex-wrap w-full">
                                                    <div class="w-full">
                                                        <label class="block uppercase tracking-wide text-blue text-sm lg:text-xs font-bold mb-2" for="neighborhood">
                                                            Neighborhood
                                                            <span class="text-red text-xl">*</span>
                                                        </label>
                                                        <input class="appearance-none block w-full border border-blue rounded py-3 px-4 mb-3 leading-tight focus:border-black shadow" id="neighborhood" name="neighborhood" type="text" required>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="w-full lg:w-1/2 lg:pl-3 mb-2 lg:mb-0">
                                                <div class="flex flex-wrap w-full mb-5">
                                                    <div class="w-full">
                                                        <fieldset>
                                                            <legend class="block uppercase tracking-wide text-blue text-sm lg:text-xs font-bold mb-2">
                                                                Is this for a scheduled visit?
                                                                <span class="text-red text-xl">*</span>
                                                            </legend>
                                                            <div class="mb-1">
                                                                <input type="radio" id="sixty" name="visit" value="60 Days" required />
                                                                <label class="uppercase tracking-wide text-sm lg:text-xs font-bold ml-2" for="sixty">60 Days</label>
                                                            </div>
                                                            <div class="mb-1">
                                                                <input type="radio" id="elevenmos" name="visit" value="11 Months" required />
                                                                <label class="uppercase tracking-wide text-sm lg:text-xs font-bold ml-2" for="elevenmos">11 Months</label>
                                                            </div>
                                                            <div>
                                                                <input type="radio" id="notscheduled" name="visit" value="Not Scheduled" required />
                                                                <label class="uppercase tracking-wide text-sm lg:text-xs font-bold ml-2" for="notscheduled">Not Scheduled</label>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                                <div class="flex flex-wrap w-full mb-2">
                                                    <div class="w-full">
                                                        <fieldset>
                                                            <legend class="block uppercase tracking-wide text-blue text-sm lg:text-xs font-bold mb-2">
                                                                Have you referenced this issue in your Homeowner's Manual?
                                                                <span class="text-red text-xl">*</span>
                                                            </legend>
                                                            <div class="mb-1">
                                                                <input type="radio" id="manualyes" name="referencedmanual" value="Yes" required />
                                                                <label class="uppercase tracking-wide text-sm lg:text-xs font-bold ml-2" for="manualyes">Yes</label>
                                                            </div>
                                                            <div>
                                                                <input type="radio" id="manualno" name="referencedmanual" value="No" required />
                                                                <label class="uppercase tracking-wide text-sm lg:text-xs font-bold ml-2" for="manualno">No</label>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                                <div class="flex flex-wrap w-full">
                                                    <div class="w-full">
                                                        <label class="block uppercase tracking-wide text-blue text-sm lg:text-xs font-bold mb-2" for="bestcontact">
                                                            What's the best way to reach you?
                                                            <span class="text-red text-xl">*</span>
                                                        </label>
                                                        <input class="appearance-none block w-full border border-blue rounded py-3 px-4 mb-3 leading-tight focus:border-black shadow" id="bestcontact" name="bestcontact" type="text" required>
                                                    </div>
                                                </div>
                                                <div class="flex flex-wrap w-full mb-8">
                                                    <div class="w-full">
                                                        <label class="block uppercase tracking-wide text-blue text-sm lg:text-xs font-bold mb-2" for="requestdescription">
                                                            Please describe the request:
                                                            <span class="text-red text-xl">*</span>
                                                        </label>
                                                        <textarea class="appearance-none block w-full border border-blue rounded py-3 px-4 mb-3 leading-tight focus:border-black shadow" id="requestdescription" name="requestdescription"></textarea>
                                                    </div>
                                                </div>
                                                <button class="bg-blue text-white font-semibold py-3 px-6 border border-blue rounded shadow w-full md:w-1/2 flex justify-center mx-auto" id="formSubmit">
                                                    Submit
                                                </button>
                                            </div>
                                        </form> 
                                        
                                    </div>
                            </section> 
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();
?>
<script src="<?php echo get_template_directory_uri() . '/js/form.js'; ?>"></script>
<script src="<?php echo get_template_directory_uri() . '/js/account-request.js'; ?>"></script>
<script src="<?php echo get_template_directory_uri() . '/assets/vendors/micromodal.min.js'; ?>"></script>

<script>
    document.addEventListener("DOMContentLoaded", function(){
        MicroModal.init({
            awaitCloseAnimation: true,
            disableScroll: true,
        });
    });
</script>