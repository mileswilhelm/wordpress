document.addEventListener("DOMContentLoaded", function(){
	// Get the form.
	var form = $('#register-form');

    // Get the messages nodes.
    var alertBody = $('#form-alert');
    var alertWrapper = $('#alertWrapper');
	var formMessage = $('#formMessage');
	var secondaryMessage = $('#secondaryMessage');

	var resetForm = function() {
		$('#register-form')[0].reset();
	};

	$('#formReset').click(function() {
		resetForm();
	});

	// Set up an event listener for the contact form.
	$('#register-form').submit(function(event) {
		// Stop the browser from submitting the form.
		event.preventDefault();
		// $('#img').show();
		// Serialize the form data.
		var formData = $('#register-form').serialize();
		
		// Submit the form using AJAX.
		$.ajax({
			type: 'POST',
			url: $('#register-form').attr('action'),
			data: formData,
			beforeSend: function() {
				$('#registerSubmit').prop('disabled', true);
			}
		}).done(function(response, textStatus, xhr) {
            console.log(response);
            if( response == 'ERROR001' || response == 'ERROR002' || response == 'ERROR001ERROR002' ) {
                $(alertBody).removeClass('bg-blue-lightest border-blue text-blue');
                $(alertBody).addClass('bg-red-lightest border-red text-red');
                $(alertWrapper).removeClass('hidden');

                $(formMessage).text('Oops! An error occured:');

                if ( response == 'ERROR001ERROR002' ) {
                    $(secondaryMessage).text('Both the username and email address are already taken. Please try another one.');
                    $('#user_login').addClass('bg-red-lightest');
                    $('#user_email').addClass('bg-red-lightest');
                }
                if ( response == 'ERROR001' ) {
                    $(secondaryMessage).text('This username is already taken. Please try another one.');
                    $('#user_login').addClass('bg-red-lightest');
                    $('#user_email').removeClass('bg-red-lightest');
                }
                if ( response == 'ERROR002') {
                    $(secondaryMessage).text('This email address is already taken. Please try another one.');
                    $('#user_login').removeClass('bg-red-lightest');
                    $('#user_email').addClass('bg-red-lightest');
                }

                $('#registerSubmit').removeAttr('disabled');
                return;
            }
            // Make sure that the formMessages div has the 'success' class.
            $('#user_login').removeClass('bg-red-lightest');
            $('#user_email').removeClass('bg-red-lightest');
            
			$(alertBody).removeClass('bg-red-lightest border-red text-red');
            $(alertBody).addClass('bg-blue-lightest border-blue text-blue');
            $(alertWrapper).removeClass('hidden');

			// Set the message texts.
			$(formMessage).text('Thank you for signing up! You will receive an email with log in instructions shortly.');
			$(secondaryMessage).text(response);

			// Clear the form.
			resetForm();
			$('#registerSubmit').removeAttr('disabled');
		}).fail(function(data) {
			// Make sure that the formMessages div has the 'error' class.
			$(alertBody).removeClass('bg-blue-lightest border-blue text-blue');
            $(alertBody).addClass('bg-red-lightest border-red text-red');
            $(alertWrapper).removeClass('hidden');

			// Set the message text.
			if (data.responseText !== '') {
                $(formMessage).text('Oops! An error occured:')
			    $(secondaryMessage).text(data.responseText);
			} else {
                $(formMessage).text('Oops! An error occured and your message could not be sent.');
			    $(secondaryMessage).text('Please try again later or get in touch with us by phone.');
			}
			$('#registerSubmit').removeAttr('disabled');
		});
	});
});