<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="yandex-verification" content="8ee07f1a11254e34" />
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function (m, e, t, r, i, k, a) {
            m[i] = m[i] || function () {
                (m[i].a = m[i].a || []).push(arguments)
            };
            m[i].l = 1 * new Date();
            k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
        })
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(52495369, "init", {
            id: 52495369,
            clickmap: true,
            trackLinks: true,
            accurateTrackBounce: true,
            webvisor: true
        });
    </script>
    <noscript>
        <div><img src="https://mc.yandex.ru/watch/52495369" style="position:absolute; left:-9999px;" alt=""/></div>
    </noscript>
    <!-- /Yandex.Metrika counter -->

    <meta property="og:locale" content="ru_RU">
    <meta property="og:type" content="article">
    <meta property="og:title" content="Сверхвидящее Кострово">
    <meta property="og:description" content="ru_RU">
    <meta property="og:site_name" content="">
    <meta name="robots" content="index, follow">
    <meta name="keywords" content="Кострово информация">
    <meta name="description" content="">
    <link rel="icon" type="image/png" href="photo/favo.png">
    <title>
        <?php
        include 'functions/head.php';
        echo $title;
        ?>
    </title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css?t=<?php echo(microtime(true) . rand()); ?>">
    <link rel="stylesheet" href="font-icons/css/font-awesome.css">
    <script>
        window.fbAsyncInit = function () {
            FB.init({
                appId: '1759331964212959',
                cookie: true,
                xfbml: true,
                version: 'v3.2'
            });

            FB.AppEvents.logPageView();

        };

        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s);
            js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
</head>
<body>
<?php
global $email;
if (empty($_COOKIE['ap'])) { ?>
    <div id="appomed-overlay"></div>
    <div id="appomed-pop-main">
        <div id="appomed-pop-caption">
            <div id="appomed-pop-h4">Внимание!</div>
            <div id="appomed-pop-close"></div>
        </div>
        <div id="appomed-pop-main-2">
            <p class="text-center">Сайт работает в режиме beta-тестирования! Если нашли баг/ошибку, пишите на почту или
                в соц сеть</p>
            <p class="text-center h3"><i class="fa fa-envelope-o"></i><a
                        href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></p>
            <div class="block_icon block-center">
                <?php get_soclal(); ?>
            </div>
            <div id="appomed-pop-but">Вернуться к просмотру сайта</div>
        </div>
    </div>

<?php } ?>
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
                        <div class="col-12 no-col">
                            <div class="float-right">
                                <?php
                                auto_users();
                                ?>
                            </div>
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
                                            <?php
                                            users_authorization();
                                            ?>
                                            <form action="" method="post" class="float-none">
                                                <div class="form-group">
                                                    <label for="exampleInputEmailGo">Email</label>
                                                    <input type="email" class="form-control" id="exampleInputEmailGo"
                                                           name="email" placeholder="Email"
                                                           value="<?php echo @$_POST['email'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword">Пароль</label>
                                                    <input type="password" class="form-control" name="password"
                                                           id="exampleInputPassword" placeholder="Password">
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" value='1' name="checkbox">Запомнить меня
                                                    </label>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-default btn-primary"
                                                            name="sub">Войти
                                                    </button>
                                                </div>
                                            </form>
                                            <?php link_reg(); ?>
                                            <p class="">Или можно авторизоваться с помощью соц сети</p>
                                            <?php link_authorization(); ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                Отмена
                                            </button>
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
                                <?php
                                if (isset($_SESSION['id']) or isset($_SESSION['token'])) {
                                    echo '<div class="nav">';
                                    echo '<nav class=\'float-left\'>';
                                    get_users_menu();
                                    echo '</nav>';
                                    echo '<nav class=\'float-left\'>';
                                    get_menu();
                                    echo '</nav>';
                                    echo '</div>';
                                } else {
                                    echo '<nav class="nav-one">';
                                    get_menu();
                                    echo '</nav>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <description>
    <div class="contain">