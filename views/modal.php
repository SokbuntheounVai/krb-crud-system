<?php
// include '../app/auth.php'; 
?>

<div class="modal" tabindex="-1" role="dialog" data-keyboard='false' data-backdrop="static" id="reset_pass_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reset Password</h5>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group" id="alert_msg_sent_email_modal">
                </div>
                <div class="form-group">
                    <input type="radio" name="chioce" id="via_email" value="email" checked>
                    <label for="re_email">Email</label>
                    <input type="email" id="re_email" class='form-control' placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="radio" name="chioce" id="via_phone" value="phone">
                    <label for="re_phone">Phone</label>
                    <input type="number" id="re_phone" class='form-control' placeholder="Phone" required disabled>
                </div>
            </div>
            <div class="modal-footer">
                <div id="time_out" class="navbar-brand">
                    <span></span> s
                </div>
                <button class="btn btn-secondary" id="btnBack">Back</button>
                <button type="button" class="btn btn-primary" id="btnSent" onclick="request_reset_pass('<?= url('/app/auth.php') ?>')">Send</button>
            </div>
        </div>
    </div>
</div>


<div class="modal" tabindex="-1" role="dialog" data-keyboard='false' data-backdrop="static" id="sign_in_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sign In</h5>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group" id="alert_msg_login_modal">

                </div>
                <div class="form-group">
                    <label for="li_username">Username</label>
                    <input type="text" id="li_username" class='form-control' placeholder="Username" required>
                </div>
                <div class="form-group">
                    <label for="li_password">Password</label>
                    <input type="password" id="li_password" class="form-control" placeholder="Password" required>
                </div>
            </div>
            <div class="modal-footer">
                <a onclick="reset_password()">Forget your password?</a>
                <button type="button" class="btn btn-primary" onclick="sign_in('<?= url('/app/auth.php') ?>')">Sign In</button>
            </div>
        </div>
    </div>
</div>


