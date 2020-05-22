<?php
header("Access-Control-Allow-Origin: *");
error_reporting(E_ALL);
ini_set('error_reporting', true);
include '../app/functions.php';
$url = url('/index.php');
$url_edit = url('/views/edit.php');
$url_remove = url('/views/remove.php');

if (isset($_POST['fullname']) && $_POST['fullname'] != ' ') {

    $reload_pagination = pagination();

    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email     = $_POST['email'];
    $phone    = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $photo = $_FILES['photo']['name'];
    $new_name_photo = rand(5, 20) . $photo;
    $uploads = "../assets/uploads/images/$photo";

    $file_tmp_name = $_FILES['photo']['tmp_name'];

    if (move_uploaded_file($file_tmp_name, $uploads)) {
        $query = "INSERT INTO tbl_users_info (full_name,username,email,phone,password,photo) 
            VALUES('$fullname','$username','$email','$phone','$password','" . url('/assets/uploads/images/' . $photo) . "')";
        $i = query_data($query);
        if ($i == 'success') {
            $non_query = 'SELECT * FROM tbl_users_info ORDER BY id DESC LIMIT 1';
            $data = retrieve_sigle_row_data($non_query);
            if ($data) {
                $output =
                    "<tr id='row_".$data['id']."'>\
                        <td id='td_id'>" . $data['id'] . "</td>\
                        <td id='td_fname'>" . $data['full_name'] . "</td>\
                        <td id='td_username'>" . $data['username'] . "</td>\
                        <td id='td_email'>" . $data['email'] . "</td>\
                        <td id='td_phone'>" . $data['phone'] . "</td>\
                        <td id='td_img'> <img src='" . $data['photo'] . "' alt='' width='40px' class='d-flex justify-content-center image-rounded'> </td>\
                        <td class='d-flex justify-content-around'>\
                            <button class='btn btn-primary btn-small' id='btnEdit". $data['id']."'".' onclick="actionEdit('.$data['id'].",'$url_edit')".'" data-toggle="modal" data-target="#edit_modal">Edit</button>\
                            <button class="btn btn-danger btn-small"'." id='btnRemove" . $data['id']."'".' onclick="actionRemove('.$data['id'].",'$url_remove')".'">Remove</button>\
                        </td>\
                    </tr>';


                echo "<div class = 'alert alert-success alert-dismissible fade show' role = 'alert' >
                <strong> Successful! </strong> Data has been saved. 
                <button type = 'button' class = 'close' data-dismiss = 'alert' aria - label = 'Close' >
                <span aria-hidden = 'true' > &times; </span>
                 </button> </div>
                 <script>
                 $(document).ready(function() {
                   $('#pagination').html($reload_pagination);
                   $('table tbody#users_info')" . '.append(`' . $output . '`);' . "
                })
                </script>
                 ";
            } else {
                echo "<div class = 'alert alert-danger alert-dismissible fade show' role = 'alert' >
                <strong> Fail! </strong> $data. 
                <button type = 'button' class = 'close' data-dismiss = 'alert' aria - label = 'Close' >
                <span aria-hidden = 'true' > &times; </span>
                 </button> </div>";
            }
        } else {
            echo "<div class = 'alert alert-danger alert-dismissible fade show' role = 'alert' >
                <strong> Fail! </strong> $i. 
                <button type = 'button' class = 'close' data-dismiss = 'alert' aria - label = 'Close' >
                <span aria-hidden = 'true' > &times; </span>
                 </button> </div>";
        }
    } else {
        echo "<div class = 'alert alert-danger alert-dismissible fade show' role = 'alert' >
            <strong> Fail! </strong>" . $_FILES['photo']['error'] . "
            <button type = 'button' class = 'close' data-dismiss = 'alert' aria - label = 'Close' >
            <span aria-hidden = 'true' > &times; </span>
             </button> </div>";
    }
} else {
    echo "<script>alert('" . $url . "')</script>";
}
