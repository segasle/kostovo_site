<h1 class="text-center">История</h1>
<?php
if (isset($_SESSION['token'])) {
    ?>
    <h2 class="h4">Вы можете написать пост</h2>
    <form class="form-horizontal" method="post">
        <div class="form-group">
            <label for="exampleInputText">Текст</label>
            <textarea class="form-control" id="exampleInputText" placeholder="Текст" rows="10" name="text"></textarea>
        </div>
      <!--  <div class="form-group">
            <p>Выберите фото</p>
            <input type="file" id="exampleInputFile" accept="image/jpeg,image/png" name="file" class="inputfile hide"
                   data-multiple-caption="{count} files selected" multiple> <label for="exampleInputFile"
                                                                                   class="btn-primary btn btn-default"><span>Выбрать</span></label>
        </div>-->
        <div class="form-group"><label for="chexkbox"><input id="chexkbox" type="checkbox" name="chexkbox" value="1">Анон</label></div>
        <button type="submit" class="btn btn-default btn-primary" name="submit">Отправить</button>

    </form>
    <?php
} else {
    ?>
    <h2 class="text-center">Авторизуйтесь через вк пожалуйста, чтобы написать пост</h2>
    <?php
}

if (isset($_POST['submit'])){
    $data = $_POST;
    $errors = array();
    if (empty($data['text'])){
        $errors[] = 'Вы не ввели сообщения';
    }
    if (empty($errors)){
        global $owner_id;
        if (isset($data['checkbox']) && $data['chexkbox'] == 1){
            $content = file_get_contents("https://api.vk.com/method/wall.post?owner_id=$owner_id&message='".$data['text']."'&signed=0&'".$_SESSION['token']."'&v=5.70");
            $js = json_decode($content, true);
        }else{
            $content = file_get_contents("https://api.vk.com/method/wall.post?owner_id=$owner_id&message='".$data['text']."'&signed=1&'".$_SESSION['token']."'&v=5.70");
            $js = json_decode($content, true);
        }
        /*$message = do_query("INSERT INTO `post` (`text`, `user`) VALUES ('{$data['text']}', '{$_SESSION['user_id']}')");
        if ($message){
            $get =mysqli_fetch_assoc(do_query("SELECT * FROM `post`, `users` WHERE users.users-id = post.user"));
            print_r($get);

            echo '<div class="go">Успешно отправлено</div>';
        } */
    }else{
        echo '<div class="errors">'.array_shift($errors).'</div>';
    }
}
get_post_vk();