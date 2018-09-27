<?php     
// Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        $firstName = strip_tags(trim($_POST["first-name"]));
        $lastName = strip_tags(trim($_POST["last-name"]));
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $phone = strip_tags(trim($_POST["phone"]));
        $comments = trim($_POST["comments"]);

        // Check that data was sent to the mailer.
        if ( empty($firstName) OR empty($lastName) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Oops! There was a problem with your submission. Please complete the form and try again.";
            exit;
        }

        // Set the recipient email address.
        $recipient = "info@vericorhomes.com";

        // Set the email subject.
        $subject = "Vericor Homes Web Contact";

        // Build the email content.
        if ($firstName && $lastName) {
            $html_name .= "<strong>Name</strong>: $firstName"." $lastName\n";
        } else {
            $html_name .= "<strong>Name</strong>: n/a\n";
        }
       if ($email) {
            $html_email .= "<strong>Email</strong>: $email\n";
        } else {
            $html_email .= "<strong>Email</strong>: n/a\n";
        }
        if ($phone) {
            $html_phone .= "<strong>Phone</strong>: $phone\n";
        } else {
            $html_phone .= "<strong>Phone</strong>: <em>Not provided</em></em>\n";
        }
        $html_message .= "<strong>Comments</strong>:\n$comments\n";

        $html = '<html>
    <body>
        <div style="background-color:#fce7a6;padding:15px;font-size: 18px;box-shadow: 0px 2px 10px #d0ccc9;">'.
        '<h1 style="text-align: center; color: #004b87; font-family: Palatino, Georgia, Times, \'Times New Roman\', serif; font-weight: 400;margin-bottom: 10px">Vericor Homes</h1>'.
        '<h3 style="text-align: center;">Online Contact</h3>'.
        '<p>'.$html_name.'</p>'.
        '<p>'.$html_email.'</p>'.
        '<p>'.$html_phone.'</p>'.
        '<p>'.$html_message.'</p>'.'
        </div>
    </body>
    </html>';

    $email_content = $html;
        
        // Set content-type header for sending HTML email
        $email_headers = "MIME-Version: 1.0" . "\r\n";
        $email_headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $email_headers .= "From: $name <$email>";

        // Send the email.
        if (mail($recipient, $subject, $email_content, $email_headers)) {
            // Set a 200 (okay) response code.
            http_response_code(200);
            echo "We will be in touch shortly.";
        } else {
            // Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "Something went wrong and we couldn't send your message.";
        }

    } else {
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "There was a problem with your submission, please try again.";
    }


?>