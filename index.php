<?php
session_start();
header("Access-Control-Allow-Origin: *");
include 'router.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= url('/assets/bootstrap/css/bootstrap.css'); ?>">
    <link rel="stylesheet" href="<?= url('/assets/package/dist/sweetalert2.css'); ?>">
    <title>Document</title>
</head>

<body>
    <script src="<?= url('/assets/package/dist/sweetalert2.all.js') ?>"></script>
    <script src="<?= url('/assets/jquery-3.4.2.js') ?>"></script>
    <?php include './views/master.php' ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="<?= url('/assets/bootstrap/js/bootstrap.js') ?>"></script>

</html>