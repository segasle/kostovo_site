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
    global $token;
    $out = '<div class="row">';
    $content2 = file_get_contents("https://api.vk.com/method/wall.get?owner_id=-70567817&count=1&extended=1&filter=all&access_token=6b3dcb09a02d5b169df16faeb42f9c192a94b804697aaf1b1cc17bc9289c46893523fe04436fa7731d46b&v=5.60");
    $elements2 = json_decode($content2, true);
    foreach ($elements2 as $value) {
        foreach ($value['items'] as $item) {
            // print_r($item);
            $data = date('d.m.Y h:m', $item['date']);
            $out .= '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4"><div class="post"><p>' . $item['text'] . '</p>';
            foreach ($item['attachments'] as $key => $values) {
                foreach ($values as $element) {
                    echo '<pre>';
                    print_r($element);
                    echo '</pre>';

                    $out2 = '<img src="' . $element['photo_604'] . '" class="post_img">' . '<p>' . $data . '</p></div></div>';
                }
            }
            $content2 = $out . $out2;

        }
//        foreach ($value as $item) {

  //      }
    }
    $content2 .= ' </div > ';
    echo $content2;
    return;
}
