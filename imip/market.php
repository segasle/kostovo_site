<h1 class="text-center">Барахолка</h1>
<form method="post" class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
        <div class="form-group">
            <?php
            selected();
            ?>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
        <div class="form-group">
            <input type="search" class="form-control" name="search" placeholder="Поиск">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
        <div class="form-group">
            <button type="submit" class="btn-primary btn" name="submit">Найти</button>
        </div>
    </div>
</form>
<div class="row">
    <?php
    if (isset($_POST['submit'])) {
        search();
    } else {
        $post = do_query("SELECT * FROM `ads`, `users` WHERE users.email = ads.author_id");
        while ($us = mysqli_fetch_assoc($post)) {
            echo '<pre>';
            print_r($us);
            echo '</pre>';
            $title = $us['title'];
            $text = $us['text'];
            $price = $us['price'];
            $data = new DateTime($us['date']);
            $name = $us['name'];
            if (!empty($us['photo_ads'])) {
                $img = '<img src="ads_img/' . $us['photo_ads'] . '" class="post_img">';
            } else {
                $img = '<div class="post_no-img"><p>Нет фото</p></div>';
            }
            if (!empty($us['users-id'])) {
                $link = '<a href="https://vk.com/id' . $us['users-id'] . '">Ссылка на профиль</a>';
            } else {
                $link = '<a href="tel:' . $us['phone'] . '">' . $us['phone'] . '</a>';
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
                            <div class="post_info">
                                <p>Продавец:<?php echo ' ' . $name . ' '.$link; ?></p>
                            </div>

                            <div class="post_data"><p><?php echo $data->format('d:m:Y H:m:s'); ?></p></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    ?>
</div>

