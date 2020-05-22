<?php

define('_HOST_NAME', 'localhost');
define('_USER_NAME', 'root');
define('_PASSWORD', 'adminmysql');
define('_DATABASE_NAME', 'state_test_db');
define('_PORT', null);

function getHost()
{
    return _HOST_NAME;
}

function getUsername()
{
    return _USER_NAME;
}
function getPass()
{
    return _PASSWORD;
}
function getDatabase()
{
    return _DATABASE_NAME;
}
function getPort()
{
    return _PORT;
}

// $con = mysqli_connect(HOST_NAME, USER_NAME, PASSWORD, DATABASE_NAME, PORT);
// $con = mysqli_connect(getHost(), getUsername(), getPass(), getDatabase(), getPort());
// if (mysqli_connect_errno()) {
//     echo "<script>alert('Fail to connection mysql!'" . mysqli_connect_errno() . "')</script>";
// } else {
//     echo "<script>alert('successful!')</script>";
// }

?>