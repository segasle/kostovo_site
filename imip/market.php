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
        $sql = do_query("SELECT * FROM `ads`, `users` WHERE users.email = ads.author_id");
        post_tempate($sql);
    }
    ?>
</div>

