<?php
define('_URL', 'http://localhost/apps/learning/php/exercise/crud');
define('_PAGINATION',5);

function allow_CORS(){
    return header('Access-Control-Allow-Origin', '*')
    ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
    ->header('Access-Control-Allow-Headers',' Origin, Content-Type, Accept, Authorization, X-Request-With')
    ->header('Access-Control-Allow-Credentials',' true');
}


function url($path)
{
    return _URL . $path;
}

function pagination_row(){
    return _PAGINATION;
}


function connectionDatabase($host, $username, $pass, $database)
{
    $con = mysqli_connect($host, $username, $pass, $database);
    return $con;
}



// include url('/views/insert.php');
