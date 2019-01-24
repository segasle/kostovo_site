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
    if (file_exists('imip/' . $file . '.php')) {
        include 'imip/' . $file . '.php';
    } else {
        include 'users/' . $file . '.php';
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
        $out .= '<a href="' . $item['url'] . '" class="' . $item['class'] . ' img_icons"></a>';
    }
    $out .= '</div>';
    echo $out;
    return;
}

function get_post_vk()
{
    $out = '<div class="row">';
    $content2 = file_get_contents("https://api.vk.com/method/wall.get?owner_id=-70567817&count=100&extended=1&filter=all&access_token=6b3dcb09a02d5b169df16faeb42f9c192a94b804697aaf1b1cc17bc9289c46893523fe04436fa7731d46b&v=5.60");
    $elements2 = json_decode($content2, true);
    if (!empty($_GET['page'])) {
        $page = $_GET['page'];
        if (0 > $page) {
            $page = 1;
        }
    } else {
        $page = 1;
    }
    foreach ($elements2 as $value) {
        foreach ($value['profiles'] as $profile) {
            $fio = $profile['first_name'] . ' ' . $profile['last_name'];
            $link = $profile['screen_name'];
        }
        foreach ($value['items'] as $item) {
            $link_post = $item['from_id'] . '_' . $item['id'];
            $data = date('d.m.Y h:m', $item['date']);
            $text = $item['text'];
            if (isset($item['attachments'])) {
                if (is_array($item['attachments']) || is_object($item['attachments'])) {
                    foreach ($item['attachments'] as $key => $values) {
                        if (isset($values['photo'])) {
                            $img = $values['photo']['photo_604'];//;
                        } else {
                            $img = '';
                        }
                    }
                }
            }
            $out .= '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4"><div class="post"><p class="post_text">' . $text . '</p>' . '<img src="' . $img . '" class="post_img">' . '<a class="post_link" href="https://vk.com/' . $link . '" target="_blank">' . $fio . '</a>' . '<p class="post_data">' . $data . '</p><a href="https://vk.com/wall' . $link_post . '" target="_blank">Ссылка на пост</a></div></div>';
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
        if (!isset($data['checkbox'])) {
            $errors[] = 'Не поставили галочку';
        }
        if (trim($data['name']) == '') {
            $errors[] = 'Вы не ввели имя';

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
        if ($data['password1'] <= 6) {
            $errors[] = 'короткий пароль';
        }
        if ($data['password2'] != $data['password1']) {
            $errors[] = 'Вы не правильно ввели пароль';
        }
        if (empty($errors)) {
            $result = do_query("SELECT COUNT(*) as count FROM users WHERE `email` = '{$data['email']}'");
            $result = $result->fetch_object();
            if (empty($result->count)) {
                // сохраняет все данные в БД
                $wer = do_query("INSERT INTO users (`name`,`email`, `password`) VALUES ('{$data['name']}','{$data['email']}','" . password_hash($data['password2'], PASSWORD_DEFAULT) . "')");
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
            if (password_verify($password, $resilt['password'])) {
                $_SESSION['outh'] = true;
                $_SESSION['id'] = $resilt['id'];
                $_SESSION['email'] = $resilt['email'];
                $_SESSION['name'] = $resilt['name'];
                $_SESSION['photo'] = $resilt['photo'];
                $_SESSION['phone'] = $resilt['phone'];
                $_SESSION['surname'] = $resilt['surname'];
                header('location: ?page=main');
            } else {
                echo '<div class="errors">Пароль не верный</div>';
            }
        } else {
            echo '<div class="errors">Пользоаатель не найден</div>';
        }
    }
    return;
}

function auto_users()
{
    if (isset($_SESSION['id'])) {
        echo '<button class="btn btn-primary modal-open float-left">Привет, ' . $_SESSION['name'] . '!</button><form method="post" class="float-left"><button type="submit" class="btn btn-primary modal-open" name="input">Выйти</button></form>';
        if (isset($_POST['input'])) {
            unset($_SESSION['id']);
            header('location: ?page=main');
        }
    } else {
        echo ' <button type="button" class="btn btn-primary modal-open" data-toggle="modal"
                                    data-target="#exampleModal">
                                <span class="fa fa-user-circle-o fa-1x">Авторизоваться</span>
                            </button>';
    }

    return;
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
        if (trim($data['name']) == '') {
            $errors[] = "Вы не ввели имя";
        }
        if (trim($data['familia']) == '') {
            $errors[] = "Вы не ввели фамилию";
        }

        if (!preg_match("/(^(?!\+.*\(.*\).*\-\-.*$)(?!\+.*\(.*\).*\-$)(\+[0-9]{1,3}\([0-9]{1,3}\)[0-9]{1}([-0-9]{0,8})?([0-9]{0,1})?)$)|(^[0-9]{1,4}$)/", "$phone")) {
            $errors[] = "Вы непраильно ввели номер телефона, пример: +7(915)5473712";
        }

        if (empty($errors)) {
            $users = do_query("UPDATE `users` SET `surname` ='" . $data['familia'] . "', `phone` = '" . $phone . "', `name` = '" . $data['name'] . "' WHERE `email` = '" . $_SESSION['email'] . "'");
            if ($users) {
                echo '<div class="go">Данные обновлены</div>';
            }
        } else {
            echo '<div class="errors">' . array_shift($errors) . '</div>';
        }

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
        if ($data['title'] == '') {
            $errors[] = 'Введите пожалуйста заголовок';
        }
        if ($data['title'] > 5) {
            $errors[] = 'Короткий заголовок';
        }
        if ($price == '') {
            $errors[] = 'Укажите пожалуйста цену';
        }
        if (!preg_match("/^(?!0.*$)([0-9]{1,3}(,[0-9]{3})?(,[0-9]{3})?(\.[0-9]{2})?)$/", "$price")) {
            $errors[] = 'Должны быть только цифры';
        }
        if ($data['text'] == '') {
            $errors[] = 'Введите текст о вещи/услуги';
        }
        if ($data['text'] > 10) {
            $errors[] = 'Мало символов';
        }
        if (empty($errors)) {
            if (!empty($data['file'])){
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
                                        $result = do_query("SELECT COUNT(*) as count FROM `ads`, `users` WHERE `title` = '{$data['title']}' AND `email` = '" . $_SESSION['email'] . "'");
                                        $result = $result->fetch_object();
                                        if (empty($result->count)) {
                                            $wer = do_query("INSERT INTO `ads` (`vaul`,`title`, `price`,  `text`, `photo`) VALUES ('{$data['value']}','{$data['title']}','{$data['price']}', '{$data['text']}','{$file}')");
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
            }
            else {
                $result = do_query("SELECT COUNT(*) as count FROM `ads`, `users` WHERE `title` = '{$data['title']}' AND `email` = '" . $_SESSION['email'] . "'");
                $result = $result->fetch_object();
                if (empty($result->count)) {
                    $wer = do_query("INSERT INTO `ads` (`vaul`,`title`, `price`,  `text`) VALUES ('{$data['value']}','{$data['title']}','{$data['price']}', '{$data['text']}')");
                    if (!empty($wer)) {
                        echo '<div class="go">Успешно подано</div>';
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
function search ($query)
{
    $query = trim($query);
    ///$query = mysqli_real_escape_string($query);
    $query = htmlspecialchars($query);
    if (!empty($query))
    {
        if (strlen($query) < 3) {
            $text = '<p>Слишком короткий поисковый запрос.</p>';
        } else if (strlen($query) > 128) {
            $text = '<p>Слишком длинный поисковый запрос.</p>';
        } else {
            $q = do_query("SELECT `id`, `title`, `text`, `vaul`
                  FROM `ads` WHERE `text` LIKE '%$query%'
                  OR `title` LIKE '%$query%' OR `vaul` LIKE '%$query%'");
            if (mysqli_affected_rows() > 0) {
                $row = mysqli_fetch_assoc($q);
                $num = mysqli_num_rows($q);
                $text = '<p>По запросу <b>'.$query.'</b> найдено совпадений: '.$num.'</p>';
                do {
                    // Делаем запрос, получающий ссылки на статьи
                    $q1 = do_query("SELECT `title` FROM `ads` WHERE `text` = '$row[id]'");


                    if (mysqli_affected_rows() > 0) {
                        $us = mysqli_fetch_assoc($q1);
                    }
                    $title = $us['title'];
                    $text = $us['text'];
                    $price = $us['price'];
                    $data = new DateTime($us['date']);
                    if (!empty($us['photo'])) {
                        $img = '<img src="ads_img/' . $us['photo'] . '" class="post_img">';
                    } else {
                        $img = '<div class="post_no-img"><p>Нет фото</p></div>';
                    }
                    $text .= '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-2">
            <div class="post">'.$img.'
                <div class="post_title">
                    <p>'. $title.'</p>
                </div>
                <div class="post_text"><p>'. $text.'</p></div>
                <div class="post_price"><p class="fa fa-rub">'.$price.'</p></div>
                <div class="post_data"><p>' .$data->format('d:m:Y H:m:s').'</p></div>
            </div>
        </div>';

                } while ($row = mysqli_fetch_assoc($q));
            } else {
                $text = '<p>По вашему запросу ничего не найдено.</p>';
            }
        }
    } else {
        $text = '<p>Задан пустой поисковый запрос.</p>';
    }

    return $text;
}