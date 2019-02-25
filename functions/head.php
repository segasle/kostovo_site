<?php
$meta = do_query("SELECT * FROM `meta_title`");
foreach ($meta as $item){

    global $title;
    if (basename($_SERVER['REQUEST_URI']) == '?page=main' or basename($_SERVER['REQUEST_URI']) == $item['page']) {
        $title = $item['title'];
    }
}