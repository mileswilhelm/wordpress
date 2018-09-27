document.addEventListener("DOMContentLoaded", function(){
	// Get the form.
	var form = $('#contact-form');

    // Get the messages nodes.
    var alertBody = $('#formAlert');
    var alertWrapper = $('#alertWrapper');
	var formMessage = $('#formMessage');
	var secondaryMessage = $('#secondaryMessage');

	var resetForm = function() {
		$('#contact-form')[0].reset();
	};

	$('#formReset').click(function() {
		resetForm();
	});

	// Set up an event listener for the contact form.
	$('#contact-form').submit(function(event) {
		// Stop the browser from submitting the form.
		event.preventDefault();
		// $('#img').show();
		// Serialize the form data.
		var formData = $('#contact-form').serialize();
		
		// Submit the form using AJAX.
		$.ajax({
			type: 'POST',
			url: $('#contact-form').attr('action'),
			data: formData,
			beforeSend: function() {
				$('#formSubmit').prop('disabled', true);
			}
		}).done(function(response) {
			// Make sure that the formMessages div has the 'success' class.
			$(alertBody).removeClass('bg-red-lightest border-red text-red');
            $(alertBody).addClass('bg-blue-lightest border-blue text-blue');
            $(alertWrapper).removeClass('hidden');

			// Set the message texts.
			$(formMessage).text('Thank You!');
			$(secondaryMessage).text(response);

			// Clear the form.
			resetForm();
			$('#formSubmit').removeAttr('disabled');
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
			$('#formSubmit').removeAttr('disabled');
		});
	});
});