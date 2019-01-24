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
    $post = do_query("SELECT * FROM `ads`");
    while ($us = mysqli_fetch_array($post)) {
        $title = $us['title'];
        $text = $us['text'];
        $price = $us['price'];
        $data = new DateTime($us['date']);
        if (!empty($us['photo'])) {
            $img = '<img src="ads_img/' . $us['photo'] . '" class="post_img">';
        } else {
            $img = '<div class="post_no-img"><p>Нет фото</p></div>';
        }
        ?>

        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2">
            <div class="post"><?php echo $img; ?>
                <div class="post_title">
                    <p><?php echo $title;?></p>
                </div>
                <div class="post_text"><p><?php echo $text;?></p></div>
                <div class="post_price"><p class="fa fa-rub"><?php echo $price;?></p></div>
                <div class="post_data"><p><?php echo $data->format('d:m:Y H:m:s');?></p></div>
            </div>
        </div>

        <?php
    } ?>
</div>

