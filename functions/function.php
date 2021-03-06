<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
header('Content-Type: text/html; charset=utf-8');

define('WP_DEBUG', true);
define('WP_CACHE', false);
function connections()
{
    $file = '';
    if (empty($_GET['page'])) {
        $file = 'main';
    } else {
        $file = $_GET['page'];
    }

    include 'tempate/header.php';
    if (file_exists('users/' . $file . '.php')) {
        if (isset($_SESSION['id']) or isset($_SESSION['token'])) {
            include 'users/' . $file . '.php';
        } else {
            include 'imip/errors.php';
        }
    } else {
        include 'imip/' . $file . '.php';
    }

    include 'tempate/footer.php';

}

function do_query($query)
{
    global $mysqli;

    $result = mysqli_query($mysqli, $query);
    return $result;
}

function get_menu()
{
    $sql = do_query('SELECT * FROM `menu` WHERE `parent` = "0" ORDER BY menu.id');
    $output = "<ul>";
    foreach ($sql as $r) {
        $output .= "<li><a href='" . $r['url'] . "'>" . $r['title'] . "</a></li>";
    }
    $output .= "</ul>";
    echo $output;
    return;
}

function get_users_menu()
{
    $sql = do_query('SELECT * FROM `users_menu` WHERE `parent` = "0" ORDER BY users_menu.id');
    $output = "<ul>";
    foreach ($sql as $r) {
        $output .= "<li><a href='" . $r['url'] . "'>" . $r['title'] . "</a></li>";
    }
    $output .= "</ul>";
    echo $output;
    return;
}

function input_reg()
{
    $sql = do_query('SELECT * FROM `input_reg` ORDER BY input_reg.id');
    $output = "<form method='post' action=''>";
    foreach ($sql as $r) {
        $name = $r['name'];
        $output .= "<div class='form-group'><label for='" . $r['for'] . "'>" . $r['text'] . "</label><input class='form-control' type='" . $r['type'] . "' name='" . $r['name'] . "' placeholder='" . $r['placeholder'] . "' id='" . $r['for'] . "' value='" . @$_POST[$name] . "'></div>";
    }
    $output .= "<div class=\"checkbox\">
    <label>
      <input type=\"checkbox\" name='checkbox' >Вы должны согласиться со правами на передачу данных
    </label>
  </div> <button type=\"submit\" class=\"btn btn-default btn-primary\" name='submit'>Отправить</button></form>";
    echo $output;
    return;
}

function link_reg()
{
    $sql = do_query('SELECT * FROM `reg`');
    $output = "";
    foreach ($sql as $r) {
        $output .= "<p>" . $r['description'] . "<a href='" . $r['url'] . "'>" . " " . $r['title'] . "</a></p>";
    }

    echo $output;
    return;
}

function get_soclal()
{
    $out = '<div class="block_img">';
    $sql = do_query('SELECT * FROM `social_network`');
    foreach ($sql as $item) {
        $out .= '<a href="' . $item['url'] . '" class="' . $item['class'] . ' img_icons" target="_blank"></a>';
    }
    $out .= '</div>';
    echo $out;
    return;
}

function get_news()
{
    global $token;
    $out = '<div class="row">';
    $content = file_get_contents("https://api.vk.com/method/wall.get?owner_id=-178156792&count=100&extended=1&filter=all&$token&v=5.60");
    $elements = json_decode($content, true);
    foreach ($elements as $element) {
        foreach ($element['groups'] as $item) {
            echo '<h1 class="text-center">' . $item['name'] . '</h1>';
        }


        foreach ($element['items'] as $item) {
            $text = $item['text'];
            $link = $item['owner_id'] . '_' . $item['id'];
            $data = date('d.m.Y h:m', $item['date']);
            if (isset($item['attachments'])) {
                if (is_array($item['attachments']) || is_object($item['attachments'])) {

                    foreach ($item['attachments'] as $attachment => $key) {

                        if (isset($key['photo'])) {
                            $img = "<img src='" . $key['photo']['photo_1280'] . "' class='w-100'>";
                        } else {
                            $img = '';
                        }

                    }

                }
            }

            $out .= '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><div class="post"><p class="post_text">' . $text . '</p>' . @$img . '<p class="post_data">' . $data . '</p><a href="https://vk.com/wall' . $link . '" class="post_link">Ссылка на пост</a></div></div>';
        }
    }
    $out .= '</div>';
    echo $out;
    return;
}