<div class="modal" id="create_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Input Infomation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group" id="alert_msg">

                </div>
                <div class="form-group">
                    <label for="fullname">Full Name</label>
                    <input type="text" class="form-control" id="fullname" placeholder="Full Name" required>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" placeholder="name@example.com" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" placeholder="Phone" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password" min="6">
                </div>
                <div class="form-group">
                    <label for="phone">Verify Password</label>
                    <input type="password" class="form-control" id="ver_password" placeholder="Verify Password" min="6">
                </div>
                <div class="form-group">
                    <label for="photo">Photo</label>
                    <input type="file" class="form-control" onchange="prev_photo(event)" id="photo" name="photo" required>
                </div>

                <p id='photo-preview'>
                    <img src="" id="prev_photo" alt="" width="150px">
                </p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSave" onclick="save_data(`<?= url('/views/insert.php') ?>`)" data-url_index="<?= url('/') ?>">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="edit_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Infomation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                </script>
                <div class="form-group" id="edit_alert_msg">

                </div>
                <input id="u_id" type="number" value="" hidden>
                <div class="form-group">
                    <label for="u_fullname">Full Name</label>
                    <input type="text" class="form-control" id="u_fullname" placeholder="Full Name" required min="5">
                </div>
                <div class="form-group">
                    <label for="u_username">Username</label>
                    <input type="text" class="form-control" id="u_username" placeholder="Username" required min="3">
                </div>
                <div class="form-group">
                    <label for="u_email">Email address</label>
                    <input type="email" class="form-control" id="u_email" placeholder="name@example.com" required>
                </div>
                <div class="form-group">
                    <label for="u_phone">Phone</label>
                    <input type="text" class="form-control" id="u_phone" placeholder="Phone" required>
                </div>
                <div class="form-group">
                    <label for="cpm_password">Password </label>
                    <div class="form-inline">
                        <div class="form-group">
                            <input type="password" class="form-control mx-sm-6" id="cpm_password" onkeyup="action_change()" placeholder="Enter current password">
                        </div>
                        <button id="btnNewPass" class="btn btn-secondary btn-small mx-sm-2" disabled='true' onclick="checked_pass(`<?= url('/views/edit.php') ?>`)">New Password</button>
                    </div>
                    <p id="pass_alert" class="text-danger">
                    </p>
                </div>
                <div class="new_pass">
                    <div class="form-group">
                        <label for="u_new_password">New Password</label>
                        <input type="password" class="form-control" id="u_new_password" placeholder="New Password">
                    </div>
                    <div class="form-group">
                        <label for="u_ver_password">Verify Password</label>
                        <input type="password" class="form-control" id="u_ver_password" placeholder="Verify Password">
                    </div>
                </div>
                <div class="form-group">
                    <label for="u_photo">Photo</label>
                    <input type="file" class="form-control" onchange="prev_photo(event)" id="u_photo">
                </div>

                <p id='photo-preview'>
                    <img src="" id="u_prev_photo" alt="" width="150px">
                </p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSave" onclick="update_data(`<?= url('/views/edit.php') ?>`)" data-url_index="<?= url('/') ?>">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.new_pass').hide();
        $('#time_out').hide();
        $('#btnBack').click(function() {
            $('#sign_in_modal').modal('show');
            $('#reset_pass_modal').modal('hide');
        })

        var checked = $("input[name='chioce']");

        checked.on('click', function() {
            if (checked.filter(':checked').val() == 'email') {
                $('#reset_pass_modal #re_email').removeAttr('disabled');
                $('#reset_pass_modal #re_phone').attr('disabled', 'disabled');
            } else if (checked.filter(':checked').val() == 'phone') {
                $('#reset_pass_modal #re_email').attr('disabled', 'disabled');
                $('#reset_pass_modal #re_phone').removeAttr('disabled');
            }
        })
    })

    function reset_password() {
        $(document).ready(function() {
            $('#sign_in_modal').modal('hide');
            $('#reset_pass_modal').modal('show');
        })
    }

    function request_reset_pass(url) {
        var checked = $("input[name='chioce']");

        if (checked.filter(':checked').val() == 'email') {
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    action: 'reset_password_by_email',
                    email: $('#re_email').val()
                },
                success: function(response) {
                    if (response == 'success') {
                        $('#reset_pass_modal #alert_msg_sent_email_modal').html(
                            `<div class = 'alert alert-primary alert-dismissible fade show' role = 'alert' >
                         <strong> Sent! </strong> Please check your email. 
                        <button type = 'button' class = 'close' data-dismiss = 'alert' aria - label = 'Close' >
                         <span aria-hidden = 'true' > &times; </span>
                         </button> </div>`);
                        $('#re_email').attr('disabled', 'disabled');
                        $('#btnSent').attr('disabled', 'disabled');
                        $('#time_out').show();

                        var i = 30;
                        var x = setInterval(function() {
                            i -= 1;
                            if (i == 0) {
                                clearInterval(x);
                            }
                            $('#time_out span').html(i);
                        }, 1000)
                        setTimeout(function() {
                            $('#re_email').removeAttr('disabled', 'disabled');
                            $('#btnSent').removeAttr('disabled', 'disabled');
                            $('#btnSent').html('Resend');
                            $('#time_out').hide();
                        }, 30000)

                    } else {
                        $('#reset_pass_modal #alert_msg_sent_email_modal').html(response);
                    }
                    // console.log(response);

                },
                error: function(e) {
                    console.log('fail');
                }

            })
        } else if (checked.filter(':checked').val() == 'phone') {
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    action: 'reset_password_by_phone',
                    phone: $('#re_phone').val()
                },
                success: function(response) {
                    if (response == 'success') {
                        $('#reset_pass_modal #alert_msg_sent_email_modal').html(
                            `<div class = 'alert alert-primary alert-dismissible fade show' role = 'alert' >
                         <strong> Sent! </strong> Please check your message. 
                        <button type = 'button' class = 'close' data-dismiss = 'alert' aria - label = 'Close' >
                         <span aria-hidden = 'true' > &times; </span>
                         </button> </div>`);
                        $('#re_phone').attr('disabled', 'disabled');
                        $('#btnSent').attr('disabled', 'disabled');
                        $('#time_out').show();

                        var i = 30;
                        var x = setInterval(function() {
                            i -= 1;
                            if (i == 0) {
                                clearInterval(x);
                            }
                            $('#time_out span').html(i);
                        }, 1000)
                        setTimeout(function() {
                            $('#re_phone').removeAttr('disabled', 'disabled');
                            $('#btnSent').removeAttr('disabled', 'disabled');
                            $('#btnSent').html('Resend');
                            $('#time_out').hide();
                        }, 30000)

                    } else {
                        $('#reset_pass_modal #alert_msg_sent_email_modal').html(response);
                    }
                    // console.log(response);

                },
                error: function(e) {
                    console.log('fail');
                }

            })
        }
    }


    function sign_in(url) {
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                action: 'sign_in',
                username: $('#li_username').val(),
                password: $('#li_password').val()
            },
            success: function(response) {
                if (response == 'success') {
                    window.location.reload();
                } else {
                    $('#alert_msg_login_modal').html(response);
                }
            },
            error: function(e) {
                console.log('fail');
            }

        })
    }

    function checked_pass(url) {
        var id = $('#u_id').val()
        pass = $('#cpm_password').val();
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                action: 'checked_current_password',
                id: id,
                password: pass
            },
            success: function(response) {
                $('#run-script').html(response);
            },
            error: function(e) {

            }

        })
    }

    function action_change() {
        $(document).ready(function() {
            var pasVal = $('#cpm_password').val();
            if (pasVal == '') {
                $('#btnNewPass').attr('disabled', 'disabled');
            } else {
                $('#btnNewPass').removeAttr('disabled', 'disabled');
            }
        })
    }

    function prev_photo(evt) {
        if (evt.target.files[0] != null) {
            let CheckedPhoto = document.getElementById('prev_photo');
            let U_CheckedPhoto = document.getElementById('u_prev_photo');
            CheckedPhoto.src = URL.createObjectURL(evt.target.files[0]);
            U_CheckedPhoto.src = URL.createObjectURL(evt.target.files[0]);
        }

    }

    function update_data(get_url) {
        var id = $('#u_id'),
            fullname = $('#u_fullname'),
            username = $('#u_username'),
            email = $('#u_email'),
            phone = $('#u_phone'),
            password = $('#u_new_password'),
            ver_password = $('#u_ver_password'),
            url_index = $('#btnSave').data('url_index');

        var photo_get = $('#u_photo').prop('files')[0];
        var form_data = new FormData();
        form_data.append('action', 'update_data');
        form_data.append('id', id.val());
        form_data.append('fullname', fullname.val());
        form_data.append('username', username.val());
        form_data.append('email', email.val());
        form_data.append('phone', phone.val());
        form_data.append('password', password.val());
        form_data.append('photo', photo_get);

        if (ver_password.val() === password.val()) {
            $.ajax({
                // dataType: 'text',
                type: 'POST',
                url: get_url,
                contentType: false,
                cache: false,
                processData: false,
                data: form_data,
                success: function(data) {
                    $('#run-script').html(data);
                    clear();
                    $('#edit_modal button.close').click();
                },
                error: function(xhr, status, error) {
                    console.log(error)
                }
            })
        } else {
            let msg = "<div class = 'alert alert-warning alert-dismissible fade show' role = 'alert' >\
                    <strong> Incorrect! </strong> You fail to input password. \
                    <button type = 'button' class = 'close' data-dismiss = 'alert' aria - label = 'Close' >\
                    <span aria-hidden = 'true' > &times; </span>\
                     </button> </div>\
                ";

            $('#edit_alert_msg').html(msg);
        }
    }

    function clear() {
        $('#fullname').val('');
        $('#username').val('');
        $('#email').val('');
        $('#phone').val('');
        $('#password').val('');
        $('#ver_password').val('');
        $('#u_new_password').val('');
        $('#u_ver_password').val('');
        $('#photo').val('');
        $('#cpm_password').val('');
        $('.new_pass').hide();
        $('#photo').val(null);
        $('#u_photo').val(null);
    }

    function save_data(get_url) {

        $(document).ready(function() {
            var fullname = $('#fullname'),
                username = $('#username'),
                email = $('#email'),
                phone = $('#phone'),
                password = $('#password'),
                ver_password = $('#ver_password'),
                url_index = $('#btnSave').data('url_index');

            var photo_get = $('#photo').prop('files')[0];
            var form_data = new FormData();
            form_data.append('fullname', fullname.val());
            form_data.append('username', username.val());
            form_data.append('email', email.val());
            form_data.append('phone', phone.val());
            form_data.append('password', password.val());
            form_data.append('photo', photo_get);

            if (ver_password.val() === password.val()) {
                $.ajax({
                    // dataType: 'text',
                    type: 'POST',
                    url: get_url,
                    contentType: false,
                    cache: false,
                    processData: false,
                    data: form_data,
                    success: function(data) {
                        $('#run-script').html(data);
                        clear();
                        $('#create_modal button.close').click();
                    },
                    error: function(xhr, status, error) {
                        console.log(error)
                    }
                })
            } else {
                let msg = "<div class = 'alert alert-warning alert-dismissible fade show' role = 'alert' >\
                    <strong> Incorrect! </strong> You fail to input password. \
                    <button type = 'button' class = 'close' data-dismiss = 'alert' aria - label = 'Close' >\
                    <span aria-hidden = 'true' > &times; </span>\
                     </button> </div>\
                ";

                $('#alert_msg').html(msg);
            }
        })
    }
</script>