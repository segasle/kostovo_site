<h1 class="text-center">Мероприятия</h1>
<?php
require 'panser/simple_html_dom.php';
$content = file_get_html("https://www.kostrovodk.ru/meropriyatiya");

foreach ($content->find('div#comp-in8s4jllinlineContent') as $item){
    echo $item;
  //  print_r($item);
}