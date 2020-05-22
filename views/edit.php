<?php
header("Access-Control-Allow-Origin: *");
include '../app/functions.php';
$url = url('/index.php');


if (isset($_POST['action'])) {
    if ($_POST['action'] == 'get_data_to_edit') {
        get_data_to_edit($_POST['id']);
    } elseif ($_POST['action'] == 'checked_current_password') {
        checked_current_password($_POST['id'], $_POST['password']);
    } elseif ($_POST['action'] == 'update_data') {
        update_data();
    }
}

function update_data()
{
    if (isset($_POST['id'])) {
        $id     = $_POST['id'];
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $email     = $_POST['email'];
        $phone    = $_POST['phone'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);


        if ($_POST['password'] == '' && $_FILES['photo']) {
            $photo = $_FILES['photo']['name'];
            $uploads = "../assets/uploads/images/$photo";
            $file_tmp_name = $_FILES['photo']['tmp_name'];
            $path_photo =  url("/assets/uploads/images/$photo");
            if (move_uploaded_file($file_tmp_name, $uploads)) {
                $query = "UPDATE tbl_users_info SET full_name = '$fullname' , username = '$username', email = '$email',phone = '$phone',photo = '$path_photo' WHERE id = $id";
                update($query, $id);
            } else {
                echo "<div class = 'alert alert-danger alert-dismissible fade show' role = 'alert' >
                <strong> Fail! </strong>" . $_FILES['photo']['error'] . "
                <button type = 'button' class = 'close' data-dismiss = 'alert' aria - label = 'Close' >
                <span aria-hidden = 'true' > &times; </span>
                 </button> </div>";
            }
        } elseif (!$_FILES['photo'] && $_POST['password'] != '') {
            $query = "UPDATE tbl_users_info SET full_name = '$fullname' , username = '$username', email = '$email',phone = '$phone', password = '$password' WHERE id = $id";
            update($query, $id);

        } elseif ($_POST['password'] == '' && !$_FILES['photo']) {
            $query = "UPDATE tbl_users_info SET full_name = '$fullname' , username = '$username', email = '$email',phone = '$phone' WHERE id = $id";
            update($query, $id);

        } else {
            $photo = $_FILES['photo']['name'];
            $uploads = "../assets/uploads/images/$photo";
            $file_tmp_name = $_FILES['photo']['tmp_name'];
            $path_photo =  url("/assets/uploads/images/$photo");
            if (move_uploaded_file($file_tmp_name, $uploads)) {
                $query = "UPDATE tbl_users_info SET full_name = '$fullname' , username = '$username', email = '$email',phone = '$phone', password = '$password' ,photo = '$path_photo' WHERE id = $id";
                update($query, $id);
            } else {
                echo "<div class = 'alert alert-danger alert-dismissible fade show' role = 'alert' >
                <strong> Fail! </strong>" . $_FILES['photo']['error'] . "
                <button type = 'button' class = 'close' data-dismiss = 'alert' aria - label = 'Close' >
                <span aria-hidden = 'true' > &times; </span>
                 </button> </div>";
            }
        }
    }
}

function update($query, $id)
{
    $i = query_data($query);
    if ($i == 'success') {
        $non_query = "SELECT * FROM tbl_users_info WHERE id = $id LIMIT 1";
        $data = retrieve_sigle_row_data($non_query);
        if ($data) {
            $output =
                "
                    $('table tbody#users_info #row_$id #td_fname').html('" . $data['full_name'] . "');
                    $('table tbody#users_info #row_$id #td_username').html('" . $data['username'] . "');
                    $('table tbody#users_info #row_$id #td_email').html('" . $data['email'] . "');
                    $('table tbody#users_info #row_$id #td_phone').html('" . $data['phone'] . "');
                    $('table tbody#users_info #row_$id #td_img img').attr('src','" . $data['photo'] . "');
                ";


            echo "
            <script>
         $(document).ready(function(){
            $output
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
}

function checked_current_password($id, $password)
{
    $non_query = "SELECT password FROM tbl_users_info WHERE id = $id LIMIT 1";
    $data = retrieve_sigle_row_data($non_query);

    if (password_verify($password, $data['password'])) {
        echo '
            <script>
                $("#edit_modal #pass_alert").hide();
                $("#edit_modal .new_pass").show();
                $("#btnNewPass").attr("disabled", "disabled");
            </script>
        ';
    } else {
        echo '
            <script>
                $("#edit_modal .new_pass").hide();
                $("#edit_modal #pass_alert").show();
                $("#edit_modal #pass_alert").text("Incorrect Password!");
            </script>
        ';
    }
}

function get_data_to_edit($id)
{
    $non_query = "SELECT * FROM tbl_users_info WHERE id = $id LIMIT 1";
    $data = retrieve_sigle_row_data($non_query);
    if ($data) {
        $fullname = $data['full_name'];
        $username = $data['username'];
        $email    = $data['email'];
        $phone    = $data['phone'];
        $password = $data['password'];
        $photo    = $data['photo'];

        echo "
        <script>
                 $(document).ready(function() {
                   $('#edit_modal #u_id')" . '.val("' . $id . '");' . "
                   $('#edit_modal #u_fullname')" . '.val("' . $fullname . '");' . "
                   $('#edit_modal #u_username')" . '.val("' . $username . '");' . "
                   $('#edit_modal #u_email')" . '.val("' . $email . '");' . "
                   $('#edit_modal #u_phone')" . '.val("' . $phone . '");' . "
                   $('#edit_modal #u_prev_photo')" . '.attr("src","' . $photo . '");' . "
                })
                </script>
        ";
    }
}
