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
    if (isset($data['submit'])) {
        $email = $data['email'];
        $password = $data['password'];


        $resilt = mysqli_fetch_assoc(do_query("SELECT * FROM `users` WHERE `email` ='" . $email . "'"));
        //var_dump($resilt['password']);
        if ($resilt) {

            if (password_verify($password, $resilt['password'])) {
                //echo '<div class="go"></div>';
                $_SESSION['outh'] = true;
                $_SESSION['id'] = $resilt['id'];
                $_SESSION['email'] = $resilt['email'];
                $_SESSION['name'] = $resilt['name'];
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
        echo '<a href="?page=profile" class="btn btn-primary modal-open">Привет, ' . $_SESSION['name'] . '!</a><form method="post"><button type="submit" class="btn btn-primary modal-open" name="input">Выйти</button></form>';
        if (isset($_POST['input'])){
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