function users_reg()
{
    $data = $_POST;
    if (isset($data['submit'])) {
        $email = $data['email'];
        $errors = array();
        $phone = $data['phone'];
        if (!isset($data['checkbox'])) {
            $errors[] = 'Не поставили галочку';
        }
        if (trim($data['name']) == '') {
            $errors[] = 'Вы не ввели имя';

        }
        if (trim($data['surname']) == '') {
            $errors[] = 'Вы не ввели фамили≥';

        }
        if (trim($data['email']) == '') {
            $errors[] = 'Вы не ввели электронную почту';
        }
        if (!preg_match("/^(?!.*@.*@.*$)(?!.*@.*\-\-.*\..*$)(?!.*@.*\-\..*$)(?!.*@.*\-$)(.*@.+(\..{1,11})?)$/", "$email")) {
            $errors[] = 'Вы неправильно ввели электронную почту';
        }
        if ($data['password1'] == '') {
            $errors[] = 'Вы не ввели пароль';

        }
        if ($data['password1'] >= 6) {
            $errors[] = 'короткий пароль';
        }

        if ($data['password2'] != $data['password1']) {
            $errors[] = 'Вы не правильно ввели пароль';
        }
        if (!preg_match("/(^(?!\+.*\(.*\).*\-\-.*$)(?!\+.*\(.*\).*\-$)(\+[0-9]{1,3}\([0-9]{1,3}\)[0-9]{1}([-0-9]{0,8})?([0-9]{0,1})?)$)|(^[0-9]{1,4}$)/", "$phone")) {
            $errors[] = "Вы непраильно ввели номер телефона, пример: +7(915)5473712";
        }
        if (trim($data['address']) == '') {
            $errors[] = "Вы не ввели адрес";
        }
        if (empty($errors)) {
            $result = do_query("SELECT COUNT(*) as count FROM users WHERE `email` = '{$data['email']}'");
            $result = $result->fetch_object();
            if (empty($result->count)) {
                // сохраняет все данные в БД
                $wer = do_query("INSERT INTO users (`name`, `surname`,`email`, `password`, `phone`, `address`) VALUES ('{$data['name']}','{$data['surname']}','{$data['email']}','" . password_hash($data['password2'], PASSWORD_DEFAULT) . "','{$data['phone']}','{$data['address']}')");
                if (!empty($wer)) {
                    echo '<div class="go">Успешно зарегиревались</div>';
                }
            } else {
                echo '<div class="errors">Такая электронная почта уже есть</div>';
            }
        } else {
            echo '<div class="errors">' . array_shift($errors) . '</div>';
        }

    }
    return;
}

function users_authorization()
{
    $data = $_POST;
    if (isset($data['sub'])) {
        $email = $data['email'];
        $password = $data['password'];
        $resilt = mysqli_fetch_assoc(do_query("SELECT * FROM `users` WHERE `email` ='" . $email . "'"));
        if ($resilt) {
            if (!password_verify($password, $resilt['password'])) {
//                setcookie('id', $data['email'], time()+3600*24*30*12, '/');
//                setcookie('password', $data['password'], time()+3600*24*30*12, '/');
//                header('location: ' .$_SERVER['HTTP_REFERER']);
                echo '<div class="errors">Пароль не верный</div>';

            }
        } else {
            echo '<div class="errors">Пользоаатель не найден</div>';
        }
    }
    return;
}

