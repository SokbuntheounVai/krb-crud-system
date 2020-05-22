<?php
header("Access-Control-Allow-Origin: *");
include '../router.php';
// include 'session.php';
cal_page();

class Pagination
{
    private static $last, $current_page, $page_number;
    public function _contructor($page_number)
    {
        self::$page_number = $page_number;
    }

    public static function setPageNumber($page_number)
    {
        self::$page_number = $page_number;
    }

    public static function getPageNumber()
    {
        return self::$page_number;
    }

    public static function setPagelast($last)
    {
        self::$last = $last;
    }

    public static function getPagelast()
    {
        return self::$last;
    }

    public static function setCurrentPage($current_page)
    {
        self::$current_page = $current_page;
    }

    public static function getCurrentPage()
    {
        return self::$current_page;
    }
}

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'pagination') {
        pagination();
    } elseif ($_POST['action'] == 'P_numbtn') {
        Pagination::setPageNumber($_POST['num_page']);
        display_by_pagination(Pagination::getPageNumber());
    } elseif ($_POST['action'] == 'P_btnPrev') {
        Pagination::setPageNumber($_POST['num_page']);
        pagination_button(Pagination::getPageNumber());
    } elseif ($_POST['action'] == 'P_btnNext') {
        Pagination::setPageNumber($_POST['num_page']);
        pagination_button(Pagination::getPageNumber());
    }
}

function display_row($id, $fullname, $username, $email, $phone, $photo)
{
    $url_edit = url('/views/edit.php');
    $url_remove = url('/views/remove.php');
    return
        "<tr id='row_" . $id . "'>
                        <td id='td_id'>" . $id . "</td>
                        <td id='td_fname'>" . $fullname . "</td>
                        <td id='td_username'>" . $username . "</td>
                        <td id='td_email'>" . $email . "</td>
                        <td id='td_phone'>" . $phone . "</td>
                        <td id='td_img'> <img src='" . $photo . "' alt='' width='40px' class='d-flex justify-content-center image-rounded'> </td>
                        <td class='d-flex justify-content-around'>
                            <button class='btn btn-primary btn-small' id='btnEdit" . $id . "'" . ' onclick="actionEdit(' . $id . ",'$url_edit')" . '" data-toggle="modal" data-target="#edit_modal">Edit</button>
                            <button class="btn btn-danger btn-small"' . " id='btnRemove" . $id . "'" . ' onclick="actionRemove(' . $id . ",'$url_remove')" . '">Remove</button>
                        </td>
                    </tr>';
}

function pagination_button($num)
{
    Pagination::setCurrentPage($_POST['cur_page']);
    $current_page = Pagination::getCurrentPage();
    if ($num == 'p_btn_next') {
        // if(Pagination::getCurrentPage()==)
        echo "
        <script>
            $(document).ready(function(){
                $('#P_btnNum".($current_page+1)."').click();
            })
        </script>
        ";
    } elseif ($num == 'p_btn_prev') {
        echo "
        <script>
             $('#P_btnNum".($current_page-1)."').click();
        </script>
        ";
    }
}

function display_by_pagination($num)
{
    // $cr = Pagination::getCurrentPage();
    $offset = '';
    if ($num == 1) {
        $addScript = "
        <script>
             $('#P_btnPrev').attr('disabled', 'disabled');
             $('#P_btnNext').removeAttr('disabled', 'disabled');
        </script>     
        ";
        Pagination::setCurrentPage($num);
        $data = retrieve_data("SELECT * FROM tbl_users_info WHERE active = 1 LIMIT " . pagination_row());
    } else {
        $offset = '';
        $offset = (pagination_row() * $num) - pagination_row();
        $data = retrieve_data("SELECT * FROM tbl_users_info WHERE active = 1 LIMIT $offset," . pagination_row());
        if (Pagination::getPagelast() == $num) {
            $addScript = "
            <script>
                $('#P_btnPrev').removeAttr('disabled', 'disabled');
                $('#P_btnNext').attr('disabled', 'disabled');
            </script>     
            ";
        } else {
            $addScript = "
            <script>
                $('#P_btnPrev').removeAttr('disabled', 'disabled');
                $('#P_btnNext').removeAttr('disabled', 'disabled');
            </script>     
            ";
        }
        Pagination::setCurrentPage($num);
    }

    $output = '';

    foreach ($data as $d) {
        $output .= display_row($d['id'], $d['full_name'], $d['username'], $d['email'], $d['phone'], $d['photo']);
    }

    echo $output . $addScript . "<script>$('#page_num').val(" . Pagination::getCurrentPage() . ");</script>";
}

function cout_row(){
    return mysqli_num_rows(retrieve_data("SELECT * FROM tbl_users_info WHERE active = 1"));
}

function cal_page()
{
    $actauly_count = retrieve_data("SELECT * FROM tbl_users_info WHERE active = 1");

    if ((mysqli_num_rows($actauly_count) % _PAGINATION) == 0) {
        $divide = (int) (mysqli_num_rows($actauly_count) / _PAGINATION);
    } else {
        $divide = (int) (mysqli_num_rows($actauly_count) / _PAGINATION) + 1;
    }
    Pagination::setPagelast($divide);
    return $divide;
}

function pagination()
{


    $li = '';
    for ($i = 0; $i < cal_page(); $i++) {
        $li .= '<li class="page-item"><button class="page-link" id="P_btnNum' . ($i + 1) . '" onclick="actionPagination(' . "'P_numbtn" . "','" . url('/app/functions.php') . "'," . ($i + 1) . ')" ' . '">' . ($i + 1) . '</button></li>';
    }

    $output = '
    <ul class="pagination" >
        <li class="page-item"><button class="page-link" type="button"  id="P_btnPrev" onclick="actionPagination(' . "'P_btnPrev" . "','" . url('/app/functions.php') . "','p_btn_prev'" . ')" ' . '">Previous</button></li>' .
        $li
        . '<li class="page-item"><button class="page-link" type="button"  id="P_btnNext" onclick="actionPagination(' . "'P_btnNext" . "','" . url('/app/functions.php') . "','p_btn_next'" . ')" ' . '">Next</button></li>
    </ul>
    ';

    echo $output;
}

function query_data($query)
{
    $con = mysqli_connect(getHost(), getUsername(), getPass(), getDatabase());
    if ($con) {
        if ($con->query($query)) {
            return 'success';
            mysqli_close($con);
        } else {
            return mysqli_error($con);
            mysqli_close($con);
        }
    } else {
        echo "<script>alert('" . $con->error_log . "')</script>";
    }
}

function retrieve_data($query)
{
    $con = mysqli_connect(getHost(), getUsername(), getPass(), getDatabase());
    if ($con) {
        $output = mysqli_query($con, $query);
        if ($output) {
            return $output;
            mysqli_close($con);
        } else {
            return mysqli_error($con);
            mysqli_close($con);
        }
    } else {
        echo "<script>alert('" . mysqli_error($con) . "')</script>";
    }
}

function retrieve_sigle_row_data($query)
{
    $con = mysqli_connect(getHost(), getUsername(), getPass(), getDatabase());
    if ($con) {
        if ($output = $con->query($query)) {
            return mysqli_fetch_array($output);
            mysqli_close($con);
        } else {
            return mysqli_error($con);
            mysqli_close($con);
        }
    } else {
        echo "<script>alert('" . mysqli_error($con) . "')</script>";
    }
}

function checkedConnectionDatabase($host, $username, $pass, $database, $success_msg, $fail_msg)
{
    if (connectionDatabase($host, $username, $pass, $database)) {
        echo $success_msg;
    } else {
        echo $fail_msg;
    }
}
