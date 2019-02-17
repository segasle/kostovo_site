<h1 class="text-center">Мероприятия</h1>
<?php
$link = 'https://www.kostrovodk.ru/meropriyatiya';
echo '<p class="h5">Контент взят с официального сайта <a href="'.$link.'">ДК  Кострово</a></p>';
require 'panser/simple_html_dom.php';
$content = file_get_html("$link");

foreach ($content->find('div#comp-in8s4jll_TeamListView_i6m8gew6109_dup_i6qm3pfb338_dup_i6ro0rw0157_dup_i70h8xkx181_dup_i7ek4o403_imomtrwe_in8s4jm2_Array__0_0_paginatedlistinlineContent') as $item){
    echo $item;
  //  echo '</div>';
    //  print_r($item);
}