function user_ses()
{

    if (isset($_POST['sub'])) {
        $resilt = mysqli_fetch_assoc(do_query("SELECT * FROM `users`"));
        if (isset($_SESSION)) {
            $_SESSION['outh'] = true;
            $_SESSION['id'] = $resilt['id'];
            $_SESSION['email'] = $resilt['email'];
            $_SESSION['name'] = $resilt['name'];
            $_SESSION['photo'] = $resilt['photo'];
            $_SESSION['phone'] = $resilt['phone'];
            $_SESSION['surname'] = $resilt['surname'];
            $_SESSION['address'] = $resilt['address'];
            header('location: ?page=main');
        }
    }

}

function auto_users()
{
    if (isset($_SESSION['id']) or isset($_SESSION['token'])) {
        echo '<button class="btn btn-primary modal-open float-left">Привет, ' . $_SESSION['name'] . '!</button><form method="post" class="float-left"><button type="submit" class="btn btn-primary modal-open" name="input">Выйти</button></form>';


    } else {
        echo ' <button type="button" class="btn btn-primary modal-open" data-toggle="modal"
                                    data-target="#exampleModal">
                                <span class="fa fa-user-circle-o fa-1x">Авторизоваться</span>
                            </button>';
    }

    return;
}

function revo()
{

    if (isset($_POST['input'])) {
        unset($_SESSION['id']);
        unset($_SESSION['token']);
        header('location: ?page=main');
    }
}

function password_recovery()
{
    $data = $_POST;
    if (isset($data['submit'])) {
        $errors = array();
        if (trim($data['email']) == '') {
            $errors[] = 'Вы не ввели электронную почту';
        }
        if ($data['password1'] == '') {
            $errors[] = 'Вы не ввели пароль';

        }
        if ($data['password1'] <= 6) {
            $errors[] = 'короткий пароль';
        }
        if ($data['password2'] != $data['password1']) {
            $errors[] = 'Вы неправильно ввели пароль';
        }
        if (empty($errors)) {
            $result = do_query("SELECT COUNT(*) as count FROM users WHERE `email` = '{$data['email']}'");
            $result = $result->fetch_object();
            if (!empty($result->count)) {
                $set = do_query("UPDATE `users` SET `password` = '" . password_hash($data['password2'], PASSWORD_DEFAULT) . "'WHERE `email` = '{$data['email']}' ");

            } else {
                echo '<div class="errors">Такая электронная почта не существует</div>';
            }
        } else {
            echo '<div class="errors">' . array_shift($errors) . '</div>';
        }
    }
    return;
}

