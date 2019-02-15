<h1 class="text-center">Мероприятия</h1>
<?php
$content = file_get_contents("https://www.kostrovodk.ru/meropriyatiya");
//$js = json_decode($content, true);
$js = explode('<div id="comp-in8s4jllinlineContent"', $content);
print_r($js);
