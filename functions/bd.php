<?php
global $mysqli;
if (empty($mysqli)){
    $mysqli = mysqli_connect('localhost', 'root', 'root', 'kostovo');
    mysqli_set_charset($mysqli, 'UTF8');
}

if (mysqli_connect_errno()){
    echo 'ошибка в подключении к БД ('.mysqli_connect_errno().')'.mysqli_connect_error();
}session_start();