function users_data()
{
    $data = $_POST;
    if (isset($data['submit'])) {
        if (isset($_FILES['file'])) {
            $update = 'update/';
            $file = $_FILES['file']['name'];
            $update_file = $update . $file;
            if (!file_exists($update_file)) {
                if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                    if ($_FILES['file']['size'] > 1024 * 3 * 1024) {
                        echo '<div class="errors">Файл должен быть не больше 3 МБ</div>';
                    } else {
                        $ext = pathinfo($update_file, PATHINFO_EXTENSION);
                        $allow = array('jpeg', 'jpg', 'png');
                        if (in_array($ext, $allow)) {
                            if (move_uploaded_file($_FILES['file']['tmp_name'], $update_file)) {
                                $users = do_query("UPDATE `users` SET `photo` = '" . $file . "'WHERE `email` = '" . $_SESSION['email'] . "' ");
                                print_r($users);
                                if ($users) {
                                    echo '<div class="go">Файл успешно загружен</div>';
                                }
                            }
                        }
                    }
                }
            }
        }
        $errors = array();
        $phone = $data['phone'];
        /* if (!empty($_SESSION['name'])) {
             $data['name'] = $_SESSION['name'];
         }
         if (!empty($_SESSION['surname'])) {
             $data['familia'] = $_SESSION['surname'];
         }
         if (isset($data['name']) or isset($data['familia']) or isset($data['phone']) or isset($data['address'])) {
             if (trim($data['name']) == '') {
                 $errors[] = "Вы не ввели имя";
             }
             if (trim($data['familia']) == '') {
                 $errors[] = "Вы не ввели фамилию";
             }*/
        if (!preg_match("/(^(?!\+.*\(.*\).*\-\-.*$)(?!\+.*\(.*\).*\-$)(\+[0-9]{1,3}\([0-9]{1,3}\)[0-9]{1}([-0-9]{0,8})?([0-9]{0,1})?)$)|(^[0-9]{1,4}$)/", "$phone")) {
            $errors[] = "Вы непраильно ввели номер телефона, пример: +7(915)5473712";
        }
        if (trim($data['address']) == '') {
            $errors[] = "Вы не ввели адрес";
        }

        if (empty($errors)) {
            $users = do_query("UPDATE `users` SET `address` = '" . $data['address'] . "',`phone` = '" . $phone . "' WHERE `email` = '" . $_SESSION['email'] . "'");
            if ($users) {
                echo '<div class="go">Данные обновлены</div>';
            }
        } else {
            echo '<div class="errors">' . array_shift($errors) . '</div>';
        }
        //}
    }
    return;
}

function selected()
{
    $option = array(
        array(
            'value' => 'Транспорт',
        ),
        array(
            'value' => '&nbsp; &nbsp; Автомобили',
        ),
        array(
            'value' => '&nbsp; &nbsp; мотоциклы и мототехника',
        ),
        array(
            'value' => '&nbsp; &nbsp; грузовики и спецтехника',
        ),
        array(
            'value' => '&nbsp; &nbsp; водный транспорт',
        ),
        array(
            'value' => '&nbsp; &nbsp; запчасти и аксессуары',
        ),
        array(
            'value' => 'недвижимость',
        ),
        array(
            'value' => '&nbsp; &nbsp; квартиры',
        ),
        array(
            'value' => '&nbsp; &nbsp; комнаты',
        ),
        array(
            'value' => '&nbsp; &nbsp; дома, дачи, коттеджи',
        ),
        array(
            'value' => '&nbsp; &nbsp; земельные участки',
        ), array(
            'value' => '&nbsp; &nbsp; гаражи и машиноместа',
        ), array(
            'value' => '&nbsp; &nbsp; коммерческая недвижимость',
        ), array(
            'value' => '&nbsp; &nbsp; недвижимость за рубежом',
        ), array(
            'value' => 'личные вещи',
        ), array(
            'value' => '&nbsp; &nbsp; одежда , обувь, аксессуары',
        ), array(
            'value' => '&nbsp; &nbsp; детская одежда и обувь',
        ), array(
            'value' => '&nbsp; &nbsp; товары для детей и игрушки',
        ), array(
            'value' => '&nbsp; &nbsp; часы и украшения',
        ), array(
            'value' => '&nbsp; &nbsp; красота и здоровье',
        ), array(
            'value' => 'для дома и дачи',
        ), array(
            'value' => '&nbsp; &nbsp; бытовая техника',
        ), array(
            'value' => '&nbsp; &nbsp; мебель и интерьер',
        ), array(
            'value' => '&nbsp; &nbsp; посуда и товары для кухни',
        ), array(
            'value' => '&nbsp; &nbsp; продукты питания',
        ), array(
            'value' => '&nbsp; &nbsp; ремонт и строительство',
        ), array(
            'value' => '&nbsp; &nbsp; растения',
        ), array(
            'value' => 'бытовая электроника',
        ), array(
            'value' => '&nbsp; &nbsp; аудио и видео',
        ), array(
            'value' => '&nbsp; &nbsp; игры ,приставки и программы',
        ), array(
            'value' => '&nbsp; &nbsp; настольные компьютеры',
        ), array(
            'value' => '&nbsp; &nbsp; ноутбуки',
        ), array(
            'value' => '&nbsp; &nbsp; оргтехника и расходники',
        ), array(
            'value' => '&nbsp; &nbsp; планшеты и электронные книги',
        ), array(
            'value' => '&nbsp; &nbsp; телефоны',
        ), array(
            'value' => '&nbsp; &nbsp; товары для компьютера',
        ), array(
            'value' => '&nbsp; &nbsp; фототехника',
        ), array(
            'value' => 'хобби и отдых',
        ), array(
            'value' => '&nbsp; &nbsp; билеты и путешествия',
        ), array(
            'value' => '&nbsp; &nbsp; велосипеды',
        ), array(
            'value' => '&nbsp; &nbsp; книги и журналы',
        ), array(
            'value' => '&nbsp; &nbsp; коллекционирование',
        ), array(
            'value' => '&nbsp; &nbsp; музыкальные инструменты',
        ), array(
            'value' => '&nbsp; &nbsp; охота и рыбалка',
        ), array(
            'value' => '&nbsp; &nbsp; спорт и отдых',
        ), array(
            'value' => 'животные',
        ), array(
            'value' => '&nbsp; &nbsp; собаки',
        ), array(
            'value' => '&nbsp; &nbsp; кошки',
        ), array(
            'value' => '&nbsp; &nbsp; птицы',
        ), array(
            'value' => '&nbsp; &nbsp; аквариум',
        ), array(
            'value' => '&nbsp; &nbsp; другие животные',
        ), array(
            'value' => '&nbsp; &nbsp; товары для животных',
        ), array(
            'value' => 'для биснеса',
        ), array(
            'value' => '&nbsp; &nbsp; готовый бизнес',
        ), array(
            'value' => '&nbsp; &nbsp; оборудование для бизнеса',
        ),
    );
    $out = ' <select class="form-control" name="value">';
    foreach ($option as $item) {
        $out .= '<option value="' . $item['value'] . '">' . $item['value'] . '</option>';
    }
    $out .= '</select>';
    echo $out;
    return;
}

