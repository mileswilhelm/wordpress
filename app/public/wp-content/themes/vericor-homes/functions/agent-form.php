<?php     
// Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        $firstName = strip_tags(trim($_POST["first-name"]));
        $lastName = strip_tags(trim($_POST["last-name"]));
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $phone = strip_tags(trim($_POST["phone"]));
        $company = strip_tags(trim($_POST["company"]));
        $staddress = strip_tags(trim($_POST["staddress"]));
        $city = strip_tags(trim($_POST["city"]));
        $state = strip_tags(trim($_POST["state"]));
        $zip = strip_tags(trim($_POST["zip"]));
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
        $subject = "Vericor Homes - Agent Incentive Program Request";

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
            $html_phone .= "<strong>Phone</strong>: <em>Not provided</em>\n";
        }
        if ($company) {
            $html_company .= "<strong>Company</strong>: $company\n";
        } else {
            $html_company .= "<strong>Company</strong>: <em>Not provided</em>\n";
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
        $html_message .= "<strong>Comments</strong>:\n$comments\n";

        $html = '<html>
    <body>
        <div style="background-color:#fce7a6;padding:15px;font-size: 18px;box-shadow: 0px 2px 10px #d0ccc9;">'.
        '<h1 style="text-align: center; color: #004b87; font-family: Palatino, Georgia, Times, \'Times New Roman\', serif; font-weight: 400;margin-bottom: 10px">Vericor Homes</h1>'.
        '<h3 style="text-align: center;">Online Agent Incentive Program Request</h3>'.
        '<p>'.$html_name.'</p>'.
        '<p>'.$html_email.'</p>'.
        '<p>'.$html_phone.'</p>'.
        '<p>'.$html_company.'</p>'.
        '<p>'.$html_staddress.'</p>'.
        '<p>'.$html_city.'</p>'.
        '<p>'.$html_state.'</p>'.
        '<p>'.$html_zip.'</p>'.
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