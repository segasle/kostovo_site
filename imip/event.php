<h1 class="text-center">Мероприятия</h1>
<?php
$link = 'https://www.kostrovodk.ru/meropriyatiya';
echo '<p class="h5">Контент взят с официального сайта <a href="'.$link.'">ДК  Кострово</a><p>';
require 'panser/simple_html_dom.php';
$content = file_get_html("$link");

foreach ($content->find('div#comp-in8s4jllinlineContent') as $item){
    echo $item;
  //  print_r($item);
}