function add_ads()
{
    $data = $_POST;
    if (isset($data['submit'])) {
        $price = $data['price'];
        $errors = array();
        if (empty($data['title'])) {
            $errors[] = 'Введите пожалуйста заголовок';
        }
        if ($data['title'] > 5) {
            $errors[] = 'Короткий заголовок';
        }
        if (empty($price)) {
            $errors[] = 'Укажите пожалуйста цену';
        }
        if (!preg_match("/^(?!0.*$)([0-9]{1,3}(,[0-9]{3})?(,[0-9]{3})?(\.[0-9]{2})?)$/", "$price")) {
            $errors[] = 'Должны быть только цифры';
        }
        if (empty($data['text'])) {
            $errors[] = 'Введите текст о вещи/услуги';
        }
        if ($data['text'] > 10) {
            $errors[] = 'Мало символов';
        }
        if (empty($errors)) {
            if (!empty($data['file'])) {
                if (isset($_FILES['file'])) {
                    $update = 'ads_img/';
                    $file = $_FILES['file']['name'];
                    $update_file = $update . $file;
                    if (!file_exists($update_file)) {
                        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                            if ($_FILES['file']['size'] > 1024 * 3 * 1024) {
                                echo '<div class="errors">Файл должен быть не больше 3 МБ</div>';
                            } else {
                                $ext = pathinfo($update_file, PATHINFO_EXTENSION);
                                $allow = array('jpeg', 'jpg', 'png');
                                if (in_array($ext, $allow)) {
                                    if (move_uploaded_file($_FILES['file']['tmp_name'], $update_file)) {
                                        $result = do_query("SELECT COUNT(*) as count FROM `ads` WHERE `title` = '{$data['title']}'");
                                        $result = $result->fetch_object();
                                        if (empty($result->count)) {
                                            $wer = do_query("INSERT INTO `ads` (`vaul`,`title`, `price`,  `text`, `photo`, `author_id` ) VALUES ('{$data['value']}','{$data['title']}','{$data['price']}', '{$data['text']}','{$file}','{$_SESSION['email']}'')");
                                            if (!empty($wer)) {
                                                echo '<div class="go">Успешно подано</div>';
                                            } else {
                                                echo '<div class="errors">Такая запись уже есть</div>';
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            } else {
                $result = do_query("SELECT COUNT(*) as count FROM `ads` WHERE `title` = '{$data['title']}'");
                $result = $result->fetch_object();
                if (empty($result->count)) {
                    $wer = do_query("INSERT INTO `ads` (`vaul`,`title`, `price`,  `text`, `author_id`) VALUES ('{$data['value']}','{$data['title']}','{$data['price']}', '{$data['text']}', '{$_SESSION['email']}')");
                    if (!empty($wer)) {
                        echo '</div class="go">Успешно подано</div>';
                    } else {
                        echo '<div class="errors">Такая запись уже есть</div>';
                    }
                }

            }
        } else {
            echo '<div class="errors">' . array_shift($errors) . '</div>';
        }
    }
    return;
}

function post_tempate($sql)
{
    while ($us = mysqli_fetch_assoc($sql)) {

        $title = $us['title'];
        $text = $us['text'];
        $price = $us['price'];
        $data = new DateTime($us['date']);
        $name = $us['name'];
        if (!empty($us['photo_ads'])) {
            $img = '<img src="ads_img/' . $us['photo_ads'] . '" class="post_img">';
        } else {
            $img = '<div class="post_no-img"><p>Нет фото</p></div>';
        }
        if (!empty($us['users-id'])) {
            $link = '<a href="https://vk.com/id' . $us['users-id'] . '">Ссылка на профиль</a>';
        } else {
            $link = '<a href="tel:' . $us['phone'] . '">' . $us['phone'] . '</a>';
        }
        //$class = 'fa-star';
        global $class;
        ?>
        <div class="col-12">
            <div class="post">
                <div class="row">
                    <div class="col-xs-12 col-md-2">
                        <?php echo $img; ?>
                    </div>
                    <div class="col-xs-12 col-md-10">
                        <div class="post_favourites">
                            <form action="" method="post">
                                <button type="submit" name="star" value="1"><i class="fa <?php echo $class; ?> fa-2x"
                                                                               aria-hidden="true"></i></button>
                            </form>
                        </div>
                        <!--
                        <button type="button" class="modal-message" data-toggle="modal"
                                data-target="#exampleModal2">
                            <span class="fa fa-commenting-o fa-2x"></span>
                        </button>
                        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="message">
                                            <div class="message-window">
                                                <p class="window-text"></p>
                                            </div>
                                        </div>
                                        <form action="" method="post" class="form-message">
                                            <div class="form-group">
                                                <div class="form-message-text">
                                                    <input type="text" class="form-control">
                                                    <button type="submit" class="fa fa-paper-plane-o fa-2x"></button>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                            Отмена
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        -->
                        <div class="post_title">
                            <p><?php echo $title; ?></p>
                        </div>
                        <div class="post_text"><p><?php echo $text; ?></p></div>
                        <div class="post_price"><p class="fa fa-rub"><?php echo $price; ?></p></div>
                        <div class="post_info">
                            <p>Продавец:<?php echo ' ' . $name . ' ' . $link; ?></p>
                        </div>

                        <div class="post_data"><p><?php echo $data->format('d.m.Y H:m:s'); ?></p></div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    return true;
}

function search()
{
    if (isset($_POST['submit'])) {
        if (!empty($_POST['search'])) {

            $search = explode(' ', $_POST['search']);
            $res = array();
            $cound = count($search);
            $co = 0;
            $errors = array();
            if (strlen($_POST['search']) < 3) {
                $errors[] = 'Слишком короткий поисковый запрос.';
            }
            if (strlen($_POST['search']) > 64) {
                $errors[] = 'Слишком длинный поисковый запрос.';
            }
            if (empty($errors)) {
                foreach ($search as $item) {
                    $co++;
                    if ($co < $cound) {
                        $res[] = "CONCAT (`title`, `text`) LIKE '%" . $item . "%' OR ";
                    } else {
                        $res[] = "CONCAT (`title`, `text`) LIKE '%" . $item . "%'";
                    }
                }
                $implode = implode("", $res);
                $sql = do_query("SELECT * FROM `ads`, `users` WHERE users.email = ads.author_id AND $implode");
                if (mysqli_num_rows($sql) > 0) {
                    post_tempate($sql);
                } else {
                    echo '<div class="errors">По вашему запросу ничего не найдено.</div>';
                }

            } else {
                echo '<div class="errors">' . array_shift($errors) . '</div>';
            }
        } else {
            echo '<div class="errors">Задан пустой поисковый запрос.</div>';
        }

    }
    return;
}

function link_authorization()
{
    global $scope;
    global $redirect_uri;
    global $id;
    if (empty($_SESSION['token'])) {
        echo ' <a href="https://oauth.vk.com/authorize?client_id=' . $id . '&display=page&redirect_uri=' . $redirect_uri . '&scope=' . $scope . '&response_type=code&v=5.92" class="fa fa-vk fa-2x" aria-hidden="true"></a>';
    }
    return;
}

function vk_authorization()
{
    global $users;
    global $redirect_uri;
    global $id;
    global $appkey;
    if (!empty($_GET['code'])) {
        $code = $_GET['code'];
        $content = file_get_contents("https://oauth.vk.com/access_token?client_id=$id&client_secret=$appkey&redirect_uri=$redirect_uri&code=$code");
        $token2 = json_decode($content, true);
        $_SESSION['token'] = $token2['access_token'];
        $_SESSION['email'] = $token2['email'];
        $_SESSION['user_id'] = $token2['user_id'];
        $vkid = $_SESSION['user_id'];
        $token = $_SESSION['token'];
        if (isset($_SESSION['token'])) {
            $use = file_get_contents("https://api.vk.com/method/users.get?user_ids=$vkid&fields=$users&access_token=$token&v=5.92");
            $user = json_decode($use, true);
            foreach ($user['response'] as $item) {
                $_SESSION['name'] = $item['first_name'];
                $_SESSION['surname'] = $item['last_name'];
                $_SESSION['photo'] = $item['photo_max'];
            }
            $result = do_query("SELECT COUNT(*) as count FROM users WHERE `email` = '{$_SESSION['email']}'");
            $result = $result->fetch_object();
            if (empty($result->count)) {
                $wer = do_query("INSERT INTO `users` (`email`,`name`, `surname`,  `photo`, `users-id`, `token`) VALUES ('{$_SESSION['email']}','{$_SESSION['name']}','{$_SESSION['surname']}', '{$_SESSION['photo']}', '{$_SESSION['user_id']}', '{$_SESSION['token']}')");

            } else {
                $users = do_query("UPDATE `users` SET `token` = '" . $_SESSION['token'] . "' WHERE `email` = '" . $_SESSION['email'] . "'");
            }
            //         print_r($token2);
        }

    }


    /*<div class="block-icons">
                                                <i class="fa fa-facebook-official fa-2x" aria-hidden="true"></i>
                                                <i class="fa fa-odnoklassniki fa-2x" aria-hidden="true"></i>

                                                <i class="fa fa-instagram fa-2x" aria-hidden="true"></i>
                                            </div>                                                             */
    return;
}

//                vk_authorization();
/**
 *   Функцция favourites()
 * объявления в избранный
 */
//

function favourites()
{
    $class = 'fa-star';
    //global $class;
    // Если была нажжата кнопка в виде звезды
    if (isset($_POST['star'])) {
        // проверяет, Если пользователь авторизовался
        if (isset($_SESSION['id']) or isset($_SESSION['token'])) {
            $data = $_POST['star'];
            // Если кнопка равняется единице
            if ($data == '1') {
                $class = 'fa-star favo';
                // таблица с объявлениями
                $users = do_query("SELECT * FROM `ads`");
                foreach ($users as $user) {
                    echo '<pre>';
                    print_r($user);
                    echo '</pre>';
                }
                $_SESSION['post_id'] = $users['id'];
                // Если пост  найден

                if ($users) {
                    $favo = do_query("SELECT * FROM `favo`");
                    //$favo = $favo->fetch_assoc();
                    if ($favo) {
                        if (isset($_SESSION['id'])) {
                            $id = $_SESSION['id'];
                        } else {
                            $id = $_SESSION['user_id'];
                        }
                        $fa = do_query("INSERT INTO `favo` (`user_id`, `ads_id`) VALUES ('{$id}','{$_SESSION['post_id']}')");

                        if ($fa) {
                            // присвоится класс к кнопке

                            // если есть класс
                            if (isset($class)) {
//                                // добавится сесии
//                                $_SESSION['post_title'] = $users['title'];
//                                $_SESSION['post_price'] = $users['price'];
//                                $_SESSION['post_text'] = $users['text'];
//                                $_SESSION['post_photo_ads'] = $users['photo_ads'];
//                                $_SESSION['post_name'] = $users['name'];
//                                $_SESSION['post_date'] = $users['date'];
//                                $_SESSION['post_address'] = $users['address'];
//                                $_SESSION['post_phone'] = $users['phone'];
//                                $_SESSION['post_user'] = $users['users-id'];

                            }
                        }
                    }

                }
            }
        } else {
            echo '<div class="errors">Вы должны авторизоваться</div>';
        }
    }
    return true;
}

//favourites();
function group_photo_vk()
{

    $content = file_get_contents("https://api.vk.com/method/photos.get?owner_id=-70567817&album_id=194340901&count=50&access_token=48188f4b3d31e87bee34497e19813a6245ec18cee7522d098b1c2d2be2939ae418ba9ab7333c429e07a26&v=5.60");
    $photos = json_decode($content, true);
    foreach ($photos['response'] as $photo) {
        if (!empty(is_array($photo) || is_object($photo))) {
            foreach ($photo as $item) {
                if (isset($item['photo_1280'])) {
                    $img = $item['photo_1280'];
                } else {
                    $img = $item['photo_604'];
                }
                echo '<div class="col-lg-6 col-xs-12"><div class="slide"><img src="' . $img . '" class=""><div class="slide_post"><p><a href="https://vk.com/photo' . $item['owner_id'] . '_' . $item['id'] . '">Сcылка на фото</a></p></div></div></div>';
            }
        }
    }

    return;
}

function event_mail()
{
    if (isset($_POST)) {
        $data = $_POST;
        if (!empty($data)) {
            $messi = array(
                'Имя' => "{$data['name']}",
                'Почта' => "{$data['email']}",
                'Тема' => "{$data['topic']}",
                'Сообщение' => "{$data['text']}",
            );
            foreach ($messi as $key => $value) {
                $asd = $messi;
            }
            $mess = implode("", $asd);
            $to = 'segasle@yandex.ru';
            $subject = 'Обратная связь';
            $message = "$mess";
            $headers = 'From: segasle@kafe-lyi.ru' . "\r\n" .
                'Reply-To: segasle@kafe-lyi.ru' . "\r\n" .
                "Content-Type: text/plain; charset=\"UTF-8\"\r\n"
                . 'X-Mailer: PHP/' . phpversion();

            mail("$to", "$subject", "$message", "$headers");

        }
    }
    return;
}