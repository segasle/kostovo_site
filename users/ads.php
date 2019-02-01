<h1 class="text-center">Мои объявления</h1>
<?php
$user = do_query("SELECT * FROM `ads` WHERE ads.author_id = '{$_SESSION['email']}'");
while ($us = mysqli_fetch_assoc($user)) {
    $title = $us['title'];
    $text = $us['text'];
    $price = $us['price'];
    $data = new DateTime($us['date']);
    if (!empty($us['photo_ads'])) {
        $img = '<img src="ads_img/' . $us['photo_ads'] . '" class="post_img">';
    } else {
        $img = '<div class="post_no-img"><p>Нет фото</p></div>';
    }
    ?>
    <div class="col-12">
        <div class="post">
            <div class="row">
                <div class="col-xs-12 col-md-2">
                    <?php echo $img; ?>
                </div>
                <div class="col-xs-12 col-md-10">
                    <div class="post_title">
                        <p><?php echo $title; ?></p>
                    </div>
                    <div class="post_text"><p><?php echo $text; ?></p></div>
                    <div class="post_price"><p class="fa fa-rub"><?php echo $price; ?></p></div>
                    <div class="post_data"><p><?php echo $data->format('d:m:Y H:m:s'); ?></p></div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
