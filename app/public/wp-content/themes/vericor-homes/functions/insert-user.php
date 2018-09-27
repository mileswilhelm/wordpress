<?php
$path = $_SERVER["DOCUMENT_ROOT"];
require_once($path.'/wp-load.php');
$user_login = filter_var($_REQUEST['user_login'], FILTER_SANITIZE_STRING);
$user_email = filter_var($_REQUEST['user_email'], FILTER_SANITIZE_EMAIL);
$first_name = filter_var($_REQUEST['first_name'], FILTER_SANITIZE_STRING);
$last_name = filter_var($_REQUEST['last_name'], FILTER_SANITIZE_STRING);
$direct_number = filter_var($_REQUEST['direct_number'], FILTER_SANITIZE_NUMBER_FLOAT);
$direct_address = filter_var($_REQUEST['direct_address'], FILTER_SANITIZE_STRING);

$display_name = $first_name.' '.$last_name;
$data_url = filter_var($_REQUEST['user_insert'], FILTER_SANITIZE_URL);
$redirect_to = filter_var($_REQUEST['redirect_to'], FILTER_SANITIZE_URL);
$from = 'info@vericorhomes.com';
$type = $_REQUEST['type'];

?>
<?php

if($type=='insert'&&isset($user_login)&&isset($user_email)){

	function randomPassword() {
	    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
	    $pass = array(); //remember to declare $pass as an array
	    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	    for ($i = 0; $i < 12; $i++) {
	        $n = rand(0, $alphaLength);
	        $pass[] = $alphabet[$n];
	    }
	    return implode($pass); //turn the array into a string
	}

	$password = randomPassword();

	$userdata = array(
	    'user_login'  =>  $user_login,
	    'role' => 'subscriber',
	    'user_email' => $user_email,
	    'first_name' => $first_name,
	    'last_name' => $last_name,
	    'display_name' => $display_name,
		'user_pass'   =>  $password,  // When creating a user, `user_pass` is expected.
	);
	$user_id = wp_insert_user( $userdata );

	//On success
	if( !is_wp_error($user_id) ) {
		update_user_meta( $user_id, 'user_phone_number', $direct_number);
		update_user_meta( $user_id, 'user_address', $direct_address);
		$subject = 'You can now log in to the Vericor Homeowner Portal!';
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "From: ".$from."\r\n";
		$msg = '
			<html>
				<body>
					<table>
						<tr>
							<td>User Name:</td>
							<td>'.$user_login.'</td>
						</tr>
						<tr>
							<td>Password:</td>
							<td>'.$password.'</td>
						</tr>
						<tr>
							<td>Name:</td>
							<td>'.$display_name.'</td>
						</tr>
						<tr>
							<td>Phone Number:</td>
							<td>'.$direct_number.'</td>
						</tr>
						<tr>
							<td>Address:</td>
							<td>'.$direct_address.'</td>
						</tr>
						<tr>
							<td>Email:</td>
							<td>'.$user_email.'</td>
						</tr>
						<tr>
							<td><a href="'.site_url().'/homeowners" style="padding: 8px 24px; background: #004b87; display: block; color: #fff; text-decoration: none; margin-top: 16px; border-radius: 4px;">Confirm</a></td>
						</tr>
					</table>
				</body>
			</html>
		';
	 	mail($user_email, $subject, $msg, $headers);
	 	echo $display_name.' has been added! They will receive an email notification with their username and password.';
	} else {
		echo 'Error!';
	}
}
if($type=='confirm'&&isset($user_login)&&isset($user_email)){

       if ( username_exists( $user_login ) || email_exists( $user_email )) {
       		
           	if ( username_exists( $user_login )) {
				echo 'ERROR001';
			}
			if(email_exists( $user_email )){
				echo 'ERROR002';
			}

       }
       else {
			
			$subject = $display_name.' wants to access the Vericor Homeowner Portal!';
			$msg = '
				<html>
					<body>
						<table>
							<tr>
								<td>User Name:</td>
								<td>'.$user_login.'</td>
							</tr>
							<tr>
								<td>Name:</td>
								<td>'.$display_name.'</td>
							</tr>
							<tr>
								<td>Phone Number:</td>
								<td>'.$direct_number.'</td>
							</tr>
							<tr>
								<td>Address:</td>
								<td>'.$direct_address.'</td>
							</tr>
							<tr>
								<td>Email:</td>
								<td>'.$user_email.'</td>
							</tr>
							<tr>
								<td><a href="'.$data_url.'?type=insert&user_login='.$user_login.'&user_email='.$user_email.'&first_name='.$first_name.'&last_name='.$last_name.'&display_name='.$display_name.'&direct_number='.$direct_number.'&direct_address='.$direct_address.'" style="padding: 0.5rem 1.5rem; background: #004b87; display: block; color: #fff; text-decoration: none;">Approve</a></td>
							</tr>
						</table>
					</body>
				</html>
			';

			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= "From: ".$display_name."\r\n";
			// $headers .= "BCc: eddie@eastonadv.com, scott@eastonadv.com" . "\r\n";
			// send email
			mail('info@vericorhomes.com', $subject, $msg, $headers);
			// mail('miles@eastonadv.com', $subject, $msg, $headers);
			// echo 'Request Sent!';
	}
}