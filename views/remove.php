<?php
header("Access-Control-Allow-Origin: *");
// include '../router.php';
include '../app/functions.php';
$url = url('/index.php');
if (isset($_GET['id'])) {
    $query = 'UPDATE tbl_users_info SET active = 0 WHERE id = '.$_GET['id'];

    if (query_data($query)) {
        $output = "
            <script>
                $(document).ready(function() {
                    $('table tbody#users_info tr#row_" . $_GET['id'] . "').remove();
                })
            </script>
        ";
        echo $output;
    } else {
        echo 'fail';
    }
}
