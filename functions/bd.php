<?php
$user = 'ca57629_kostrovo';
$array = array(
    array(
        'host' => 'localhost',
        'user' => 'root',
        'password' => 'root',
        'database' => array(
            array(
                'name' => 'kostrobo',
            ),
            array(
                'name' => 'kostrovo',
            ),
        ),
    ),
    array(
        'host' => 'localhost',
        'user' => $user,
        'password' => 'Nexvf1998',
        'database' => array(
            array(
                'name' => $user,
            ),
        ),
    ),
);
global $mysqli;
foreach ($array as $item => $key) {

    if (isset($key['database'])) {
        if (is_array($key['database']) || is_object($key['database'])) {
            foreach ($key['database'] as $value) {
                /*echo '<pre>';
                print_r($value);
                echo '</pre>';                                           */
                if (isset($value['name'])) {
                    $base = $value['name'];
                }
                if (empty($mysqli)) {
                    $mysqli = mysqli_connect($key['host'], $key['user'], $key['password'], $base);
                    mysqli_set_charset($mysqli, 'UTF8');
                }
                if (mysqli_connect_errno()) {
                    echo 'ошибка в подключении к БД (' . mysqli_connect_errno() . ')' . mysqli_connect_error();
                }
            }

        }


    }


    session_start();
}