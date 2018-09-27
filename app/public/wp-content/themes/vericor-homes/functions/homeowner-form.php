<?php     
// Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        $firstName = strip_tags(trim($_POST["first-name"]));
        $lastName = strip_tags(trim($_POST["last-name"]));
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $neighborhood = strip_tags(trim($_POST["neighborhood"]));
        $staddress = strip_tags(trim($_POST["staddress"]));
        $city = strip_tags(trim($_POST["city"]));
        $state = strip_tags(trim($_POST["state"]));
        $visit = strip_tags(trim($_POST["visit"]));
        $referencedmanual = strip_tags(trim($_POST["referencedmanual"]));
        $bestcontact = strip_tags(trim($_POST["bestcontact"]));
        $requestdescription = trim($_POST["requestdescription"]);

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
        $subject = "Vericor Homes - Homeowner Service Request ";

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
        if ($neighborhood) {
            $html_neighborhood .= "<strong>Neighborhood</strong>: $neighborhood\n";
        } else {
            $html_neighborhood .= "<strong>Neighborhood</strong>: <em>Not provided</em>\n";
        }
        if ($staddress) {
            $html_staddress .= "<strong>Street Address</strong>: $staddress\n";
        } else {
            $html_staddress .= "<strong>Street Address</strong>: <em>Not provided</em>\n";
        }
        if ($city) {
            $html_city .= "<strong>City</strong>: $city\n";
        } else {
            $html_city .= "<strong>City</strong>: <em>Not provided</em>\n";
        }
        if ($state) {
            $html_state .= "<strong>State</strong>: $state\n";
        } else {
            $html_state .= "<strong>State</strong>: <em>Not provided</em>\n";
        }
        if ($zip) {
            $html_zip .= "<strong>Zip</strong>: $zip\n";
        } else {
            $html_zip .= "<strong>Zip</strong>: <em>Not provided</em>\n";
        }
        if ($visit) {
            $html_visit .= "<strong>Is this for a scheduled visit?</strong>: $visit\n";
        } else {
            $html_visit .= "<strong>Is this for a scheduled visit?</strong>: <em>Not provided</em>\n";
        }
        if ($referencedmanual) {
            $html_referencedmanual .= "<strong>Have you referenced this issue in your Homeowner's Manual?</strong>: $referencedmanual\n";
        } else {
            $html_referencedmanual .= "<strong>Have you referenced this issue in your Homeowner's Manual?</strong>: <em>Not provided</em>\n";
        }
        if ($bestcontact) {
            $html_bestcontact .= "<strong>What's the best way to reach you?</strong>: $bestcontact\n";
        } else {
            $html_bestcontact .= "<strong>What's the best way to reach you?</strong>: <em>Not provided</em>\n";
        }
        $html_message .= "<strong>Request Description</strong>:\n$requestdescription\n";

        $html = '<html>
    <body>
        <div style="background-color:#fce7a6;padding:15px;font-size: 18px;box-shadow: 0px 2px 10px #d0ccc9;">'.
        '<h1 style="text-align: center; color: #004b87; font-family: Palatino, Georgia, Times, \'Times New Roman\', serif; font-weight: 400;margin-bottom: 10px">Vericor Homes</h1>'.
        '<h3 style="text-align: center;">Online Homeowner Service Request</h3>'.
        '<p>'.$html_name.'</p>'.
        '<p>'.$html_email.'</p>'.
        '<p>'.$html_staddress.'</p>'.
        '<p>'.$html_city.'</p>'.
        '<p>'.$html_state.'</p>'.
        '<p>'.$html_zip.'</p>'.
        '<p>'.$html_neighborhood.'</p>'.
        '<p>'.$html_visit.'</p>'.
        '<p>'.$html_referencedmanual.'</p>'.
        '<p>'.$html_bestcontact.'</p>'.
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