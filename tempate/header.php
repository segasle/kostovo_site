<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css?t=<?php echo(microtime(true).rand()); ?>">
</head>
<body>
<div class="container-fluid">
    <header>
        <div class="header">
            <div class="row">
                <div class="col-12">

                    <div class="logo">
                        <div class="sun">
                            <div class="roth"></div>
                        </div>
                        <div class="slang"><p>сверхвидящее</p><p>кострово</p></div>
                    </div>
                    <div class="row">
                        <div class="col-12 menu-header">
                            <div class="menu">
                                <input type="checkbox" id="checkbox">
                                <label class="burger" for="checkbox">
                                    <div class="burger_open"></div>
                                </label>
                                <nav>
                                    <?php
                                    get_menu();
                                    ?>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container">