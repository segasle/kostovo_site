<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css?t=<?php echo(microtime(true) . rand()); ?>">
    <link rel="stylesheet" href="font-icons/css/font-awesome.css">
</head>
<body>
<div class="container-fluid">
    <header>
        <div class="header">
            <div class="row">
                <div class="col-12">
                    <div class="logo">
                        <div class="sun move">
                            <div class="roth"></div>
                        </div>
                        <div class="slang"><p>сверхвидящее</p>
                            <p>кострово</p></div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="button" class="btn btn-primary modal-open" data-toggle="modal"
                                    data-target="#exampleModal">
                                <span class="fa fa-user-circle-o fa-1x">Авторизоваться</span>
                            </button>
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Авторизуйтесь</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail">Email</label>
                                                    <input type="email" class="form-control" id="exampleInputEmail" name="email" placeholder="Email">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword">Пароль</label>
                                                    <input type="password" class="form-control" name="password" id="exampleInputPassword" placeholder="Password">
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox">Запомнить меня
                                                    </label>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-default btn-primary" name="submit">Войти</button>
                                                </div>
                                            </form>
                                           <?php link_reg(); ?>
                                            <p class="">Или можно авторизоваться с помощью соц сети</p>
                                            <div class="block-icons">
                                                <i class="fa fa-facebook-official fa-2x" aria-hidden="true"></i>
                                                <i class="fa fa-odnoklassniki fa-2x" aria-hidden="true"></i>
                                                <i class="fa fa-vk fa-2x" aria-hidden="true"></i>
                                                <i class="fa fa-instagram fa-2x" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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