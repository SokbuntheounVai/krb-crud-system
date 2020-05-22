<?php
header("Access-Control-Allow-Origin: *");

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// include '../router.php';
include 'functions.php';
include 'session.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Twilio\Rest\Client;

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'clear_auth') {
        logout();
    } elseif ($_POST['action'] == 'sign_in') {
        login($_POST['username'], $_POST['password']);
    } elseif ($_POST['action'] == 'reset_password_by_email') {
        reset_password($_POST['email']);
    } elseif ($_POST['action'] == 'reset_password_by_phone') {
        reset_pass_by_phone($_POST['phone']);
    }
}

function reset_pass_by_phone($phone)
{
    $data = retrieve_sigle_row_data("SELECT phone, username FROM tbl_users_info WHERE phone = '$phone' AND active = 1 LIMIT 1");
    if ($data) {
        $newPass = rand_Pass();
        $password = password_hash($newPass, PASSWORD_BCRYPT);

        $i = query_data("UPDATE tbl_users_info SET password = '$password' WHERE phone = '$phone'");
        if ($i) {
            echo 'success';
            template_phone_sms($phone, $newPass);
        } else {
            echo "<div class = 'alert alert-danger alert-dismissible fade show' role = 'alert' >
            <strong> Fail! </strong> Your phone not match. 
            <button type = 'button' class = 'close' data-dismiss = 'alert' aria - label = 'Close' >
            <span aria-hidden = 'true' > &times; </span>
             </button> </div>";
        }
    } else {
        echo "<div class = 'alert alert-danger alert-dismissible fade show' role = 'alert' >
            <strong> Fail! </strong> Your phone not match. 
            <button type = 'button' class = 'close' data-dismiss = 'alert' aria - label = 'Close' >
            <span aria-hidden = 'true' > &times; </span>
             </button> </div>";
    }
}

function template_phone_sms($phone, $newpass)
{
    require_once('../vender/twilio/sdk/src/Twilio/autoload.php');

    $account_sid = "ACf34df9de236199591a6d0847344a3bdb";
    $auth_token = "13e4dc05e59e4b3bd83a4f6faece1180";
    $twilio_number = "+12059906902";
    $client = new Client($account_sid, $auth_token);

    $client->messages->create(
        "+855" . $phone,
        ['from' => $twilio_number, 'body' => 'Your new password : ' . $newpass]
    );
}

function rand_Pass($upper = 1, $lower = 5, $numeric = 3, $other = 2)
{

    $pass_order = array();
    $passWord = '';

    //Create contents of the password 
    for ($i = 0; $i < $upper; $i++) {
        $pass_order[] = chr(rand(65, 90));
    }
    for ($i = 0; $i < $lower; $i++) {
        $pass_order[] = chr(rand(97, 122));
    }
    for ($i = 0; $i < $numeric; $i++) {
        $pass_order[] = chr(rand(48, 57));
    }
    for ($i = 0; $i < $other; $i++) {
        $rand = rand(33, 47);
        if ($rand == 34 || $rand == 39 || $rand == 45 || $rand == 44 || $rand == 46) {
            $i -= 1;
            continue;
        } else {
            $pass_order[] = chr($rand);
        }
    }

    //using shuffle() to shuffle the order
    shuffle($pass_order);

    //Final password string 
    foreach ($pass_order as $char) {
        $passWord .= $char;
    }
    return $passWord;
}

function template_msg($client_name, $newPass)
{
    $msg = "
        <h1>Hi! $client_name.</h1><hr>
        <p>
            Here is your new password : $newPass
        </p>
    ";

    return $msg;
}

function template_send_mail($username, $password, $client_mail, $mail_sub, $mail_msg)
{
    require_once('../vender/PHPMailer-master/src/OAuth.php');
    require_once('../vender/PHPMailer-master/src/PHPMailer.php');
    require_once('../vender/PHPMailer-master/src/POP3.php');
    require_once('../vender/PHPMailer-master/src/SMTP.php');
    try {

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tsl';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->isHTML(true);
        $mail->Username = $username;
        $mail->Password = $password;
        $mail->setFrom($username);
        $mail->Subject = $mail_sub;
        $mail->Body = $mail_msg;
        $mail->addAddress($client_mail);
        $mail->send();
        // return 'success';
    } catch (Exception $e) {
        echo $e;
    }
}

function reset_password($email)
{
    $data = retrieve_sigle_row_data("SELECT email, username FROM tbl_users_info WHERE email = '$email' AND active = 1 LIMIT 1");
    if ($data) {
        $newPass = rand_Pass();
        $password = password_hash($newPass, PASSWORD_BCRYPT);
        $i = query_data("UPDATE tbl_users_info SET password = '$password' WHERE email = '$email'");
        if ($i) {
            echo 'success';
            template_send_mail('ceetrolamo555@gmail.com', 'cambodia555', $data['email'], 'Reset Password', template_msg($data['username'], $newPass));
        } else {
            echo "<div class = 'alert alert-danger alert-dismissible fade show' role = 'alert' >
            <strong> Fail! </strong> Your email not match. 
            <button type = 'button' class = 'close' data-dismiss = 'alert' aria - label = 'Close' >
            <span aria-hidden = 'true' > &times; </span>
             </button> </div>";
        }
    } else {
        echo "<div class = 'alert alert-danger alert-dismissible fade show' role = 'alert' >
            <strong> Fail! </strong> Your email not match. 
            <button type = 'button' class = 'close' data-dismiss = 'alert' aria - label = 'Close' >
            <span aria-hidden = 'true' > &times; </span>
             </button> </div>";
    }
}

function logout()
{
    Session::store_session(['username' => '']);
}

function login($username, $password)
{
    $data = retrieve_sigle_row_data("SELECT username, password, photo FROM tbl_users_info WHERE username = '$username' AND active = 1 LIMIT 1");
    if ($data) {
        if ($username != $data['username'] || !password_verify($password, $data['password'])) {
            echo "<div class = 'alert alert-danger alert-dismissible fade show' role = 'alert' >
            <strong> Fail! </strong> Incorrect username or password. 
            <button type = 'button' class = 'close' data-dismiss = 'alert' aria - label = 'Close' >
            <span aria-hidden = 'true' > &times; </span>
             </button> </div>";
        } elseif ($username != $data['username'] && !password_verify($password, $data['password'])) {
            echo "<div class = 'alert alert-danger alert-dismissible fade show' role = 'alert' >
            <strong> Fail! </strong> Incorrect username or password. 
            <button type = 'button' class = 'close' data-dismiss = 'alert' aria - label = 'Close' >
            <span aria-hidden = 'true' > &times; </span>
             </button> </div>";
        } else {
            Session::store_session(['username' => $username, 'photo' => $data['photo']]);
            echo 'success';
        }
    } else {
        echo "<div class = 'alert alert-danger alert-dismissible fade show' role = 'alert' >
            <strong> Fail! </strong> Incorrect username or password. 
            <button type = 'button' class = 'close' data-dismiss = 'alert' aria - label = 'Close' >
            <span aria-hidden = 'true' > &times; </span>
             </button> </div>";
    }
}
