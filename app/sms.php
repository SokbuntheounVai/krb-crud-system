<?php

// use Twilio\Rest\Client;
// require_once('../vender/twilio/sdk/src/Twilio/autoload.php');

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// $phone = '077718487';
// $newpass = '12345';


// $account_sid = "ACf34df9de236199591a6d0847344a3bdb";
//     $auth_token = "13e4dc05e59e4b3bd83a4f6faece1180";
//     $twilio_number = "+12059906902";
//     $client = new Client($account_sid, $auth_token);

//     $client->messages->create(
//         "+855" . $phone,
//         ['from' => $twilio_number, 'body' => 'Your new password : ' . $newpass]
//     );

     // require_once('../vender/php-uk/php-uk/textlocal.class.php');

    // // Account details +12059906902
	// $apiKey = urlencode('AfF+TKjpGjY-LbbhANm58MUTu9hX9HpBgMRAVWorGA');
	
	// // Message details
	// $numbers = array('855'.$phone);
	// $sender = urlencode('Khemrakbot Tech');
	// $message = rawurlencode('Your new password : '.$newpass);
 
	// $numbers = implode(',', $numbers);
 
	// // Prepare data for POST request
	// $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
 
	// // Send the POST request with cURL
	// $ch = curl_init('https://api.txtlocal.com/send/');
	// curl_setopt($ch, CURLOPT_POST, true);
	// curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// $response = curl_exec($ch);
	// curl_close($ch);
	
	// // Process your response here
	// echo $response;

    // require __DIR__.'';


    // require_once('../vender/twilio/sdk/src/Twilio/Rest/Client.php');
    // require_once('../vender/twilio/sdk/src/Twilio/Exceptions/ConfigurationException.php');
    // require_once('../vender/twilio/sdk/src/Twilio/Exceptions/TwilioException.php');
    // require_once('../vender/twilio/sdk/src/Twilio/Exceptions/EnvironmentException.php');
    // require_once('../vender/twilio/sdk/src/Twilio/Http/Client.php');
    // require_once('../vender/twilio/sdk/src/Twilio/Http/CurlClient.php');
    // require_once('../vender/twilio/sdk/src/Twilio/VersionInfo.php');
