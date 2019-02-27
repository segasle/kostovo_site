<?php
$array = array(
    array(
        'host' => 'localhost',
        'user' => 'root',
        'password' => 'root',
        'database' => 'kostovo',
    ),
    array(
        'host' => 'localhost',
        'user' => 'ca57629_kostrovo',
        'password' => 'Nexvf1998',
        'database' => 'ca57629_kostrovo',
    ),
);
global $mysqli;
foreach ($array as $item){
    if (empty($mysqli)){
        $mysqli = mysqli_connect($item['host'], $item['user'], $item['password'], $item['database']);
        mysqli_set_charset($mysqli, 'UTF8');
    }
    if (mysqli_connect_errno()){
        echo 'ошибка в подключении к БД ('.mysqli_connect_errno().')'.mysqli_connect_error();
    }session_start();
}