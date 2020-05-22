<?php
// include '../app/session.php';
include 'modal.php';

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// include '../app/functions.php';
Pagination::setPageNumber(1);
Pagination::setCurrentPage(1);

if (Session::get_session('username') == '') {
?>
    <script>
        $(document).ready(function() {
            $('#sign_in_modal').modal('show');
        })
    </script>
<?php
}

?>

<!-- Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facere nobis inventore ipsum quaerat accusamus accusantium et id, perspiciatis magnam quidem quas totam corrupti molestiae dolores ullam quae sapiente omnis itaque. -->
<div>
    <nav class="navbar navbar-dark bg-primary">
        <div class="navbar-brand">
            CRUD System
        </div>
        <?php
        if (Session::get_session('username') != '') {
        ?>
            <div class="navbar-brand">
                <img src="<?= Session::get_session('photo') ?>" width="25px" class='img-rounded' alt="phto">
                <span><?= Session::get_session('username') ?></span>
            </div>
            <div class="navbar-brand">
                <button class="btn btn-warning btn-oval" id="btnSignOut" onclick="sign_out('<?= url('/app/logout.php') ?>')">Sign Out</button>
            </div>
        <?php
        }
        ?>
    </nav>
    <br>
    <section>
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <nav class="navbar navbar-light-primary">
                        <div class="navbar-brand">List Infomations</div>
                        <div class="navbar-brand"><button class="btn btn-success btn-small" data-toggle="modal" data-target="#create_modal">Create New</button></div>
                    </nav>
                </div>
                <div class="card-body">
                    <div id="run-script"></div>
                    <table class="table table-bordered table-sm">
                        <thead>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Photo</th>
                            <th>Action</th>
                        </thead>
                        <tbody id="users_info">
                            <?php
                            $data_users = retrieve_data('SELECT * FROM tbl_users_info WHERE active = 1 LIMIT ' . pagination_row());
                            foreach ($data_users as $data) {
                            ?>
                                <tr id="row_<?= $data['id'] ?>">
                                    <td id='td_id'><?= $data['id'] ?></td>
                                    <td id='td_fname'><?= $data['full_name'] ?></td>
                                    <td id='td_username'><?= $data['username'] ?></td>
                                    <td id='td_email'><?= $data['email'] ?></td>
                                    <td id='td_phone'><?= $data['phone'] ?></td>
                                    <td id='td_img'> <img src="<?= $data['photo'] ?>" alt="" width="40px" class="d-flex justify-content-center image-rounded"> </td>
                                    <td class="d-flex justify-content-around">
                                        <button class="btn btn-primary btn-small" id="btnEdit<?= $data['id']; ?>" onclick='actionEdit(<?= $data["id"]; ?>, "<?= url("/views/edit.php") ?>")' data-user_id="<?= $data['id']; ?>" data-toggle="modal" data-target="#edit_modal">Edit</button>
                                        <button class="btn btn-danger btn-small" id="btnRemove<?= $data['id']; ?>" onclick="actionRemove(<?= $data['id']; ?>, '<?= url('/views/remove.php') ?>')" data-user_id="<?= $data['id']; ?>">Remove</button>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center">
                        <nav aria-label="Page navigation" id="pagination">
    
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<input type="text" id="data_url" hidden value="<?= url('/app/functions.php') ?>">
<input type="text" id="page_list" hidden value="<?= Pagination::getPageNumber() ?>">
<input type="text" id="page_num" hidden value="<?= Pagination::getCurrentPage() ?>">
<script>
    // $(document).bind("contextmenu", function(e) {
    //     e.preventDefault();
    // });

    // $(document).keydown(function(e) {
    //     if (e.which === 123) {
    //         return false;
    //     }
    // });


    $.ajax({
        url: $('#data_url').val(),
        type: 'POST',
        data: {
            action: 'pagination'
        },
        success: function(data) {
            $('#pagination').html(data);
            if ($('#page_list').val() == 1) {
                $('#P_btnPrev').attr('disabled', 'disabled');
            } else {
                $('#P_btnPrev').removeAttr('disabled', 'disabled');
            }
        }
    })

    if ($('#page_list').val() == 1) {
        $('#P_btnPrev').attr('disabled', 'disabled');
    } else {
        $('#P_btnPrev').removeAttr('disabled', 'disabled');
    }



    function actionPagination(action, url, num) {
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                action: action,
                num_page: num,
                cur_page : $('#page_num').val()
            },
            success: function(data) {
                $('table tbody#users_info').html(data);
            },
            error: function(e) {
                console.log('Fail')
            }
        })
    }



    function sign_out(url) {
        $.ajax({
            url: url,
            success: function(data) {
                window.location.reload();
            },
            error: function() {
                alert('fail');
            }
        })
    }

    function actionEdit(id, url) {
        var cp_id = id,
            get_url = url;
        $(document).ready(function() {
            $.ajax({
                url: get_url,
                type: 'POST',
                data: {
                    action: 'get_data_to_edit',
                    id: cp_id
                },
                success: function(data) {
                    $('#run-script').html(data);
                },
                error: function(e) {

                }
            })
        })
    }

    function actionRemove(id, url) {
        var cp_id = id,
            get_url = url;

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $(document).ready(function() {
                    $.ajax({
                        url: get_url,
                        data: {
                            id: cp_id
                        },
                        success: function(data) {
                            if (data != 'fail') {
                                $('#run-script').html(data);
                                swalWithBootstrapButtons.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                            } else {
                                swalWithBootstrapButtons.fire(
                                    'Cancelled',
                                    'Your imaginary file is safe :)',
                                    'error'
                                )
                            }
                        }
                    })
                })
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                )
            }
        })
    }
</script>