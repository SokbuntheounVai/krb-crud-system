<?php
// header("Access-Control-Allow-Origin: *");
include '../vender/PHPMailer-master/src/PHPMailer.php';
error_reporting(E_ALL);
error_reporting(-1);
ini_set('error_reporting', '1');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once('../vender/PHPMailer-master/src/OAuth.php');
require_once('../vender/PHPMailer-master/src/POP3.php');
require_once('../vender/PHPMailer-master/src/SMTP.php');

// include '../router.php';
// include 'functions.php';
try{
$mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPDebug = 1;
    $mail->CharSet   = 'UTF-8';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tsl';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->isHTML(true);
    $mail->Username = 'ceetrolamo555@gmail.com';
    $mail->Password = 'cambodia555';
    $mail->setFrom('ceetrolamo555@gmail.com');
    $mail->Subject = 'TESTING';
    $mail->Body = '<h1>Hello</h1>';
    $mail->addAddress('buntheoun.developer27@gmail.com');
    $mail->send();
}catch(Exception $e){
    echo $e;
}
    // if (!$mail->send()) {
    //     echo 'Fail';
    // } else {
    //     echo 'success';
    // }







// echo reset_password('buntheoun.developer27@gmail.com');

// template_send_mail('ceetrolamo555@gmail.com','cambodia555','buntheoun.developer27@gmail.com','Password',template_msg('nani', rand_Pass()));
// // template_send_mail()


// function rand_Pass($upper = 1, $lower = 5, $numeric = 3, $other = 2)
// {

//     $pass_order = array();
//     $passWord = '';

//     //Create contents of the password 
//     for ($i = 0; $i < $upper; $i++) {
//         $pass_order[] = chr(rand(65, 90));
//     }
//     for ($i = 0; $i < $lower; $i++) {
//         $pass_order[] = chr(rand(97, 122));
//     }
//     for ($i = 0; $i < $numeric; $i++) {
//         $pass_order[] = chr(rand(48, 57));
//     }
//     for ($i = 0; $i < $other; $i++) {
//         $rand = rand(33, 47);
//         if ($rand == 34 || $rand == 39 || $rand == 45 || $rand == 44 || $rand == 46) {
//             $i -= 1;
//             continue;
//         } else {
//             $pass_order[] = chr($rand);
//         }
//     }

//     //using shuffle() to shuffle the order
//     shuffle($pass_order);

//     //Final password string 
//     foreach ($pass_order as $char) {
//         $passWord .= $char;
//     }
//     return $passWord;
// }

// function template_msg($client_name, $newPass)
// {
//     $msg = "
//         <h1>Hi! $client_name.</h1><hr>
//         <p>
//             Here is your new password : $newPass
//         </p>
//     ";

//     return $msg;
// }

// function template_send_mail($username, $password, $client_mail, $mail_sub, $mail_msg)
// {
//     // require_once('../vender/PHPMailer-master/src/PHPMailer.php');

    

//     //     $to = "ceetrolamo@gmail.com";
//     // $subject = "HTML email";

//     // $message = "
//     // <html>
//     // <head>
//     // <title>Reset Password</title>
//     // </head>
//     // <body>
//     // <p>This email contains HTML Tags!</p>
//     // <hr>
//     // <h3>Hi! $username</h3>
//     // <p>This is your new password : $password</p>
//     // </body>
//     // </html>
//     // ";

//     // // Always set content-type when sending HTML email
//     // $headers = "MIME-Version: 1.0" . "\r\n";
//     // $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

//     // // More headers
//     // $headers .= 'From: <ceetrolamo555@gmail.com>' . "\r\n";

//     // mail($to,$subject,$message,$headers);
// }

// function reset_password($email)
// {
//     $data = retrieve_sigle_row_data("SELECT email, username FROM tbl_users_info WHERE email = '$email' AND active = 1 LIMIT 1");
//     if ($data) {
//         $newPass = rand_Pass();
//         $i = template_send_mail('ceetrolamo555@gmail.com', 'Cambodia555', $data['email'], 'Reset Password', template_msg($data['username'], $newPass));

//         echo $i;
// //         // $password = password_hash($newPass,PASSWORD_BCRYPT);
// //         // $i = query_data("UPDATE tbl_users_info SET password = '$password' WHERE email = '$email'");
// //         if ($i=='success') {
// //             echo 'success';
// //         } else {
// //             echo "<div class = 'alert alert-danger alert-dismissible fade show' role = 'alert' >
// //             <strong> Fail! </strong> Your email not match. 
// //             <button type = 'button' class = 'close' data-dismiss = 'alert' aria - label = 'Close' >
// //             <span aria-hidden = 'true' > &times; </span>
// //              </button> </div>";
// //         }
// //     } else {
// //         echo "<div class = 'alert alert-danger alert-dismissible fade show' role = 'alert' >
// //             <strong> Fail! </strong> Your email not match. 
// //             <button type = 'button' class = 'close' data-dismiss = 'alert' aria - label = 'Close' >
// //             <span aria-hidden = 'true' > &times; </span>
// //              </button> </div>";
//     }
// }

// 
