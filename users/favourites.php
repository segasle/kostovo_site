<?php
if (isset($_SESSION['id']) or isset($_SESSION['token'])){
    if (isset($_SESSION['post_title']) and isset($_SESSION['post_price']) and isset($_SESSION['post_text']) and isset($_SESSION['post_photo_ads']) and isset( $_SESSION['post_name']) and isset($_SESSION['post_date']) and isset($_SESSION['post_address']) and isset($_SESSION['post_phone']) and isset($_SESSION['post_user'])){
        $sql = do_query("SELECT * FROM `ads`, `users` WHERE users.email = ads.author_id");
        post_tempate($sql);






    }
}