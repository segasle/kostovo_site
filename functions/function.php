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
    include 'imip/' . $file . '.php';
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
function input_reg()
{
    $sql = do_query('SELECT * FROM `input_reg`');
    $output = "<form method='post' action=''>";
    foreach ($sql as $r) {
        $output .= "<div class='form-group'><label for='".$r['for']."'>".$r['text']."</label><input class='form-control' type='".$r['type']."' name='".$r['name']."' placeholder='".$r['placeholder']."' id='".$r['for']."' ></div>";
    }
    $output .= "</form>";
    echo $output;
    return;
}
function link_reg()
{
    $sql = do_query('SELECT * FROM `reg`');
    $output = "";
    foreach ($sql as $r) {
        $output .= "<p>".$r['description']."<a href='" . $r['url'] . "'>"." " . $r['title'] . "</a></p>";
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
    foreach ($elements2 as $value) {
        foreach ($value['profiles'] as $profile) {
        $fio = $profile['first_name'] . ' ' . $profile['last_name'];
            $link = $profile['screen_name'];
          
        }
        foreach ($value['items'] as $item) {
            $link_post = $item['from_id'].'_'.$item['id'];
            $data = date('d.m.Y h:m', $item['date']);
            $text = $item['text'];
  //            print_r($value);
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
            $out .= '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4"><div class="post"><p class="post_text">' . $text . '</p>'.'<img src="' . $img .'" class="post_img">' . '<a class="post_link" href="https://vk.com/' . $link . '" target="_blank">' . $fio . '</a>' . '<p class="post_data">' . $data . '</p><a href="https://vk.com/wall'.$link_post.'" target="_blank">Ссылка на пост</a></div></div>';
        }
    }
    $out .= '</div>';

    echo $out;
    return;
}
//get_post_vk();